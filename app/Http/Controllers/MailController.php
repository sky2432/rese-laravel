<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\MailNotification;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function mail(Request $request)
    {
        if ($request->role === 'admin') {
            $items = User::where('role', 'user')->get();
            foreach ($items as $item) {
                $item->notify(new MailNotification($request));
            }
        } else {
            return response()->json([
                'message' => 'Not Allowed',
            ], 400);
        }
    }
}
