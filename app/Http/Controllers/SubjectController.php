<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();
        return view('admin.add-subject', compact('teachers'));
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
         // Check if the subject already exists
            $existingSubject = Subject::where('teacherId', $request->input('teacherId'))
            ->where('gradeLevel', $request->input('gradeLevel'))
            ->where('section', $request->input('section'))
            ->where('subject', $request->input('subjectTitle'))
            ->first();

        if ($existingSubject) {
        // Optionally: Update the existing record
        // $existingSubject->subjectType = $request->input('subjectType');
        // $existingSubject->subjectTeacher = $request->input('teacherName');
        // $existingSubject->save();

        // Notify the user and redirect
        notify()->warning('Subject already exists for this section!');
        }

        // Add New Subject
        $subject = new Subject();

        $subject->studentId = null;
        $subject->teacherId = $request->input('teacherId');
        $subject->gradeLevel = $request->input('gradeLevel');
        $subject->section = $request->input('section');
        $subject->subject = $request->input('subjectTitle');
        $subject->subjectType = $request->input('subjectType');
        $subject->subjectTeacher = $request->input('teacherName');
        $subject->save();

        notify()->success('Subject Added Successfully!');
        return redirect()->route('subjectlist.show');

    }

    /**
     * Display the specified resource.
     */
    public function showEditSubject(string $id)
    {
        $subject = Subject::find($id);
        $teachers = Teacher::all();
        $sections = Section::all();
        return view('admin.edit-subject', compact('subject', 'teachers', 'sections'));
    }

    public function fetchSubjects(Request $request) {
        $gradeLevel = $request->input('gradeLevel');
        $section = $request->input('section');
        $subjects = Subject::where('gradeLevel', $gradeLevel)
                            ->where('section', $section)
                            ->get();
        
        if ($subjects->isNotEmpty()) {
            return response()->json($subjects);
        } else {
            return response()->json(['error' => 'Subjects not found for the given grade level'], 404);
        }
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
        $subject = Subject::find($id);

        $subject->studentId = null;
        $subject->teacherId = $request->input('teacherId');
        $subject->gradeLevel = $request->input('gradeLevel');
        $subject->section = $request->input('section');
        $subject->subject = $request->input('subjectTitle');
        $subject->subjectType = $request->input('subjectType');
        $subject->subjectTeacher = $request->input('subjectTeacher');
        $subject->save();

        notify()->success('Subject Updated Successfully!');
        return redirect()->route('subjectlist.show');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
