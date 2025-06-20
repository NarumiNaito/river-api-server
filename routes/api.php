<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\WaterLevelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:user')->group(function () {
    Route::prefix('/user')->name('profile.')->group(function() {
        Route::get('/', [AuthController::class,'user'])->name('user');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
    Route::prefix('/user-water-level')->name('water.')->group(function() {
        Route::get('/fetch', [WaterLevelController::class, 'fetch'])->name('fetch');
        Route::post('setting', [WaterLevelController::class, 'setting'])->name('setting');
    });  
});

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
