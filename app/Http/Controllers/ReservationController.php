<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\EvaluationService;

class ReservationController extends Controller
{
    public function user($user_id)
    {
        $items = User::find($user_id)->shopsReserved()->with(['area:id,name', 'genre:id,name'])->oldest('visited_on')->get();

        $shops = EvaluationService::createAllRating($items);

        return response()->json([
            'data' => $shops
        ], 200);
    }

    public function shop($shop_id)
    {
        $item = Reservation::where('shop_id', $shop_id)->get();

        return response()->json([
            'data' => $item
        ], 200);
    }

    public function store(Request $request)
    {
        $item = new Reservation();
        $item->fill($request->all())->save();

        return response()->json([
            'data' => $item
        ], 200);
    }

    public function update(Request $request, $reservation_id)
    {
        $item = Reservation::find($reservation_id);
        $item->update($request->all());

        return response()->json([
                'data' => $item
            ], 200);
    }

    public function destroy($reservation_id)
    {
        Reservation::destroy($reservation_id);

        return response()->json([], 204);
    }
}
