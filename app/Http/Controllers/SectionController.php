<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();
        return view('admin.add-section', compact('teachers'));
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
    public function store(Request $request)
    {
        $section = new Section();

        $section->gradeLevel = $request->input('gradeLevel');
        $section->section = $request->input('section');
        $section->sectionName = $request->input('sectionName');
        $section->teacherId = $request->input('sectionTeacher');
        $section->status = 'active';
        $section->save();

        return redirect()->route('add-section.show')->with('success', 'Section Added Successfully');
    }

    public function showSectionList()
    {
        $sections = Section::all();
        $teacherIds = $sections->pluck('teacherId')->toArray(); // Extract teacherIds from sections
        $teachers = Teacher::whereIn('teacherId', $teacherIds)->get();
        return view('admin.sectionlist', compact('sections', 'teachers'));
    }

    public function showEditSection(string $id)
    {
        $sections = Section::find($id);
        $teachers = Teacher::all();
        return view('admin.edit-section', compact('sections', 'teachers'));
    }

    public function fetchSection(Request $request) {
        $gradeLevel = $request->input('gradeLevel');
        $section = Section::where('gradeLevel', $gradeLevel)->get();
        
        if ($section->isNotEmpty()) {
            return response()->json($section);
        } else {
            return response()->json(['error' => 'Section not found for the given grade level'], 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $section = Section::find($id);

        $section->gradeLevel = $request->input('gradeLevel');
        $section->section = $request->input('section');
        $section->sectionName = $request->input('sectionName');
        $section->teacherId = $request->input('sectionTeacher');
        $section->status = $request->input('status');
        $section->save();

        return redirect()->route('sectionlist.show')->with('success', 'Section Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
