<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MoneyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('aboutUs', [HomeController::class, 'aboutUs'])->name('aboutUs');
Route::get('contacts', [HomeController::class, 'contacts'])->name('contacts');
Route::get('service', [HomeController::class, 'service'])->name('service');

Route::prefix('authorization')->group(function(){
        Route::get('/', [AuthController::class, 'getAuth'])->middleware(GuestMiddleware::class)->name('getAuth');
        Route::post('/auth', [AuthController::class, 'postAuth'])->name('postAuth');
        Route::post('/register', [AuthController::class, 'postRegister'])->middleware(GuestMiddleware::class)->name('postRegister');
        Route::post('/logout', [AuthController::class, 'logout'])->middleware(AuthMiddleware::class)->name('logout');
 });
 Route::prefix('admin')->middleware(AdminMiddleware::class)->group(function(){
        Route::get('/info', [AdminController::class, 'info'])->name('info');
        Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');
        Route::patch('/users/{id}/setAdmin', [AdminController::class, 'setAdmin'])->name('users.setAdmin');
 });
Route::prefix('money')->middleware(AuthMiddleware::class)->group(function(){
       Route::get('/money', [MoneyController::class, 'moneyStatic'])->name('money.static');
       Route::get('/moneyHistory', [MoneyController::class, 'moneyHistory'])->name('money.history');
       Route::post('/addMoney', [MoneyController::class, 'addMoney'])->name('money.addMoney');
});
       Route::get('/transactions/export', [MoneyController::class, 'moneyExport'])
       ->middleware(AuthMiddleware::class)->name('transactions.export');
Route::prefix('users')->middleware(AuthMiddleware::class)->group(function(){
       Route::get('/profile', [UserController::class, 'getProfile'])->name('user.profile');
       Route::patch('/updateProfile', [UserController::class, 'update'])->name('user.update');
});
Route::get('posts/index', [PostController::class, 'index'])->name('posts.index');
Route::prefix('posts')->middleware(AdminMiddleware::class)->group(function(){
       Route::get('/create', [PostController::class, 'create'])->name('posts.create');
       Route::post('/store', [PostController::class, 'store'])->name('posts.store');
       Route::delete('/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
       Route::get('/edit', [PostController::class, 'edit'])->name('posts.edit');
});
Route::get('posts/{id}', [PostController::class, 'show'])->name('posts.show');

Route::prefix('messages')->middleware(AuthMiddleware::class)->group(function(){
       Route::get('/index', [MessageController::class, 'index'])->name('messages.index');
       Route::get('/create', [MessageController::class, 'create'])->name('messages.create');
       Route::post('/store', [MessageController::class, 'store'])->name('messages.store');
       Route::get('/{id}', [MessageController::class, 'show'])->name('messages.show');
});
