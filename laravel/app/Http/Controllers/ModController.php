<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Game;
use App\Models\Mod;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ModRequest;

class ModController extends BaseController
{
    protected $model = Mod::class;    

    public function selectByGameId($id)
    {
        $mod = Game::find($id)->mod();
        
        return response()->json($mod, 200);
    }

    public function selectByUserId($id)
    {
        $mod = User::find($id)->mod();

        return response()->json($mod, 200);
    }

    public function selectByAuthorId($id)
    {
        $mod = Author::find($id)->mod();

        return response()->json($mod, 200);
    }

    public function create(Request $request){
        
        $validator = Validator::make($request->all(), $this->getValidationRules());
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }

        $item = $this->model::create([
            'game_id' => $request->game_id, 
            'author_id' => $request->author_id, 
            'name' => $request->name, 
            'info' => $request->info, 
            'date_add' => $request->date_add
        ]);

        return response()->json($item, 201);
    }

    protected function getValidationRules(){
         return (new ModRequest())->rules();
    }
}
