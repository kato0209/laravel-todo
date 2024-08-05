<?php

use App\Http\Controllers\HealthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoController;

Route::get('/health', [HealthController::class, 'index']);
Route::post('/users', [UserController::class, 'create_user']);
Route::post('/todos', [TodoController::class, 'create_todo']);
Route::get('/todos', [TodoController::class, 'get_todos']);
