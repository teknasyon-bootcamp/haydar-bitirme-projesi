<?php

namespace Routes;

use App\Controllers\AuthController;
use App\Controllers\CategoryController;
use App\Controllers\UserController;
use App\Middlewares\Auth;
use App\Middlewares\RedirectIfAuthenticated;


$app->router->get('/', 'welcome')->name('welcome');
$app->router->get('/contact', 'contact');

$app->router->post('/logout', [AuthController::class, 'logout'])->name('logout');
$app->router->get('/register', [AuthController::class, 'register'])->name('register')->middleware(RedirectIfAuthenticated::class);
$app->router->post('/register', [UserController::class, 'store']);
$app->router->get('/login', [AuthController::class, 'login'])->name('login')->middleware(RedirectIfAuthenticated::class);;
$app->router->post('/login', [UserController::class, 'login'])->name('login');

$app->router->get('/manage/main', 'manage.main')->name('manage.main')->middleware(Auth::class);
$app->router->get('/manage/categories', [CategoryController::class, 'index'])->name('manage.category.index');
$app->router->post('/manage/category/editor/add', [CategoryController::class, 'editorAdd'])->name('manage.category.editor.add');
$app->router->delete('/manage/category/editor/delete', [CategoryController::class, 'editorDelete'])->name('manage.category.editor.destory');
$app->router->get('/manage/categories/create', [CategoryController::class, 'create'])->name('manage.category.create');
$app->router->post('/manage/categories/create', [CategoryController::class, 'store'])->name('manage.category.store');
$app->router->get('/manage/category/edit', [CategoryController::class, 'edit'])->name('manage.category.edit');
$app->router->put('/manage/category/edit', [CategoryController::class, 'update'])->name('manage.category.update');
$app->router->delete('/manage/category/delete', [CategoryController::class, 'destroy'])->name('manage.category.destroy');
