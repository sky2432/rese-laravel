<?php

namespace App\Services;

use App\Models\Shop;
use App\Services\ImageService;

class DeleteService
{
    public static function deleteShopAllData($shop)
    {
        $shop_id = $shop->id;
        ImageService::deleteImage($shop->image_url);
        Shop::destroy($shop_id);
    }
}
