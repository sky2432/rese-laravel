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
        $shop_id = $shop->id;
        self::deletePivotTable('shop_id', $shop_id);
        ImageService::deleteImage($shop->image_url);
        Shop::destroy($shop_id);
    }

    public static function deletePivotTable($colum_name, $id)
    {
        Favorite::where($colum_name, $id)->delete();
        Reservation::where($colum_name, $id)->delete();
        Evaluation::where($colum_name, $id)->delete();
    }
}
