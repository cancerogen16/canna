<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RecordRequest;
use App\Models\Record;

class RecordController extends ApiController
{
    public function __construct(Record $model, RecordRequest $request)
    {
        $this->model = $model;
        $this->request = $request;
    }
}