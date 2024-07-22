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
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/userDelete/{id}', [UserController::class, 'destroy']);

    //game
    Route::get('/gameSelectAll', [GameController::class, 'selectAll']);
    Route::get('/gameSelectById/{id}', [GameController::class, 'selectById']);
    Route::get('/gameSelectByTagId/{id}', [GameController::class, 'selectByTagId']);
    Route::get('/gameSelectByUserId/{id}', [GameController::class, 'selectByUserId']);
    Route::get('/gameSelectByAuthorId/{id}', [GameController::class, 'selectByAuthorId']);
    Route::get('/gameSelectByPublisherId/{id}', [GameController::class, 'selectByPublisherId']);
    Route::post('/gameCreate', [GameController::class, 'create']);
    Route::post('/gameUpdate', [GameController::class, 'update']);
    Route::get('/gameDelete/{id}', [GameController::class, 'destroy']);

    //dls
    Route::get('/dlsSelectById/{id}', [DLSController::class, 'selectById']);
    Route::get('/dlsSelectByUserId/{id}', [DLSController::class, 'selectByUserId']);
    Route::get('/dlsSelectByGameId/{id}', [DLSController::class, 'selectByGameId']);
    Route::get('/dlsSelectByAuthorId/{id}', [DLSController::class, 'selectByAuthorId']);
    Route::get('/dlsSelectByPublisherId/{id}', [DLSController::class, 'selectByPublisherId']);
    Route::post('/dlsCreate', [DLSController::class, 'create']);
    Route::post('/dlsUpdate', [DLSController::class, 'update']);
    Route::get('/dlsDelete/{id}', [DLSController::class, 'destroy']);

    //mod
    Route::get('/modSelectById/{id}', [ModController::class, 'selectById']);
    Route::get('/modSelectByUserId/{id}', [ModController::class, 'selectByUserId']);
    Route::get('/modSelectByGameId/{id}', [ModController::class, 'selectByGameId']);
    Route::get('/modSelectByAuthorId/{id}', [ModController::class, 'selectByAuthorId']);
    Route::post('/modCreate', [ModController::class, 'create']);
    Route::post('/modUpdate', [ModController::class, 'update']);
    Route::get('/delete/{id}', [ModController::class, 'destroy']);

    //author
    Route::post('/authorCreate', [AuthorController::class, 'create']);
    Route::post('/authorUpdate', [AuthorController::class, 'update']);
    Route::get('/authorDelete/{id}', [AuthorController::class, 'destroy']);

    //publisher
    Route::post('/publCreate', [PublisherController::class, 'create']);
    Route::post('/publUpdate', [PublisherController::class, 'update']);
    Route::get('/publDelete/{id}', [PublisherController::class, 'destroy']);

    //tag
    Route::post('/tagCreate', [TagController::class, 'create']);
    Route::post('/tagUpdate', [TagController::class, 'update']);
    Route::get('/tagDelete/{id}', [TagController::class, 'destroy']);

    //os
    Route::post('/osCreate', [OSController::class, 'create']);
    Route::post('/osUpdate', [OSController::class, 'update']);
    Route::get('/osDelete/{id}', [OSController::class, 'destroy']);

    //wish game
    Route::get('/whGameSelectByUserId/{id}', [WishGameController::class, 'selectByUserId']);
    Route::post('/whGameCreate', [WishGameController::class, 'create']);
    Route::get('/whGameDelete/{id}', [WishGameController::class, 'destroy']);

    //discount
    Route::get('/discountSelectByGameId/{id}', [DiscountController::class, 'selectByGameId']);
    Route::post('/discountCreate', [DiscountController::class, 'create']);
    Route::post('/discountUpdate', [DiscountController::class, 'update']);
    Route::get('/discountDelete/{id}', [DiscountController::class, 'destroy']);

    //order
    Route::get('/orderSelectByUserId/{id}', [OrderController::class, 'selectByUserId']);
    Route::post('/orderCreate', [OrderController::class, 'create']);
    Route::post('/orderUpdate', [OrderController::class, 'update']);
    Route::get('/orderDelete/{id}', [OrderController::class, 'destroy']);

    //order history
    Route::get('/OrdHisSelectByUserId/{id}', [OrderHistoryController::class, 'selectByUserId']);
    Route::post('/OrdHisCreate', [OrderHistoryController::class, 'create']);
    Route::post('/OrdHisUpdate', [OrderHistoryController::class, 'update']);
    Route::get('/OrdHisDelete/{id}', [OrderHistoryController::class, 'destroy']);

    //revie
    Route::get('/revieSelectByUserId/{id}', [RevieController::class, 'selectByUserId']);
    Route::get('/revieSelectByGameId/{id}', [RevieController::class, 'selectByUserId']);
    Route::post('/revieCreate', [RevieController::class, 'create']);
    Route::post('/revieUpdate', [RevieController::class, 'update']);
    Route::get('/revieDelete/{id}', [RevieController::class, 'destroy']);
});
