<?php


namespace App\Contracts;


use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

interface UploadImageServiceContract
{
    /**
     * @param UploadedFile $file
     * @return mixed
     */
    public function upload(UploadedFile $file);

    /**
     * @param string $filename
     * @param int $width ширина для ресайза
     * @param int $height высота для ресайза
     * @return string
     */
    public function resize(string $filename, int $width, int $height);
}