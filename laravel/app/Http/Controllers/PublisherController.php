<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use App\Http\Requests\PublisherRequest;

class PublisherController
{
    public function create(PublisherRequest $request)
    {
        $publisher = Publisher::create($request->all());

        return response()->json($publisher, 201);
    }

    public function update(PublisherRequest $request, $id)
    {
        $publisher = Publisher::findOrFail($id);
        $publisher->update($request->all());
        $publisher->save();

        return response()->json($publisher, 202);
    }

    public function destroy($id)
    {
        $publisher = Publisher::destroy($id);

        return response()->json($publisher, 204);
    }
}
