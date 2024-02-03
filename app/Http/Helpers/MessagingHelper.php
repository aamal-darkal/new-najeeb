<?php

namespace App\Http\Helpers;

use App\Models\Setting;
use Exception;
use GuzzleHttp\Client;

class MessagingHelper
{

    public static function sendMessage($msg, $to)
    {
        try {
            $client = new Client(['verify' => false]);
            $user_name_syriatel = Setting::where('key', 'user_name_syriatel')->first()->value;
            $password_syriatel = Setting::where('key', 'password_syriatel')->first()->value;
            $sender_syriatel = Setting::where('key', 'sender_syriatel')->first()->value;
            $url = 'https://bms.syriatel.sy/API/SendSMS.aspx?user_name=' . $user_name_syriatel . '&password=' . $password_syriatel . '&msg=' . $msg . '&sender=' . $sender_syriatel . '&to=' . $to;
            $client->request('POST', $url);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
