<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\TagRequest;

class TagController extends SpecialController
{
    protected $model = Tag::class;    

    protected function getValidationRules(){
         return (new TagRequest())->rules();
    }
}
