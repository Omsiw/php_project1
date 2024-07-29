<?php

namespace App\Http\Controllers;

use App\Models\OrderHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\OrderHistoryRequest;

class OrderHistoryController extends BaseController
{
    protected $model = OrderHistory::class; 
    
    public function selectByUserId($id)
    {
        $orderHistory = OrderHistory::where('user_id', $id);
        
        return response()->json($orderHistory, 200);
    }

    public function create(Request $request){
        
        $validator = Validator::make($request->all(), $this->getValidationRules());
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }

        $item = $this->model::create([
            'order_id' => $request->order_id, 
            'user_id' => $request->user_id, 
            'date' => Carbon::now()
        ]);

        return response()->json($item, 201);
    }

    protected function getValidationRules(){
         return (new OrderHistoryRequest())->rules();
    }
}
