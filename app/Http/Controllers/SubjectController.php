<?php

namespace App\Http\Controllers;

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
        // Add New Subject
        $subject = new Subject();

        $subject->studentId = null;
        $subject->teacherId = $request->input('teacherId');
        $subject->subjectCode = $request->input('subjectCode');
        $subject->gradeLevel = $request->input('gradeLevel');
        $subject->subjectTitle = $request->input('subjectTitle');
        $subject->subjectType = $request->input('subjectType');
        $subject->subjectTeacher = $request->input('teacherName');
        $subject->subjectUnit = $request->input('totalUnits');
        $subject->subjectLectUnit = $request->input('lectureUnit');
        $subject->subjectLabUnit = $request->input('labUnit');
        $subject->save();

          return redirect()->route('subjectlist.show')->with('success', 'Subject Added Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function showEditSubject(string $id)
    {
        $subject = Subject::find($id);
        $teachers = Teacher::all();
        return view('admin.edit-subject', compact('subject', 'teachers'));
    }

    public function fetchSubjects(Request $request) {
        $gradeLevel = $request->input('gradeLevel');
        $subjects = Subject::where('gradeLevel', $gradeLevel)->get();
        
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
        $subject->subjectCode = $request->input('subjectCode');
        $subject->gradeLevel = $request->input('gradeLevel');
        $subject->subjectTitle = $request->input('subjectTitle');
        $subject->subjectType = $request->input('subjectType');
        $subject->subjectTeacher = $request->input('subjectTeacher');
        $subject->subjectUnit = $request->input('totalUnits');
        $subject->subjectLectUnit = $request->input('lectureUnit');
        $subject->subjectLabUnit = $request->input('labUnit');
        $subject->save();

        return redirect()->route('subjectlist.show')->with('success', 'Subject Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
