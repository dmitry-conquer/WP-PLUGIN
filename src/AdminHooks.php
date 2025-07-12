<?php
namespace Plugin_Name;
if (!defined('ABSPATH')) {
  exit;
}

if (!class_exists(__NAMESPACE__ . '\AdminHooks')) {
  class AdminHooks
  {
    public static function register()
    {
      add_filter('plugin_action_links_' . plugin_basename(__DIR__), [self::class, 'add_plugin_setting_link']);
    }

    public function add_plugin_setting_link($links)
    {
      $custom_link = '<a href="admin.php?page=zen_settings_page">Settings</a>';
      array_push($links, $custom_link);
      return $links;
    }
  }
}