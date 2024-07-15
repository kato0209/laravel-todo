<?php

use App\Http\Controllers\HealthController;
use App\Http\Controllers\UserController;

Route::get('/health', [HealthController::class, 'index']);
Route::post('/users', [UserController::class, 'create_user']);
