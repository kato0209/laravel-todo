<?php

use App\Http\Controllers\HealthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthController;

Route::get('/health', [HealthController::class, 'index']);
Route::post('/users', [UserController::class, 'create_user']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/todos', [TodoController::class, 'create_todo']);
Route::get('/todos', [TodoController::class, 'get_todos']);
