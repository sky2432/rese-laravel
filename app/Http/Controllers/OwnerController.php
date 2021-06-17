<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateNameEmailRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Owner;
use App\Services\DeleteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OwnerController extends Controller
{
    public function index()
    {
        $items = Owner::with(['shop:id,owner_id,name'])->get();
        ;

        return response()->json([
            'data' => $items
        ], config('const.STATUS_CODE.OK'));
    }

    public function confirm(Request $request)
    {
        RegisterRequest::rules($request, 'owners');

        return response()->json([
        ], config('const.STATUS_CODE.NO_CONTENT'));
    }

    public function store(Request $request)
    {
        $item = new Owner();
        $item->password = Hash::make($request->password);
        $item->has_shop = false;
        $item->fill($request->all())->save();

        return response()->json([
            'data' => $item
        ], config('const.STATUS_CODE.OK'));
    }

    public function show($owner_id)
    {
        $item = Owner::with(['shop', 'shop.genre:id,name'])->where('id', $owner_id)->first();

        return response()->json([
            'data' => $item
        ], config('const.STATUS_CODE.OK'));
    }

    //名前・メールアドレスの更新
    public function update(Request $request, $owner_id)
    {
        $item = Owner::find($owner_id);
        UpdateNameEmailRequest::rules($request, $owner_id, 'owners', $item);

        $item->update($request->all());

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
        $shop = Owner::find($owner_id)->shop;
        if ($shop) {
            DeleteService::deleteShopAllData($shop);
        }

        Owner::destroy($owner_id);

        return response()->json([], config('const.STATUS_CODE.NO_CONTENT'));
    }

    public function showOwnerShop($owner_id)
    {
        $item = Owner::find($owner_id)->shop()->with('genre:id,name')->first();

        if ($item) {
            return response()->json([
                'data' => $item
            ], config('const.STATUS_CODE.OK'));
        } else {
            return response()->json([], config('const.STATUS_CODE.NO_CONTENT'));
        }
    }
}
