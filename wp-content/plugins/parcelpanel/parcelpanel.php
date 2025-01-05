<?php

/**
 * Plugin Name: Parcel Panel Order Tracking for WooCommerce
 * Plugin URI: https://docs.parcelpanel.com/woocommerce
 * Description: The best order tracking plugin specially designed for WooCommerce, driving customer loyalty and more sales by providing the best post-purchase experience.
 * Version: 4.4.0
 * Author: Parcel Panel
 * Author URI: https://www.parcelpanel.com
 * Developer: Parcel Panel
 * Developer URI: https://www.parcelpanel.com
 * Text Domain: parcelpanel
 * Domain Path: /l10n/languages/
 * License: GPL-2.0
 * Requires PHP: 7.2
 * Requires at least: 5.8
 * WC requires at least: 4.4.0
 * WC tested up to: 7.3
 *
 * @copyright 2018-2023 ParcelPanel
 */

define('ParcelPanel\VERSION', '4.4.0');
define('ParcelPanel\DB_VERSION', '2.9.0');

define('ParcelPanel\PLUGIN_FILE', __FILE__);
define('ParcelPanel\PLUGIN_PATH', untrailingslashit(plugin_dir_path(__FILE__)));

defined('ParcelPanel\DEBUG') || define('ParcelPanel\DEBUG', false);

if ( is_multisite() ) {
    // 在多站点环境中，检查当前站点的激活插件
    $active_plugins = get_site_option('active_sitewide_plugins'); // 获取全局激活插件
    $is_woocommerce_active = isset($active_plugins['woocommerce/woocommerce.php']);
} else {
    // 在单站点环境中，检查当前激活插件
    $active_plugins = apply_filters('active_plugins', get_option('active_plugins'));
    $is_woocommerce_active = in_array('woocommerce/woocommerce.php', $active_plugins);
}

// 检查是否激活 WooCommerce
if ($is_woocommerce_active) {

    include __DIR__ . '/vendor/autoload.php';

    ParcelPanel\ParcelPanel::instance();
}

// compatible with HPOS
add_action('before_woocommerce_init', function () {
    if (class_exists(\Automattic\WooCommerce\Utilities\FeaturesUtil::class)) {
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility('custom_order_tables', __FILE__, true);
    }
});
