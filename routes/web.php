<?php

namespace Routes;

use App\Controllers\AuthController;
use App\Controllers\UserController;
use App\Middlewares\Auth;
use App\Middlewares\RedirectIfAuthenticated;

$app->router->get('/manage/main', 'manage.main')->name('manage.main')->middleware(Auth::class);
$app->router->post('/logout', [AuthController::class, 'logout'])->name('logout');
$app->router->get('/', 'welcome')->name('welcome');
$app->router->get('/contact', 'contact');

$app->router->post('/logout', [AuthController::class, 'logout'])->name('logout');
$app->router->get('/register', [AuthController::class, 'register'])->name('register')->middleware(RedirectIfAuthenticated::class);
$app->router->post('/register', [UserController::class, 'store']);
$app->router->get('/login', [AuthController::class, 'login'])->name('login')->middleware(RedirectIfAuthenticated::class);;
$app->router->post('/login', [UserController::class, 'login'])->name('login');
