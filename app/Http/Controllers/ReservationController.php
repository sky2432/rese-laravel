<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Owner;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\EvaluationService;

class ReservationController extends Controller
{
    public function showUserReservations($user_id)
    {
        $items = User::find($user_id)->shopsReserved()->with(['area:id,name', 'genre:id,name'])->oldest('visited_on')->get();

        $shops = EvaluationService::createRating($items);

        return response()->json([
            'data' => $shops
        ], config('const.STATUS_CODE.OK'));
    }

    public function showShopReservations($shop_id)
    {
        $items = Shop::find($shop_id)->usersReserved()->get();

        return response()->json([
            'data' => $items
        ], config('const.STATUS_CODE.OK'));
    }

    public function store(ReservationRequest $request)
    {
        $item = new Reservation();
        $item->fill($request->all())->save();

        return response()->json([
            'data' => $item
        ], config('const.STATUS_CODE.OK'));
    }

    public function update(Request $request, $reservation_id)
    {
        $item = Reservation::find($reservation_id);
        $item->update($request->all());

        return response()->json([
                'data' => $item
            ], config('const.STATUS_CODE.OK'));
    }

    public function destroy($reservation_id)
    {
        $item = Reservation::find($reservation_id);
        $item->status = 'cancelled';
        $item->save();

        return response()->json([], config('const.STATUS_CODE.NO_CONTENT'));
    }
}
