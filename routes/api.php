<?php

use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// route::get('user', [UserController::class, 'index']);

Route::apiResource('users', UserController::class);

Route::apiResource('funcionario', FuncionarioController::class);