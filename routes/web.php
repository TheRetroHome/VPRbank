<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::prefix('authorization')->group(function(){
        Route::get('/', [AuthController::class, 'getAuth'])->name('getAuth');
        Route::post('/auth', [AuthController::class, 'postAuth'])->name('postAuth');
        Route::post('/register', [AuthController::class, 'postRegister'])->name('postRegister');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
 });
 Route::prefix('admin')->middleware(AdminMiddleware::class)->group(function(){
        Route::get('/info', [AdminController::class, 'info'])->name('info');
        Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');
 });
