<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class NotificationsController extends Controller
{
    public function read()
    {
       auth()->user()->unReadNotifications->markAsRead();
       return redirect()->back();
    }
}
