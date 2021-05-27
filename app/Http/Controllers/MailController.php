<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailRequest;
use App\Models\Owner;
use App\Models\User;
use App\Notifications\MailNotification;

class MailController extends Controller
{
    public function sendForAll(MailRequest $request)
    {
        $users = User::all();
        $this->sendMail($users, $request);
        $owners = Owner::all();
        $this->sendMail($owners, $request);
    }

    public function sendForUsers(MailRequest $request)
    {
        $users = User::all();
        $this->sendMail($users, $request);
    }

    public function sendForOwners(MailRequest $request)
    {
        $owners = Owner::all();
        $this->sendMail($owners, $request);
    }

    public function sendMail($items, $request)
    {
        foreach ($items as $item) {
            $item->notify(new MailNotification($request));
        }
    }
}
