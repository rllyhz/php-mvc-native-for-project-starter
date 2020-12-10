<?php

/**
 * @author rllyhz <rullyihza00@gmail.com>
 * @link https://github.com/rllyhz
 */

namespace Lib\Rllyhz\PhpMVC\Helpers;

/**
 * Class RequireHelper
 * 
 * Helpers to assistant main app require php files safely.
 * 
 * @package Lib\Rllyhz\PhpMVC\Helpers
 */
class RequireHelper
{
  public static function getValidFormatFile(string $fileName, string $folder = "")
  {
    if ($folder == "") {
      return $fileName . ".php";
    }

    return $folder . DIRECTORY_SEPARATOR . $fileName . ".php";
  }
  public static function fileExists($file)
  {
    if (file_exists($file)) {
      return true;
    }

    return false;
  }

  public static function file(string $pathToFile)
  {
    // require a php file
  }

  public static function fileInFolder(string $folder, $fileName)
  {
    // require php file in a folder
    $file = $folder . DIRECTORY_SEPARATOR . $fileName;

    if (self::fileExists($file)) {
      require_once $file;
    }

    // throw an Error
  }

  public static function filesInfolder($folderPath, $option)
  {
    // require all php files in a folder
  }
}
