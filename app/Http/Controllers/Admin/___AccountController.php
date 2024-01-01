<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function getRequests()
    {
        $students = Student::where('state','new')->paginate(10);
        return view('students.student-requests',compact('students'));
    }
}
