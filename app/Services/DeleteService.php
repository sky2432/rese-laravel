<?php

namespace App\Services;

use App\Models\Evaluation;
use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\Shop;
use App\Services\ImageService;


class DeleteService
{
    public static function deleteShopAllData($shop)
    {
        $shopId = $shop->id;
        Favorite::where('shop_id', $shopId)->delete();
        Reservation::where('shop_id', $shopId)->delete();
        Evaluation::where('shop_id', $shopId)->delete();
        ImageService::deleteImage($shop->image_url);
        Shop::destroy($shopId);
    }
}
