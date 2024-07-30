<?php

namespace App\Http\Controllers;

use App\Models\Enrollee;
use App\Models\Grade;
use App\Models\Notification;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Builder\Function_;

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

        // Check if the student is already enrolled this SY
        $year = date('Y');
        $month = date('m');

        if ($month <= 6) {
            $schoolYear = ($year - 1) . '-' . $year;
        } else {
            $schoolYear = $year . '-' . ($year + 1);
        }

        $studentId = $request->input('studentId');
        $existingEnrollment = Enrollee::where('studentId', $studentId)
        ->where('schoolYear', $schoolYear)
        ->first();

        // Enroll Student
        if ($existingEnrollment) {
            // Student is already enrolled, do not enroll again
            notify()->error('Student Already Enrolled!');
            return redirect()->back();
        } else {
            // Proceed with enrollment
            $enrollee = new Enrollee();
            $enrollee->studentId = $studentId;
            $enrollee->name = $fullName;
            $enrollee->subjects = $request->input('subjects');
            $enrollee->gradeLevel = $request->input('gradeLevel');
            $enrollee->section = $request->input('section');
            $enrollee->semester = $request->input('semester');
            $enrollee->strand = $request->input('strand');
            $enrollee->classType = $request->input('classType');
            $enrollee->schoolYear = $schoolYear;
            $enrollee->status = $request->input('status');
            $enrollee->save();

            $notif = new Notification();
            $notif->userId = $studentId;
            $notif->title = "Enrollment Approved!";
            $notif->message = "Congratulation! your enrollment for school year ". $schoolYear . " has been approved";
            $notif->type = "enrollment";
            $notif->userRole = "student";
            $notif->save();
        }

        // create row for each subjects
        $subjects = explode(',', $request->input('subjects'));
        // Remove any extra spaces around each subject
        $subjects = array_map('trim', $subjects);
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
            $grade->schoolYear = $schoolYear;
            $grade->save();
        }

        notify()->success('Student Enrolled Successfully!');
        return redirect()->route('enroll-student.show');
    }

    public function selfEnroll(Request $request)
    {
        $fName = $request->input('firstName');
        $mName = $request->input('middleName');
        $lName = $request->input('lastName');
        $sName = $request->input('suffixName');
        $fullName = $fName.' '.$mName.' '.$lName.' '.$sName;

          // Check if the student is already enrolled this SY
          $year = date('Y');
          $month = date('m');
  
          if ($month <= 6) {
              $schoolYear = ($year - 1) . '-' . $year;
          } else {
              $schoolYear = $year . '-' . ($year + 1);
          }

        // Enroll Student
        $enrollee = new Enrollee();
       
        $enrollee->studentId = $request->input('studentId');
        $enrollee->name = $fullName;
        $enrollee->subjects = $request->input('subjects');
        $enrollee->gradeLevel = $request->input('gradeLevel');
        $enrollee->section = $request->input('section');
        $enrollee->semester = $request->input('semester');
        $enrollee->strand = $request->input('strand');
        $enrollee->classType = $request->input('classType');
        $enrollee->status = $request->input('status');
        $enrollee->save();

        $notif = new Notification();
        $notif->userId = $request->input('studentId');
        $notif->title = "Pending Enrollment!";
        $notif->message = "Wait for Registrar to approved your enrollment";
        $notif->type = "enrollment";
        $notif->userRole = "student";
        $notif->save();

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
            $grade->schoolYear = $schoolYear;
            $grade->save();
        }

        notify()->success('Wait for registrar to confirm!');
        return redirect()->route('selfEnrollment.show');
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


    public function selfEnrollment()
    {
        $userId = Auth::id();
        $students = User::where('id', $userId)->first();
        $studentId = $students->studentId;
        $student = Student::where('studentId', $studentId)->first();

        $enrollee = Enrollee::where('studentId', $studentId)->first();

        // +1 WHEN SELF ENROLLMENT
        $gradeMapping = [
            "Grade 7" => "Grade 8",
            "Grade 8" => "Grade 9",
            "Grade 9" => "Grade 10",
            "Grade 10" => "Grade 11",
            "Grade 11" => "Grade 12",
            "Grade 12" => "Graduated"
        ];

        $gradeLevel = $enrollee->gradeLevel;
        $gradeLevelUp = isset($gradeMapping[$gradeLevel]) ? $gradeMapping[$gradeLevel] : "Invalid grade level";

        return view('student.enrollment', compact('student', 'gradeLevelUp', 'enrollee'));

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

          // Check if the student is already enrolled this SY
          $year = date('Y');
          $month = date('m');
  
          if ($month <= 6) {
              $schoolYear = ($year - 1) . '-' . $year;
          } else {
              $schoolYear = $year . '-' . ($year + 1);
          }

        // Enroll Student
        $enrollee = Enrollee::find($id);
       
        $enrollee->studentId = $request->input('studentId');
        $enrollee->name = $fullName;
        $enrollee->subjects = $request->input('subjects');
        $enrollee->gradeLevel = $request->input('gradeLevel');
        $enrollee->section = $request->input('section');
        $enrollee->semester = $request->input('semester');
        $enrollee->strand = $request->input('strand');
        $enrollee->classType = $request->input('classType');
        $enrollee->status = $request->input('status');
        $enrollee->save();

        // delete previous grade when section is changed
        $studentId = $request->input('studentId');
        $grade = Grade::where('studentId', $studentId);
        $grade->delete();

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
            $grade->schoolYear = $schoolYear;
            $grade->save();
         }

        notify()->success('Student Enrolled Successfully!');
        return redirect()->route('enrolled-student-list.show');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
