<?php

/**
 * @author rllyhz <rullyihza00@gmail.com>
 * @link https://github.com/rllyhz
 */

namespace Lib\Rllyhz\PhpMVC\Http;

/**
 * Class Response
 * 
 * Http Response
 * 
 * @package Lib\Rllyhz\PhpMVC\Http
 */
class Response
{
  private Request $request;

  public function __construct(Request $request)
  {
    $this->request = $request;
  }

  public static function send(string $message, int $statusCode)
  {
    // 
  }
}
