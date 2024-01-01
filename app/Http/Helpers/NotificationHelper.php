<?php

namespace App\Http\Helpers;

use App\Models\Notification;
use App\Models\Setting;
use App\Models\Student;
use App\Models\User;

class NotificationHelper
{
    public static function sendNotification(Notification $notification , $tokens)
    {                
        
        $SERVER_API_KEY = env("FIREBASE_SERVER_KEY");

        $data = [
             "registration_ids" => $tokens, // for one device or more as indexed array
             "notification" => [
                'title' => $notification->title,
                'body' => $notification->description,
                'sound' => "default" // required for sound on ios
            ],
            "priority" => "high",
        ];
        
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        curl_close($ch);

        return $response;
    }    

}
