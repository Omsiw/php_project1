<?php

use App\Http\Controllers\DiscountController;
use App\Http\Controllers\DLSController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ModController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\OSController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\RevieController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishGameController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//user
Route::post('/singIn', [UserController::class, 'singIn']);
Route::post('/logIn', [UserController::class, 'logIn']);
Route::get('/delete/{id}', [UserController::class, 'destroy']);

//game
Route::get('/selectAll', [GameController::class, 'selectAll']);
Route::get('/selectById/{id}', [GameController::class, 'selectById']);
Route::get('/selectByTagId/{id}', [GameController::class, 'selectByTagId']);
Route::get('/selectByUserId/{id}', [GameController::class, 'selectByUserId']);
Route::get('/selectByAuthorId/{id}', [GameController::class, 'selectByAuthorId']);
Route::get('/selectByPublisherId/{id}', [GameController::class, 'selectByPublisherId']);
Route::post('/create', [GameController::class, 'create']);
Route::post('/update', [GameController::class, 'update']);
Route::get('/delete/{id}', [GameController::class, 'destroy']);

//dls
Route::get('/selectById/{id}', [DLSController::class, 'selectById']);
Route::get('/selectByUserId/{id}', [DLSController::class, 'selectByUserId']);
Route::get('/selectByGameId/{id}', [DLSController::class, 'selectByGameId']);
Route::get('/selectByAuthorId/{id}', [DLSController::class, 'selectByAuthorId']);
Route::get('/selectByPublisherId/{id}', [DLSController::class, 'selectByPublisherId']);
Route::post('/create', [DLSController::class, 'create']);
Route::post('/update', [DLSController::class, 'update']);
Route::get('/delete/{id}', [DLSController::class, 'destroy']);

//mod
Route::get('/selectById/{id}', [ModController::class, 'selectById']);
Route::get('/selectByUserId/{id}', [ModController::class, 'selectByUserId']);
Route::get('/selectByGameId/{id}', [ModController::class, 'selectByGameId']);
Route::get('/selectByAuthorId/{id}', [ModController::class, 'selectByAuthorId']);
Route::post('/create', [ModController::class, 'create']);
Route::post('/update', [ModController::class, 'update']);
Route::get('/delete/{id}', [ModController::class, 'destroy']);

//author
Route::post('/create', [AuthorController::class, 'create']);
Route::post('/update', [AuthorController::class, 'update']);
Route::get('/delete/{id}', [AuthorController::class, 'destroy']);

//publisher
Route::post('/create', [PublisherController::class, 'create']);
Route::post('/update', [PublisherController::class, 'update']);
Route::get('/delete/{id}', [PublisherController::class, 'destroy']);

//tag
Route::post('/create', [TagController::class, 'create']);
Route::post('/update', [TagController::class, 'update']);
Route::get('/delete/{id}', [TagController::class, 'destroy']);

//os
Route::post('/create', [OSController::class, 'create']);
Route::post('/update', [OSController::class, 'update']);
Route::get('/delete/{id}', [OSController::class, 'destroy']);

//wish game
Route::get('/selectByUserId/{id}', [WishGameController::class, 'selectByUserId']);
Route::post('/create', [WishGameController::class, 'create']);
Route::get('/delete/{id}', [WishGameController::class, 'destroy']);

//discount
Route::get('/selectByGameId/{id}', [DiscountController::class, 'selectByGameId']);
Route::post('/create', [DiscountController::class, 'create']);
Route::post('/update', [DiscountController::class, 'update']);
Route::get('/delete/{id}', [DiscountController::class, 'destroy']);

//order
Route::get('/selectByUserId/{id}', [OrderController::class, 'selectByUserId']);
Route::post('/create', [OrderController::class, 'create']);
Route::post('/update', [OrderController::class, 'update']);
Route::get('/delete/{id}', [OrderController::class, 'destroy']);

//order history
Route::get('/selectByUserId/{id}', [OrderHistoryController::class, 'selectByUserId']);
Route::post('/create', [OrderHistoryController::class, 'create']);
Route::post('/update', [OrderHistoryController::class, 'update']);
Route::get('/delete/{id}', [OrderHistoryController::class, 'destroy']);

//revie
Route::get('/selectByUserId/{id}', [RevieController::class, 'selectByUserId']);
Route::get('/selectByGameId/{id}', [RevieController::class, 'selectByUserId']);
Route::post('/create', [RevieController::class, 'create']);
Route::post('/update', [RevieController::class, 'update']);
Route::get('/delete/{id}', [RevieController::class, 'destroy']);

