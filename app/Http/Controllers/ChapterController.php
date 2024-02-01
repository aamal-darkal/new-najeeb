<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Subject;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'subject' => 'required|exists:subjects,id'
        ]);
        $subject = Subject::find($request->package);

        return view('pages.chapters.create', compact('subject'));            
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Subject::create($request->all());

        return back()->with('success', 'Chapter is added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chapter $chapter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chapter $chapter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chapter $chapter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chapter $chapter)
    {
        //
    }
}
