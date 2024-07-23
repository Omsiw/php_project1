<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Http\Requests\DiscountRequest;

class DiscountController extends BaseController
{
    protected $model = Discount::class;    

    public function selectByGameId($id)
    {
        $discount = Discount::where('game_id', $id);

        return response()->json($discount, 200);
    }

    protected function getValidationRules(){
         return (new DiscountRequest())->rules();
    }
}
