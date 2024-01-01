<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Package;
use App\Models\Subject;
use App\Models\WeekProgram;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\ExportStudents;
use Maatwebsite\Excel\Facades\Excel;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $weekDays =   ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];
    private $times = [
        '8:00 AM', '8:30 AM',  '9:00 AM', '9:30 AM', '10:00 AM', '10:30 AM', '11:00 AM', '11:30 AM',
        '12:00 PM', '12:30 PM', '1:00 PM', '1:30 PM', '2:00 PM', '2:30 PM', '3:00 PM', '3:30 PM', '4:00 PM'
    ];

    public function index()
    {
        $subjects = Subject::with('package', 'weekProgs')->withCount('students')->get();
        return view('pages.subjects.index', compact('subjects'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'package' => 'required|exists:packages,id'
        ]);
        $package = Package::find($request->package);
        // notAllowedTimes******* to review *******!!!!

        $weekprogs = WeekProgram::join('subjects' , 'week_programs.subject_id' , '=' , 'subjects.id' )->wherehas('subject', function ($q) use ($package) {
            return $q->where('package_id', $package->id);
        })
            ->select(
                'name as title',
                'color as backgroundColor',
                DB::raw('"black" as textColor') ,
                'start_time as startTime',
                'end_time as endTime',
                DB::raw("CONCAT('[\'' , (day+5)%7 , '\']') as daysOfWeek"),                                
            )
            ->get();
            
        return view('pages.subjects.create', compact('package'))
            ->with('weekDays', $this->weekDays)
            ->with('times', $this->times)
            ->with('weekprogs' , $weekprogs);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubjectRequest $request)
    {
        // return $request;
        $subject = Subject::create($request->only(['name', 'cost', 'color' , 'package_id']));
        $days = $request->days;
        foreach ($days as $i => $day) {
            $start_time = Carbon::createFromFormat('h:i A', $request['start_times'][$i]);
            $end_time = Carbon::createFromFormat('h:i A', $request['end_times'][$i]);
            $subject->weekProgs()->create(['day' => $day, 'start_time' => $start_time, 'end_time' => $end_time]);
        }
        return back()->with('success' , 'Subject is added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        $package = $subject->package;
        $weekprogs = WeekProgram::join('subjects' , 'week_programs.subject_id' , '=' , 'subjects.id' )->wherehas('subject', function ($q) use ($package) {
            return $q->where('package_id', $package->id);
        })
            ->select(
                'name as title',
                'color as backgroundColor',
                DB::raw('"black" as textColor') ,
                'start_time as startTime',
                'end_time as endTime',
                DB::raw("CONCAT('[\'' , (day+5)%7 , '\']') as daysOfWeek"),                                
            )
            ->get();
        return view('pages.subjects.edit', compact('subject', 'package', 'weekprogs'))
            ->with('weekDays', $this->weekDays)
            ->with('times', $this->times);
    }


    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $subject->update($request->only(['name', 'cost','color', 'package_id']));

        $ids = $request->weekProgIds;
        $states = $request->weekProgStates;
        $days = $request->days;
        $start_times = $request->start_times;
        $end_times = $request->end_times;

        foreach ($days as $i => $day) {
            $start_time = Carbon::createFromFormat('h:i A', $start_times[$i]);
            $end_time = Carbon::createFromFormat('h:i A', $end_times[$i]);

            if ($states[$i] == 'insert') {
                WeekProgram::create(['day' => $day, 'start_time' => $start_time, 'end_time' => $end_time, 'subject_id' => $subject->id]);
            } elseif ($states[$i] == 'delete' && $ids[$i] != 'insert') {
                WeekProgram::find($ids[$i])->delete();
            } elseif ($states[$i] == 'delete') {
                $weekProgram = WeekProgram::find($ids[$i]);
                $weekProgram->update(['day' => $day, 'start_time' => $start_time, 'end_time' => $end_time]);
            }
        }
        return back()->with('success' , 'Subject is updated successfully');
    }

    /**
     *
     */
    public function show(Subject $subject)
    {
        $lectures = $subject->lectures()->orderby('date', 'desc')->get();
        return view('pages.subjects.show', compact('subject', 'lectures'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        if ($subject->lectures->count()) return back()->with('error', 'sorry, we can\'t delete subject that has lecture, you should delete its lectures first ');
        if ($subject->students->count()) return back()->with('error', 'sorry, we can\'t delete subject that subcribed by students , first you should unsubcribe students first ');
        $subject->delete();
        return back()->with('success', 'package deleted successfuly');
    }
    public function excel(Subject $subject) 
    {
        return Excel::download(new ExportStudents($subject), $subject->name ."_students.xlsx");
    }
}
