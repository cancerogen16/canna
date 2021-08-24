<?php

namespace App\Http\Controllers\Api;

use App\Facades\ImageUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class ImageController extends Controller
{
    use ApiResponder;

    /**
     * @param ImageRequest $request
     * @return JsonResponse
     */
    public function uploadImage(ImageRequest $request): JsonResponse
    {
        try {
            $file = $request->file('image');

            $image = ImageUpload::upload($file);

            if ($image) {
                return $this->ok([
                    'image' => $image
                ]);
            } else {
                throw new \Exception('File upload error');
            }
        } catch (Throwable $e) {
            return $this->error([], $e->getMessage());
        }
    }
}
