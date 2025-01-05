<?php
/**
 * The Axo module.
 *
 * @package WooCommerce\PayPalCommerce\Axo
 */

declare(strict_types=1);

namespace WooCommerce\PayPalCommerce\Axo;

use Psr\Log\LoggerInterface;
use WooCommerce\PayPalCommerce\ApiClient\Authentication\SdkClientToken;
use WooCommerce\PayPalCommerce\ApiClient\Exception\PayPalApiException;
use WooCommerce\PayPalCommerce\ApiClient\Exception\RuntimeException;
use WooCommerce\PayPalCommerce\Axo\Assets\AxoManager;
use WooCommerce\PayPalCommerce\Axo\Gateway\AxoGateway;
use WooCommerce\PayPalCommerce\Button\Assets\SmartButtonInterface;
use WooCommerce\PayPalCommerce\Onboarding\Render\OnboardingOptionsRenderer;
use WooCommerce\PayPalCommerce\Vendor\Dhii\Container\ServiceProvider;
use WooCommerce\PayPalCommerce\Vendor\Dhii\Modular\Module\ModuleInterface;
use WooCommerce\PayPalCommerce\Vendor\Interop\Container\ServiceProviderInterface;
use WooCommerce\PayPalCommerce\Vendor\Psr\Container\ContainerInterface;
use WooCommerce\PayPalCommerce\WcGateway\Gateway\CreditCardGateway;
use WooCommerce\PayPalCommerce\WcGateway\Settings\Settings;
use WooCommerce\PayPalCommerce\WcGateway\Helper\CartCheckoutDetector;
use WooCommerce\PayPalCommerce\WcGateway\Settings\SettingsListener;
use WooCommerce\PayPalCommerce\WcSubscriptions\Helper\SubscriptionHelper;
/**
 * Class AxoModule
 */
class AxoModule implements ModuleInterface {
	/**
	 * {@inheritDoc}
	 */
	public function setup(): ServiceProviderInterface {
		return new ServiceProvider(
			require __DIR__ . '/../services.php',
			require __DIR__ . '/../extensions.php'
		);
	}

