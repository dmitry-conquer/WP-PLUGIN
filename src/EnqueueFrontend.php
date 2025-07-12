<?php
namespace Plugin_Name;

if (!defined('ABSPATH')) {
  exit;
}

if (!class_exists(__NAMESPACE__ . '\EnqueueFrontend')) {
  class EnqueueFrontend
  {
    public static function register()
    {
      add_action('admin_enqueue_scripts', [self::class, 'enqueue']);
    }

    public static function enqueue()
    {
      wp_enqueue_style(
        'plugin-name-admin',
        plugin_dir_url(__DIR__) . 'assets/css/frontend.css',
        [],
        filemtime(plugin_dir_path(__DIR__) . 'assets/css/frontend.css')
      );

      wp_enqueue_script(
        'plugin-name-admin',
        plugin_dir_url(__DIR__) . 'assets/js/frontend.js',
        [],
        filemtime(plugin_dir_path(__DIR__) . 'assets/js/frontend.js'),
        true
      );

      $settings = self::get_plugin_settings();
      wp_localize_script('plugin-name-admin', 'pluginNameConfig', $settings);
    }

    private static function get_settings_fields()
    {
      $fields = [];
      if (file_exists(plugin_dir_path(__DIR__) . 'config/settings-fields.php')) {
        $fields = include plugin_dir_path(__DIR__) . 'config/settings-fields.php';
      }
      return is_array($fields) ? $fields : [];
    }

    private static function get_plugin_settings()
    {
      $fields = self::get_settings_fields();
      $options = get_option('plugin_settings_options', []);
      $settings = [];
      foreach ($fields as $key => $field) {
        $settings[$key] = $options[$key] ?? $field['default'];
      }
      return $settings;
    }
  }
}
