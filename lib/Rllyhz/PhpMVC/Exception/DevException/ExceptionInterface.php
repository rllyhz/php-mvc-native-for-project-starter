<?php

/**
 * @author rllyhz <rullyihza00@gmail.com>
 * @link https://github.com/rllyhz
 */

namespace Lib\Rllyhz\PhpMVC\Exception\DevExcption;

interface ExceptionInterface
{
  function setProperty(string $file, string $line);

  function setMessage(string $message);

  function showError();
}
