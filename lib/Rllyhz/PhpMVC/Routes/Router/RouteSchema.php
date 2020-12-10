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

  /**
   * RouteSchema Constructor
   * 
   * @param string $routeName
   * @param string $uri
   * @param mixed $handler
   */
  public function __construct(string $routeName, string $uri, $handler)
  {
    $this->routeName = $routeName;
    $this->uri = $uri;
    $this->handler = $handler;
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
   * getHandler function
   * 
   * @return mixed $this->handler
   */
  public function getHandler()
  {
    return $this->handler;
  }
}
