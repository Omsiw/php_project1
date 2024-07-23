<?php

namespace App\Http\Controllers;

use App\Models\Revie;
use App\Http\Requests\RevieRequest;

class RevieController extends BaseController
{
    protected $model = Revie::class;
    
    public function selectByGameId($id)
    {
        $revie = Revie::where('game_id', $id);

        return response()->json($revie, 200);
    }
    
    public function selectByUserId($id)
    {
        $revie = Revie::where('user_id', $id);

        return response()->json($revie, 200);
    }

    protected function getValidationRules(){
         return (new RevieRequest())->rules();
    }
}
