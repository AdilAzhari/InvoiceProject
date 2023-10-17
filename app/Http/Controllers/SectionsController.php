<?php

namespace App\Http\Controllers;

use App\Models\sections;
use App\Http\Requests\StoresectionsRequest;
use App\Http\Requests\UpdatesectionsRequest;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = sections::get();
        return view('sections.section', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoresectionsRequest $request)
    {
        $section = sections::where('section_name', $request->section_name)->get();

        sections::create([
            'section_name' => $request->section_name,
            'description' => $request->description,
            'Created_by' => Auth::user()->name,
        ]);

        session()->flash('Add', 'section has been added');
        return redirect('/sections');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatesectionsRequest $request, sections $sections)
    {

        $sections->pdate(
            [
                'section_name' => $request->section_name,
                'description' => $request->description
            ]
        );
        session()->flash('edit', 'section has been updated');
        return redirect('/sections');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HttpRequest $request)
    {
        sections::find($request->id)->delete();
        session()->flash('delete', 'section has been deleted');
        return redirect('/sections');
    }
}
