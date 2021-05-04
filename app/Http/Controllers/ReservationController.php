<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Database\Seeders\ReservationSeeder;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $item = new Reservation();
        $item->fill($request->all())->save();

        return response()->json([
            'message' => 'Reservation created',
            'data' => $item
        ], 200);
    }

    public function show($id)
    {
        $item = Reservation::where('user_id', $id)->get();

        return response()->json([
            'data' => $item
        ], 200);
    }

    public function shop($id)
    {
        $item = Reservation::where('shop_id', $id)->get();

        return response()->json([
            'data' => $item
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $item = Reservation::find($id);
        $item->update($request->all());

        return response()->json([
            'message' => 'Reservation updated',
            'data' => $item
        ], 200);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $item = Reservation::find($id);

        if ($item->user_id === $request->user_id) {
            Reservation::destroy($id);

            return response()->json([
                'massage' => 'Reservation Deleted'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not allowed',
            ], 400);
        }
    }


}
