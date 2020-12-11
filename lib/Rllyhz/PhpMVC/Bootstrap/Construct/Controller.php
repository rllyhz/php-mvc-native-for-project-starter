<?php

/**
 * @author rllyhz <rullyihza00@gmail.com>
 * @link https://github.com/rllyhz
 */

namespace Lib\Rllyhz\PhpMVC\Bootstrap\Construct;

use Lib\Rllyhz\PhpMVC\Helpers\RequireHelper;

/**
 * Class Controller

 * Main Controller.
 * 
 * @package Lib\Rllyhz\PhpMVC\Bootstrap\Construct
 */
class Controller
{
  private function getViewsFolder()
  {
    return constant(Application::$VIEWS_FOLDER);
  }

  private function has(string $view)
  {
    $view = trim($view, "/");
    $fileView = RequireHelper::getValidFormatFile($view, $this->getViewsFolder());

    if (RequireHelper::fileExists($fileView)) {
      return true;
    } else {
      return false;
    }
  }

  protected function render(string $view, $data = null)
  {
    if ($this->has($view)) {
      $fileView = RequireHelper::getValidFormatFile($view, $this->getViewsFolder());

      return RequireHelper::file($fileView, $data);
    }

    // throw an Error
  }
}
