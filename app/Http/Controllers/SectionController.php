<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use App\Services\MessageLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $sectionName = $request->input('sectionName');
        $section->sectionName = ucwords(strtolower($sectionName)); //make it title Format AMBER/amber will be Amber
        $section->teacherId = $request->input('sectionTeacher');
        $section->status = 'active';
        $section->save();

        $logs = new Log();
        $logs->studentId = Auth::user()->studentId;
        $logs->type = "add_section";
        $logs->activity = "Added new section " . $request->input('gradeLevel') . " - " .  $request->input('subjectTitle');
        $logs->save();

        notify()->success('Section Added Successfully!');
        return redirect()->route('add-section.show');
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

    public function fetchSection(Request $request)
    {
        $gradeLevel = $request->input('gradeLevel');
        $section = Section::where('gradeLevel', $gradeLevel)->get();

        if ($section->isNotEmpty()) {
            return response()->json($section);
        } else {
            return response()->json(['error' => 'Section not found for the given grade level'], 404);
        }
    }
    public function fetchSectionByStrand(Request $request)
    {
        $strand = $request->input('strand');
        $gradeLevel = $request->input('gradeLevel');

        // Fetch sections based on strand and grade level
        $sections = Section::where('section', $strand) //section instead of strand, no strand in Section table
            ->where('gradeLevel', $gradeLevel)
            ->get(['sectionName']); // Fetch only the sectionName attribute

        // Check if sections were found
        if ($sections->isNotEmpty()) {
            return response()->json($sections);
        } else {
            return response()->json([], 200); // Return an empty array instead of 404
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
        $originalSection = $section->replicate();

        $oldSectionName = $section->sectionName;

        $section->gradeLevel = $request->input('gradeLevel');
        $section->section = $request->input('section');
        $section->sectionName = $request->input('sectionName');
        $section->teacherId = $request->input('sectionTeacher');
        $section->status = $request->input('status');
        $section->save();

        // use for activity logs
        $sectionFields = [
            'gradeLevel',
            'section',
            'sectionName',
            'teacherId',
            'status'
        ];

        $sectionChanges = MessageLogService::detectChanges($originalSection, $section, $sectionFields);

        // Log the changes (if any)
        if (!empty($sectionChanges)) {
            $activityMessage = "Updated the section details of " . $section->gradeLevel . " - " . $section->sectionName . ": " . implode(", ", $sectionChanges);

            $logs = new Log();
            $logs->studentId = Auth::user()->studentId;
            $logs->type = "edit_section";
            $logs->activity = $activityMessage;
            $logs->save();
        }

        // when section name is updated, it will also update the section in Subject Table
        Subject::where('gradeLevel', $section->gradeLevel)
            ->where('section', $oldSectionName)
            ->update(['section' => $section->sectionName]);

        notify()->success('Section Updated Successfully!');
        return redirect()->route('sectionlist.show');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
