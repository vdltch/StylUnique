<?php
/**
 * Mailerlite handler of the plugin.
 *
 * @package    Blossomthemes_Email_Newsletter
 * @subpackage Blossomthemes_Email_Newsletter/includes
 * @author    blossomthemes
 */
use MailerLiteApi\MailerLite;
use GuzzleHttp\Client as GuzzleClient;
use Http\Adapter\Guzzle7\Client as GuzzleAdapter;
class Blossomthemes_Email_Newsletter_Mailerlite {

	/*Function to add main mailchimp action*/
	function bten_mailerlite_action( $email, $sid, $fname ) {
		if ( ! empty( $email ) && ! filter_var( $email, FILTER_VALIDATE_EMAIL ) === false ) {
			// mailerlite API credentials
			$blossomthemes_email_newsletter_setting = get_option( 'blossomthemes_email_newsletter_settings', true );
			$apiKey                                 = $blossomthemes_email_newsletter_setting['mailerlite']['api-key'];

			if ( ! empty( $apiKey ) ) {
				// Check if server is local.
				$is_local = ( $_SERVER['SERVER_ADDR'] === '127.0.0.1' || $_SERVER['SERVER_ADDR'] === '::1' );

				// Create an options array for the Guzzle HTTP client. If the server is localhost, disable SSL verification by setting 'verify' to false.
				$guzzle_client_options = array(
					'verify' => ! $is_local,
				);

				// Instantiate a new Guzzle HTTP client with the specified options.
				$guzzle_client = new GuzzleClient( $guzzle_client_options );

				// Create a new Guzzle adapter. This adapter allows the MailerLite client to send HTTP requests using the Guzzle HTTP client.
				$http_adapter = new GuzzleAdapter( $guzzle_client );

				// Instantiate a new MailerLite client with the provided API key and the Guzzle adapter.
				$mailer_lite_client = new MailerLite( $apiKey, $http_adapter );
				$groupsApi          = $mailer_lite_client->groups();
				$subscriber         = array(
					'email' => $email,
					'name'  => $fname,
				);

				$obj  = new BlossomThemes_Email_Newsletter_Settings();
				$data = $obj->mailerlite_lists();

				if ( ! empty( $data ) ) {
					$listids = get_post_meta( $sid, 'blossomthemes_email_newsletter_setting', true );

					if ( ! isset( $listids['mailerlite']['list-id'] ) ) {
						$listid          = $blossomthemes_email_newsletter_setting['mailerlite']['list-id'];
						$addedSubscriber = $groupsApi->addSubscriber( $listid, $subscriber, 1 ); // returns added subscriber
						$response        = isset( $addedSubscriber->error ) ? $addedSubscriber->error->message : '200';

					} else {
						foreach ( $listids['mailerlite']['list-id'] as $key => $value ) {
							$addedSubscriber = $groupsApi->addSubscriber( $key, $subscriber, 1 );
						}
						$response = isset( $addedSubscriber->error ) ? $addedSubscriber->error->message : '200';
					}
				}
			}
			return $response;
		}
	}
}
new Blossomthemes_Email_Newsletter_Mailerlite();
