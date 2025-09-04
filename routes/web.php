<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::prefix('authorization')->group(function(){
        Route::get('/', [AuthController::class, 'getAuth'])->name('getAuth');
        Route::post('/auth', [AuthController::class, 'postAuth'])->name('postAuth');
        Route::post('/register', [AuthController::class, 'postRegister'])->name('postRegister');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
 });

