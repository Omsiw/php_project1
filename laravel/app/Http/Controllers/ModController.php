<?php

namespace App\Http\Controllers;

use App\Models\Mod;
use App\Http\Requests\ModRequest;

class ModController
{
    public function selectByGameId($id)
    {
        $mod = Mod::game()->find($id);
        
        return response()->json($mod, 200);
    }

    public function selectById($id)
    {
        $mod = Mod::find($id);

        return response()->json($mod, 200);
    }

    public function selectByUserId($id)
    {
        $mod = Mod::user()->find($id);

        return response()->json($mod, 200);
    }

    public function selectByAuthorId($id)
    {
        $mod = Mod::author()->find($id);

        return response()->json($mod, 200);
    }

    public function create(ModRequest $request)
    {
        $mod = Mod::create($request->all());

        return response()->json($mod, 201);
    }

    public function update(ModRequest $request, $id)
    {
        $mod = Mod::findOrFail($id);
        $mod->update($request->all());
        $mod->save();

        return response()->json($mod, 202);
    }

    public function destroy($id)
    {
        $mod = Mod::destroy($id);

        return request()->json($mod, 204);
    }
}
