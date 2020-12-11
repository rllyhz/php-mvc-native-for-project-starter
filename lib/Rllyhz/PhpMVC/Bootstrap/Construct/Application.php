<?php

/**
 * @author rllyhz <rullyihza00@gmail.com>
 * @link https://github.com/rllyhz
 */

namespace Lib\Rllyhz\PhpMVC\Bootstrap\Construct;

use App\Core\Route;
use Lib\Rllyhz\PhpMVC\Helpers\RequireHelper;
use Lib\Rllyhz\PhpMVC\Helpers\RouterHelper;
use Lib\Rllyhz\PhpMVC\Helpers\SecurityHelper;
use Lib\Rllyhz\PhpMVC\Http\Client\Request as ClientRequest;
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

  private string $requestURI;
  private array $paramKeys;
  private array $params;
  private array $data;

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

    $this->loadHelpers();

    $this->resolve();
  }

  /**
   * prepareUp function
   * 
   * Prepares up the app.
   */
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

  /**
   * getRoutes function
   * 
   * Get all of available routes.
   * 
   * @return mixed $routes
   */
  private function getRoutes()
  {
    RequireHelper::fileInFolder($this->rootDirectory, "routes" . DIRECTORY_SEPARATOR . "web.php");
    return Route::getRoutes();
  }

  /**
   * loadHelpers function
   * 
   * Loads helper files.
   * 
   */
  private function loadHelpers()
  {
    $helperFolder = $this->rootDirectory . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "helpers";

    return RequireHelper::filesInfolder($helperFolder);
  }

  /**
   * resolve function
   * 
   * Resolve the request URI.
   * 
   * @return mixed $routes
   */
  private function resolve()
  {
    $method = $this->server->requestMethod;
    $availableRoutes = $this->routes[$method];
    $this->requestURI = $this->getRequestURI();

    if (!empty($availableRoutes)) {

      foreach ($availableRoutes as $route) {

        if (RouterHelper::expectsAnyParams($route)) {
          $result = RouterHelper::resolve($route, $this->requestURI);

          if ($result["matched"]) {
            $this->paramKeys = $result["paramKeys"];

            return $this->handleRoute($route);
          }
        } else if ($route->getUri() == $this->requestURI) {
          $this->paramKeys = RouterHelper::getParams($route);
          return $this->handleRoute($route);
        }
      }

      $this->notFound();
      // throw an Error
    }
  }

  /**
   * Gets the requested URI
   */
  private function getRequestURI()
  {
    $uri = $this->server->requestURI;

    if (strpos($uri, "?") == false) {
      return trim($uri, "/");
    }

    $uri = explode("?", $uri);

    return trim($uri[0], "/");
  }

  /**
   * handleRoute function
   * 
   * Handles matched route.
   */
  private function handleRoute(RouteSchema $route)
  {
    // If its view not null
    if ($route->getView() != null) {

      $fileView = RequireHelper::getValidFormatFile(
        $route->getView(),
        constant(self::$VIEWS_FOLDER)
      );

      if (RequireHelper::fileExists($fileView)) {
        return RequireHelper::file($fileView);
      } else {
        // $this->notFound();
        // throw an Error
        return;
      }
      // 
    }


    $this->params = [];
    $uriArray = explode("/", $route->getUri());
    $requestURIArray = explode("/", $this->requestURI);

    foreach ($uriArray as $key => $value) {
      $value = str_replace("{", "", $value);
      $value = str_replace("}", "", $value);

      if (isset($requestURIArray[$key])) {
        array_push($this->params, [$value => $requestURIArray[$key]]);
      } else {
        return $this->notFound();
        // throw an Error
      }
    }

    $this->params = array_filter($this->params, function ($dt) {
      $dtKey = array_key_first($dt);

      foreach ($this->paramKeys as $key) {
        if ($dtKey == $key) {
          return true;
        }
      }
    });

    $this->data = [];

    foreach ($this->params as $param) {
      $param = SecurityHelper::sanitizeString(array_values($param)[0]);
      $param = preg_replace("[%20]", " ", $param);

      $this->data[] = $param;
    }

    /**
     * Checking type of handler
     */
    // if it's callable then invoke.
    if (is_object($route->getHandler()) && is_callable($route->getHandler())) {

      if ($this->server->requestMethod == "GET") {

        $length = sizeof($this->data);

        if ($length == 0) {
          echo call_user_func(
            $route->getHandler(),
            $this->request
          );
        } else if ($length == 1) {
          echo call_user_func(
            $route->getHandler(),
            $this->request,
            $this->data[0]
          );
        } else if ($length == 2) {
          echo call_user_func(
            $route->getHandler(),
            $this->request,
            $this->data[0],
            $this->data[1]
          );
        } else if ($length == 3) {
          echo call_user_func(
            $route->getHandler(),
            $this->request,
            $this->data[0],
            $this->data[1],
            $this->data[2]
          );
        }
        // 
      } else {

        $request = new ClientRequest($this->request);
        echo call_user_func(
          $route->getHandler(),
          $request
        );
        // 
      }

      die;
    }

    // if it's a string then it must be a controller and its method.
    if (is_string($route->getHandler())) {

      $controllerFormat = $route->getHandler();

      // check valid controller and method name
      if (strpos($controllerFormat, "@") == false) {
        // $this->notFound();
        // throw an Error
        return;
      }

      $array = explode("@", $controllerFormat);

      $controllerName = $array[0];
      $methodName = $array[1];

      return $this->runController($controllerName, $methodName);
    }
  }

  /**
   * runController function
   * 
   * Instantiates the selected Controller and invokes its method.
   */
  private function runController(string $controllerName, string $methodName)
  {
    $controllerFile = RequireHelper::getValidFormatFile(
      $controllerName,
      constant(self::$CONTROLLERS_FOLDER)
    );

    if (!RequireHelper::fileExists($controllerFile)) {
      // $this->notFound();
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
      // $this->notFound();
      return;
    }

    /**
     * Invoking selected method of the selected controller with any paramaters.
     */
    if ($this->server->requestMethod == "GET") {
      $length = sizeof($this->data);

      if ($length == 0) {
        return $currentController->{$methodName}($this->request);
      } else if ($length == 1) {
        return $currentController->{$methodName}($this->request, $this->data[0]);
      } else if ($length == 2) {
        return $currentController->{$methodName}($this->request, $this->data[0], $this->data[1]);
      } else if ($length == 3) {
        return $currentController->{$methodName}($this->request, $this->data[0], $this->data[1], $this->data[2]);
      }
      // 
    } else {

      $request = new ClientRequest($this->request);
      return $currentController->{$methodName}($request);
      // 
    }
  }

  private function notFound()
  {
    http_response_code(404);
    die("404 Not found!");
  }
}