	/**
	 * {@inheritDoc}
	 */
	public function run( ContainerInterface $c ): void {

		add_filter(
			'woocommerce_payment_gateways',
			/**
			 * Param types removed to avoid third-party issues.
			 *
			 * @psalm-suppress MissingClosureParamType
			 */
			function ( $methods ) use ( $c ): array {
				if ( ! is_array( $methods ) ) {
					return $methods;
				}

				$gateway = $c->get( 'axo.gateway' );

				// Check if the module is applicable, correct country, currency, ... etc.
				if ( ! $c->get( 'axo.eligible' ) ) {
					return $methods;
				}

				// Add the gateway in admin area.
				if ( is_admin() ) {
					// $methods[] = $gateway; - Temporarily remove Fastlane from the payment gateway list in admin area.
					return $methods;
				}

				if ( is_user_logged_in() ) {
					return $methods;
				}

				$settings = $c->get( 'wcgateway.settings' );
				assert( $settings instanceof Settings );

				$is_paypal_enabled = $settings->has( 'enabled' ) && $settings->get( 'enabled' ) ?? false;
				$is_dcc_enabled    = $settings->has( 'dcc_enabled' ) && $settings->get( 'dcc_enabled' ) ?? false;

				if ( ! $is_paypal_enabled || ! $is_dcc_enabled ) {
					return $methods;
				}

				if ( $this->is_excluded_endpoint() ) {
					return $methods;
				}

				if ( ! $this->is_compatible_shipping_config() ) {
					return $methods;
				}

				$methods[] = $gateway;
				return $methods;
			},
			1,
			9
		);

		// Hides credit card gateway on checkout when using Fastlane.
		add_filter(
			'woocommerce_available_payment_gateways',
			/**
			 * Param types removed to avoid third-party issues.
			 *
			 * @psalm-suppress MissingClosureParamType
			 */
			function ( $methods ) use ( $c ): array {
				if ( ! is_array( $methods ) || ! $c->get( 'axo.eligible' ) ) {
					return $methods;
				}

				if ( apply_filters(
					'woocommerce_paypal_payments_axo_hide_credit_card_gateway',
					$this->hide_credit_card_when_using_fastlane( $methods, $c )
				) ) {
					unset( $methods[ CreditCardGateway::ID ] );
				}

				return $methods;
			}
		);

		// Force 'cart-block' and 'cart' Smart Button locations in the settings.
		add_action(
			'admin_init',
			static function () use ( $c ) {
				$listener = $c->get( 'wcgateway.settings.listener' );
				assert( $listener instanceof SettingsListener );

				$settings = $c->get( 'wcgateway.settings' );
				assert( $settings instanceof Settings );

				$listener->filter_settings(
					$settings->has( 'axo_enabled' ) && $settings->get( 'axo_enabled' ),
					'smart_button_locations',
					function( array $existing_setting_value ) {
						$axo_forced_locations = array( 'cart-block', 'cart' );
						return array_unique( array_merge( $existing_setting_value, $axo_forced_locations ) );
					}
				);
			}
		);

		add_action(
			'wp_loaded',
			function () use ( $c ) {
				$module = $this;

				$settings = $c->get( 'wcgateway.settings' );
				assert( $settings instanceof Settings );

				$is_paypal_enabled = $settings->has( 'enabled' ) && $settings->get( 'enabled' ) ?? false;

				$subscription_helper = $c->get( 'wc-subscriptions.helper' );
				assert( $subscription_helper instanceof SubscriptionHelper );

				// Check if the module is applicable, correct country, currency, ... etc.
				if ( ! $is_paypal_enabled
					|| ! $c->get( 'axo.eligible' )
					|| 'continuation' === $c->get( 'button.context' )
					|| $subscription_helper->cart_contains_subscription()
					|| ! $this->is_compatible_shipping_config() ) {
					return;
				}

				$manager = $c->get( 'axo.manager' );
				assert( $manager instanceof AxoManager );

				// Enqueue frontend scripts.
				add_action(
					'wp_enqueue_scripts',
					static function () use ( $c, $manager, $module ) {

						$smart_button = $c->get( 'button.smart-button' );
						assert( $smart_button instanceof SmartButtonInterface );

						if ( $module->should_render_fastlane( $c ) && $smart_button->should_load_ppcp_script() ) {
							$manager->enqueue();
						}
					}
				);

				// Render submit button.
				add_action(
					$manager->checkout_button_renderer_hook(),
					static function () use ( $c, $manager ) {
						$manager->render_checkout_button();
					}
				);

				/**
				 * Param types removed to avoid third-party issues.
				 *
				 * @psalm-suppress MissingClosureParamType
				 */
				add_filter(
					'woocommerce_paypal_payments_sdk_components_hook',
					function( $components ) {
						$components[] = 'fastlane';
						return $components;
					}
				);

				add_action(
					'wp_head',
					function () use ( $c ) {
						// phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedScript
						echo '<script async src="https://www.paypalobjects.com/insights/v1/paypal-insights.sandbox.min.js"></script>';

						// Add meta tag to allow feature-detection of the site's AXO payment state.
						$settings = $c->get( 'wcgateway.settings' );
						assert( $settings instanceof Settings );

						$this->add_feature_detection_tag(
							$settings->has( 'axo_enabled' ) && $settings->get( 'axo_enabled' )
						);
					}
				);

				add_filter(
					'woocommerce_paypal_payments_localized_script_data',
					function( array $localized_script_data ) use ( $c, $module ) {
						$api = $c->get( 'api.sdk-client-token' );
						assert( $api instanceof SdkClientToken );

						$logger = $c->get( 'woocommerce.logger.woocommerce' );
						assert( $logger instanceof LoggerInterface );

						return $module->add_sdk_client_token_to_script_data( $api, $logger, $localized_script_data );
					}
				);

				add_filter(
					'ppcp_onboarding_dcc_table_rows',
					/**
					 * Param types removed to avoid third-party issues.
					 *
					 * @psalm-suppress MissingClosureParamType
					 */
					function ( $rows, $renderer ): array {
						if ( ! is_array( $rows ) ) {
							return $rows;
						}

						if ( $renderer instanceof OnboardingOptionsRenderer ) {
							$rows[] = $renderer->render_table_row(
								__( 'Fastlane by PayPal', 'woocommerce-paypal-payments' ),
								__( 'Yes', 'woocommerce-paypal-payments' ),
								__( 'Help accelerate guest checkout with PayPal\'s autofill solution.', 'woocommerce-paypal-payments' )
							);
						}
						return $rows;
					},
					10,
					2
				);

				// Set Axo as the default payment method on checkout for guest customers.
				add_action(
					'template_redirect',
					function () use ( $c ) {

						if ( $this->should_render_fastlane( $c ) ) {
							WC()->session->set( 'chosen_payment_method', AxoGateway::ID );
						}
					}
				);

				// Add the markup necessary for displaying overlays and loaders for Axo on the checkout page.
				$this->add_checkout_loader_markup( $c );
			},
			1
		);

		add_action(
			'wc_ajax_' . FrontendLoggerEndpoint::ENDPOINT,
			static function () use ( $c ) {
				$endpoint = $c->get( 'axo.endpoint.frontend-logger' );
				assert( $endpoint instanceof FrontendLoggerEndpoint );

				$endpoint->handle_request();
			}
		);
	}

