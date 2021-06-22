<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Owner;
use App\Models\Admin;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request, $type)
    {
        if ($type === config('const.ROLE.USER')) {
            $item = User::where('email', $request->email)->first();
            LoginRequest::rules($request, $item, 'users');
            if ($request->email === 'guest@user.com') {
                $token = $item->api_token;
                $role = config('const.ROLE.GUEST');
            } else {
                $token = Str::random(60);
                $item->update(['api_token' => $token]);
                $role = config('const.ROLE.USER');
            }
        }
        if ($type === config('const.ROLE.OWNER')) {
            $item = Owner::where('email', $request->email)->first();
            LoginRequest::rules($request, $item, 'owners');
            $token = Str::random(60);
            $item->update(['api_token' => $token]);
            $role = config('const.ROLE.OWNER');
        }
        if ($type === config('const.ROLE.ADMIN')) {
            $item = Admin::where('email', $request->email)->first();
            LoginRequest::rules($request, $item, 'admins');
            $token = Str::random(60);
            $item->update(['api_token' => $token]);
            $role = config('const.ROLE.ADMIN');
        }

        return response()->json([
                'auth' => true,
                'role' => $role,
                'data' => $item,
                'token' => $token,
            ], config('const.STATUS_CODE.OK'));
    }

    public function logout()
    {
        return response()->json([
                'auth' => false,
            ], config('const.STATUS_CODE.OK'));
    }
}
