<?php


namespace App\Contracts;


use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

interface UploadImageServiceContract
{
    /**
     * @param UploadedFile $file
     * @param int $width ширина для ресайза
     * @param int $height высота для ресайза
     * @return mixed
     */
    public function upload(UploadedFile $file, int $width = 0, int $height = 0);
}