<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateNameEmailRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Services\DeleteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user')
                 ->except(['store', 'confirm']);
    }

    public function index()
    {
        $items = User::all();
        ;

        return response()->json([
            'data' => $items
        ], config('const.STATUS_CODE.OK'));
    }

    public function confirm(Request $request)
    {
        RegisterRequest::rules($request, 'users');

        return response()->json([
        ], config('const.STATUS_CODE.NO_CONTENT'));
    }

    public function store(Request $request)
    {
        $item = new User;
        $item->password = Hash::make($request->password);
        $item->fill($request->all())->save();

        return response()->json([
            'data' => $item
        ], config('const.STATUS_CODE.OK'));
    }

    //名前・メールアドレスの更新
    public function update(Request $request, $user_id)
    {
        UpdateNameEmailRequest::rules($request, $user_id, 'users');

        $item = User::find($user_id);
        $item->fill($request->all())->save();

        return response()->json([
            'data' => $item
        ], config('const.STATUS_CODE.OK'));
    }

    public function updatePassword(Request $request, $user_id)
    {
        $item = User::find($user_id);
        UpdatePasswordRequest::rules($request, $item);

        $item->password = Hash::make($request->new_password);
        $item->save();

        return response()->json([
            'data' => $item
        ], config('const.STATUS_CODE.OK'));
    }

    public function destroy($user_id)
    {
        DeleteService::deletePivotTable('user_id', $user_id);

        User::destroy($user_id);

        return response()->json([], config('const.STATUS_CODE.NO_CONTENT'));
    }
}
