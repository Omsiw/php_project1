<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

//user
Route::post('/singIn', [UserController::class, 'singIn']);
Route::post('/logIn', [UserController::class, 'logIn']);
Route::get('/delete/{id}', [UserController::class, 'destroy']);

//game
Route::post('/logIn', [UserController::class, 'logIn']);
