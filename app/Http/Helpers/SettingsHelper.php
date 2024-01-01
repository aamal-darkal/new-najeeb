<?php
 namespace App\Http\Helpers;

use App\Models\Setting;

 class SettingsHelper {
    public static function getSetting($key ){
        $setting = Setting::select('value')->where('key' , $key)->first();
        if ($setting)
            return $setting->value;
        else    
            return false;
    }
    public static function setSetting($key ,$value){
        $setting = Setting::where('key' , $key)->first();
        if ($setting){
             $setting->update(['value' => $value]);
            return true;
        }
        else    
            return false;
    }
 }