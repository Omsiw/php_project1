<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Revie;
use App\Http\Requests\RevieRequest;
use App\Models\User;

class RevieController extends BaseController
{
    protected $model = Revie::class;
    
    public function selectByGameId($id)
    {
        $revie = Game::find($id)->revie();

        return response()->json($revie, 200);
    }
    
    public function selectByUserId($id)
    {
        $revie = User::find($id)->revie();

        return response()->json($revie, 200);
    }

    protected function getValidationRules(){
         return (new RevieRequest())->rules();
    }
}
