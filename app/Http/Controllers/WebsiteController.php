<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('1website.index');
    }

    public function about()
    {
        return view('1website.about');
    }

    public function blog()
    {
        return view('1website.blog');
    }

    public function blogSingle()
    {
        return view('1website.blog-single');
    }

    public function contact()
    {
        return view('1website.contact');
    }

    public function event()
    {
        return view('1website.events');
    }

    public function eventSingle()
    {
        return view('1website.event-single');
    }

    public function teacher(Request $request)
    {
        $teachers = Teacher::all();
        // $teachers = Teacher::paginate(4);
        foreach ($teachers as $teacher) {
            $teacherId = $teacher->teacherId; // Get the teacherId for each teacher
            $image = User::where('studentId', $teacherId)->first();
            $teacher->image = $image;

            // Fetch handled grade levels based on subjects handled by this teacher
            $handledGradeLevels = Subject::where('teacherId', $teacherId)
                ->pluck('gradeLevel') // Assuming gradeLevel is a column in the subjects table
                ->unique();
            $teacher->handledGradeLevels = $handledGradeLevels; // Attach to teacher object
        }

        return view('1website.teacher', compact('teachers'));
    }

    public function teacherSingle()
    {
        return view('1website.teacher-single');
    }

    public function scholarship()
    {
        return view('1website.scholarship');
    }

    public function notice()
    {
        return view('1website.notice');
    }

    public function hierarchy()
    {
        return view('1website.hierarchy');
    }
}
