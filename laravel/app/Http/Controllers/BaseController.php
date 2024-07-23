<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BaseController
{
    protected $model;


    public function item($id){
        $item = $this->model::findOrFail($id);
        return response()->json($item);
    }

    public function list(){
        $items = $this->model::all();
        return response()->json($items);
    }

    public function create(Request $request){
        
        $validator = Validator::make($request->all(), $this->getValidationRules());
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }

        $item = $this->model::create($request->all());
        return response()->json($item, 201);
    }
    
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), $this->getValidationRules());
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }

        $item = $this->model::findOrFail($id);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($id){
        $item = $this->model::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }

    protected function getValidationRules()
    {
        return [];
    }
}
