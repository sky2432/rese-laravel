<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function confirm(Request $request)
    {
        $item = User::where('email', $request->email)->first();

        $request->validate([
            'email' => ['required','email:rfc,dns','exists:users',
        ],
            'password' => ['required',
                function ($attribute, $value, $fail) use ($item) {
                    if ($item && !(Hash::check($value, $item->password))) {
                        return $fail('パスワードが間違っています。');
                    }
                },
            ]
        ]);

        return response()->json([
                'message' => 'Validate OK',
            ], 200);
    }

    public function login(Request $request)
    {
        $item = User::where('email', $request->email)->first();

        if (Hash::check($request->password, $item->password)) {
            return response()->json([
                'auth' => true,
                'data' => $item,
            ], 200);
        } else {
            return response()->json([], 400);
        }
    }

    public function logout()
    {
        return response()->json([
                'auth' => false,
            ], 200);
    }
}
