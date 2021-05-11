<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function user($user_id)
    {
        // $item = Reservation::where('user_id', $user_id)->get();
        $items = User::find($user_id)->shopsReserved()->with(['area:id,name', 'genre:id,name'])->latest('visited_on')->get();


        return response()->json([
            'data' => $items
        ], 200);
    }

    public function shop($shop_id)
    {
        $item = Reservation::where('shop_id', $shop_id)->get();

        return response()->json([
            'data' => $item
        ], 200);
    }

    public function store(Request $request, $shop_id)
    {
        $item = new Reservation();
        $item->shop_id = $shop_id;
        $item->fill($request->all())->save();

        return response()->json([
            'data' => $item
        ], 200);
    }

    public function update(Request $request, $shop_id, $reservation_id)
    {
        $item = Reservation::find($reservation_id);

        if ($item->user_id == $request->user_id && $item->shop_id == $shop_id) {
            $item->visited_on = $request->visited_on;
            $item->number_of_visiters = $request->number_of_visiters;
            $item->save();

            return response()->json([
                'data' => $item
            ], 200);
        } else {
            return response()->json([], 400);
        }
    }

    public function destroy(Request $request, $shop_id, $reservation_id)
    {
        $item = Reservation::find($reservation_id);

        if ($item->user_id == $request->user_id && $item->shop_id == $shop_id) {
            $item->delete();

            return response()->json([], 204);
        } else {
            return response()->json([], 400);
        }
    }
}
