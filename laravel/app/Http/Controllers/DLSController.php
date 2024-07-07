<?php

namespace App\Http\Controllers;

use App\Models\DLS;
use App\Http\Requests\DLSRequest;

class DLSController
{   
    public function selectByGameId($id)
    {
        $dls = DLS::game()->find($id);
        
        return response()->json($dls, 200);
    }

    public function selectByUserId($id)
    {
        $dls = DLS::user()->find($id);

        return response()->json($dls, 200);
    }

    public function selectById($id)
    {
        $dls = DLS::find($id);

        return response()->json($dls, 200);
    }

    public function selectByAuthorId($id)
    {
        $dls = DLS::game()->author()->find($id);

        return response()->json($dls, 200);
    }

    public function selectByPublisherId($id)
    {
        $dls = DLS::game()->publisher()->find($id);

        return response()->json($dls, 200);
    }

    public function create(DLSRequest $request)
    {
        $dls = DLS::create($request->all());

        return response()->json($dls, 201);
    }

    public function update(DLSRequest $request, $id)
    {
        $dls = DLS::findOrFail($id);
        $dls->update($request->all());
        $dls->save();

        return response()->json($dls, 202);
    }

    public function destroy($id)
    {
        $dls = DLS::destroy($id);

        return request()->json($dls, 204);
    }
}
