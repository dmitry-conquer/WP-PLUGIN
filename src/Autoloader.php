<?php

namespace Plugin_Name;

if (!defined('ABSPATH')) {
  exit;
}

class Autoloader
{
  public static function register()
  {
    spl_autoload_register([self::class, 'autoload']);
  }

  public static function autoload($class)
  {
    if (strpos($class, __NAMESPACE__ . '\\') !== 0) {
      return;
    }
    $base_dir = __DIR__;
    $class_name = str_replace(__NAMESPACE__ . '\\', '', $class);
    $file_name = "{$base_dir}/{$class_name}.php";
    if (file_exists($file_name)) {
      require_once $file_name;
    }
  }
}
