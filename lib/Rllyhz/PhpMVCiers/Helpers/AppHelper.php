<?php

/**
 * @author rllyhz <rullyihza00@gmail.com>
 * @link https://github.com/rllyhz
 */

namespace Lib\Rllyhz\PhpMVCiers\Helpers;


/**
 * Class AppHelper
 * 
 * Main helper for the app.
 * 
 * @package Lib\Rllyhz\PhpMVCiers\Helpers
 */
class AppHelper
{
  public static string $SITE_URL = "SITE_URL";
  public static string $CONTROLLERS_FOLDER = "CONTROLLERS_FOLDER";
  public static string $MODEL_FOLDER = "MODEL_FOLDER";
  public static string $VIEWS_FOLDER = "VIEWS_FOLDER";
  public static string $MIGRATION_FOLDER = "MIGRATION_FOLDER";
  public static string $CONFIG_FOLDER = "CONFIG_FOLDER";

  public static string $NOT_FOUND_VIEW = "NOT_FOUND_VIEW";

  /**
   * Defines a constant
   */
  public static function defineConstant(string $name, $value, bool $isCaseSensitive = false)
  {
    if (!defined($name)) {
      define($name, $value, $isCaseSensitive);
    }
  }
  // 
}
