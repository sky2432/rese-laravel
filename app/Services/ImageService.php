<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageService
{
    public static function deleteImage($image_url)
    {
        $file_name = basename($image_url);
        Storage::disk('s3')->delete($file_name);
    }
}
