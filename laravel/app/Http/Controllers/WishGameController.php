<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WishGame;
use App\Http\Requests\WishGameRequest;

class WishGameController extends BaseController
{
    protected $model = WishGame::class;    

    public function selectByUserId($id)
    {
        $wishGame = User::find($id)->wishGame();

        return response()->json($wishGame, 200);
    }    
    
    protected function getValidationRules(){
         return (new WishGameRequest())->rules();
    }
}
