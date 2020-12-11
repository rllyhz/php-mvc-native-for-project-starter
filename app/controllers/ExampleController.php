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
}
