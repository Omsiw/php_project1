<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\OrderRequest;

class OrderController extends BaseController
{
    protected $model = Order::class;
    
    public function selectByUserId($id)
    {
        $order = Order::where('user_id', $id);
        
        return response()->json($order, 200);
    }    

    protected function getValidationRules(){
         return (new OrderRequest())->rules();
    }
}
