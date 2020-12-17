<?php

/**
 * @author rllyhz <rullyihza00@gmail.com>
 * @link https://github.com/rllyhz
 */

namespace Lib\Rllyhz\PhpMVCiers\Exception\DevException;

use Lib\Rllyhz\PhpMVCiers\Helpers\RequireHelper;

/**
 * Class Exception
 * 
 * @package Lib\Rllyhz\PhpMVCiers\Exception\DevExcption
 */
class Exception
{
  private $exceptionDirectory, $type, $tite, $message, $filename, $linePosition;

  public function __construct(string $exceptionDirectory, int $type, string $title, string $message = "", array $positionDetails = [])
  {
    $this->type = $type;
    $this->title = $title;
    $this->message = $message;
    $this->exceptionDirectory = $exceptionDirectory;
  }

  function setProperty(string $filename, int $linePosition)
  {
    $this->filename = $filename;
    $this->linePosition = $linePosition;
  }

  function setMessage(string $message)
  {
    // die(var_dump($message));
    $this->message = $message;
  }

  function render()
  {
    $viewFile = "";
    if ($this->type == ExceptionBuilder::$TYPE_ERROR) {
      $viewFile = RequireHelper::getValidFormatFile("error", $this->exceptionDirectory . DIRECTORY_SEPARATOR . "views");
    }

    if ($this->type == ExceptionBuilder::$TYPE_SUCCESS) {
      // 
    }

    if ($this->type == ExceptionBuilder::$TYPE_WARNING) {
      // 
    }

    if ($this->type == ExceptionBuilder::$TYPE_DEBUG) {
      // 
    }

    $data = [
      "title" => $this->title ?? "",
      "details" => [
        "message" => $this->message ?? "",
        "file" => $this->filename ?? "",
        "line" => $this->linePosition ?? "",
      ]
    ];

    return RequireHelper::fileExists($viewFile) ? RequireHelper::file($viewFile, $data) : "Something went wrong!";
  }
}
