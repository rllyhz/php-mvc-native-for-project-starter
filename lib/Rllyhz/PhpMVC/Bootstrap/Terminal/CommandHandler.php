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
 */
class CommandHandler
{
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

  protected function run(string $shellCommand)
  {
    return shell_exec($shellCommand);
  }
}
