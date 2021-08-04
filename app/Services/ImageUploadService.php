<?php


namespace App\Services;

use App\Contracts\UploadImageServiceContract;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Throwable;

class ImageUploadService implements UploadImageServiceContract
{
    /**
     * @param UploadedFile $file
     * @param int $width
     * @param int $height
     * @return string|null
     */
    public function upload(UploadedFile $file, int $width = 0, int $height = 0): ?string
    {
        try {
            $originalName = $file->getClientOriginalName();

            $ext = $file->getClientOriginalExtension();

            $filename = str_replace('.' . $ext, '', $originalName);

            $fileUploaded = $file->move(Storage::path('images') . '/origin/', $originalName);

            if ($fileUploaded === false) {
                throw new \Exception('Image upload error');
            }

            if ($width && $height) {
                $thumbnail = Image::make(Storage::path('images') . '/origin/' . $originalName);

                $thumbnail->fit($width, $height);

                $newName = $filename . '-' . $width . 'x' . $height . '.' . $ext;

                $thumbnail->save(Storage::path('images') . '/thumbnail/' . $newName);
            }

            return $originalName;

            throw new \Exception('Image upload error');
        } catch (Throwable $e) {
            report($e);

            return $originalName;
        }
    }
}