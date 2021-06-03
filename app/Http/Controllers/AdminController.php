<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateNameEmailRequest;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function index()
    {
        $items = Admin::all();
        ;

        return response()->json([
            'data' => $items
        ], config('const.STATUS_CODE.OK'));
    }

    public function confirm(Request $request)
    {
        RegisterRequest::rules($request, 'admins');

        return response()->json([
        ], config('const.STATUS_CODE.NO_CONTENT'));
    }

    public function store(Request $request)
    {
        $item = new Admin;
        $item->password = Hash::make($request->password);
        $item->fill($request->all())->save();

        return response()->json([
            'data' => $item
        ], config('const.STATUS_CODE.OK'));
    }

    //名前・メールアドレスの更新
    public function update(Request $request, $user_id)
    {
        UpdateNameEmailRequest::rules($request, $user_id, 'admins');

        $item = Admin::find($user_id);
        $item->update($request->all());

        return response()->json([
            'data' => $item
        ], config('const.STATUS_CODE.OK'));
    }

    public function updatePassword(Request $request, $user_id)
    {
        $item = Admin::find($user_id);
        UpdatePasswordRequest::rules($request, $item);

        $item->password = Hash::make($request->new_password);
        $item->save();

        return response()->json([
            'data' => $item
        ], config('const.STATUS_CODE.OK'));
    }

    public function destroy($user_id)
    {
        Admin::destroy($user_id);

        return response()->json([], config('const.STATUS_CODE.NO_CONTENT'));
    }
}
