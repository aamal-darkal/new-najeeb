<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * view all settings
     *
     * @return void
     */
    public function index() {
        $settings = Setting::get();
        return view('pages.settings.index' , compact('settings'));
    }

    /**
     * view all settings
     *
     * @return void
     */
    public function update(Request $request , Setting $setting) {        
        $setting->update($request->all());
        return redirect()->route('settings.index')->with('success', 'setting updated successfuly');
    }


}
