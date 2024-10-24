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

Route::middleware('auth:sanctum')->group(function (){
    // Транзакции
    Route::apiResource('transaction', V1\TransactionController::class)
        ->except('show');

    // Выход
    Route::post('logout', [V1\Auth\AuthController::class, 'logout'])
        ->name('user.logout');

    Route::get('transaction/search', [V1\TransactionController::class, 'search'])
        ->name('transaction.user');
});

// Регистрация
Route::post('register', [V1\Auth\AuthController::class, 'register'])
    ->name('user.register');

// Логин
Route::post('login', [V1\Auth\AuthController::class, 'login'])
    ->name('user.login');


