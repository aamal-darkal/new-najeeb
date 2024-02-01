<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Package;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Exports\ExportStudents;
use Maatwebsite\Excel\Facades\Excel;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */   

    public function create(Request $request)
    {
        $request->validate([
            'package' => 'required|exists:packages,id'
        ]);
        $package = Package::find($request->package);
            
        return view('pages.subjects.create', compact('package'));            
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubjectRequest $request)
    {
        Subject::create($request->only(['name', 'cost', 'package_id']));
       
        return back()->with('success' , 'Subject is added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
       
        return view('pages.subjects.edit', compact('subject'));
    }


    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $subject->update($request->only(['name', 'cost', 'package_id']));
    //no need for only??
                
        return back()->with('success' , 'Subject is updated successfully');
    }

    /**
     * show chapters of subject
     */
    public function show(Subject $subject)
    {
        $lectures = $subject->chapters()->orderby('seq')->get();
        return view('pages.subjects.show', compact('subject', 'lectures'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        if ($subject->chapters->count()) return back()->with('error', 'sorry, we can\'t delete subject that has chapters, you should delete its chapters first ');
        if ($subject->students->count()) return back()->with('error', 'sorry, we can\'t delete subject that subcribed by students , first you should unsubcribe students first ');
        $subject->delete();
        return back()->with('success', 'subject deleted successfuly');
    }

    /**
     * Export subject to excel
     *
     * @param Subject $subject
     * @return void
     */
    public function excel(Subject $subject) 
    {
        return Excel::download(new ExportStudents($subject), $subject->name ."_students.xlsx");
    }
}
