<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageService
{
    public static function deleteImage($image_url)
    {
        $file_name = basename($image_url);
        if (Storage::disk('s3')->exists($file_name)) {
            Storage::disk('s3')->delete($file_name);
        }
    }
}
