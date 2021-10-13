<?php 

require_once __DIR__.'/../vendor/autoload.php';

use Core\Application;

define('AppRootDirectory', dirname(__DIR__));

if (env('MAINTANCE_MODE') === true) {
    # code...
}

$app = new Application();
include_once AppRootDirectory."/routes/web.php";

$app->run();