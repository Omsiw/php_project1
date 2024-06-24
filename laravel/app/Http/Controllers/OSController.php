<?php

namespace App\Http\Controllers;

use App\Models\OS;
use App\Http\Requests\OSRequest;

class OSController
{
    public function create(OSRequest $request)
    {
        $os = OS::create($request->all());

        return response()->json($os, 201);
    }

    public function update(OSRequest $request, $id)
    {
        $os = OS::findOrFail($id);
        $os->update($request->all());
        $os->save();

        return response()->json($os, 202);
    }

    public function destroy($id)
    {
        $os = OS::destroy($id);

        return response()->json($os, 204);
    }
}
