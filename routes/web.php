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
use App\Middlewares\VerifyRole;

$app->router->get('/', [GuestController::class, 'welcome'])->name('welcome');
$app->router->get('/news', [GuestController::class, 'news'])->name('news');
$app->router->post('/manage/news/comment', [CommentController::class, 'store'])->name('manage.news.comment.store');
$app->router->get('/category', [GuestController::class, 'category'])->name('category');

$app->router->post('/logout', [AuthController::class, 'logout'])->name('logout');
$app->router->get('/register', [AuthController::class, 'register'])->name('register')->middleware(RedirectIfAuthenticated::class);
$app->router->post('/register', [UserController::class, 'store']);
$app->router->get('/login', [AuthController::class, 'login'])->name('login')->middleware(RedirectIfAuthenticated::class);;
$app->router->post('/login', [UserController::class, 'login'])->name('login');

$app->router->get('/manage/main', [UserController::class, 'main'])->name('manage.main')->middleware(Auth::class);

$app->router->get('/manage/categories', [CategoryController::class, 'index'])->name('manage.category.index')->middleware(Auth::class, new VerifyRole(3));
$app->router->post('/manage/category/editor/add', [CategoryController::class, 'editorAdd'])->name('manage.category.editor.add')->middleware(Auth::class, new VerifyRole(3));
$app->router->delete('/manage/category/editor/delete', [CategoryController::class, 'editorDelete'])->name('manage.category.editor.destory')->middleware(Auth::class, new VerifyRole(3));
$app->router->get('/manage/categories/create', [CategoryController::class, 'create'])->name('manage.category.create')->middleware(Auth::class, new VerifyRole(3));
$app->router->post('/manage/categories/create', [CategoryController::class, 'store'])->name('manage.category.store')->middleware(Auth::class, new VerifyRole(3));
$app->router->get('/manage/category/edit', [CategoryController::class, 'edit'])->name('manage.category.edit')->middleware(Auth::class, new VerifyRole(3));
$app->router->put('/manage/category/edit', [CategoryController::class, 'update'])->name('manage.category.update')->middleware(Auth::class, new VerifyRole(3));
$app->router->delete('/manage/category/delete', [CategoryController::class, 'destroy'])->name('manage.category.destroy')->middleware(Auth::class, new VerifyRole(3));

$app->router->get('/manage/news', [NewsController::class, 'index'])->name('manage.news.index')->middleware(Auth::class, new VerifyRole(2));
$app->router->get('/manage/news/create', [NewsController::class, 'create'])->name('manage.news.create')->middleware(Auth::class, new VerifyRole(2));
$app->router->post('/manage/news/create', [NewsController::class, 'store'])->name('manage.news.store')->middleware(Auth::class, new VerifyRole(2));
$app->router->get('/manage/news/edit', [NewsController::class, 'edit'])->name('manage.news.edit')->middleware(Auth::class, new VerifyRole(2));
$app->router->put('/manage/news/edit', [NewsController::class, 'update'])->name('manage.news.update')->middleware(Auth::class, new VerifyRole(2));
$app->router->delete('/manage/news/delete', [NewsController::class, 'destroy'])->name('manage.news.destroy')->middleware(Auth::class, new VerifyRole(2));

$app->router->get('/manage/comment', [CommentController::class, 'index'])->name('manage.comment.index')->middleware(Auth::class);
$app->router->get('/manage/comment/edit', [CommentController::class, 'edit'])->name('manage.comment.edit')->middleware(Auth::class);
$app->router->put('/manage/comment/edit', [CommentController::class, 'update'])->name('manage.comment.update')->middleware(Auth::class);
$app->router->delete('/manage/comment', [CommentController::class, 'destory'])->name('manage.comment.destroy')->middleware(Auth::class);

$app->router->get('/manage/account/deleteRequest', [UserController::class, 'requestView'])->name('manage.user.request.index')->middleware(Auth::class, new VerifyRole(3));
$app->router->post('/manage/account/deleteRequest', [UserController::class, 'request'])->name('manage.user.delete.request')->middleware(Auth::class);
$app->router->delete('/manage/account/deleteRequest', [UserController::class, 'destroy'])->name('manage.user.destroy')->middleware(Auth::class, new VerifyRole(3));
$app->router->get('/manage/accounts', [UserController::class, 'index'])->name('manage.user.index')->middleware(Auth::class, new VerifyRole(3));
$app->router->put('/manage/account/role/update', [UserController::class, 'roleUpdate'])->name('manage.user.role.update')->middleware(Auth::class, new VerifyRole(3));
$app->router->get('/manage/account/news/seen', [UserController::class, 'seenNews'])->name('manage.user.news.seen')->middleware(Auth::class);

$app->router->put('/manage/account/follow/category', [UserController::class, 'requestFollow'])->name('manage.user.follow.category')->middleware(Auth::class);

$app->router->get('/manage/accounts/logs', [UserController::class, 'logs'])->name('manage.user.logs')->middleware(Auth::class, new VerifyRole(3));