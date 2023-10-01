<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User\Notification as UserNotification;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getNotifications()
    {
        if (!Auth::check())
            return response()->json(['message' => 'Unauthorized', 'status' => false], 401);

        $where_statement = [
            ['user_id', '=', auth()->user()->id]
        ];

        $notifications = UserNotification::where($where_statement)->get();

        return response()->json(['message' => $notifications, 'status' => true], 200);
    }

    public function setNotificationRead(Request $request)
    {
        if (!Auth::check())
            return response()->json(['message' => 'Unauthorized', 'status' => false], 401);

        if (!$request->route('id'))
            return response()->json(['message' => 'Notification id not sent', 'status' => false], 401);

        $where_statement = [
            ['id', '=', $request->route('id')],
            ['user_id', '=', auth()->user()->id]
        ];

        $notification = UserNotification::where($where_statement)->first();
        $notification->read_at = now()->toDateTimeString();
        $notification->save();

        return response()->json(['message' => 'Notification read', 'status' => true], 200);
    }
}
