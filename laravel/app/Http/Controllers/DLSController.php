<?php

namespace App\Http\Controllers;

use App\Models\DLS;
use App\Http\Requests\DLSRequest;

class DLSController extends BaseController
{
    protected $model = DLS::class;    

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

    protected function getValidationRules(){
         return (new DLSRequest())->rules();
    }
}
