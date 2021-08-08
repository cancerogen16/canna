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
    public function resize(string $filename, int $width, int $height)
    {
        $originDir = Storage::path('images') . '/origin/'; // путь к оригинальным изображениям
        $thumbnailDir = Storage::path('images') . '/thumbnail/'; // путь к сжатым изображениям

        $info = pathinfo($filename); // информацию о пути к файлу

        if (isset($info['extension'])) {
            $extensions = ['jpeg', 'png', 'jpg', 'gif']; // допустимые расширения файлов

            if (in_array($info['extension'], $extensions)) {
                $extension = $info['extension'];

                $newImage = $info['filename'] . '-' . $width . 'x' . $height . '.' . $extension;
            } else {
                $filename = 'noimage.gif';
                $newImage = 'noimage-' . $width . 'x' . $height . '.gif';
            }
        } else {
            $filename = 'noimage.gif';
            $newImage = 'noimage-' . $width . 'x' . $height . '.gif';
        }

        if (file_exists($thumbnailDir . $newImage) && is_file($thumbnailDir . $newImage)) {
            return 'thumbnail/' . $newImage;
        }

        $oldImage = $filename;

        if (!file_exists($thumbnailDir . $newImage) || (filemtime($originDir . $oldImage) > filemtime($thumbnailDir . $newImage))) {
            $path = '';

            $directories = explode('/', dirname(str_replace('../', '', $newImage)));

            foreach ($directories as $directory) {
                $path = $path . '/' . $directory;

                if (!file_exists($thumbnailDir . $path)) {
                    @mkdir($thumbnailDir . $path, 0777);
                }
            }

            try {
                $thumbnail = Image::make($originDir . $filename);
            } catch (Throwable $e) {
                $newImage = 'noimage-' . $width . 'x' . $height . '.gif';

                if (file_exists($thumbnailDir . $newImage) && is_file($thumbnailDir . $newImage)) {
                    return 'thumbnail/' . $newImage;
                }

                $thumbnail = Image::make($originDir . 'noimage.gif');
                $newImage = 'noimage-' . $width . 'x' . $height . '.gif';
            }

            $thumbnail->fit($width, $height);

            $thumbnail->save($thumbnailDir . $newImage);
        }

        return 'thumbnail/' . $newImage;
    }

    /**
     * Выдаёт строку с путём к изображению с нужным размером
     *
     * @param string|null $filename Название файла изображения
     * @param string|int[] $size размер нужного изображения,
     * строкой с ключом массива sizes из файла config/image.php
     * или массивом [ширина, высота]
     * @return string
     */
    public function getImage($filename = null, $size = 'medium'): string
    {
        /* Проверка, является ли изображение ссылкой */
        if (filter_var($filename, FILTER_VALIDATE_URL)) {
            return $filename;
        } else {
            if (is_null($filename)) {
                $filename = 'noimage.gif';
            }

            if (is_array($size)) {
                $filename = $this->resize($filename, $size[0], $size[1]);
            } else {
                $sizes = config('image.sizes');
                $filename = $this->resize($filename, $sizes[$size][0], $sizes[$size][1]);
            }

            return '/images/' . $filename;
        }
    }
}