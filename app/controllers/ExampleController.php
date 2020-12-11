<?php

namespace App\Controllers;

use App\Core\Controller;

/**
 * Class ExampleController
 * 
 * @package App\Core
 */
class ExampleController extends Controller
{
  public function index()
  {
    $data = [
      "nama" => "Rully Ihza Mahendra",
      "nim" => "530",
    ];

    return view("example", $data);
  }

  public function greeting($req, $name)
  {
    $name = $this->capitalize($name);
    return "Hello, $name!";
  }

  public function capitalize(string $word)
  {
    $capitalizedWord = $word;
    $fistChar = strtoupper($capitalizedWord[0]);
    $capitalizedWord[0] = $fistChar;

    return $capitalizedWord;
  }
}
