<?php


namespace App\Contracts;


use Illuminate\Http\Request;

interface UploadImageServiceContract
{
    /**
     * @param Request $request
     * @param string $fieldName название поля изображения в форме
     * @param int $width ширина для ресайза
     * @param int $height высота для ресайза
     * @return mixed
     */
    public function upload(Request $request, string $fieldName = 'image', int $width = 0, int $height = 0);
}