<?php

namespace App\Http\Controllers\Api;

use App\Facades\ImageUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Throwable;

class ProfileController extends Controller
{
    use ApiResponder;

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $this->authorize('viewAny', Profile::class);

            $profiles = [];

            $profilesCollection = Profile::all();

            foreach ($profilesCollection as $item) {
                $item['thumb'] = ImageUpload::getImage($item['photo'], 'medium');

                $profiles[] = $item;
            }

            return $this->ok([
                'profiles' => $profiles
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProfileRequest $request
     * @return JsonResponse
     */
    public function store(ProfileRequest $request): JsonResponse
    {
        try {
            $profile = new Profile($request->validated());

            $this->authorize('create', $profile);

            $profile->save();

            if (isset($profile['photo'])) {
                $profile['thumb'] = ImageUpload::getImage($profile['photo'], 'large');
            }

            return $this->ok([
                'profile' => $profile
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $profile = Profile::findOrFail($id);

            $this->authorize('view', $profile);

            if (isset($profile['photo'])) {
                $profile['thumb'] = ImageUpload::getImage($profile['photo'], 'large');
            }

            return $this->ok([
                'profile' => $profile->toArray(),
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfileRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(ProfileRequest $request, int $id): JsonResponse
    {
        try {
            $profile = Profile::findOrFail($id);

            $data = $request->validated();

            $this->authorize('update', [$profile, $data['user_id']]);

            $profile->update($data);

            return $this->ok([
                'profile' => $profile
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        try {
            $profile = Profile::findOrFail($id);

            $this->authorize('delete', Profile::class);

            $profile->delete();

            return $this->ok([
                'profile' => $profile
            ]);
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }
}
