<?php

namespace App\Http\Controllers\Api;

use App\Facades\ImageUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\SalonRequest;
use App\Http\Requests\SalonSearchRequest;
use App\Models\Salon;
use App\Services\ImageUploadService;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class SalonController extends Controller
{
    use ApiResponder;

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $salons = [];

            $salonsCollection = Salon::all();

            foreach ($salonsCollection as $item) {
                $item['main_photo'] = ImageUpload::getImage($item['main_photo'], 'medium');

                $salons[] = $item;
            }

            return $this->ok([
                'salons' => $salons
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param SalonRequest $request
     * @return JsonResponse
     */
    public function store(SalonRequest $request): JsonResponse
    {
        try {
            $salon = new Salon($request->validated());

            $this->authorize('create', $salon);

            if (isset($salon['main_photo'])) {
                if ($main_photo = ImageUpload::upload($salon['main_photo'])) {
                    $salon['main_photo'] = $main_photo;
                }
            }

            $salon->save();

            if (isset($salon['main_photo'])) {
                $salon['main_photo'] = ImageUpload::getImage($salon['main_photo'], 'large');
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
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            $salon['main_photo'] = ImageUpload::getImage($salon['main_photo'], 'large');

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
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            $data = $request->all();

            $this->authorize('update', [$salon, $data['user_id']]);

            if (isset($salon['main_photo'])) {
                if ($main_photo = ImageUpload::upload($salon['main_photo'])) {
                    $salon['main_photo'] = $main_photo;
                }
            } else {
                $salon['main_photo'] = null;
            }

            $salon->update($data);

            if (isset($salon['main_photo'])) {
                $salon['main_photo'] = ImageUpload::getImage($salon['main_photo'], 'large');
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

            $this->authorize('delete', $salon);

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
     * @return JsonResponse
     */
    public function search(SalonSearchRequest $request): JsonResponse
    {
        $salons = [];

        $salonsCollection = DB::table('salons')
            ->join('services', 'salons.id', '=', 'services.salon_id')
            ->where('city', $request->input('city'))
            ->where('category_id', $request->input('category_id'))
            ->select('salons.*')
            ->get();

        foreach ($salonsCollection as $item) {
            $item['main_photo'] = ImageUpload::getImage($item['main_photo'], 'medium');

            $salons[] = $item;
        }

        return $this->ok([
            'salons' => $salons
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function masters(int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            $masters = $salon->getMasters('thumbnail');

            return $this->ok([
                'masters' => $masters,
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function services(int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            $services = $salon->getServices('thumbnail');

            return $this->ok([
                'services' => $services,
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function actions(int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            $actions = $salon->getActions('thumbnail');

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
    public function records(int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            $this->authorize('viewRecords', $salon);

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

    /**
     * Получает параметры салона: салон, мастеров, услуги, акции
     *
     * @param int $id
     * @return JsonResponse
     */
    public function info(int $id): JsonResponse
    {
        try {
            $salon = Salon::findOrFail($id);

            $salon['thumb'] = ImageUpload::getImage($salon['main_photo'], 'large');

            $salon['masters'] = $salon->getMasters('thumbnail');

            $salon['services'] = $salon->getServices('thumbnail');

            $salon['actions'] = $salon->getActions('thumbnail');

            return $this->ok([
                'salon' => $salon,
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }
}