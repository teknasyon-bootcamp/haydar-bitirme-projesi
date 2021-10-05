<?php 

namespace Routes;

use App\Controllers\AuthController;
use App\Controllers\UserController;


$app->router->get('/','welcome');
$app->router->post('/', [TestController::class,'index']);
$app->router->get('/contact','contact');
$app->router->get('/register',[AuthController::class,'register']);
$app->router->post('/register',[UserController::class,'store']);
$app->router->get('/login',[AuthController::class,'login']);