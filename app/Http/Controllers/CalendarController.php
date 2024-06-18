<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use App\Services\CalendarService;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.calendar');
    }

    public function schedule(CalendarService $calendarService)
    {
        $weekDays = Lesson::DAYS;
        $calendarData = $calendarService->generateCalendarData($weekDays);

        return view('admin.calendar', compact('weekDays', 'calendarData'));
    }

    public function timeTable()
    {
        $lessons = Lesson::with('teacher')->get();

        return view('admin.timetable', compact('lessons'));
    }

    public function timeTableAdd(Request $request)
    {
        $lessons = Lesson::all();
        $teachers = Teacher::all();
        $sections = Section::all();

        $gradeLevel = $request->input('gradeLevel');
        $subjects = Subject::where('gradeLevel', $gradeLevel)->get();

        return view('admin.add-schedule', compact('lessons', 'teachers', 'sections', 'subjects'));
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
        $lesson = new Lesson();

        $lesson->gradeLevel = $request->input('gradeLevel');
        $lesson->teacherId = $request->input('teacher');
        $lesson->subjectId = $request->input('subject');
        $lesson->sectionId = $request->input('section');
        $lesson->room = $request->input('room');
        $lesson->day = $request->input('day');
        $lesson->start_time = $request->input('start_time');
        $lesson->end_time = $request->input('end_time');
        $lesson->save();

        return redirect()->route('add-timetable.show')->with('success', 'Schedule Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function showEditTimeTable(string $id)
    {
        $lesson = Lesson::find($id);

        $teachers = Teacher::all();
        $sections = Section::all();
        $subjects = Subject::all();

        return view('admin.edit-timetable', compact('lesson', 'teachers', 'sections', 'subjects'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editTimeTable(Request $request, string $id)
    {
        $lesson = Lesson::find($id);
        $lessonId = $lesson->id;

        $lesson->teacherId = $request->input('teacher');
        $lesson->gradeLevel = $request->input('gradeLevel');
        $lesson->subjectId = $request->input('subject');
        $lesson->sectionId = $request->input('section');
        $lesson->room = $request->input('room');
        $lesson->day = $request->input('day');
        $lesson->start_time = $request->input('start_time');
        $lesson->end_time = $request->input('end_time');
        $lesson->save();

        return redirect()->route('edit-timetable.show', ['id' => $lessonId])->with('success', 'Schedule Updated');
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
