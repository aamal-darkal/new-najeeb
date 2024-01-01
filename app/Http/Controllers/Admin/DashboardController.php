<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lecture;
use App\Models\Package;
use App\Models\Student;

class DashboardController extends Controller
{
    public function home()
    {
        $statistics['students'] = Student::where('state','current')->count();
        $statistics['packages'] = Package::count();
        $statistics['lectures'] = Lecture::count();

        return view('pages.dashboard',compact('statistics'));
    }
}
