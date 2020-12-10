<?php

/**
 * @author rllyhz <rullyihza00@gmail.com>
 * @link https://github.com/rllyhz
 */

namespace Lib\Rllyhz\PhpMVC\Http;

use Lib\Rllyhz\PhpMVC\Bootstrap\Construct\Application;

/**
 * Class Redirect
 * 
 * Http Redirect
 * 
 * @package Lib\Rllyhz\PhpMVC\Http
 */
class Redirect
{
  private static function getSiteUrl()
  {
    return constant(Application::$SITE_URL);
  }

  public static function to(string $uri)
  {
    $uri = trim($uri, "/");
    $uri = self::getSiteUrl() . $uri;

    header("Location: $uri");
    return exit();
  }
}
