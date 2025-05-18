<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Plugin_Class_Name')) {

    class Plugin_Class_Name
    {

        /**
         * Run the plugin.
         */
        public function run()
        {
            $this->initialize_settings_page();
            $this->initialize_admin_hooks();
        }


        /**
         * Initialize admin hooks.
         */
        private function initialize_admin_hooks()
        {
            $admin_hooks = new Plugin_Name_Admin_Hooks();
            $admin_hooks->initialize();
        }

        /**
         * Initialize settings page.
         */
        private function initialize_settings_page()
        {
            $settings_page = new Plugin_Name_Settings_Page();
            $settings_page->initialize();
        }
    }
}
