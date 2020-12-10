<?php

/**
 * @author rllyhz <rullyihza00@gmail.com>
 * @link https://github.com/rllyhz
 */

namespace Lib\Rllyhz\PhpMVC\Bootstrap;

use Lib\Rllyhz\PhpMVC\Bootstrap\Construct\Application;
use Lib\Rllyhz\PhpMVC\Bootstrap\Terminal\Terminal;

/**
 * Class Bootstrap
 * 
 * Builds an instance app.
 */
class Bootstrap
{
  /**
   * build function.
   * 
   * @param string $rootDirectory
   * @param array $argv
   * @param bool $isRunningToCommandLine
   * @return Application $app
   */
  public static function build(string $rootDirectory, array $argv, bool $isRunningToCommandLine = false)
  {
    self::loadEnv($rootDirectory);

    if ($isRunningToCommandLine) {
      new Terminal($rootDirectory, $argv);
    } else {
      new Application($rootDirectory);
    }
  }

  private static function loadEnv(string $rootDirectory)
  {
    $env = \Dotenv\Dotenv::createImmutable($rootDirectory);
    $env->load();
  }
}
