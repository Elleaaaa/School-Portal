<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class FileController extends Controller
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
    public function store(Request $request, string $id)
    {
        $subject = Subject::find($id);
        if (!$subject) {
            notify()->error('Subject not found.');
            return redirect()->back();
        }

        $teacherId = Auth::user()->studentId;
    
       // Validate the file upload
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($validator->fails()) {
            // Return validation error response
            notify()->error('file should be pdf, doc or docx');
            return redirect()->back();
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            
            $file->storeAs("public/uploads/{$teacherId}/{$subject->subjectTitle}", $fileName);
    
            // Save file details to the database
            $fileRecord = new File();
            $fileRecord->subjectId = $subject->id;
            $fileRecord->teacherId = $teacherId;
            $fileRecord->fileName = $fileName; // Store the file name
            $fileRecord->save();
            
            // Notify success (you might need to adjust this based on your notification system)
            notify()->success('File uploaded successfully.');
            return redirect()->back();
        } else {
            // Notify error if file is not present (though validation should already handle this)
            notify()->error('No file was uploaded.');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
