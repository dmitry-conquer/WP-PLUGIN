<?php
namespace Plugin_Name;

if (!defined('ABSPATH')) {
  exit;
}

if (!class_exists(__NAMESPACE__ . '\EnqueueAdmin')) {
  class EnqueueAdmin
  {
    public static function register()
    {
      add_action('admin_enqueue_scripts', [self::class, 'enqueue']);
    }

    public static function enqueue()
    {
      wp_enqueue_style(
        'plugin-name-admin',
        plugin_dir_url(__DIR__) . 'assets/css/admin.css',
        [],
        filemtime(plugin_dir_path(__DIR__) . 'assets/css/admin.css')
      );

      wp_enqueue_script(
        'plugin-name-admin',
        plugin_dir_url(__DIR__) . 'assets/js/admin.js',
        [],
        filemtime(plugin_dir_path(__DIR__) . 'assets/js/admin.js'),
        true
      );

    }
  }
}
