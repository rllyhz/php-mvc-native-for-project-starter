<?php

/**
 * @author rllyhz <rullyihza00@gmail.com>
 * @link https://github.com/rllyhz
 */

namespace Lib\Rllyhz\PhpMVC\Helpers;

/**
 * Class SecurityHelper
 * 
 * Helper to assistant main app to be safe always.
 * 
 * @package Lib\Rllyhz\PhpMVC\Helpers
 */
class SecurityHelper
{
  public static function sanitizeString(string $string)
  {
    $string = filter_var($string, FILTER_SANITIZE_STRING);
    $string = filter_var($string, FILTER_SANITIZE_URL);
    $string = htmlspecialchars($string);
    $string = htmlentities($string);

    return $string;
  }
}
