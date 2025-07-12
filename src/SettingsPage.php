<?php
namespace Plugin_Name;

if (!defined('ABSPATH'))
  exit;

class SettingsPage
{
  public static function register()
  {
    add_action('admin_menu', [self::class, 'add_menu']);
    add_action('admin_init', [self::class, 'register_fields']);
  }

  public static function add_menu()
  {
    add_menu_page(
      'Сучасні налаштування',
      'Modern Settings',
      'manage_options',
      'modern-settings',
      [self::class, 'render_page'],
      'dashicons-admin-generic',
      80
    );
  }



  public static function register_fields()
  {
    register_setting('modern_settings_group', 'modern_settings');

    add_settings_section(
      'modern_main_section',
      'Основні налаштування',
      function () {
        echo '<p>Головні параметри вашого плагіна.</p>';
      },
      'modern-settings'
    );

    add_settings_field(
      'modern_text',
      'Текстове поле',
      function () {
        $options = get_option('modern_settings');
        ?>
      <input type="text" name="modern_settings[modern_text]" value="<?php echo esc_attr($options['modern_text'] ?? ''); ?>"
        class="modern-input" placeholder="Введіть текст..." />
      <?php
      },
      'modern-settings',
      'modern_main_section'
    );

    add_settings_field(
      'modern_select',
      'Вибір зі списку',
      function () {
        $options = get_option('modern_settings');
        ?>
      <select name="modern_settings[modern_select]" class="modern-select">
        <option value="one" <?php selected($options['modern_select'] ?? '', 'one'); ?>>Один</option>
        <option value="two" <?php selected($options['modern_select'] ?? '', 'two'); ?>>Два</option>
        <option value="three" <?php selected($options['modern_select'] ?? '', 'three'); ?>>Три</option>
      </select>
      <?php
      },
      'modern-settings',
      'modern_main_section'
    );

    add_settings_field(
      'modern_checkbox',
      'Чекбокс',
      function () {
        $options = get_option('modern_settings');
        ?>
      <label class="modern-switch">
        <input type="checkbox" name="modern_settings[modern_checkbox]" value="1" <?php checked($options['modern_checkbox'] ?? '', 1); ?> />
        <span class="modern-slider"></span>
        <span class="modern-switch-label">Увімкнути</span>
      </label>
      <?php
      },
      'modern-settings',
      'modern_main_section'
    );

    add_settings_field(
      'modern_radio',
      'Вибір варіанту',
      function () {
        $options = get_option('modern_settings');
        ?>
      <label><input type="radio" name="modern_settings[modern_radio]" value="a" <?php checked($options['modern_radio'] ?? '', 'a'); ?> /> Варіант A</label>
      <label><input type="radio" name="modern_settings[modern_radio]" value="b" <?php checked($options['modern_radio'] ?? '', 'b'); ?> /> Варіант B</label>
      <?php
      },
      'modern-settings',
      'modern_main_section'
    );

    add_settings_field(
      'modern_color',
      'Колір',
      function () {
        $options = get_option('modern_settings');
        ?>
      <input type="color" name="modern_settings[modern_color]"
        value="<?php echo esc_attr($options['modern_color'] ?? '#0073aa'); ?>" class="modern-color" />
      <?php
      },
      'modern-settings',
      'modern_main_section'
    );

    add_settings_field(
      'modern_file',
      'Файл',
      function () {
        ?>
      <input type="file" name="modern_settings_file" class="modern-file" />
      <small>Підтримуються зображення, pdf тощо.</small>
      <?php
      },
      'modern-settings',
      'modern_main_section'
    );

    add_settings_field(
      'modern_textarea',
      'Textarea',
      function () {
        $options = get_option('modern_settings');
        ?>
      <textarea name="modern_settings[modern_textarea]" class="modern-textarea" rows="4"
        placeholder="Введіть текст..."><?php echo esc_textarea($options['modern_textarea'] ?? ''); ?></textarea>
      <?php
      },
      'modern-settings',
      'modern_main_section'
    );
  }

  public static function render_page()
  {
    ?>
    <div class="modern-settings-wrap">
      <h1>Сучасна сторінка налаштувань</h1>
      <form method="post" action="options.php" enctype="multipart/form-data">
        <?php
        settings_fields('modern_settings_group');
        do_settings_sections('modern-settings');
        submit_button('Зберегти', 'primary large');
        ?>
      </form>
    </div>
    <?php
  }
}