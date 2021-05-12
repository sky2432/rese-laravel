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

        $shops = EvaluationService::createAllRating($items);

        return response()->json([
            'data' => $shops
        ], 200);
    }

    public function store(Request $request)
    {
        $item = new Shop();
        $item->fill($request->all())->save();

        return response()->json([
            'data' => $item
        ], 200);
    }

    public function show($shop_id)
    {
        $item = Shop::with(['area:id,name', 'genre:id,name'])->find($shop_id);

        $shop = EvaluationService::createOneRating($item);

        return response()->json([
            'data' => $shop
        ], 200);
    }

    public function update(Request $request, $shop_id)
    {
        $item = Shop::find($shop_id);
        $item->update($request->all());

        return response()->json([
            'data' => $item
        ], 200);
    }

    public function destroy($shop_id)
    {
        Shop::destroy($shop_id);

        return response()->json([], 204);
    }
}
