<?php

/**
 * @author rllyhz <rullyihza00@gmail.com>
 * @link https://github.com/rllyhz
 */

namespace Lib\Rllyhz\PhpMVC\Routes\Router;

/**
 * Class RouteSchema
 * 
 * A schema for any available routes of app.
 */
class RouteSchema
{
  private string $routeName;
  private string $uri;
  private $handler;
  private $view;

  /**
   * RouteSchema Constructor
   * 
   * @param string $routeName
   * @param string $uri
   * @param mixed $handler
   */
  public function __construct(string $routeName, string $uri, $handler, $view = null)
  {
    $this->routeName = $routeName;
    $this->uri = $uri;
    $this->handler = $handler;
    $this->view = $view;
  }

  /**
   * setRouteName function
   * 
   * @param string $name
   * @return RouteSchema $this
   */
  public function setRouteName(string $name)
  {
    $this->routeName = $name;
    return $this;
  }

  /**
   * setUri function
   * 
   * @param string $uri
   * @return RouteSchema $this
   */
  public function setUri(string $uri)
  {
    $this->uri = $uri;
    return $this;
  }

  /**
   * setView function
   * 
   * @param string $view
   * @return RouteSchema $this
   */
  public function setView(string $view)
  {
    $this->view = $view;
    return $this;
  }

  /**
   * setHandler function
   * 
   * @param mixed $handler
   * @return RouteSchema $this
   */
  public function setHandler($handler)
  {
    $this->handler = $handler;
    return $this;
  }

  /**
   * getRouteName function
   * 
   * @return string $this->routeName
   */
  public function getRouteName()
  {
    return $this->routeName;
  }

  /**
   * getUri function
   * 
   * @return string $this->uri
   */
  public function getUri()
  {
    return $this->uri;
  }

  /**
   * getView function
   * 
   * @return string $this->view
   */
  public function getView()
  {
    return $this->view;
  }

  /**
   * getHandler function
   * 
   * @return mixed $this->handler
   */
  public function getHandler()
  {
    return $this->handler;
  }
}
