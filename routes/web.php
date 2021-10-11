<?php

namespace Routes;

use App\Controllers\AuthController;
use App\Controllers\CategoryController;
use App\Controllers\CommentController;
use App\Controllers\GuestController;
use App\Controllers\UserController;
use App\Controllers\NewsController;
use App\Middlewares\Auth;
use App\Middlewares\RedirectIfAuthenticated;


$app->router->get('/', [GuestController::class, 'welcome'])->name('welcome');
$app->router->get('/news', [GuestController::class, 'news'])->name('news');
$app->router->post('/manage/news/comment', [CommentController::class, 'store'])->name('manage.news.comment.store');
$app->router->get('/category', [GuestController::class, 'category'])->name('category');

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

$app->router->get('/manage/news', [NewsController::class, 'index'])->name('manage.news.index');
$app->router->get('/manage/news/create', [NewsController::class, 'create'])->name('manage.news.create');
$app->router->post('/manage/news/create', [NewsController::class, 'store'])->name('manage.news.store');
$app->router->get('/manage/news/edit', [NewsController::class, 'edit'])->name('manage.news.edit');
$app->router->put('/manage/news/edit', [NewsController::class, 'update'])->name('manage.news.update');
$app->router->delete('/manage/news/delete', [NewsController::class, 'destroy'])->name('manage.news.destroy');

$app->router->get('/manage/comment', [CommentController::class, 'index'])->name('manage.comment.index');
$app->router->get('/manage/comment/edit', [CommentController::class, 'edit'])->name('manage.comment.edit');
$app->router->put('/manage/comment/edit', [CommentController::class, 'update'])->name('manage.comment.update');
$app->router->delete('/manage/comment', [CommentController::class, 'destory'])->name('manage.comment.destroy');

$app->router->post('/manage/account/deleteRequest', [UserController::class, 'request'])->name('manage.user.delete.request');
