<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShowLectureResource;
use App\Models\Lecture;
use App\Models\Package;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LectureController extends Controller
{
    public function timeTable()
    {
        $data['sunday'] = [];
        $data['monday'] = [];
        $data['tuesday'] = [];
        $data['wednesday'] = [];
        $data['thursday'] = [];
        $data['friday'] = [];
        $data['saturday'] = [];
        $student_id = Student::where('user_id', Auth::id())->with('subjects.weekProgs')->first()->id;
        
        $subjects = Subject::with(['package', 'weekProgs' => function($q) {
            return $q->orderBY('start_time'); 
        }])->wherehas('students' , function($q) use($student_id) {
            return $q->where('students.id' , $student_id);
        })->get();
        if (!$subjects) return $data;

        foreach ($subjects as $subject) { 

            if (!$subject->weekProgs) continue;
            foreach ($subject->weekProgs as $weekProg) {
                $day = $weekProg['day'];
                $data[$day][] =   $subject->name . ' / ' . $subject->package->name;
            }
        }
        return $data;
    }



    public function show($id)
    {
        $lecture = Lecture::find($id);
        return new ShowLectureResource($lecture);
    }
}
