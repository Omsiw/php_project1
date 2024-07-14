<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;

class UserController
{
    public function singIn(UserRequest $request)
    {
        //todo условия в классе реквест на уникальность
        //todo кодировать пароль

        $user = User::create($request->all());

        return response()->json($user, 201);
    }

    public function logIn(UserRequest $request)
    {
        //todo искать пользователя 
        //todo кодировать пароль 
        //todo сравнить пароли 
        //todo при успешном условии сгенерировать токен 
        //todo вернуть пользователя и токин

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
