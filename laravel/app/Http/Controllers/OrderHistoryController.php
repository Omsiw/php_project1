<?php

namespace App\Http\Controllers;

use App\Models\OrderHistory;
use App\Http\Requests\OrderHistoryRequest;

class OrderHistoryController
{
    public function selectByUserId($id)
    {
        $orderHistory = OrderHistory::where('user_id', $id);
        
        return response()->json($orderHistory, 200);
    }

    public function create(OrderHistoryRequest $request)
    {
        $orderHistory = OrderHistory::create($request->all());

        return response()->json($orderHistory, 201);
    }

    public function update(OrderHistoryRequest $request, $id)
    {
        $orderHistory = OrderHistory::findOrFail($id);
        $orderHistory->update($request->all());
        $orderHistory->save();

        return response()->json($orderHistory, 202);
    }

    public function destroy($id)
    {
        $orderHistory = OrderHistory::destroy($id);

        return response()->json($orderHistory, 204);
    }
}
