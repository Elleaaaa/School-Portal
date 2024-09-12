<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Enrollee;
use Illuminate\Http\Request;
use App\Imports\GradesImport;
use App\Models\SHSGrade;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class GradeController extends Controller
{

    public function showJHSGrades()
    {
        $studentId = Auth::user()->studentId;

        //get the school years of the student
        $schoolYears = Grade::where('studentId', $studentId)
                            ->distinct()
                            ->pluck('schoolYear')
                            ->toArray();

        return view('student.grades-jhs', compact('schoolYears'));
    }

    public function getJHSGrades(Request $request)
    {
        $studentId = Auth::user()->studentId;
        $schoolYear = $request->input('schoolYear');
        $grades = Grade::where('studentId', $studentId)
                    ->where('schoolYear', $schoolYear)
                    ->get();

        return response()->json($grades);
    }

     public function showSHSGrades()
    {
        $studentId = Auth::user()->studentId;

        //get the school years of the student
        $schoolYears = SHSGrade::where('studentId', $studentId)
                            ->distinct()
                            ->pluck('schoolYear')
                            ->toArray();

        return view('student.grades-shs', compact('schoolYears'));
    }

    public function getSHSGrades(Request $request)
    {
        $studentId = Auth::user()->studentId;
        $schoolYear = $request->input('schoolYear');
        $grades = SHSGrade::where('studentId', $studentId)
                    ->where('schoolYear', $schoolYear)
                    ->get();

        return response()->json($grades);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

    public function importGrade(Request $request)
    {
        $request->validate([
            'gradeImport' => 'required|mimes:xlsx,csv,txt',
        ]);
        
        $file = $request->file('gradeImport');
        
        try {
            (new GradesImport)->import($file);
            notify()->success('Grades Imported Successfully!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        }
        
        return back();
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $grade = Grade::where('id', $id)->first();
        $grade->firstQGrade = $request->input('firstQGrade') !== null ? $request->input('firstQGrade') : 'not yet graded';
        $grade->secondQGrade = $request->input('secondQGrade') !== null ? $request->input('secondQGrade') : 'not yet graded';
        $grade->thirdQGrade = $request->input('thirdQGrade') !== null ? $request->input('thirdQGrade') : 'not yet graded';
        $grade->fourthQGrade = $request->input('fourthQGrade') !== null ? $request->input('fourthQGrade') : 'not yet graded';
        $grade->save();

        return redirect()->route('studentsgrade.show');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
