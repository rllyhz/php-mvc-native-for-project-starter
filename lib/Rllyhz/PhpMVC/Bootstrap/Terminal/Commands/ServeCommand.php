<?php

/**
 * @author rllyhz <rullyihza00@gmail.com>
 * @link https://github.com/rllyhz
 */

namespace Lib\Rllyhz\PhpMVC\Bootstrap\Terminal\Commands;

use Lib\Rllyhz\PhpMVC\Bootstrap\Terminal\CommandHandler;

/**
 * Class ServeCommand
 * 
 * Serves Php web server on {host}:{port}.
 */
class ServeCommand extends CommandHandler
{
  public function __construct(array $params)
  {
    $this->host = $_ENV["APP_HOST"];
    $this->port = $_ENV["APP_PORT"];
    $this->params = $params;

    $this->serve();
  }

  private function serve()
  {
    $this->run("print 'Hello'");

    return $this->run(
      "php -S {$this->host}:{$this->port} -t public/"
    );
  }
}
