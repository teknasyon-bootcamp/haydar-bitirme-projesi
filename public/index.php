<?php 

require_once __DIR__.'/../vendor/autoload.php';

use Core\Application;

define('AppRootDirectory', dirname(__DIR__));

$app = new Application();

$app->router->get('/', 'home');
$app->router->get('/contact','deneme.contact');


$app->run();