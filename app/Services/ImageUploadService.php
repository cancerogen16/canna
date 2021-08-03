<?php


namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Throwable;

class ImageUploadService
{
    /**
     * @param Request $request
     * @param string $fieldName
     * @param int $width
     * @param int $height
     * @return string|null
     */
    public function upload(Request $request, string $fieldName = 'image', int $width = 100, int $height = 100): ?string
    {
        try {
            if ($request->hasFile($fieldName)) {
                $file = $request->file($fieldName);

                $originalName = $file->getClientOriginalName();

                $ext = $file->getClientOriginalExtension();

                $filename = str_replace('.' . $ext, '', $originalName);

                $fileUploaded = $file->move(Storage::path('images') . '/origin/', $originalName);

                if ($fileUploaded === false) {
                    throw new \Exception('Image upload error');
                }

                $thumbnail = Image::make(Storage::path('images') . '/origin/' . $originalName);

                $thumbnail->fit($width, $height);

                $newName = $filename . '-' . $width . 'x' . $height . '.' . $ext;

                $thumbnail->save(Storage::path('images') . '/thumbnail/' . $newName);

                return $originalName;
            }

            throw new \Exception('Image upload error');
        } catch (Throwable $e) {
            report($e);

            return null;
        }
    }
}