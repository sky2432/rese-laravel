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
        $items = User::find($user_id)->favoriteShops()->with('genre:id,name')->get();

        $shops = EvaluationService::createRating($items);

        return response()->json([
            'data' => $shops
        ], config('const.STATUS_CODE.OK'));
    }

    public function store(Request $request)
    {
        $favorite = Favorite::unique($request)->first();
        if ($favorite) {
            return response()->json([], config('const.STATUS_CODE.NO_CONTENT'));
        } else {
            $item = new Favorite();
            $item->fill($request->all())->save();

            return response()->json([
                'data' => $item
            ], config('const.STATUS_CODE.OK'));
        }
    }

    public function destroy($favorite_id)
    {
        Favorite::destroy($favorite_id);

        return response()->json([], config('const.STATUS_CODE.NO_CONTENT'));
    }
}
