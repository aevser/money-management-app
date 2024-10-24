<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1;

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

Route::apiResource('transaction', V1\TransactionController::class)
    ->except('show');

Route::post('register', [V1\Auth\AuthController::class, 'register'])
    ->name('user.register');

Route::post('login', [V1\Auth\AuthController::class, 'login'])
    ->name('user.login');

Route::post('logout', [V1\Auth\AuthController::class, 'logout'])
    ->name('user.logout');
