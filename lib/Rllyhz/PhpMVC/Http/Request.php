<?php

/**
 * @author rllyhz <rullyihza00@gmail.com>
 * @link https://github.com/rllyhz
 */

namespace Lib\Rllyhz\PhpMVC\Http;

/**
 * Class Request
 * 
 * Http Request
 * 
 * @package Lib\Rllyhz\PhpMVC\Http
 */
class Request
{
  private Server $server;
  private array $dataGETs;
  private array $dataPOSTs;
  private array $dataFILEs;

  public function __construct(Server $server, array $dataGETs, array $dataPOSTs, array $dataFILEs)
  {
    $this->server = $server;
    $this->dataGETs = $dataGETs;
    $this->dataPOSTs = $dataPOSTs;
    $this->dataFILEs = $dataFILEs;
  }

  public function getServer()
  {
    return $this->server;
  }

  public function dataGET(string $key = "")
  {
    if ($key == "") {
      return $this->dataGETs;
    }

    if (isset($this->dataGETs[$key])) {
      return $this->dataGETs[$key];
    }

    // throw an Error
  }

  public function dataPOST(string $key = "")
  {
    if ($key == "") {
      return $this->dataPOSTs;
    }

    if (isset($this->dataPOSTs[$key])) {
      return $this->dataPOSTs[$key];
    }

    // throw an Error
  }

  public function dataFILE(string $key = "")
  {
    if ($key == "") {
      return $this->dataFILEs;
    }

    if (isset($this->dataFILEs[$key])) {
      return $this->dataFILEs[$key];
    }

    // throw an Error
  }
}
