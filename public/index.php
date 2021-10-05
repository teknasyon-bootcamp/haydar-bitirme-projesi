<?php 

require_once __DIR__.'/../vendor/autoload.php';

use App\Controllers\TestController;
use Core\Application;

define('AppRootDirectory', dirname(__DIR__));

$app = new Application();
include_once AppRootDirectory."/routes/web.php";

$app->run();