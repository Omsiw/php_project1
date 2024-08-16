<?php

namespace App\Http\Controllers;

use App\Models\OrderHistory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\OrderHistoryRequest;

class OrderHistoryController extends BaseController
{
    protected $model = OrderHistory::class; 
    
    public function selectByUserId($id)
    {
        $orderHistory = User::find($id)->orderHistory();
        
        return response()->json($orderHistory, 200);
    }

    protected function getValidationRules(){
         return (new OrderHistoryRequest())->rules();
    }
}
