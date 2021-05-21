<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopRequest;
use App\Models\Shop;
use App\Services\EvaluationService;
use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Models\Favorite;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    public function index()
    {
        $items = Shop::with(['area:id,name', 'genre:id,name'])->get();

        $shops = EvaluationService::createRating($items);

        return response()->json([
            'data' => $shops,
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

        $path = Storage::disk('s3')->putFile('/', $request->file('image'), 'public');
        $url = Storage::disk('s3')->url($path);

        $item->image_url = $url;
        $item->save();

        return response()->json([
            'data' => $item
        ], config('const.STATUS_CODE.OK'));
    }

    public function show($shop_id)
    {
        $item = Shop::with(['area:id,name', 'genre:id,name'])->where('id', $shop_id)->get();

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

    public function destroy($shop_id)
    {
        Favorite::where('shop_id', $shop_id)->delete();
        Reservation::where('shop_id', $shop_id)->delete();
        Evaluation::where('shop_id', $shop_id)->delete();

        $item = Shop::find($shop_id);
        $file_name = basename($item->image_url);
        Storage::disk('s3')->delete($file_name);

        Shop::destroy($shop_id);

        return response()->json([], config('const.STATUS_CODE.NO_CONTENT'));
    }
}
