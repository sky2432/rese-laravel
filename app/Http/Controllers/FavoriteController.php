<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function show($id)
    {
        $item = Favorite::where('user_id', $id)->get();

        return response()->json([
            'data' => $item
        ], 200);
    }

    public function store(Request $request)
    {
        $item = new Favorite();
        $item->fill($request->all())->save();

        return response()->json([
            'massage' => 'Favorite created',
            'data' => $item
        ], 200);
    }

    public function destroy($shop_id, $id)
    {
        Favorite::destroy($id);

        return response()->json([
                'massage' => 'Favorite deleted'
            ], 200);
    }
}
