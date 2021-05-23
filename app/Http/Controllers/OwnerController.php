<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateNameEmailRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\Owner;
use App\Models\Evaluation;
use App\Models\Favorite;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OwnerController extends Controller
{
    public function index()
    {
        $items = Owner::all();

        return response()->json([
            'data' => $items
        ], config('const.STATUS_CODE.OK'));
    }

    public function store(Request $request)
    {
        $item = new Owner();
        $item->password = Hash::make($request->password);
        $item->fill($request->all())->save();

        return response()->json([
            'data' => $item
        ], config('const.STATUS_CODE.OK'));
    }

    public function show($owner_id)
    {
        $item = Owner::find($owner_id);

        return response()->json([
            'data' => $item
        ], config('const.STATUS_CODE.OK'));
    }

    public function update(Request $request, $owner_id)
    {
        UpdateNameEmailRequest::rules($request, $owner_id, 'owners');

        $item = Owner::find($owner_id);
        $item->fill($request->all())->save();

        return response()->json([
            'data' => $item
        ], config('const.STATUS_CODE.OK'));
    }

    public function updatePassword(Request $request, $owner_id)
    {
        $item = Owner::find($owner_id);
        UpdatePasswordRequest::rules($request, $item);

        $item->password = Hash::make($request->new_password);
        $item->save();

        return response()->json([
            'data' => $item
        ], config('const.STATUS_CODE.OK'));
    }

    public function destroy($owner_id)
    {
        $item = Owner::find($owner_id)->shop()->first();
        if ($item) {
            $shop_id = $item->id;
            Favorite::where('shop_id', $shop_id)->delete();
            Reservation::where('shop_id', $shop_id)->delete();
            Evaluation::where('shop_id', $shop_id)->delete();
        }
        
        Owner::destroy($owner_id);

        return response()->json([], config('const.STATUS_CODE.NO_CONTENT'));
    }

    public function showOwnerShop($owner_id)
    {
        $item = Owner::find($owner_id)->shop()->with(['area:id,name', 'genre:id,name'])->first();

        if ($item) {
            return response()->json([
                'data' => $item
            ], config('const.STATUS_CODE.OK'));
        } else {
            return response()->json([], config('const.STATUS_CODE.NO_CONTENT'));
        }
    }
}
