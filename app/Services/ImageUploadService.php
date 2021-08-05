<?php


namespace App\Services;

use App\Contracts\UploadImageServiceContract;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Throwable;

class ImageUploadService implements UploadImageServiceContract
{
    /**
     * @param UploadedFile $file
     * @return string|null
     */
    public function upload(UploadedFile $file): ?string
    {
        try {
            $originalName = $file->getClientOriginalName();

            $fileUploaded = $file->move(Storage::path('images') . '/origin/', $originalName);

            if ($fileUploaded === false) {
                throw new \Exception('Image upload error');
            }

            return $originalName;
        } catch (Throwable $e) {
            report($e);

            return $originalName;
        }
    }

    /**
     * @param string $filename
     * @param int $width
     * @param int $height
     * @return string
     */
    public function resize(string $filename, int $width, int $height) {
        $originDir = Storage::path('images') . '/origin/';
        $thumbnailDir = Storage::path('images') . '/thumbnail/';

        if (!file_exists($originDir . $filename) || !is_file($originDir . $filename)) {
            $filename = "noimage.gif";
        }

        $info = pathinfo($filename);

        $extension = $info['extension'];

        $oldImage = $filename;
        $newImage = $info['filename'] . '-' . $width . 'x' . $height . '.' . $extension;

        if (!file_exists($thumbnailDir . $newImage) || (filemtime($originDir . $oldImage) > filemtime($thumbnailDir . $newImage))) {
            $path = '';

            $directories = explode('/', dirname(str_replace('../', '', $newImage)));

            foreach ($directories as $directory) {
                $path = $path . '/' . $directory;

                if (!file_exists($thumbnailDir . $path)) {
                    @mkdir($thumbnailDir . $path, 0777);
                }
            }

            $thumbnail = Image::make($originDir . $filename);

            $thumbnail->fit($width, $height);

            $thumbnail->save($thumbnailDir . $newImage);
        }

        return $newImage;
    }
}