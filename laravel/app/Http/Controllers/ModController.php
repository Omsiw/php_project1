<?php

namespace App\Http\Controllers;

use App\Models\Mod;
use App\Http\Requests\ModRequest;

class ModController extends SpecialController
{
    protected $model = Mod::class;    

    public function selectByGameId($id)
    {
        $mod = Mod::game()->find($id);
        
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
    protected function getValidationRules(){
         return (new ModRequest())->rules();
    }
}
