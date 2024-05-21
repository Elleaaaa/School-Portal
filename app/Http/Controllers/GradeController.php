<?php

namespace App\Http\Controllers;

use App\Imports\GradesImport;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        (new GradesImport)->import($file);

        return back()->with('success', 'Grades imported successfully.');
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
