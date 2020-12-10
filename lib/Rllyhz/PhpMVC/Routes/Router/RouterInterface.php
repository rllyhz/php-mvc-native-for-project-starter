<?php

/**
 * @author rllyhz <rullyihza00@gmail.com>
 * @link https://github.com/rllyhz
 */

namespace Lib\Rllyhz\PhpMVC\Routes\Router;

/**
 * Class RouteInterface
 * 
 * An interface for Route's Schema.
 * 
 * @package Lib\Rllyhz\PhpMVC\Routes\Router
 */
interface RouterInterface
{
  public static function get(string $uri, $handler);

  public static function post(string $uri, $handler);

  public static function put(string $uri, $handler);

  public static function delete(string $uri, $handler);

  public static function view(string $uri, string $view);
}
