<?php

use Lib\Rllyhz\PhpMVC\Bootstrap\Construct\Application;
use Lib\Rllyhz\PhpMVC\Helpers\RequireHelper;

function view(string $view, $data = null)
{
  $fileView = RequireHelper::getValidFormatFile($view, constant(Application::$VIEWS_FOLDER));

  if (RequireHelper::fileExists($fileView)) {
    return RequireHelper::file($fileView, $data);
  }
}
