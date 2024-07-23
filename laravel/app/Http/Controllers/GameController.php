<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Http\Requests\GameRequest;

class GameController
{    
    public function item($id){
        $item = Game::findOrFail($id);
        return response()->json($item);
    }

    public function list(){
        $items = Game::all();
        return response()->json($items);
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
        $game = Game::create([
            "name" => $request->name,
            "cost" => $request->cost,
            "date_add" => $request->date_add,
            "info" => $request->info
        ]);

        $game->os()->attach($request->os_ids);
        $game->tag()->attach($request->tag_ids);
        $game->author()->attach($request->author_ids);
        if ($request->publisher_ids == null){
            $game->publisher()->attach($request->author_ids);
        } else{
            $game->publisher()->attach($request->publisher_ids);
        }

        return response()->json($game, 201);
    }

    public function update(GameRequest $request, int $id)
    {
        $game = Game::findOrFail($id);
        $game->update([ 
            "name" => $request->name,
            "cost" => $request->cost,
            "date_add" => $request->date_add,
            "info" => $request->info
        ]);

        $game->os()->detach();
        $game->tag()->detach();
        $game->author()->detach();
        $game->publisher()->detach();

        $game->os()->attach($request->os_ids);
        $game->tag()->attach($request->tag_ids);
        $game->author()->attach($request->author_ids);
        if ($request->publisher_ids == null){
            $game->publisher()->attach($request->author_ids);
        } else{
            $game->publisher()->attach($request->publisher_ids);
        }

        return response()->json($game, 202);
    }

    public function destroy(int $id)
    {
        $game = Game::find($id);
        $game->user()->detach();
        $game->os()->detach();
        $game->tag()->detach();
        $game->author()->detach();
        $game->publisher()->detach();

        $game->delete();

        return request()->json($game, 204);
    }
}
