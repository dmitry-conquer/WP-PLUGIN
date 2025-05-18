<?php
if (!defined('ABSPATH')) {
  exit;
}

class Plugin_Name_Admin_Hooks
{

  private $enqueue;

  public function __construct()
  {
    $this->enqueue = new Plugin_Name_Enqueue();
  }

  public function initialize()
  {
    add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets']);
    add_action('wp_enqueue_scripts', [$this, 'enqueue_frontend_assets']);
    add_filter('plugin_action_links_' . PLUGIN_NAME_BASENAME, [$this, 'add_plugin_setting_link']);
  }

  /**
   * Enqueue admin styles and scripts.
   */
  public function enqueue_admin_assets()
  {
    $this->enqueue->enqueue_admin_styles();
  }

  /**
   * Enqueue frontend styles and scripts.
   */
  public function enqueue_frontend_assets()
  {
    $this->enqueue->enqueue_frontend_scripts();
  }

  /**
   * Adds a custom "Settings" link to the plugin's action links on the Plugins page.
   *
   * @param array $links An array of existing plugin action links.
   * @return array Modified array of plugin action links with the custom "Settings" link added.
   */
  public function add_plugin_setting_link($links)
  {
    $custom_link = '<a href="admin.php?page=zen_settings_page">Settings</a>';
    array_push($links, $custom_link);
    return $links;
  }
}