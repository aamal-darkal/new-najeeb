<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseHelper;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $student = Student::where('user_id', Auth::id())->with(['notifications' => function ($q) {
            return $q->where('time_publish', '<=', now());
        }])->first();
        return ResponseHelper::success(NotificationResource::collection($student->notifications), 'All notification');
    }

    public function unseen()
    {
        $student = Student::where('user_id', Auth::id())->whereHas('notifications', function ($q) {
            $q->where('seen', false)->where('time_publish', '<=', now());
        })->with('notifications')->first();
        if ($student)
            return ResponseHelper::success(NotificationResource::collection($student->notifications), 'unseen notification');
        return ResponseHelper::success(null, 'There is no unseen notification');
    }

    public function see(Request $request)
    {
        $request->validate([
            "notifications" => "array|nullable",
            "notifications.*" => "numeric",
        ]);
        $student = Student::where('user_id', Auth::id())->with('notifications')->first();
        $notifications = $student->notifications;

        if ($student) {
            if ($request->notifications == null) {
                return ResponseHelper::success(NotificationResource::collection($notifications), 'nothing to update');
            }

            foreach ($notifications as $notification) {
                $notification->pivot->update(['seen' => true]);
            }
        }
        return ResponseHelper::success(NotificationResource::collection($notifications), 'notifications marked as seen');
    }
}
