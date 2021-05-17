<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Services\EvaluationService;
use Illuminate\Http\Request;

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
        $item = new Shop();
        $item->fill($request->all())->save();

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

    public function update(Request $request, $shop_id)
    {
        $item = Shop::find($shop_id);
        $item->update($request->all());

        return response()->json([
            'data' => $item
        ], config('const.STATUS_CODE.OK'));
    }

    public function destroy($shop_id)
    {
        Shop::destroy($shop_id);

        return response()->json([], config('const.STATUS_CODE.NO_CONTENT'));
    }
}
