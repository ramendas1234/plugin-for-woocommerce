<?php
/**
 * Plugin Name: WooCommerce Freebie Engine
 * Plugin URI: https://example.com/woocommerce-freebie-engine/
 * Description: Create powerful "Buy One Get One" style promotional offers for your WooCommerce store with flexible rules and conditions.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://example.com/
 * Text Domain: wc-freebie-engine
 * Domain Path: /languages/
 * Requires at least: 5.0
 * Tested up to: 6.4
 * WC requires at least: 4.0
 * WC tested up to: 9.1
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define plugin constants.
if ( ! defined( 'WCFE_PLUGIN_FILE' ) ) {
	define( 'WCFE_PLUGIN_FILE', __FILE__ );
}

if ( ! defined( 'WCFE_PLUGIN_DIR' ) ) {
	define( 'WCFE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'WCFE_PLUGIN_URL' ) ) {
	define( 'WCFE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'WCFE_VERSION' ) ) {
	define( 'WCFE_VERSION', '1.0.0' );
}

// Bootstrap the plugin.
if ( ! class_exists( 'WCFE_Bootstrap' ) ) {
	include_once WCFE_PLUGIN_DIR . 'core/bootstrap.php';
	WCFE_Bootstrap::init();
}