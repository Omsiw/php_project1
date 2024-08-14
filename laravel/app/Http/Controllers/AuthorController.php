<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Http\Requests\AuthorRequest;
class AuthorController extends BaseController
{
    protected $model = Author::class;    

    protected function getValidationRules(){
         return (new AuthorRequest())->rules();
    }
}