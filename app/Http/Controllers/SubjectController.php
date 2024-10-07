<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        } else {
            // Add New Subject
            $subject = new Subject();

            $subject->studentId = null;
            $subject->teacherId = $request->input('teacherId');
            $subject->gradeLevel = $request->input('gradeLevel');
            $subject->strand = $request->input('strand');
            $subject->semester = $request->input('semester');
            $subject->section = $request->input('section');
            $subject->subject = $request->input('subjectTitle');
            $subject->subjectType = $request->input('subjectType');
            $subject->subjectTeacher = $request->input('teacherName');
            $subject->save();

            $logs = new Log();
            $logs->studentId = Auth::user()->studentId;
            $logs->type = "add_subject";
            $logs->activity = "Added new subject " . $request->input('subjectTitle');
            $logs->save();


            notify()->success('Subject Added Successfully!');
        }
        return redirect()->back();
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

    public function fetchSubjects(Request $request)
    {
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

    public function fetchSubjectsBySem(Request $request)
    {
        $gradeLevel = $request->input('gradeLevel');
        $strand = $request->input('strand');
        $semester = $request->input('semester');

        $subjects = Subject::where('strand', $strand)
            ->where('gradeLevel', $gradeLevel)
            ->where('semester', $semester)
            ->get();

        if ($subjects->isNotEmpty()) {
            return response()->json($subjects);
        } else {
            // Return an empty array instead of a 404 error to simplify handling on the frontend
            return response()->json([]);
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
        $originalSubject = $subject->replicate(); // used in activility logs

        $subject->studentId = null;
        $subject->teacherId = $request->input('teacherId');
        $subject->gradeLevel = $request->input('gradeLevel');
        $subject->strand = $request->input('strand');
        $subject->semester = $request->input('semester');
        $subject->section = $request->input('section');
        $subject->subject = $request->input('subjectTitle');
        $subject->subjectType = $request->input('subjectType');
        $subject->subjectTeacher = $request->input('subjectTeacher');
        $subject->save();

        // used in activility logs
        $changes = [];
        if ($originalSubject->subject != $subject->subject) {
            $changes[] = "subject title from '{$originalSubject->subject}' to '{$subject->subject}'";
        }
        if ($originalSubject->teacherId != $subject->teacherId) {
            $changes[] = "teacher from '{$originalSubject->teacherId}' to '{$subject->teacherId}'";
        }
        if ($originalSubject->gradeLevel != $subject->gradeLevel) {
            $changes[] = "grade level from '{$originalSubject->gradeLevel}' to '{$subject->gradeLevel}'";
        }
        if ($originalSubject->strand != $subject->strand) {
            $changes[] = "strand from '{$originalSubject->strand}' to '{$subject->strand}'";
        }
        if ($originalSubject->semester != $subject->semester) {
            $changes[] = "semester from '{$originalSubject->semester}' to '{$subject->semester}'";
        }
        if ($originalSubject->section != $subject->section) {
            $changes[] = "section from '{$originalSubject->section}' to '{$subject->section}'";
        }
        if ($originalSubject->subjectType != $subject->subjectType) {
            $changes[] = "subject type from '{$originalSubject->subjectType}' to '{$subject->subjectType}'";
        }
        if ($originalSubject->subjectTeacher != $subject->subjectTeacher) {
            $changes[] = "subject teacher from '{$originalSubject->subjectTeacher}' to '{$subject->subjectTeacher}'";
        }

        // Create the activity log message
        $activityMessage = "Edited subject " . $request->input('subjectTitle');
        if (!empty($changes)) {
            $activityMessage .= ". Changes: " . implode(", ", $changes);
        }

        // Log the activity
        $logs = new Log();
        $logs->studentId = Auth::user()->studentId;
        $logs->type = "edit_subject";
        $logs->activity = $activityMessage;
        $logs->save();

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
