<?php

use App\Http\Controllers\HealthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthMiddleware;

Route::middleware([AuthMiddleware::class])->group(function () {
    Route::post('/users', [UserController::class, 'create_user']);
    Route::get('/users', [UserController::class, 'get_login_user']);

    Route::post('/todos', [TodoController::class, 'create_todo']);
    Route::get('/todos', [TodoController::class, 'get_todos']);
    Route::delete('/todos/{todoID}', [TodoController::class, 'delete_todo'])->where('todoID', '[0-9]+');
});

Route::get('/health', [HealthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);
