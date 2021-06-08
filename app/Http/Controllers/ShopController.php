<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Services\EvaluationService;
use App\Services\ImageService;
use App\Http\Requests\ShopRequest;
use App\Services\DeleteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    public function index()
    {
        $items = Shop::WithAreaGenre()->get();
        $shops = EvaluationService::createRating($items);

        return response()->json([
            'data' => $shops,
            'user' => $items,
        ], config('const.STATUS_CODE.OK'));
    }

    public function store(Request $request)
    {
        $form_data = $request->all();
        $resData = json_decode($form_data['sendData']);

        $item = new Shop();
        $item->name = $resData->name;
        $item->owner_id = $resData->owner_id;
        $item->area_id = $resData->area_id;
        $item->genre_id = $resData->genre_id;
        $item->overview = $resData->overview;
        $item->address = $resData->address;

        $url = $this->uploadImage($request);
        $item->image_url = $url;
        $item->save();

        return response()->json([
            'data' => $item
        ], config('const.STATUS_CODE.OK'));
    }

    public function show($shop_id)
    {
        $item = Shop::WithAreaGenre()->with('owner:id,name')->where('id', $shop_id)->get();

        $shop = EvaluationService::createRating($item);
        $oneShop = $shop[0];

        return response()->json([
            'data' => $oneShop
        ], config('const.STATUS_CODE.OK'));
    }

    public function update(ShopRequest $request, $shop_id)
    {
        $item = Shop::find($shop_id);
        $item->update($request->all());

        return response()->json([
            'data' => $item
        ], config('const.STATUS_CODE.OK'));
    }

    public function updateAddress(Request $request, $shop_id)
    {
        $item = Shop::find($shop_id);
        $item->update(['address' => $request->address]);

        return response()->json([
            'data' => $item
        ], config('const.STATUS_CODE.OK'));
    }

    public function updateImage(Request $request, $shop_id)
    {
        $item = Shop::find($shop_id);
        ImageService::deleteImage($item->image_url);

        $url = $this->uploadImage($request);
        $item->image_url = $url;
        $item->save();

        return response()->json([
            'data' => $item
        ], config('const.STATUS_CODE.OK'));
    }

    public function uploadImage($request)
    {
        $path = Storage::disk('s3')->putFile('/', $request->file('image'), 'public');
        $url = Storage::disk('s3')->url($path);
        return $url;
    }

    public function downloadImage($shop_id)
    {
        $item = Shop::find($shop_id);
        $file_name = basename($item->image_url);
        if (Storage::disk('s3')->exists($file_name)) {
            return Storage::disk('s3')->download($file_name);
        } else {
            return response()->json([
            ], config('const.STATUS_CODE.NO_CONTENT'));
        }
    }

    public function destroy($shop_id)
    {
        $item = Shop::find($shop_id);
        DeleteService::deleteShopAllData($item);

        return response()->json([], config('const.STATUS_CODE.NO_CONTENT'));
    }
}
