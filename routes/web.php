<?php 

namespace Routes;

use App\Controllers\AuthController;
use App\Controllers\UserController;

$app->router->get('/manage/main', 'manage.main')->name('manage.main');
$app->router->post('/logout', [AuthController::class,'logout'])->name('logout');
$app->router->get('/','welcome')->name('welcome');
$app->router->get('/contact','contact');
$app->router->get('/register',[AuthController::class,'register'])->name('register');
$app->router->post('/register',[UserController::class,'store']);
$app->router->get('/login',[AuthController::class,'login'])->name('login');
$app->router->post('/login',[UserController::class,'login'])->name('login');
