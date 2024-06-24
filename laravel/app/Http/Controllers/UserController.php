<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;

class UserController
{
    public function singIn(UserRequest $request)
    {
        $user = User::create($request->all());

        return response()->json($user, 201);
    }

    public function logIn(UserRequest $request)
    {
        $user = User::where('name', '==', $request->name);

        if ($user == null) {
            return response()->setStatusCode(306);
        } 
        if ($user->password != $request->password){
            return response()->setStatusCode(306);
        } else{
            return response()->json($user, 202);
        }
    }

    public function destroy(int $id)
    {
        $user = User::destroy($id);
        
        return response()->json($user,204);
    }
}
