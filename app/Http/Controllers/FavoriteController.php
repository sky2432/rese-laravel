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

    public function delete(Request $request)
    {
        $id = $request->id;
        $item = Favorite::find($id);

        if ($item->user_id === $request->user_id) {
            Favorite::destroy($id);

            return response()->json([
                'massage' => 'Favorite deleted'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not allowed',
            ], 400);
        }
    }
}
