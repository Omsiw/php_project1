<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpecialController extends BaseController
{
    public function destroy($id){
        $item = $this->model::findOrFail($id);
        $item->game()->detach();
        
        $item->delete();
        return response()->json(null, 204);
    }
}
