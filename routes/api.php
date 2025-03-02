<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\TransactionController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Защищённые маршруты
Route::middleware(['auth:api'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'me']);

    Route::post('/accounts', [BankAccountController::class, 'store']);
    Route::get('/accounts', [BankAccountController::class, 'index']);
    Route::get('/accounts/{id}', [BankAccountController::class, 'show']);
    Route::delete('/accounts/{id}', [BankAccountController::class, 'destroy']);

    Route::post('/transactions', [TransactionController::class, 'store']);
    Route::get('/transactions', [TransactionController::class, 'index']);
});
