<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Http\Requests\DiscountRequest;

class DiscountController
{
    /**
     * Display a listing of the resource.
     */
    public function selectByGameId($id)
    {
        $discount = Discount::where('game_id', '==', $id);

        return response()->json($discount, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(DiscountRequest $request)
    {
        $discount = Discount::create($request->all());

        return response()->json($discount, 201);
    }

    public function update(DiscountRequest $request, $id)
    {
        $discount = Discount::findOrFail($id);
        $discount->update($request->all());
        $discount->save();

        return response()->json($discount, 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $discount = Discount::destroy($id);
        
        return response()->json($discount, 204);
    }
}
