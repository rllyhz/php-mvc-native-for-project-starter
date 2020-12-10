<?php

/**
 * @author rllyhz <rullyihza00@gmail.com>
 * @link https://github.com/rllyhz
 */

namespace Lib\Rllyhz\PhpMVC\Bootstrap\Construct;

use App\Core\Route;
use Lib\Rllyhz\PhpMVC\Helpers\RequireHelper;
use Lib\Rllyhz\PhpMVC\Http\Request;
use Lib\Rllyhz\PhpMVC\Http\Response;
use Lib\Rllyhz\PhpMVC\Http\Server;
use Lib\Rllyhz\PhpMVC\Routes\Router\RouteSchema;

/**
 * Class Application

 * Main Application.
 * 
 * @package Lib\Rllyhz\PhpMVC\Bootstrap\Construct
 */
class Application
{
  public static $SITE_URL = "SITE_URL";
  public static $CONTROLLERS_FOLDER = "CONTROLLERS_FOLDER";
  public static $MODEL_FOLDER = "MODEL_FOLDER";
  public static $VIEWS_FOLDER = "VIEWS_FOLDER";
  public static $MIGRATION_FOLDER = "MIGRATION_FOLDER";
  public static $CONFIG_FOLDER = "CONFIG_FOLDER";

  /**
   * @var string $rootDirectory;
   */
  private string $rootDirectory;

  /**
   * @var array $routes;
   */
  private array $routes;

  private Server $server;
  private Request $request;
  private Response $response;

  /**
   * Application Constructor
   * 
   * @param string $rootDirectory
   */
  public function __construct(string $rootDirectory)
  {
    $this->rootDirectory = $rootDirectory;

    $this->prepareUp();

    $this->server = new Server($_SERVER);
    $this->request = new Request($this->server, $_GET, $_POST, $_FILES);
    $this->response = new Response($this->request);
    $this->routes = $this->getRoutes();

    $this->resolve();
  }

  private function prepareUp()
  {
    if (!defined(self::$SITE_URL)) {
      $siteURL = 'http' . (empty($_SERVER['HTTPS']) ? '' : 's') . '://' . $_SERVER['HTTP_HOST'] . '/';
      define(self::$SITE_URL, $siteURL);
    }

    if (!defined(self::$CONFIG_FOLDER)) {
      define(self::$CONFIG_FOLDER, $this->rootDirectory . DIRECTORY_SEPARATOR . "config");
    }

    if (!defined(self::$CONTROLLERS_FOLDER)) {
      define(self::$CONTROLLERS_FOLDER, $this->rootDirectory . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "controllers");
    }

    if (!defined(self::$MODEL_FOLDER)) {
      define(self::$MODEL_FOLDER, $this->rootDirectory . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "models");
    }

    if (!defined(self::$VIEWS_FOLDER)) {
      define(self::$VIEWS_FOLDER, $this->rootDirectory . DIRECTORY_SEPARATOR . "resources" . DIRECTORY_SEPARATOR . "views");
    }

    if (!defined(self::$MIGRATION_FOLDER)) {
      // define(self::$MIGRATION_FOLDER, $this->rootDirectory . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "controllers");
    }
  }

  private function getRoutes()
  {
    RequireHelper::fileInFolder($this->rootDirectory, "routes" . DIRECTORY_SEPARATOR . "web.php");
    return Route::getRoutes();
  }

  private function resolve()
  {
    $method = $this->server->requestMethod;
    $availableRoutes = $this->routes[$method];
    $requestURI = $this->getRequestURI();

    if (!empty($availableRoutes)) {

      foreach ($availableRoutes as $route) {

        if ($route->getUri() == $requestURI) {
          $this->handleRoute($route);
        }
        // 
      }

      // throw an Error
    }
  }

  private function getRequestURI()
  {
    $uri = $this->server->requestURI;

    if (strpos($uri, "?") == false) {
      return trim($uri, "/");
    }

    $uri = explode("?", $uri);

    return trim($uri[0], "/");
  }

  private function handleRoute(RouteSchema $route)
  {
    if (is_object($route->getHandler()) && is_callable($route->getHandler())) {
      echo call_user_func(
        $route->getHandler(),
        $this->request,
        $this->response
      );

      die;
    }

    if (is_string($route->getHandler())) {

      $controllerFormat = $route->getHandler();

      // check valid controller and method name
      if (strpos($controllerFormat, "@") == false) {
        // throw an Error
        return;
      }

      $array = explode("@", $controllerFormat);

      $controllerName = $array[0];
      $methodName = $array[1];

      return $this->runController($controllerName, $methodName);
    }
  }

  private function runController(string $controllerName, string $methodName)
  {
    $controllerFile = RequireHelper::getValidFormatFile(
      $controllerName,
      constant(self::$CONTROLLERS_FOLDER)
    );

    if (!RequireHelper::fileExists($controllerFile)) {
      // throw an Error
      return;
    }

    /**
     * Instantiating the selected controller
     */
    $controllerClass = "\App\Controllers\\" . $controllerName;
    $currentController = new $controllerClass();

    if (!method_exists($currentController, $methodName)) {
      // throw an Error
      return;
    }

    /**
     * Invoking selected method of the selected controller
     */
    $currentController->{$methodName}($this->request);
  }
}
