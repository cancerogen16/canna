<?php

namespace App\Http\Controllers\Api;

use App\Models\Record;

class RecordController extends ApiController
{
    public function __construct(Record $model)
    {
        $this->model = $model;
    }
}