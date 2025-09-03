<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('authorization')->group(function(){
        Route::get('/', [AuthController::class, 'getAuth'])->name('getAuth');
 });

