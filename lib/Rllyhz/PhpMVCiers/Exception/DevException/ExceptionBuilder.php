<?php

/**
 * @author rllyhz <rullyihza00@gmail.com>
 * @link https://github.com/rllyhz
 */

namespace Lib\Rllyhz\PhpMVCiers\Exception\DevException;

/**
 * Class ExceptionBuilder
 * 
 * @package Lib\Rllyhz\PhpMVCiers\Exception\DevExcption
 */
class ExceptionBuilder
{
  public static $TYPE_ERROR = 0;
  public static $TYPE_WARNING = 1;
  public static $TYPE_SUCCESS = 2;
  public static $TYPE_DEBUG = 3;

  private static $instance = null;
  private $exception;

  public static function build(string $exceptionDirectory, int $type, string $title, string $message = "")
  {
    if (self::$instance == null) {
      self::$instance = new ExceptionBuilder(new Exception($exceptionDirectory, $type, $title, $message));
    }

    return self::$instance;
  }

  public function __construct(Exception $exception)
  {
    $this->exception = $exception;
    return $this->exception;
  }

  public function setMessage(string $message)
  {
    $this->exception->setMessage($message);
    return $this->exception;
  }

  public function setProperty(string $filename, int $linePosition)
  {
    $this->exception->setProperty($filename, $linePosition);
    return $this->exception;
  }

  public function render()
  {
    return $this->exception->render();
  }
  // 
}
