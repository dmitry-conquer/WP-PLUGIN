<?php
/**
 * Handles enqueueing of scripts and styles for the plugin.
 *
 * @package Plugin_Name
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

if (!class_exists('Plugin_Name_Enqueue')) {

  /**
   * Class Plugin_Name_Enqueue
   */
  class Plugin_Name_Enqueue
  {

    /**
     * Enqueue admin styles.
     *
     * @return void
     */
    public function enqueue_admin_styles()
    {
      wp_enqueue_style(
        'plugin-name-admin',
        PLUGIN_NAME_URL . 'assets/css/admin.css',
        [],
        filemtime(PLUGIN_NAME_PATH . 'assets/css/admin.css')
      );
    }

    /**
     * Enqueue frontend scripts.
     *
     * @return void
     */
    public function enqueue_frontend_scripts()
    {
      wp_enqueue_script(
        'plugin-name',
        PLUGIN_NAME_URL . 'assets/js/plugin.js',
        [],
        filemtime(PLUGIN_NAME_PATH . 'assets/js/plugin.js'),
        true
      );

      $settings = $this->get_plugin_settings();
      wp_localize_script('plugin-name', 'pluginNameConfig', $settings);
    }

    /**
     * Retrieve settings fields.
     *
     * @return array Settings fields.
     */
    private function get_settings_fields()
    {
      $fields = [];

      if (file_exists(PLUGIN_NAME_PATH . 'includes/settings-fields.php')) {
        $fields = include PLUGIN_NAME_PATH . 'includes/settings-fields.php';
      }

      return is_array($fields) ? $fields : [];
    }

    /**
     * Retrieve plugin settings.
     *
     * @return array Plugin settings.
     */
    private function get_plugin_settings()
    {
      $fields = $this->get_settings_fields();
      $options = get_option('plugin_settings_options', []);

      $settings = [];
      foreach ($fields as $key => $field) {
        $settings[$key] = $options[$key] ?? $field['default'];
      }

      return $settings;
    }
  }
}
