<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Http\Requests\AuthorRequest;
class AuthorController
{
    public function create(AuthorRequest $request)
    {
        $author = Author::create($request->all());

        return response()->json($author, 201);
    }

    public function update(AuthorRequest $request, $id)
    {
        $author = Author::findOrFail($id);
        $author->update($request->all());
        $author->save();

        return response()->json($author, 202);
    }

    public function destroy($id)
    {
        $author = Author::destroy($id);

        return response()->json($author, 204);
    }
}
