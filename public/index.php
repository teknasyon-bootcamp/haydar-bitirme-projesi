<?php 

require_once __DIR__.'/../vendor/autoload.php';

use App\Controllers\TestController;
use Core\Application;

define('AppRootDirectory', dirname(__DIR__));

$app = new Application();

$app->router->get('/','welcome');

$app->router->post('/', [TestController::class,'index']);
$app->router->get('/contact','contact');


$app->run();