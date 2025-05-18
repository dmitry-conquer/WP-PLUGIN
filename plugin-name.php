<?php
/**
 * Plugin Name: Plugin Name
 * Description: Plugin description goes here.
 * Version: 1.0.0
 * Author: Dmitro Frolov
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Define plugin constants.
define( 'PLUGIN_NAME_PATH', plugin_dir_path( __FILE__ ) );
define( 'PLUGIN_NAME_URL', plugin_dir_url( __FILE__ ) );
define( 'PLUGIN_NAME_BASENAME', plugin_basename( __FILE__ ) );

// Autoload required files.
require_once PLUGIN_NAME_PATH . 'includes/class-settings-page.php';
require_once PLUGIN_NAME_PATH . 'includes/class-admin-hooks.php';
require_once PLUGIN_NAME_PATH . 'includes/class-enqueue.php';
require_once PLUGIN_NAME_PATH . 'includes/class-plugin-name.php';

/**
 * Initialize the plugin.
 */
function plugin_name_init() {
    $plugin = new Plugin_Class_Name();
    $plugin->run();
}
add_action( 'plugins_loaded', 'plugin_name_init' );
