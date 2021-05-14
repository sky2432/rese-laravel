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

    public function store(Request $request)
    {
        $item = new Favorite();
        $item->fill($request->all())->save();

        return response()->json([
            'data' => $item
        ], 200);
    }

    public function destroy($favorite_id)
    {
        Favorite::destroy($favorite_id);

        return response()->json([], 204);
    }
}
