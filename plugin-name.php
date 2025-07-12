<?php
/**
 * Plugin Name: Plugin Name
 * Description: Plugin description goes here.
 * Version: 1.0.0
 * Author: Dmitro Frolov
 */

if (!defined('ABSPATH')) {
    exit;
}


require_once __DIR__ . '/src/Autoloader.php';

Plugin_Name\Autoloader::register();

add_action('plugins_loaded', function () {
    Plugin_Name\EnqueueAdmin::register();
    Plugin_Name\EnqueueFrontend::register();
    Plugin_Name\SettingsPage::register();
    Plugin_Name\AdminHooks::register();
});