	/**
	 * Adds id token to localized script data.
	 *
	 * @param SdkClientToken  $api User id token api.
	 * @param LoggerInterface $logger The logger.
	 * @param array           $localized_script_data The localized script data.
	 * @return array
	 */
	private function add_sdk_client_token_to_script_data(
		SdkClientToken $api,
		LoggerInterface $logger,
		array $localized_script_data
	): array {
		try {
			$sdk_client_token             = $api->sdk_client_token();
			$localized_script_data['axo'] = array(
				'sdk_client_token' => $sdk_client_token,
			);

		} catch ( RuntimeException $exception ) {
			$error = $exception->getMessage();
			if ( is_a( $exception, PayPalApiException::class ) ) {
				$error = $exception->get_details( $error );
			}

			$logger->error( $error );
		}

		return $localized_script_data;
	}

	/**
	 * Returns the key for the module.
	 *
	 * @return string|void
	 */
	public function getKey() {
	}

	/**
	 * Condition to evaluate if Credit Card gateway should be hidden.
	 *
	 * @param array              $methods WC payment methods.
	 * @param ContainerInterface $c The container.
	 * @return bool
	 */
	private function hide_credit_card_when_using_fastlane( array $methods, ContainerInterface $c ): bool {
		return $this->should_render_fastlane( $c ) && isset( $methods[ CreditCardGateway::ID ] );
	}

	/**
	 * Condition to evaluate if Fastlane should be rendered.
	 *
	 * Fastlane should only render on the classic checkout, when Fastlane is enabled in the settings and also only for guest customers.
	 *
	 * @param ContainerInterface $c The container.
	 * @return bool
	 */
	private function should_render_fastlane( ContainerInterface $c ): bool {
		$settings = $c->get( 'wcgateway.settings' );
		assert( $settings instanceof Settings );

		$is_axo_enabled = $settings->has( 'axo_enabled' ) && $settings->get( 'axo_enabled' ) ?? false;
		$is_dcc_enabled = $settings->has( 'dcc_enabled' ) && $settings->get( 'dcc_enabled' ) ?? false;

		return ! is_user_logged_in()
			&& CartCheckoutDetector::has_classic_checkout()
			&& $this->is_compatible_shipping_config()
			&& $is_axo_enabled
			&& $is_dcc_enabled
			&& ! $this->is_excluded_endpoint();
	}

	/**
	 * Adds the markup necessary for displaying overlays and loaders for Axo on the checkout page.
	 *
	 * @param ContainerInterface $c The container.
	 * @return void
	 */
	private function add_checkout_loader_markup( ContainerInterface $c ): void {

		if ( $this->should_render_fastlane( $c ) ) {
			add_action(
				'woocommerce_checkout_before_customer_details',
				function () {
					echo '<div class="ppcp-axo-loading">';
				}
			);

			add_action(
				'woocommerce_checkout_after_customer_details',
				function () {
					echo '</div>';
				}
			);

			add_action(
				'woocommerce_checkout_billing',
				function () {
					echo '<div class="loader"><div class="ppcp-axo-overlay"></div>';
				},
				8
			);

			add_action(
				'woocommerce_checkout_billing',
				function () {
					echo '</div>';
				},
				12
			);
		}
	}

	/**
	 * Condition to evaluate if the current endpoint is excluded.
	 *
	 * @return bool
	 */
	private function is_excluded_endpoint(): bool {
		// Exclude the Order Pay endpoint.
		return is_wc_endpoint_url( 'order-pay' );
	}

	/**
	 * Condition to evaluate if the shipping configuration is compatible.
	 *
	 * @return bool
	 */
	private function is_compatible_shipping_config(): bool {
		return ! wc_shipping_enabled() || ( wc_shipping_enabled() && ! wc_ship_to_billing_address_only() );
	}

	/**
	 * Outputs a meta tag to allow feature detection on certain pages.
	 *
	 * @param bool $axo_enabled Whether the gateway is enabled.
	 * @return void
	 */
	private function add_feature_detection_tag( bool $axo_enabled ) {
		$show_tag = is_checkout() || is_cart() || is_shop();

		if ( ! $show_tag ) {
			return;
		}

		printf(
			'<meta name="ppcp.axo" content="ppcp.axo.%s" />',
			$axo_enabled ? 'enabled' : 'disabled'
		);
	}
}
