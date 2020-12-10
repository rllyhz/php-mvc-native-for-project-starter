<?php

/**
 * @author rllyhz <rullyihza00@gmail.com>
 * @link https://github.com/rllyhz
 */

namespace Lib\Rllyhz\PhpMVC\Bootstrap\Terminal;

/**
 * Class CommandHandler
 * 
 * Command handler.
 * 
 * @package Lib\Rllyhz\PhpMVC\Bootstrap\Terminal
 */
class CommandHandler
{
  /**
   * @var string rootDirectory
   */
  protected string $rootDirectory;

  /**
   * @var string host
   */
  protected string $host;

  /**
   * @var int port
   */
  protected int $port;

  /**
   * @var array params
   */
  protected array $params;

  /**
   * runShellScript function
   * 
   * run a shell script command.
   * 
   * @param string $shellCommand
   * @return string|null
   */
  protected function runShellScript(string $shellCommand)
  {
    return shell_exec($shellCommand);
  }

  protected function showHeading(string $title)
  {
    return $this->show("\n\n|| $title ||\n\n\n");
  }

  protected function alert(string $message)
  {
    echo "\n$message\n";
  }

  protected function message(string $message)
  {
    echo "\n$message\n";
  }

  protected function show(string $message)
  {
    echo $message;
  }
}
