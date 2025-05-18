<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

delete_option('plugin_settings_options');
delete_option('plugin_name_version');
