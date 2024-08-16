<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\OrderRequest;
use App\Models\User;

class OrderController extends BaseController
{
    protected $model = Order::class;
    
    public function selectByUserId($id)
    {
        $order = User::find($id)->order();
        
        return response()->json($order, 200);
    }    

    protected function getValidationRules(){
         return (new OrderRequest())->rules();
    }
}
