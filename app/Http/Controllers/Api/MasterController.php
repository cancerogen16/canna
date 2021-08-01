<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterRequest;
use App\Models\Master;
use App\Models\Salon;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Throwable;


class MasterController extends Controller
{
    use ApiResponder;

    public function index(): JsonResponse
    {
        $masters = Master::all();

        return $this->handleResponse([
            'masters' => $masters
        ]);
    }

    public function store(MasterRequest $request): JsonResponse
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

            return $this->handleResponse([
                'master' => $master
            ], 201);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $master = Master::findOrFail($id);

            return $this->handleResponse([
                'master' => $master->toArray()
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function update(MasterRequest $request, int $id): JsonResponse
    {
        try {
            $master = Master::findOrFail($id);

            $data = $request->validated();

            $master->update($data);

            return $this->handleResponse([
                'master' => $master
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function delete(int $id): JsonResponse
    {
        try {
            $master = Master::findOrFail($id);

            $master->delete();

            return $this->handleResponse([
                'master' => $master
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function getServices(int $id)
    {
        try {
            $master = Master::findOrFail($id);

            $services = $master->services()->get();

            return $this->handleResponse([
                'services' => $services,
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function getCalendars(int $id)
    {
        try {
            $master = Master::findOrFail($id);

            $calendars = $master->calendars()->get();

            return $this->handleResponse([
                'calendars' => $calendars,
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function getCalendarsForDay()
    {
        try {
            $master = Master::findOrFail($id);

            $calendars = $master->calendars()->get();

            return $this->handleResponse([
                'calendars' => $calendars,
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function getRecords()
    {
        //
    }
}
