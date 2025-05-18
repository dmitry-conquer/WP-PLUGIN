<div class="wrap">
  <h1 class="wp-heading-inline"><?php echo esc_html(get_admin_page_title()); ?></h1>
  <hr class="wp-header-end">
  
  <?php settings_errors(); ?>
  
  <form method="post" action="options.php" class="plugin-settings-form">
    <?php
    // Output security fields for the registered setting
    settings_fields('plugin_settings');
    
    // Output setting sections and their fields
    do_settings_sections('plugin_settings_page');
    
    // Output save settings button
    submit_button(__('Save Settings', 'text-domain'), 'primary large');
    ?>
  </form>
</div>


