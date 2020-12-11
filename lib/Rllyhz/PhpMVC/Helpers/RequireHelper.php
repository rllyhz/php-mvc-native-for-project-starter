<?php

/**
 * @author rllyhz <rullyihza00@gmail.com>
 * @link https://github.com/rllyhz
 */

namespace Lib\Rllyhz\PhpMVC\Helpers;

/**
 * Class RequireHelper
 * 
 * Helper to assistant main app to require php files safely.
 * 
 * @package Lib\Rllyhz\PhpMVC\Helpers
 */
class RequireHelper
{
  /**
   * Get valid format file (.php)
   * 
   * @return string $validFormattedFile
   */
  public static function getValidFormatFile(string $fileName, string $folder = "")
  {
    if ($folder == "") {
      return $fileName . ".php";
    }

    return $folder . DIRECTORY_SEPARATOR . $fileName . ".php";
  }

  /**
   * Check a php file exists.
   * 
   * @param string $pathToFile
   * @return bool $exists
   */
  public static function fileExists(string $pathToFile)
  {
    if (file_exists($pathToFile)) {
      return true;
    }

    return false;
  }

  /**
   * Require a php file.
   * 
   * @param string $pathToFile
   */
  public static function file(string $pathToFile, $data = null)
  {
    if ($data != null) {
      extract($data);
    }

    require_once $pathToFile;
  }

  /**
   * Require a php file in specific folder.
   * 
   * @param string $pathToFile
   * @param string $fileName
   */
  public static function fileInFolder(string $folder, string $fileName)
  {
    $file = $folder . DIRECTORY_SEPARATOR . $fileName;

    if (self::fileExists($file)) {
      require_once $file;
    }

    // throw an Error
  }

  /**
   * Require all files in specific folder.
   * 
   * @param string $folder
   * @param array $option
   */
  public static function filesInfolder($folder, $option = null)
  {
    if ($option != null) {
    }

    $files = glob($folder . '/*.php');
    foreach ($files as $file) {
      require_once $file;
    }
  }
}
