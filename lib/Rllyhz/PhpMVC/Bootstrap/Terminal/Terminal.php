<?php

/**
 * @author rllyhz <rullyihza00@gmail.com>
 * @link https://github.com/rllyhz
 */

namespace Lib\Rllyhz\PhpMVC\Bootstrap\Terminal;

use Lib\Rllyhz\PhpMVC\Bootstrap\Terminal\Commands\CreateCommand;
use Lib\Rllyhz\PhpMVC\Bootstrap\Terminal\Commands\ServeCommand;

/**
 * Class Terminal
 * 
 * Handles command from cli.
 */
class Terminal
{
  /**
   * @var string $rootDirectory
   */
  private string $rootDirectory;

  /**
   * @var array $argv
   */
  private array $argv;

  /**
   * @var array $params
   */
  private array $params;

  /**
   * @var array $commands
   */
  private array $commands;

  /**
   * @var array $activeCommand
   */
  private array $activeCommand;

  /**
   * Terminal Constructor
   * 
   * @param array $argv
   */
  public function __construct(string $rootDirectory, array $argv)
  {
    $this->argv = $argv;
    $this->rootDirectory = $rootDirectory;
    $this->params = [];
    $this->activeCommand = [];

    $this->setCommands();
    $this->processArgv();
    $this->resolve();
  }

  /**
   * processArgv function
   * 
   * Processes the argvs.
   * Throw an error if can not be finished.
   */
  private function processArgv()
  {
    if (!empty($this->argv)) {
      foreach ($this->argv as $indexArgv => $contentArgv) {
        if ($contentArgv === 'rllyhz') continue;

        array_push($this->params, $contentArgv);
      }
    } else {
      // throw an Error
    }
  }

  /**
   * setCommand function
   * 
   * Set available commands to run.
   */
  private function setCommands()
  {
    $this->commands = [];

    array_push($this->commands, [
      "commandName" => "serve",
      "handler" => ServeCommand::class,
      "requiredParams" => 0
    ]);

    array_push($this->commands, [
      "commandName" => "create",
      "handler" => CreateCommand::class,
      "requiredParams" => 2
    ]);
  }

  /**
   * resolve function
   * 
   * Check if argument matches to available commands.
   * Throw an error if can not be found.
   */
  private function resolve()
  {
    if (!isset($this->params[0])) {
      // throw an Error
      return;
    }

    $inputCommand = $this->params[0];

    foreach ($this->commands as $command) {
      if ($command["commandName"] === $inputCommand) {
        $this->activeCommand = $command;
        unset($this->params[0]);
        $this->params = array_values($this->params);

        $this->run();
      }
    }

    if (empty($this->activeCommand)) {
      // throw an Error
      return;
    }
  }

  /**
   * run function
   * 
   * Run the selected command.
   * Throw an error if can not be finished.
   */
  private function run()
  {
    if (sizeof($this->params) != $this->activeCommand["requiredParams"]) {
      // throw an Error
      return;
    }

    $handler = $this->activeCommand["handler"];
    new $handler($this->rootDirectory, $this->params);
  }
}
