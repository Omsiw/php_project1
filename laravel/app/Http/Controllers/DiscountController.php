<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Http\Requests\DiscountRequest;
use Illuminate\Support\Facades\Storage;

class DiscountController extends BaseController
{
    protected $model = Discount::class;    

    public function selectRandomGames(){
        $games = Discount::inRandomOrder()->limit(10)->get()->game();

        $data = [];

        
        foreach($games as $game){
            if ($game->image_path == null){
                $imgUrl = Storage::url($game->image_path);
            } else{
                $imgUrl = null;
            }
            $data[] = [
                'name' => $game->name,
                'cost' => $game->cost,
                'date_add' => $game->date_add,
                'info' => $game->info,
                'img' => $imgUrl
            ];
        }


        return response()->json($game, 200);
    }

    public function selectByGameId($id)
    {
        $discount = Discount::where('game_id', $id);

        return response()->json($discount, 200);
    }

    protected function getValidationRules(){
         return (new DiscountRequest())->rules();
    }
}
