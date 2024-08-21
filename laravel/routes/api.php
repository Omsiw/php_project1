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
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//user
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/gameRandomSelect', [GameController::class, 'randomGames']);
Route::get('/gameSelect/{id}', [GameController::class, 'item']);
Route::get('/gameSelect', [GameController::class, 'list']);
Route::get('/osSelect', [OSController::class, 'list']);
Route::get('/tagSelect', [TagController::class, 'list']);
Route::get('/authorSelect', [AuthorController::class, 'list']);
Route::get('/publSelect', [PublisherController::class, 'list']);
Route::get('/discountSelectRandomGame', [Discount::class, 'selectRandomGames']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/userSelectAllGames/{id}', [UserController::class, 'showGames']);
    Route::get('/userAddGameInLib/{id}/{gameId}', [UserController::class, 'addGame']);
    Route::get('/userDelete/{id}', [UserController::class, 'destroy']);

    //game
    Route::get('/gameSelectByTagId/{id}', [GameController::class, 'selectByTagId']);
    Route::get('/gameSelectByUserId/{id}', [GameController::class, 'selectByUserId']);
    Route::get('/gameSelectByAuthorId/{id}', [GameController::class, 'selectByAuthorId']);
    Route::get('/gameSelectByPublisherId/{id}', [GameController::class, 'selectByPublisherId']);
    Route::post('/gameCreate', [GameController::class, 'create']);
    Route::post('/gameUpdate/{id}', [GameController::class, 'update']);
    Route::get('/gameDelete/{id}', [GameController::class, 'destroy']);

    //dls
    Route::get('/dlsSelectById/{id}', [DLSController::class, 'item']);
    Route::get('/dlsSelectByUserId/{id}', [DLSController::class, 'selectByUserId']);
    Route::get('/dlsSelectByGameId/{id}', [DLSController::class, 'selectByGameId']);
    Route::get('/dlsSelectByAuthorId/{id}', [DLSController::class, 'selectByAuthorId']);
    Route::get('/dlsSelectByPublisherId/{id}', [DLSController::class, 'selectByPublisherId']);
    Route::post('/dlsCreate', [DLSController::class, 'create']);
    Route::post('/dlsUpdate/{id}', [DLSController::class, 'update']);
    Route::get('/dlsDelete/{id}', [DLSController::class, 'destroy']);

    //mod
    Route::get('/modSelectById/{id}', [ModController::class, 'item']);
    Route::get('/modSelectByUserId/{id}', [ModController::class, 'selectByUserId']);
    Route::get('/modSelectByGameId/{id}', [ModController::class, 'selectByGameId']);
    Route::get('/modSelectByAuthorId/{id}', [ModController::class, 'selectByAuthorId']);
    Route::post('/modCreate', [ModController::class, 'create']);
    Route::post('/modUpdate/{id}', [ModController::class, 'update']);
    Route::get('/modDelete/{id}', [ModController::class, 'destroy']);

    //author
    Route::post('/authorCreate', [AuthorController::class, 'create']);
    Route::post('/authorUpdate/{id}', [AuthorController::class, 'update']);
    Route::get('/authorDelete/{id}', [AuthorController::class, 'destroy']);

    //publisher
    Route::post('/publCreate', [PublisherController::class, 'create']);
    Route::post('/publUpdate/{id}', [PublisherController::class, 'update']);
    Route::get('/publDelete/{id}', [PublisherController::class, 'destroy']);

    //tag
    Route::post('/tagCreate', [TagController::class, 'create']);
    Route::post('/tagUpdate/{id}', [TagController::class, 'update']);
    Route::get('/tagDelete/{id}', [TagController::class, 'destroy']);

    //os
    Route::post('/osCreate', [OSController::class, 'create']);
    Route::post('/osUpdate/{id}', [OSController::class, 'update']);
    Route::get('/osDelete/{id}', [OSController::class, 'destroy']);

    //wish game
    Route::get('/whGameSelectByUserId/{id}', [WishGameController::class, 'selectByUserId']);
    Route::post('/whGameCreate', [WishGameController::class, 'create']);
    Route::get('/whGameDelete/{id}', [WishGameController::class, 'destroy']);

    //discount
    Route::get('/discountSelectByGameId/{id}', [DiscountController::class, 'selectByGameId']);
    Route::post('/discountCreate', [DiscountController::class, 'create']);
    Route::post('/discountUpdate/{id}', [DiscountController::class, 'update']);
    Route::get('/discountDelete/{id}', [DiscountController::class, 'destroy']);

    //order
    Route::get('/orderSelectByUserId/{id}', [OrderController::class, 'selectByUserId']);
    Route::post('/orderCreate', [OrderController::class, 'create']);
    Route::post('/orderUpdate/{id}', [OrderController::class, 'update']);
    Route::get('/orderDelete/{id}', [OrderController::class, 'destroy']);

    //order history
    Route::get('/OrdHisSelectByUserId/{id}', [OrderHistoryController::class, 'selectByUserId']);
    Route::post('/OrdHisCreate', [OrderHistoryController::class, 'create']);
    Route::post('/OrdHisUpdate/{id}', [OrderHistoryController::class, 'update']);
    Route::get('/OrdHisDelete/{id}', [OrderHistoryController::class, 'destroy']);

    //revie
    Route::get('/revieSelectByUserId/{id}', [RevieController::class, 'selectByUserId']);
    Route::get('/revieSelectByGameId/{id}', [RevieController::class, 'selectByUserId']);
    Route::post('/revieCreate', [RevieController::class, 'create']);
    Route::post('/revieUpdate/{id}', [RevieController::class, 'update']);
    Route::get('/revieDelete/{id}', [RevieController::class, 'destroy']);
});