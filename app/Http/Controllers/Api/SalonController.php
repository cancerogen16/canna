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
use Illuminate\Support\Facades\DB;
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

        return $this->ok([
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
                return $this->response(401, [], 'Нет доступа');
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

            return $this->response(201, [
                'salon' => $salon
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @param ImageUploadService $uploadService
     * @return JsonResponse
     */
    public function show(ImageUploadService $uploadService, int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            $salon['main_photo'] = $uploadService->getImage($salon['main_photo'], 'large');

            return $this->ok([
                'salon' => $salon
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param SalonRequest $request
     * @param int $id
     * @param ImageUploadService $uploadService
     * @return JsonResponse
     */
    public function update(Request $request, ImageUploadService $uploadService, int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            $data = $request->all();

            if (Auth::user()->cannot('update', [$salon, $data['user_id']])) {
                return $this->response(401, [], 'Нет доступа');
            }

            if (isset($salon['main_photo'])) {
                if ($main_photo = $uploadService->upload($salon['main_photo'])) {
                    $salon['main_photo'] = $main_photo;
                }
            } else {
                $salon['main_photo'] = null;
            }

            $salon->update($data);

            if (isset($salon['main_photo'])) {
                $salon['main_photo'] = $uploadService->getImage($salon['main_photo'], 'large');
            }

            return $this->ok([
                'salon' => $salon
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            if (Auth::user()->cannot('delete', $salon)) {
                return $this->response(401, [], 'Нет доступа');
            }

            $salon->delete();

            return $this->ok([
                'salon' => $salon
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param SalonSearchRequest $request
     * @param ImageUploadService $uploadService
     * @return JsonResponse
     */
    public function search(SalonSearchRequest $request, ImageUploadService $uploadService): JsonResponse
    {
        $salons = [];

        $salonsCollection = DB::table('salons')
            ->join('services', 'salons.id', '=', 'services.salon_id')
            ->where('city', $request->input('city'))
            ->where('category_id', $request->input('category_id'))
            ->select('salons.*')
            ->get();

        foreach ($salonsCollection as $item) {
            $item['main_photo'] = $uploadService->getImage($item['main_photo'], 'medium');

            $salons[] = $item;
        }

        return $this->ok([
            'salons' => $salons
        ]);
    }

    /**
     * @param int $id
     * @param ImageUploadService $uploadService
     * @return JsonResponse
     */
    public function getMasters(ImageUploadService $uploadService, int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            $masters = [];

            $mastersCollection = $salon->masters()->get();

            foreach ($mastersCollection as $item) {
                $item['photo'] = $uploadService->getImage($item['photo'], 'thumbnail');

                $masters[] = $item;
            }

            return $this->ok([
                'masters' => $masters,
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param ImageUploadService $uploadService
     * @param int $id
     * @return JsonResponse
     */
    public function getServices(ImageUploadService $uploadService, int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            $services = [];

            $servicesCollection = $salon->services()->get();

            foreach ($servicesCollection as $item) {
                $item['image'] = $uploadService->getImage($item['image'], 'thumbnail');

                $services[] = $item;
            }

            return $this->ok([
                'services' => $services,
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param ImageUploadService $uploadService
     * @param int $id
     * @return JsonResponse
     */
    public function getActions(ImageUploadService $uploadService, int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            $actions = [];

            $actionsCollection = $salon->actions()->get();

            foreach ($actionsCollection as $item) {
                $item['photo'] = $uploadService->getImage($item['photo'], 'medium');

                $actions[] = $item;
            }

            return $this->ok([
                'actions' => $actions,
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getRecords(int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            if (Auth::user()->cannot('viewRecords', $salon)) {
                return $this->response(401, [], 'Нет доступа');
            }

            $services = $salon->services()->get();

            $records = [];

            foreach ($services as $service) {
                foreach ($service->records()->get() as $record) {
                    $records[] = $record;
                }
            }

            return $this->ok([
                'records' => $records,
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }
}