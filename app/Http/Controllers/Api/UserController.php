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
            return $this->response(401, [], 'Нет доступа');
        }

        $users = User::all();

        return $this->ok([
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
                return $this->response(401, [], 'Нет доступа');
            }

            return $this->ok([
                'user' => $user->toArray(),
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
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
                return $this->response(401, [], 'Нет доступа');
            }

            $data = $request->validated();

            $user->update($data);

            return $this->ok([
                'user' => $user,
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
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
                return $this->response(401, [], 'Нет доступа');
            }

            $user->delete();

            return $this->ok([
                'user' => $user,
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
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
                return $this->response(401, [], 'Нет доступа');
            }

            $profile = $user->profile()->first();
            if (isNull($profile)) {
                $profile = collect([]);
            } else {
                $profile['photo'] = $uploadService->getImage($profile['photo'], 'large');
            }

            return $this->ok([
                'profile' => $profile->toArray(),
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
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
                return $this->response(401, [], 'Нет доступа');
            }

            $salons = [];

            $salonsCollection = $user->salons()->get();

            foreach ($salonsCollection as $item) {
                $item['main_photo'] = $uploadService->getImage($item['main_photo'], 'thumbnail');

                $salons[] = $item;
            }

            return $this->ok([
                'salons' => $salons,
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
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
                return $this->response(401, [], 'Нет доступа');
            }

            $records = $user->records()->get();

            return $this->ok([
                'records' => $records,
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }
}
