<?php

if (!class_exists('Plugin_Name_Settings_Page')) {

  class Plugin_Name_Settings_Page
  {

    /**
     * Initializes the settings page by hooking into WordPress actions.
     *
     * @return void
     */
    public function initialize()
    {
      add_action('admin_menu', [$this, 'register_settings_page']);
      add_action('admin_init', [$this, 'register_settings']);
    }

    /**
     * Registers the settings page for the plugin in the WordPress admin menu.
     *
     * @return void
     */
    public function register_settings_page()
    {
      add_menu_page(
        __('Plugin Name Settings', 'plugin-textdomain'),
        __('Plugin Name', 'plugin-textdomain'),
        'manage_options',
        'plugin_settings_page',
        [$this, 'settings_page_content'],
        'dashicons-admin-generic',
        30
      );
    }

    /**
     * Registers the plugin settings, settings sections, and settings fields.
     *
     * @return void
     */
    public function register_settings()
    {
      register_setting('plugin_settings', 'plugin_settings_options');

      add_settings_section(
        'plugin_settings_section',
        __('Settings', 'plugin-textdomain'),
        [$this, 'settings_section_html'],
        'plugin_settings_page'
      );

      $fields = $this->get_settings_fields();

      foreach ($fields as $field_id => $field) {
        add_settings_field(
          $field_id,
          $field['label'],
          [$this, 'render_field'],
          'plugin_settings_page',
          'plugin_settings_section',
          [
            'id' => $field_id,
            'type' => $field['type'],
            'default' => $field['default'],
          ]
        );
      }
    }

    /**
     * Renders a settings field based on the provided arguments.
     *
     * @param array $args {
     *     @type string $id       The unique ID of the field.
     *     @type string $type     The type of the field.
     *     @type mixed  $default  The default value of the field.
     * }
     *
     * @return void
     */
    public function render_field(array $args)
    {
      $field_id = esc_attr($args['id']);
      $field_default = $args['default'] ?? '';
      $field_type = $args['type'];
      $options = get_option('plugin_settings_options', []);
      $value = $options[$field_id] ?? $field_default;

      switch ($field_type) {
        case 'checkbox':
          $checked = checked($value, '1', false);
          echo "<input type='checkbox' id='{$field_id}' name='plugin_settings_options[{$field_id}]' value='1' {$checked} />";
          break;

        case 'checkbox_list':
          $post_types = get_post_types(['public' => true], 'objects');
          foreach ($post_types as $post_type) {
            $post_type_name = esc_attr($post_type->name);
            $checked = in_array($post_type_name, (array) $value, true) ? 'checked' : '';
            echo "<label>
                <input type='checkbox' name='plugin_settings_options[{$field_id}][]' value='{$post_type_name}' {$checked}>
                " . esc_html($post_type->label) . "
              </label><br>";
          }
          break;

        case 'textarea':
          $escaped_value = esc_textarea($value);
          echo "<textarea id='{$field_id}' name='plugin_settings_options[{$field_id}]'>{$escaped_value}</textarea>";
          break;

        default:
          $escaped_value = esc_attr($value);
          echo "<input type='{$field_type}' id='{$field_id}' name='plugin_settings_options[{$field_id}]' value='{$escaped_value}' />";
          break;
      }
    }

    /**
     * Outputs the HTML content for the settings section of the plugin.
     *
     * @return void
     */
    public function settings_section_html()
    {
      echo '<p>' . esc_html__('Settings for the plugin.', 'plugin-textdomain') . '</p>';
    }

    /**
     * Outputs the content of the settings page.
     *
     * @return void
     */
    public function settings_page_content()
    {
      require_once PLUGIN_NAME_PATH . 'templates/settings-page.php';
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
        $fields = require PLUGIN_NAME_PATH . 'includes/settings-fields.php';
      }

      return is_array($fields) ? $fields : [];
    }
  }
}
