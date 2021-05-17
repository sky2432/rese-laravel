<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Owner;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;

class AuthController extends Controller
{
    public function userLogin(Request $request)
    {
        $item = User::where('email', $request->email)->first();

        LoginRequest::rules($request, $item, 'users');

        return response()->json([
                'auth' => true,
                'role' => 'user',
                'data' => $item,
            ], config('const.STATUS_CODE.OK'));
    }

    public function ownerLogin(Request $request)
    {
        $item = Owner::where('email', $request->email)->first();

        LoginRequest::rules($request, $item, 'owners');

        return response()->json([
                'auth' => true,
                'role' => 'owner',
                'data' => $item,
            ], config('const.STATUS_CODE.OK'));
    }

    public function adminLogin(Request $request)
    {
        $item = Admin::where('email', $request->email)->first();

        LoginRequest::rules($request, $item, 'admins');

        return response()->json([
                'auth' => true,
                'role' => 'admin',
                'data' => $item,
            ], config('const.STATUS_CODE.OK'));
    }

    public function logout()
    {
        return response()->json([
                'auth' => false,
            ], config('const.STATUS_CODE.OK'));
    }
}
