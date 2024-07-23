<?php

namespace App\Http\Controllers;

use App\Models\OrderHistory;
use App\Http\Requests\OrderHistoryRequest;

class OrderHistoryController extends BaseController
{
    protected $model = OrderHistory::class; 
    
    public function selectByUserId($id)
    {
        $orderHistory = OrderHistory::where('user_id', $id);
        
        return response()->json($orderHistory, 200);
    }

    protected function getValidationRules(){
         return (new OrderHistoryRequest())->rules();
    }
}
