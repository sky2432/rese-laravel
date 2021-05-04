<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(UserRequest $request)
    {
        $item = new User();
        $item->fill($request->all());
        $item->password = Hash::make($request->password);
        $item->save();

        return response()->json([
            'message' => 'User created',
            'data' => $item
        ], 200);
    }

    public function show($id)
    {
        $item = User::find($id);

        return response()->json([
            'message' => 'Get userData',
            'data' => $item
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $item = User::find($id);
        $item->fill($request->all());
        $item->password = Hash::make($request->password);
        $item->save();

        return response()->json([
            'message' => 'User updated',
            'data' => $item
        ], 200);
    }

    public function delete(Request $request)
    {
            User::destroy($request->user_id);

            return response()->json([
                'massage' => 'User deleted'
            ], 200);
    }
}
