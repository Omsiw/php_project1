<?php

namespace App\Http\Controllers;

use App\Models\Revie;
use App\Http\Requests\RevieRequest;

class RevieController
{
    public function showByGameId($id)
    {
        $revie = Revie::where('game_id', $id);

        return response()->json($revie, 200);
    }
    
    public function showByUserId($id)
    {
        $revie = Revie::where('user_id', $id);

        return response()->json($revie, 200);
    }

    public function create(RevieRequest $request)
    {
        $revie = Revie::create($request->all());

        return response()->json($revie, 201);
    }

    public function update(RevieRequest $request, $id)
    {
        $revie = Revie::findOrFail($id);
        $revie->update($request->all());
        $revie->save();

        return response()->json($revie, 202);
    }

    public function destroy($id)
    {
        $revie = Revie::destroy($id);

        return response()->json($revie, 204);
    }
}
