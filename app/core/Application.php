<?php

namespace App\Core;

use Lib\Rllyhz\PhpMVC\Bootstrap\Construct\Application as App;

/**
 * Class Application
 * 
 * @package App\Core
 */
class Application extends App
{
  public function __construct(string $rootDirectory)
  {
    parent::__construct($rootDirectory);
  }
}
