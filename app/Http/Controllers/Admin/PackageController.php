<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePackageRequest;
use App\Models\Package;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = Package::withCount('subjects')->get();
        return view('pages.packages.index', compact('packages'));
    }

    public function paginatedIndex(Request $request)
    {
        if ($request->ajax()) { /** review meaning */
            $packages = Package::withCount('subjects')->paginate(2);
            return view('pages.packages.index', compact('packages'))->render();
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.packages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePackageRequest $request): RedirectResponse
    {
        $package  = Package::create($request->validated());

        if ($request->file('image')) {
            $path = 'images/packages';
            $file = $request->file('image');
            $filename = $package->id . '.' . $file->extension();
            $file->storeAs($path,  $filename, 'public');
            $package->image = $filename;
        }
        $package->save();
        return redirect()->route('packages.index')->with('success', 'package created successfuly');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        return view('pages.packages.show', compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package): View
    {
        return view('pages.packages.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Package $package): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,gif,png,jpg',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);
        if ($request->file('image')) {
            Storage::delete('public/images/packages/'  .   $package->image );
            $file = $request->file('image');
            $filename = $package->id . '.' . $file->extension();
            $file->storeAs('public/images/packages',  $filename);
            $validated['image']= $filename;
        }
        $package->update($validated);
        return redirect()->route('packages.index')->with('success', 'package updated successfuly');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package): RedirectResponse
    {
        $subjectsCount =  $package->subjects->count();
        if ($subjectsCount > 0)
            return back()->with('error', 'sorry, we can\'t delete package that has subject, you should delete its subjects first');
        else {            
            Storage::delete('public/images/packages/' .    $package->image );

            $package->delete();
            return back()->with('success', 'package deleted successfuly');
        }
    }
}
