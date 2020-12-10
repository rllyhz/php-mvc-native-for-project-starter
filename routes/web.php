<?php

use App\Core\Route;

/**
 * Route for define the available routes of app.
 */

Route::get("/", 'HomeController@index');
