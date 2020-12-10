<?php

/**
 * @author rllyhz <rullyihza00@gmail.com>
 * @link https://github.com/rllyhz
 */

namespace Lib\Rllyhz\PhpMVC\Routes\Router;

/**
 * Class RouterBuilder
 * 
 * Main Router of app.
 * 
 * @package Lib\Rllyhz\PhpMVC\Routes\Router
 */
trait RouterBuilder
{
  private static $GET_METHOD = "GET";
  private static $POST_METHOD = "POST";
  private static $PUT_METHOD = "PUT";
  private static $DELETE_METHOD = "DELETE";

  /**
   * @var array $routes
   * 
   * array of Lib\Rllyhz\PhpMVC\Routes\Router\RouteSchema
   * To keep the available routes of app.
   */
  private array $routes = [
    "GET" => [],
    "POST" => [],
    "PUT" => [],
    "DELETE" => [],
  ];

  /**
   * @var MainRouter $router
   * 
   * To serve and handle the available routes of app.
   */
  private static $router = null;

  private static function getRouter()
  {
    if (self::$router == null) {
      self::$router = new MainRouter();
      return self::$router;
    }

    return self::$router;
  }

  public static function getRoutes(string $method = "")
  {
    $router = self::getRouter();
    if ($method == "") {
      return $router->getAllRoutes();
    }

    return $router->getRoutesByMethod($method);
  }

  public function getAllRoutes()
  {
    return $this->routes;
  }

  public function getRoutesByMethod(string $method)
  {
    if ($this->isMethodAvailable($method)) {
      return $this->routes[$method];
    }

    // throw an Error
  }

  /**
   * addRoute() function
   * 
   * Adds available routes.
   * 
   * @param Lib\Rllyhz\PhpMVC\Routes\Router\RouteSchema
   */
  public function addRoute(RouteSchema $route, string $method)
  {
    if ($this->isMethodAvailable($method)) {
      return array_push($this->routes[$method], $route);
    }

    // throw an Error
  }

  public function validateUri(string $uri)
  {
    if ($uri == "/") {
      return "";
    }

    $uri = trim($uri, "/");

    return $uri;
  }

  public function getRouteNameFromUri($uri)
  {
    $routeName = "";
    $exploded = explode("/", $uri);

    if (sizeof($exploded) == 1) {
      return $uri;
    }

    foreach ($exploded as $key => $name) {
      if ($key == (sizeof($exploded) - 1)) {
        $routeName .= $name;
      } else {
        $routeName .= $name . ".";
      }
    }

    // get routeName from given uri.
    return $routeName;
  }

  public function validateHandler($handler)
  {
    // validate given handler.
    return $handler;
  }

  private function isMethodAvailable(string $methodName)
  {
    if (
      self::$GET_METHOD === $methodName ||
      self::$POST_METHOD === $methodName ||
      self::$PUT_METHOD === $methodName ||
      self::$DELETE_METHOD === $methodName
    ) {
      return true;
    }

    return false;
  }
}
