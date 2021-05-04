<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $items = Shop::all();

        return response()->json([
            'data' => $items
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

    public function show($id)
    {
        $items = Shop::find($id);

        return response()->json([
            'data' => $items
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $item = Shop::find($id);
        $item->update($request->all());

        return response()->json([
            'data' => $item
        ], 200);
    }

}
