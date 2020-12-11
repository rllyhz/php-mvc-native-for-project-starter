<?php

/**
 * @author rllyhz <rullyihza00@gmail.com>
 * @link https://github.com/rllyhz
 */

namespace Lib\Rllyhz\PhpMVCiers\Bootstrap\Terminal\Commands;

use Lib\Rllyhz\PhpMVCiers\Bootstrap\Terminal\CommandHandler;

/**
 * Class ServeCommand
 * 
 * Serves Php web server on {host}:{port}.
 * 
 * @package Lib\Rllyhz\PhpMVCiers\Bootstrap\Terminal\CommandHandler
 */
class ServeCommand extends CommandHandler
{
  /**
   * ServeCommand Constructor
   * 
   * @param array $params
   */
  public function __construct(string $rootDirectory, array $params)
  {
    $this->rootDirectory = $rootDirectory;
    $this->params = $params;
    $this->host = $_ENV["APP_HOST"];
    $this->port = $_ENV["APP_PORT"];

    $this->serve();
  }

  /**
   * serve function
   * 
   * serves web using built-in web server available in php.
   */
  private function serve()
  {
    $this->showHeading("PHP MVC Native by Rllyhz");

    return $this->runShellScript(
      "php -S {$this->host}:{$this->port} -t public/"
    );
  }
}
