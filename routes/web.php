<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MoneyController;


Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('aboutUs', [HomeController::class, 'aboutUs'])->name('aboutUs');
Route::get('contacts', [HomeController::class, 'contacts'])->name('contacts');

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
