<?php 

namespace Routes;

use App\Controllers\AuthController;
use App\Controllers\UserController;


$app->router->get('/','welcome')->name('welcome');
$app->router->post('/', [TestController::class,'index'])->name('');
$app->router->get('/contact','contact');
$app->router->get('/register',[AuthController::class,'register'])->name('register');
$app->router->post('/register',[UserController::class,'store']);
$app->router->get('/login',[AuthController::class,'login'])->name('login');