<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;
use function PHPUnit\Framework\isNull;

class UserController extends ApiController
{
    public function __construct(User $model, UserRequest $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        if (Auth::user()->cannot('viewAny', User::class)) {
            return $this->response(401, 'Нет доступа');
        }

        $users = User::all();

        return $this->ok(null, $users->toArray());
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
                return $this->response(401, 'Нет доступа');
            }

            return $this->ok(null, $user->toArray());
        } catch (Throwable $e) {
            return $this->error(null, [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function update(int $id, UserRequest $request): JsonResponse
    {
        try {
            $user = User::findOrFail($id);

            if (Auth::user()->cannot('update', $user)) {
                return $this->response(401, 'Нет доступа');
            }

            $data = $request->validated();

            $user->update($data);

            return $this->ok(null, $user->toArray());
        } catch (Throwable $e) {
            return $this->error(null, [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $user = User::findOrFail($id);

            if (Auth::user()->cannot('delete', $user)) {
                return $this->response(401, 'Нет доступа');
            }

            $user->delete();

            return $this->ok(null, $user->toArray());
        } catch (Throwable $e) {
            return $this->error(null, [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the profile of the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function getProfile(int $id): JsonResponse
    {
        try {
            $user = User::findOrFail($id);

            if (Auth::user()->cannot('view', $user)) {
                return $this->response(401, 'Нет доступа');
            }

            $profile = $user->profile()->first();
            if (isNull($profile)) {
                $profile = collect([]);
            }

            return $this->ok(null, $profile->toArray());
        } catch (Throwable $e) {
            return $this->error(null, [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the salons listing of the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function getSalons(int $id): JsonResponse
    {
        try {
            $user = User::findOrFail($id);

            if (Auth::user()->cannot('view', $user)) {
                return $this->response(401, 'Нет доступа');
            }

            $salons = $user->salons()->get();

            return $this->ok(null, $salons->toArray());
        } catch (Throwable $e) {
            return $this->error(null, [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the records listing of the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function getRecords(int $id)
    {
        try {
            $user = User::findOrFail($id);

            if (Auth::user()->cannot('view', $user)) {
                return $this->response(401, 'Нет доступа');
            }

            $records = $user->records()->get();

            return $this->ok(null, $records->toArray());
        } catch (Throwable $e) {
            return $this->error(null, [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }
}
