<?php

namespace App\Http\Controllers;

use App\Models\WishGame;
use App\Http\Requests\WishGameRequest;

class WishGameController
{
    public function create(WishGameRequest $request)
    {
        $wishGame = WishGame::create($request->all());

        return response()->json($wishGame, 201);
    }

    public function showByUserId($id)
    {
        $wishGame = WishGame::where('user_id', '==', $id);

        return response()->json($wishGame,200);
    }

    public function destroy($id)
    {
        $wishGame = WishGame::destroy($id);
        
        return response()->json($wishGame, 204);
    }
}
