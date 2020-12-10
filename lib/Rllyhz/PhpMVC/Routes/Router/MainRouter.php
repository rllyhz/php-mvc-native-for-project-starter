<?php

/**
 * @author rllyhz <rullyihza00@gmail.com>
 * @link https://github.com/rllyhz
 */

namespace Lib\Rllyhz\PhpMVC\Routes\Router;

/**
 * Class MainRouter
 * 
 * Main Router of app.
 * 
 * @package Lib\Rllyhz\PhpMVC\Routes\Router
 */
class MainRouter implements RouterInterface
{
  use RouterBuilder;

  public static function get(string $uri, $handler)
  {
    $router = self::getRouter();

    $uri = $router->validateUri($uri);
    $handler = $router->validateHandler($handler);
    $routeName = $router->getRouteNameFromUri($uri);

    $route = new RouteSchema($routeName, $uri, $handler);

    return $router
      ->addRoute($route, MainRouter::$GET_METHOD);
  }

  public static function post(string $uri, $handler)
  {
    $router = self::getRouter();

    $uri = $router->validateUri($uri);
    $handler = $router->validateHandler($handler);
    $routeName = $router->getRouteNameFromUri($uri);

    $route = new RouteSchema($routeName, $uri, $handler);

    return $router
      ->addRoute($route, MainRouter::$POST_METHOD);
  }

  public static function put(string $uri, $handler)
  {
    $router = self::getRouter();

    $uri = $router->validateUri($uri);
    $handler = $router->validateHandler($handler);
    $routeName = $router->getRouteNameFromUri($uri);

    $route = new RouteSchema($routeName, $uri, $handler);

    return $router
      ->addRoute($route, MainRouter::$PUT_METHOD);
  }

  public static function delete(string $uri, $handler)
  {
    $router = self::getRouter();

    $uri = $router->validateUri($uri);
    $handler = $router->validateHandler($handler);
    $routeName = $router->getRouteNameFromUri($uri);

    $route = new RouteSchema($routeName, $uri, $handler);

    return $router
      ->addRoute($route, MainRouter::$DELETE_METHOD);
  }

  public static function view(string $uri, string $view)
  {
    echo "Viewing..";
  }
}
