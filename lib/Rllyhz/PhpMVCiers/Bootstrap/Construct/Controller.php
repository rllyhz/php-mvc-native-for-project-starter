<?php

/**
 * @author rllyhz <rullyihza00@gmail.com>
 * @link https://github.com/rllyhz
 */

namespace Lib\Rllyhz\PhpMVCiers\Bootstrap\Construct;

use Lib\Rllyhz\PhpMVCiers\Helpers\AppHelper;
use Lib\Rllyhz\PhpMVCiers\Helpers\RequireHelper;

/**
 * Class Controller

 * Main Controller.
 * 
 * @package Lib\Rllyhz\PhpMVCiers\Bootstrap\Construct
 */
class Controller
{
  private function getViewsFolder()
  {
    return constant(AppHelper::$VIEWS_FOLDER);
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
