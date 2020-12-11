<?php

/**
 * @author rllyhz <rullyihza00@gmail.com>
 * @link https://github.com/rllyhz
 */

namespace Lib\Rllyhz\PhpMVC\Helpers;

use Lib\Rllyhz\PhpMVC\Routes\Router\RouteSchema;

/**
 * Class RouterHelper
 * 
 * Helper to assistant main app to handle routes.
 * 
 * @package Lib\Rllyhz\PhpMVC\Helpers
 */
class RouterHelper
{
  /**
   * matches function
   * 
   * Checks if uri of the route matches to the requested uri.
   * 
   * @return bool $matched
   */
  private static function matches(RouteSchema $route, $requestURI)
  {
    if (self::expectsAnyParams($route)) {

      $params = self::getParams($route);
      $uri = $route->getUri();

      /**
       * Replacing '/' to '.' so that preg_match works fine (warning if not so).
       */
      // $uri = str_replace("/", ".", $uri);
      // $requestURI = str_replace("%20", "", $requestURI);

      /**
       * Replacing '{param}' to purely regex format, so that preg_match works as expected.
       */
      foreach ($params as $param) {
        $uri = preg_replace("[{[\d\D\w\W]+}]", "[0-9a-zA-Z]+", $uri);
      }

      return preg_match("[$uri]", $requestURI) == 1 ? true : false;
    }
  }

  /**
   * resolve function
   * 
   * Resolves the matched route.
   * 
   * @return mixed $result;
   */
  public static function resolve(RouteSchema $route, $requestURI)
  {
    $matched = self::matches($route, $requestURI);
    $paramKeys = [];

    if (RouterHelper::expectsAnyParams($route)) {
      $paramKeys = RouterHelper::getParams($route);
    }

    return [
      "matched" => $matched,
      "paramKeys" => $paramKeys
    ];
  }

  /**
   * expectsAnyParams function
   * 
   * Check if route expects any params.
   * 
   * @return bool $bool
   */
  public static function expectsAnyParams(RouteSchema $route)
  {
    return strpos($route->getUri(), "{") != false ? true : false;
  }

  /**
   * getOnlyUriOf function
   * 
   * Get only Uri of given route.
   * 
   * @return string $uriOnly
   */
  public static function getOnlyUriOf(RouteSchema $route)
  {
    $array = explode("{", $route->getUri());
    return trim($array[0]);
  }

  /**
   * getParams function
   * 
   * Get list of expected params of given route.
   * 
   * @return array $params
   */
  public static function getParams(RouteSchema $route)
  {
    $params = [];
    $param = "";
    $startToRecord = false;

    foreach (str_split($route->getUri()) as $char) {
      if ($char == "{") {
        $startToRecord = true;
        $param = "";
        continue;
      } else if ($char == "}") {
        $startToRecord = false;
        array_push($params, $param);
        continue;
      }

      if ($startToRecord) {
        $param .= $char;
      }
    }

    return $params;
  }
}
