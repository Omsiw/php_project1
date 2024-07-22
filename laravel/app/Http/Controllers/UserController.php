<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserAuthRequest;

class UserController
{
    public function register(UserAuthRequest $request)
    {
        $user = User::create([
            'login' => $request->login,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'login' => $user->login,
            'token' => $token
        ], 201);
    }

    public function login(UserRequest $request)
    {
        $user = User::where('login', $request->login)->first();
        if (!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'login' => $user->login,
            'token' => $token
        ], 201);
    }

    public function addGame(int $id, int $gameId){
        $user = User::find($id);
        $user->game()->attach($gameId);
    }


    public function destroy(int $id)
    {
        $user = User::destroy($id);
        
        return response()->json($user,204);
    }
}
