<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\MasterRequest;
use App\Models\Master;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\JsonResponse;
use Throwable;

class MasterController extends ApiController
{
    public function __construct(Master $model, MasterRequest $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function store($request): JsonResponse
    {
        try {
            $master = new Master($request->validated());

            $filename  = $master['photo']->getClientOriginalName();

            $master['photo']->move(Storage::path('images').'origin/',$filename);

            $thumbnail = Image::make(Storage::path('images').'origin/'.$filename);

            $thumbnail->fit(300, 300);

            $thumbnail->save(Storage::path('images').'thumbnail/'.$filename);

            $master['photo'] = $filename;

            $master->save();

            return $this->response(201, 'Created');
        } catch (Throwable $e) {
            return $this->error(null, [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }
}
