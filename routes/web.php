<?php

use App\Core\Route;

/**
 * Route for define the available routes of app.
 */

Route::view("/", 'welcome');

Route::get("/test", function () {
  return view("example");
});

Route::get("greeting/{name}/{age}", function ($request, $name, $age) {
  echo "Hello, $name. Your age is $age year-old.";
});

Route::get("example/index", 'ExampleController@index');
