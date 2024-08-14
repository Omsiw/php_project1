<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use App\Http\Requests\PublisherRequest;

class PublisherController extends BaseController
{
    protected $model = Publisher::class;    

    protected function getValidationRules(){
         return (new PublisherRequest())->rules();
    }
}
