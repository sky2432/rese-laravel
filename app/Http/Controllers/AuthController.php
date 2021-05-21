<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Owner;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;

class AuthController extends Controller
{
    public function login(Request $request, $type)
    {
        if ($type === 'user') {
            $item = User::where('email', $request->email)->first();
            LoginRequest::rules($request, $item, 'users');
            $role = 'user';
        }
        if ($type === 'owner') {
            $item = Owner::where('email', $request->email)->first();
            LoginRequest::rules($request, $item, 'owners');
            $role = 'owner';
        }
        if ($type === 'admin') {
            $item = Admin::where('email', $request->email)->first();
            LoginRequest::rules($request, $item, 'admins');
            $role = 'admin';
        }

        return response()->json([
                'auth' => true,
                'role' => $role,
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
