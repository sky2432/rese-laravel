<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\EvaluationService;


class FavoriteController extends Controller
{
    public function show($user_id)
    {
        $items = User::find($user_id)->favoriteShops()->with(['area:id,name', 'genre:id,name'])->get();

        $shops = EvaluationService::createAllRating($items);

        return response()->json([
            'data' => $shops
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
