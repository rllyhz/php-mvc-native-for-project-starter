<?php

/**
 * @author rllyhz <rullyihza00@gmail.com>
 * @link https://github.com/rllyhz
 */

namespace Lib\Rllyhz\PhpMVCiers\Http;

use Lib\Rllyhz\PhpMVCiers\Helpers\AppHelper;

/**
 * Class Redirect
 * 
 * Http Redirect
 * 
 * @package Lib\Rllyhz\PhpMVCiers\Http
 */
class Redirect
{
  private static function getSiteUrl()
  {
    return constant(AppHelper::$SITE_URL);
  }

  public static function to(string $uri)
  {
    $uri = trim($uri, "/");
    $uri = self::getSiteUrl() . $uri;

    header("Location: $uri");
    return exit();
  }
}
