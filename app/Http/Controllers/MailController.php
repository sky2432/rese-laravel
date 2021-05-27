<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\User;
use App\Notifications\MailNotification;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function sendForAll(Request $request)
    {
        if ($request->role === 'admin') {
            $users = User::all();
            $this->sendMail($users, $request);
            $owners = Owner::all();
            $this->sendMail($owners, $request);
        } else {
            return response()->json([], 400);
        }
    }

    public function sendForUsers(Request $request)
    {
        if ($request->role === 'admin') {
            $users = User::all();
            $this->sendMail($users, $request);
        } else {
            return response()->json([], 400);
        }
    }

    public function sendForOwners(Request $request)
    {
        if ($request->role === 'admin') {
            $owners = Owner::all();
            $this->sendMail($owners, $request);
        } else {
            return response()->json([], 400);
        }
    }

    public function sendMail($items, $request)
    {
        foreach ($items as $item) {
            $item->notify(new MailNotification($request));
        }
    }
}
