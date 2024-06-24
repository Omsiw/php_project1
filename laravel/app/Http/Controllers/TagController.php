<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\TagRequest;

class TagController
{
    public function create(TagRequest $request)
    {
        $tag = Tag::create($request->all());

        return response()->json($tag, 201);
    }

    public function update(TagRequest $request, $id)
    {
        $tag = Tag::findOrFail($id);
        $tag->update($request->all());
        $tag->save();

        return response()->json($tag, 202);
    }

    public function destroy($id)
    {
        $tag = Tag::destroy($id);

        return response()->json($tag, 204);
    }
}
