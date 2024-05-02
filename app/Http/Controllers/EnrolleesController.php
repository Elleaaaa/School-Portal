<?php

namespace App\Http\Controllers;

use App\Models\Enrollee;
use App\Models\Grade;
use Illuminate\Http\Request;

class EnrolleesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.enroll-student');
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
        $fName = $request->input('firstName');
        $mName = $request->input('middleName');
        $lName = $request->input('lastName');
        $sName = $request->input('suffixName');
        $fullName = $fName.' '.$mName.' '.$lName.' '.$sName;

        // Enroll Student
        $enrollee = new Enrollee();
       
        $enrollee->studentId = $request->input('studentId');
        $enrollee->name = $fullName;
        $enrollee->subjects = $request->input('subjects');
        $enrollee->gradeLevel = $request->input('gradeLevel');
        $enrollee->section = $request->input('section');
        $enrollee->semester = $request->input('semester');
        $enrollee->classType = $request->input('classType');
        $enrollee->status = $request->input('status');
        $enrollee->save();

        // create row for each subjects
        $subjects = explode(',', $request->input('subjects'));
        foreach ($subjects as $subject) {
            $grade = new Grade();
            $grade->studentId = $request->input('studentId');
            $grade->gradeLevel = $request->input('gradeLevel');
            $grade->section = $request->input('section');
            $grade->semester = $request->input('semester');
            $grade->subject = $subject;
            $grade->firstQGrade = 'not yet graded';
            $grade->secondQGrade = 'not yet graded';
            $grade->thirdQGrade = 'not yet graded';
            $grade->fourthQGrade = 'not yet graded';
            $grade->schoolYear = null;
            $grade->save();
        }

        return redirect()->route('enroll-student.show')->with('success', 'Student Enrolled Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function showEditEnrollStudent(string $id)
    {
        $enrollees = Enrollee::find($id);

        $name = $enrollees->name;

        // Split the full name into components
        $nameComponents = explode(' ', $name);
        
        // Extract each component
        $firstName = isset($nameComponents[0]) ? $nameComponents[0] : null;
        $middleName = isset($nameComponents[1]) ? $nameComponents[1] : null;
        $lastName = isset($nameComponents[2]) ? $nameComponents[2] : null;
        $suffixName = isset($nameComponents[3]) ? $nameComponents[3] : null;
        return view('admin.edit-enroll-student', compact('enrollees', 'firstName', 'middleName', 'lastName', 'suffixName'));
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
        $fName = $request->input('firstName');
        $mName = $request->input('middleName');
        $lName = $request->input('lastName');
        $sName = $request->input('suffixName');
        $fullName = $fName.' '.$mName.' '.$lName.' '.$sName;

        // Enroll Student
        $enrollee = Enrollee::find($id);
       
        $enrollee->studentId = $request->input('studentId');
        $enrollee->name = $fullName;
        $enrollee->subjects = $request->input('subjects');
        $enrollee->gradeLevel = $request->input('gradeLevel');
        $enrollee->section = $request->input('section');
        $enrollee->semester = $request->input('semester');
        $enrollee->classType = $request->input('classType');
        $enrollee->status = $request->input('status');
        $enrollee->save();

        return redirect()->route('enrolled-student-list.show')->with('success', 'Student Enrolled Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
