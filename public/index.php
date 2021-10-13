<?php 

require_once __DIR__.'/../vendor/autoload.php';

use App\Exceptions\MaintanceException;
use Core\Application;

define('AppRootDirectory', dirname(__DIR__));

if (env('MAINTANCE_MODE') == true) {
    
    require_once AppRootDirectory."/views/errors/maintance.php";

    exit;
    
}

$app = new Application();
include_once AppRootDirectory."/routes/web.php";

$app->run();