<?php

/**
 * @author rllyhz <rullyihza00@gmail.com>
 * @link https://github.com/rllyhz
 */

namespace Lib\Rllyhz\PhpMVC\Http\Client;

use Lib\Rllyhz\PhpMVC\Http\Request as HttpRequest;

/**
 * Class Request
 * 
 * Http Client Request
 * 
 * @package Lib\Rllyhz\PhpMVC\Http|Client
 */
class Request
{
  /**
   * @var Request $request
   */
  private HttpRequest $request;

  /**
   * Request Constructor
   */
  public function __construct(HttpRequest $request)
  {
    $this->request = $request;
  }

  public function input(string $key)
  {
    return $this
      ->request->dataPOST($key);
  }

  public function files(string $key)
  {
    return $this
      ->request->dataFILE($key);
  }
}
