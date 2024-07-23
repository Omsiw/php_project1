<?php

namespace App\Http\Controllers;

use App\Models\OS;
use App\Http\Requests\OSRequest;

class OSController extends SpecialController
{
    protected $model = OS::class;    

    protected function getValidationRules(){
         return (new OSRequest())->rules();
    }
}
