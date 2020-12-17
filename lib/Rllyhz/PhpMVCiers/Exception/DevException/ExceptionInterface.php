<?php

/**
 * @author rllyhz <rullyihza00@gmail.com>
 * @link https://github.com/rllyhz
 */

namespace Lib\Rllyhz\PhpMVCiers\Exception\DevException;

/**
 * Interface ExceptionInterface
 * 
 * @package Lib\Rllyhz\PhpMVCiers\Exception\DevExcption
 */
interface ExceptionInterface
{
  function setProperty(string $filename, int $linePosition);

  function setMessage(string $message);

  function showError();

  function render();
}
