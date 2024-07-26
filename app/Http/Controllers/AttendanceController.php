<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Enrollee;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->studentId;
        $advisorySection = Section::where('teacherId', $id)->first();
        $handleSubjects = Subject::where('teacherId', $id)->first();
        $myStudents = null;
        $section = null;
        if($advisorySection){
            $gradeLevel = $advisorySection->gradeLevel;
            $section = $advisorySection->sectionName;
            $myStudents = Enrollee::where('gradeLevel', $gradeLevel)
                      ->where('section', $section)
                      ->get();
        }else
        {
            $subject = $handleSubjects->subjectTitle;
            $myStudents = Enrollee::whereRaw("FIND_IN_SET(?, REPLACE(subjects, ' ', ''))", [$subject])
                      ->get();
        }

        $myStudentsIds = $myStudents->pluck('studentId')->toArray();
        $studentDetails = Student::whereIn('studentId', $myStudentsIds)->get();
        $images = User::all();
        return view('teacher.attendance', compact('myStudents', 'images', 'studentDetails', 'section'));
    }

    public function showAttendance()
    {
        $id = Auth::user()->studentId;
        $advisorySection = Section::where('teacherId', $id)->first();
        $handleSubjects = Subject::where('teacherId', $id)->first();
        $myStudents = null;
        $section = null;
        if($advisorySection){
            $gradeLevel = $advisorySection->gradeLevel;
            $section = $advisorySection->sectionName;
            $myStudents = Enrollee::where('gradeLevel', $gradeLevel)
                      ->where('section', $section)
                      ->get();
        }else
        {
            $subject = $handleSubjects->subjectTitle;
            $myStudents = Enrollee::whereRaw("FIND_IN_SET(?, REPLACE(subjects, ' ', ''))", [$subject])
                      ->get();
        }

        $myStudentsIds = $myStudents->pluck('studentId')->toArray();
        $attendanceRecords = Attendance::whereIn('studentId', $myStudentsIds)->get();
        
        $studentsWithAttendance = $myStudents->map(function ($student) use ($attendanceRecords) {
            $student->attendance = $attendanceRecords->where('studentId', $student->studentId);
            return $student;
        });

        $images = User::all();
        return view('teacher.view-attendance', compact('myStudents', 'images', 'section', 'studentsWithAttendance'));
    }

    public function showStudentAttendance(Request $request)
    {
        return view('student.attendance');
    }

    public function getAttendance(Request $request)
    {
        $user = Auth::user();
        $studentId = $user->studentId;
        $month = $request->input('month', now()->format('Y-m'));

        $attendanceData = Attendance::where('studentId', $studentId)
            ->where('date', 'like', $month . '%')
            ->get(['date', 'status']);

        return response()->json($attendanceData);
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
        $date = now()->toDateString();
    
        foreach ($request->attendance as $studentId => $status) {
            // Check if an attendance record already exists for this student on the current date
            $attendance = Attendance::where('studentId', $studentId)
                                    ->where('date', $date)
                                    ->first();
    
            if ($attendance) {
                // Update the existing record
                $attendance->status = $status;
                $attendance->save();
                notify()->success('Attendance updated successfully');
            } else {
                // Create a new record
                Attendance::create([
                    'studentId' => $studentId,
                    'date' => $date,
                    'status' => $status,
                ]);
                notify()->success('Attendance recorded successfully');
            }
        }

        return redirect()->back();
    }

    public function getAttendanceAJAX()
    {
        $studentId = Auth::user()->studentId;
    
        // Get the start and end of the current month
        $startOfMonth = now()->startOfMonth()->toDateString();
        $endOfMonth = now()->endOfMonth()->toDateString();
    
        // Generate all dates in the month
        $dates = [];
        $date = $startOfMonth;
        while ($date <= $endOfMonth) {
            $dates[] = $date;
            $date = \Carbon\Carbon::parse($date)->addDay()->toDateString();
        }
    
        // Fetch attendance data
        $attendanceData = Attendance::where('studentId', $studentId)
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->get(['date', 'status']);
    
        // Map attendance data to ensure every date is included
        $attendanceData = collect($dates)->map(function($date) use ($attendanceData) {
            $entry = $attendanceData->firstWhere('date', $date);
            return [
                'date' => $date,
                'status' => $entry ? $entry->status : false // Default to false (absent) if no data
            ];
        });
    
        return response()->json($attendanceData);
    }

    public function getAllAttendanceAJAX()
    {
        // Get the start and end of the current month
        $startOfMonth = now()->startOfMonth()->toDateString();
        $endOfMonth = now()->endOfMonth()->toDateString();
    
        // Fetch attendance data grouped by date and status
        $attendanceData = Attendance::whereBetween('date', [$startOfMonth, $endOfMonth])
            ->selectRaw('date, status, COUNT(*) as count')
            ->groupBy('date', 'status')
            ->get()
            ->mapToGroups(function ($item) {
                return [$item->date => ['status' => $item->status, 'count' => $item->count]];
            })
            ->map(function ($group) {
                return [
                    'present' => $group->where('status', 1)->sum('count'),
                    'absent' => $group->where('status', 0)->sum('count')
                ];
            });
    
        // Prepare data for response
        $result = $attendanceData->map(function ($counts, $date) {
            return [
                'date' => $date,
                'present' => $counts['present'] ?? 0,
                'absent' => $counts['absent'] ?? 0,
            ];
        })->values();
    
        return response()->json($result);
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
