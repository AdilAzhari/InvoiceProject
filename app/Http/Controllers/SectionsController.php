<?php

namespace App\Http\Controllers;

use App\Models\sections;
use App\Http\Requests\StoresectionsRequest;
use App\Http\Requests\UpdatesectionsRequest;
use Illuminate\Support\Facades\Auth;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sections.section');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoresectionsRequest $request)
    {
        $section = sections::where('section_name',$request->section_name)->get();

            sections::create([
                'section_name' => $request->section_name,
                'description' => $request->description,
                'Created_by' => Auth::user()->name,
            ]);
            session()->flash('Add', 'section has been added');
            return redirect('/sections');

        // return $section;
    }

    /**
     * Display the specified resource.
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatesectionsRequest $request, sections $sections)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(sections $sections)
    {
        //
    }
}
