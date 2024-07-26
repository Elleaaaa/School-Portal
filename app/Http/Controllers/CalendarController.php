<?php

namespace App\Http\Controllers;

use App\Models\Enrollee;
use App\Models\Lesson;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Services\CalendarService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.calendar');
    }

    public function schedule(Request $request, CalendarService $calendarService)
    {
        $gradeLevel = $request->input('gradeLevel');
        $section = $request->input('section');

        $lessons = Lesson::where('gradeLevel', $gradeLevel)
                        ->where('sectionId', $section)
                        ->get();

        $weekDays = Lesson::DAYS;
        $calendarData = $calendarService->generateCalendarData($weekDays, $lessons);

        return view('admin.calendar', compact('weekDays', 'calendarData'));
    }

    public function studentSchedule(CalendarService $calendarService)
    {
        $student = auth()->user();
        $studentId = $student->studentId;
        $enrolled = Enrollee::where('studentId', $studentId)
                            ->where('status', 'Enrolled')
                            ->get();
        $calendarData = null;
        $weekDays = Lesson::DAYS; // load all weekdays
        
        if ($enrolled->isNotEmpty()) { // Check if $enrolled is not empty
            // get the section of the student
            $section = Enrollee::where('studentId', $studentId)->first()->section;
        
            // get the schedule of the section of the student
            $lessons = Lesson::where('sectionId', $section)->get();
        
            // Organize lessons into calendar data format using CalendarService
            $calendarData = $calendarService->generateCalendarDataFiltered($weekDays, $lessons);
        
            return view('student.schedule', compact('weekDays', 'calendarData'));
        }
        
        return view('student.schedule', compact('weekDays', 'calendarData'));
    }

    public function teacherSchedule(CalendarService $calendarService)
    {
        $teacher = auth()->user();
        $teacherId = $teacher->studentId; //studentId the name of column in db
    
        // get the schedule of the section of the student
        $lessons = Lesson::where('teacherId', $teacherId)->get();
    
        $weekDays = Lesson::DAYS;
        // Organize lessons into calendar data format using CalendarService
        $calendarData = $calendarService->generateCalendarDataFiltered($weekDays, $lessons);
    
        return view('teacher.schedule', compact('weekDays', 'calendarData'));
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
        $gradeLevel = $request->input('gradeLevel');
        $teacherId = $request->input('teacher');
        $subjectId = $request->input('subject');
        $sectionId = $request->input('section');
        $room = $request->input('room');
        $day = $request->input('day');
        $start_time = $request->input('start_time');
        $end_time = $request->input('end_time');

        // Check for overlapping lessons in the same room
        $overlappingLesson = Lesson::where('room', $room)
            ->where('day', $day)
            ->where(function($query) use ($start_time, $end_time) {
                $query->where(function($q) use ($start_time, $end_time) {
                    $q->where('start_time', '<', $end_time)
                    ->where('end_time', '>', $start_time);
                });
            })
            ->first();

        if ($overlappingLesson) {
            // Return the specific time that is not available
            $conflictTime = "from {$overlappingLesson->start_time} to {$overlappingLesson->end_time}";
            return redirect()->back()
                ->with('failed', "There is an overlapping lesson in the same room: $conflictTime")
                ->withInput();
        }

        // Save the lesson if no overlapping lessons are found
        $lesson = new Lesson();
        $lesson->gradeLevel = $gradeLevel;
        $lesson->teacherId = $teacherId;
        $lesson->subjectId = $subjectId;
        $lesson->sectionId = $sectionId;
        $lesson->room = $room;
        $lesson->day = $day;
        $lesson->start_time = $start_time;
        $lesson->end_time = $end_time;
        $lesson->save();

        notify()->success('Lesson Created Successfully!');
        return redirect()->back();
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
