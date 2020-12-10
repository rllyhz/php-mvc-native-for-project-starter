<?php

use Lib\Rllyhz\PhpMVC\Bootstrap\Bootstrap;

require_once dirname(__DIR__) . "/vendor/autoload.php";

Bootstrap::build(dirname(__DIR__), []);

echo "Public index";
