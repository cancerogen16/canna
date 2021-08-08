<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SalonRequest;
use App\Http\Requests\SalonSearchRequest;
use App\Models\Salon;
use App\Services\ImageUploadService;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class SalonController extends Controller
{
    use ApiResponder;

    /**
     * @param ImageUploadService $uploadService
     * @return JsonResponse
     */
    public function index(ImageUploadService $uploadService): JsonResponse
    {
        $salons = [];

        $salonsCollection = Salon::all();

        foreach ($salonsCollection as $item) {
            $item['main_photo'] = $uploadService->getImage($item['main_photo'], 'medium');

            $salons[] = $item;
        }

        return $this->handleResponse([
            'salons' => $salons
        ]);
    }

    /**
     * @param SalonRequest $request
     * @param ImageUploadService $uploadService
     * @return JsonResponse
     */
    public function store(SalonRequest $request, ImageUploadService $uploadService): JsonResponse
    {
        try {
            $salon = new Salon($request->validated());

            if (Auth::user()->cannot('create', $salon)) {
                return $this->handleResponse([
                    'errors' => ['Нет доступа'],
                ]);
            }

            if (isset($salon['main_photo'])) {
                if ($main_photo = $uploadService->upload($salon['main_photo'])) {
                    $salon['main_photo'] = $main_photo;
                }
            }

            $salon->save();

            if (isset($salon['main_photo'])) {
                $salon['main_photo'] = $uploadService->getImage($salon['main_photo'], 'large');
            }

            return $this->handleResponse([
                'salon' => $salon
            ], 201);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @param ImageUploadService $uploadService
     * @return JsonResponse
     */
    public function show(int $id, ImageUploadService $uploadService): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            $salon['main_photo'] = $uploadService->getImage($salon['main_photo'], 'large');

            return $this->handleResponse([
                'salon' => $salon
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    /**
     * @param SalonRequest $request
     * @param int $id
     * @param ImageUploadService $uploadService
     * @return JsonResponse
     */
    public function update(Request $request, int $id, ImageUploadService $uploadService): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            $data = $request->all();

            if (Auth::user()->cannot('update', [$salon, $data['user_id']])) {
                return $this->handleResponse([
                    'errors' => ['Нет доступа'],
                ]);
            }

            if (isset($salon['main_photo'])) {
                if ($main_photo = $uploadService->upload($salon['main_photo'])) {
                    $salon['main_photo'] = $main_photo;
                }
            } else {
                $salon['main_photo'] = null;
            }

            $salon->update($data);

            return $this->handleResponse([
                'salon' => $salon
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function delete(int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            if (Auth::user()->cannot('delete', $salon)) {
                return $this->handleResponse([
                    'errors' => ['Нет доступа'],
                ]);
            }

            $salon->delete();

            return $this->handleResponse([
                'salon' => $salon
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function search(SalonSearchRequest $request)
    {
        $result = [];

        $salons = Salon::where('city', $request->input('city'))->get();

        foreach ($salons as $salon) {
            if ($salon->services()->where('category_id', $request->input('category_id'))->get()) {
                $result[] = $salon;
            }
        }

        return $this->handleResponse([
            'salons' => $result,
        ]);

    }

    public function getMasters(int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            $masters = $salon->masters()->get();

            return $this->handleResponse([
                'masters' => $masters,
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function getServices(int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            $services = $salon->services()->get();

            return $this->handleResponse([
                'services' => $services,
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function getActions(int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            $actions = $salon->actions()->get();

            return $this->handleResponse([
                'actions' => $actions,
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    public function getRecords(int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            if (Auth::user()->cannot('viewRecords', $salon)) {
                return $this->handleResponse([
                    'errors' => ['Нет доступа'],
                ]);
            }

            $services = $salon->services()->get();

            $records = [];

            foreach ($services as $service) {
                foreach ($service->records()->get() as $record) {
                    $records[] = $record;
                }
            }

            return $this->handleResponse([
                'records' => $records,
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }
}