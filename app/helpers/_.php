<?php

use Lib\Rllyhz\PhpMVCiers\Helpers\AppHelper;
use Lib\Rllyhz\PhpMVCiers\Helpers\RequireHelper;

function view(string $view, $data = null)
{
  $fileView = RequireHelper::getValidFormatFile($view, constant(AppHelper::$VIEWS_FOLDER));

  if (RequireHelper::fileExists($fileView)) {
    return RequireHelper::file($fileView, $data);
  }
}
