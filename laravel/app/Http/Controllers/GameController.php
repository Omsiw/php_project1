<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Http\Requests\GameRequest;

class GameController
{
    public function selectAll()
    {
        $game = Game::paginate(9);
        
        return response()->json($game, 200);
    }

    public function selectById($id)
    {
        $game = Game::with('dls')->find($id);

        return response()->json($game, 200);
    }

    public function selectByUserId($id)
    {
        $game = Game::user()->find($id);

        return response()->json($game, 200);
    }

    public function selectByTagId($id)
    {
        $game = Game::tag()->find($id);
    }

    public function selectByAuthorId($id)
    {
        $game = Game::author()->find($id);

        return response()->json($game, 200);
    }

    public function selectByPublisherId($id)
    {
        $game = Game::publisher()->find($id);

        return response()->json($game, 200);
    }

    public function create(GameRequest $request)
    {
        $game = Game::create($request->all());

        return response()->json($game, 201);
    }

    public function update(GameRequest $request, $id)
    {
        $game = Game::findOrFail($id);
        $game->update($request->all());
        $game->save();

        return response()->json($game, 202);
    }

    public function destroy($id)
    {
        $game = Game::destroy($id);

        return request()->json($game, 204);
    }
}
