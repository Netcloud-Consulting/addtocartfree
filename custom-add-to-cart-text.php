<?php
/**
 * Plugin Name: Custom Add to Cart Text
 * Description: Customize the 'Add to Cart' button text globally or per product.
 * Version: 1.0
 * Author: Netcloud Consulting
 * Text Domain: custom-add-to-cart-text
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Define Constants
define('CAC_TEXT_VERSION', '1.0');
define('CAC_TEXT_PLUGIN_DIR', plugin_dir_path(__FILE__));

// Include Settings Page
require_once CAC_TEXT_PLUGIN_DIR . 'includes/settings-page.php';

// Enqueue Admin Scripts and Styles
function cac_text_enqueue_admin_scripts() {
    wp_enqueue_style('cac-text-admin-style', plugin_dir_url(__FILE__) . 'assets/css/admin-style.css');
    wp_enqueue_script('cac-text-admin-script', plugin_dir_url(__FILE__) . 'assets/js/admin-script.js', array('jquery'), CAC_TEXT_VERSION, true);
}
add_action('admin_enqueue_scripts', 'cac_text_enqueue_admin_scripts');

// Change Add to Cart Text
function cac_text_custom_add_to_cart_text( $text, $product ) {
    $global_text = get_option('cac_text_global', 'Add to Cart');
    return esc_html($global_text);
}
add_filter('woocommerce_product_single_add_to_cart_text', 'cac_text_custom_add_to_cart_text', 10, 2);
add_filter('woocommerce_product_add_to_cart_text', 'cac_text_custom_add_to_cart_text', 10, 2);
