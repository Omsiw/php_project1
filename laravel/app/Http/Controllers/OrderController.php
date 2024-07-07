<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\OrderRequest;

class OrderController
{
    public function selectByUserId($id)
    {
        $order = Order::where('user_id', $id);
        
        return response()->json($order, 200);
    }

    public function create(OrderRequest $request)
    {
        $order = Order::create($request->all());

        return response()->json($order, 201);
    }

    public function update(OrderRequest $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->all());
        $order->save();

        return response()->json($order, 202);
    }

    public function destroy($id)
    {
        $order = Order::destroy($id);

        return response()->json($order, 204);
    }
}
