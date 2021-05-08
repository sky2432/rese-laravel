<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function show($user_id)
    {
        $items = Favorite::where('user_id', $user_id)->get();

        return response()->json([
            'data' => $items
        ], 200);
    }

    public function update(Request $request, $shop_id)
    {
        $item = new Favorite();
        $item->shop_id = $shop_id;
        $item->fill($request->all())->save();

        return response()->json([
            'data' => $item
        ], 200);
    }

    public function destroy(Request $request, $shop_id)
    {
        $item = Favorite::find($request->favorite_id);

        if ($item->user_id == $request->user_id && $item->shop_id == $shop_id) {
            $item->delete();

            return response()->json([], 204);
        } else {
            return response()->json([], 400);
        }
    }
}
