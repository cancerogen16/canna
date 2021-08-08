<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\ImageUploadService;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;
use function PHPUnit\Framework\isNull;

class UserController extends Controller
{
    use ApiResponder;
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        if (Auth::user()->cannot('viewAny', User::class)) {
            return $this->handleResponse([
                'errors' => ['Нет доступа'],
            ]);
        }

        $users = User::all();

        return $this->handleResponse([
            'users' => $users,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $user = User::findOrFail($id);

            if (Auth::user()->cannot('view', $user)) {
                return $this->handleResponse([
                    'errors' => ['Нет доступа'],
                ]);
            }

            return $this->handleResponse([
                'user' => $user->toArray(),
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserRequest  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(UserRequest $request, int $id): JsonResponse
    {
        try {
            $user = User::findOrFail($id);

            if (Auth::user()->cannot('update', $user)) {
                return $this->handleResponse([
                    'errors' => ['Нет доступа'],
                ]);
            }

            $data = $request->validated();

            $user->update($data);

            return $this->handleResponse([
                'user' => $user,
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        try {
            $user = User::findOrFail($id);

            if (Auth::user()->cannot('delete', $user)) {
                return $this->handleResponse([
                    'errors' => ['Нет доступа'],
                ]);
            }

            $user->delete();

            return $this->handleResponse([
                'user' => $user,
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Display the profile of the specified resource.
     *
     * @param ImageUploadService $uploadService
     * @param int $id
     * @return JsonResponse
     */
    public function getProfile(ImageUploadService $uploadService, int $id): JsonResponse
    {
        try {
            $user = User::findOrFail($id);

            if (Auth::user()->cannot('view', $user)) {
                return $this->handleResponse([
                    'errors' => ['Нет доступа'],
                ]);
            }

            $profile = $user->profile()->first();
            if (isNull($profile)) {
                $profile = collect([]);
            } else {
                $profile['photo'] = $uploadService->getImage($profile['photo'], 'large');
            }

            return $this->handleResponse([
                'profile' => $profile->toArray(),
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Display the salons listing of the specified resource.
     *
     * @param ImageUploadService $uploadService
     * @param int $id
     * @return JsonResponse
     */
    public function getSalons(ImageUploadService $uploadService, int $id): JsonResponse
    {
        try {
            $user = User::findOrFail($id);

            if (Auth::user()->cannot('view', $user)) {
                return $this->handleResponse([
                    'errors' => ['Нет доступа'],
                ]);
            }

            $salons = [];

            $salonsCollection = $user->salons()->get();

            foreach ($salonsCollection as $item) {
                $item['main_photo'] = $uploadService->getImage($item['main_photo'], 'thumbnail');

                $salons[] = $item;
            }

            return $this->handleResponse([
                'salons' => $salons,
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Display the records listing of the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function getRecords(int $id): JsonResponse
    {
        try {
            $user = User::findOrFail($id);

            if (Auth::user()->cannot('view', $user)) {
                return $this->handleResponse([
                    'errors' => ['Нет доступа'],
                ]);
            }

            $records = $user->records()->get();

            return $this->handleResponse([
                'records' => $records,
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }
}
