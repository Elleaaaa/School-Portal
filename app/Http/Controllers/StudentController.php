<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Enrollee;
use App\Models\Grade;
use App\Models\Guardian;
use App\Models\LastSchool;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Mail\WelcomeEmail;
use App\Models\Fee;
use App\Models\FeeList;
use App\Models\Subject;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\Break_;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.add-student');
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
        // Add New Student
        $student = new Student();

        $student->firstName = $request->input('firstName');
        $student->middleName = $request->input('middleName');
        $student->lastName = $request->input('lastName');
        $student->suffix = $request->input('suffixName');
        $student->studentId = $request->input('studentId');
        $student->gender = $request->input('gender');
        $student->birthday = $request->input('birthday');
        $student->age = $request->input('age');
        $student->mobileNumber = $request->input('mobileNumber');
        $student->landlineNumber = $request->input('landlineNumber');
        $student->religion = $request->input('religion');
        $student->placeOfBirth = $request->input('birthplace');

        // Add New Address
        $address = new Address();
        $address->studentId = $request->input('studentId');
        $address->region = $request->input('region');
        $address->province = $request->input('province');
        $address->city = $request->input('city');
        $address->baranggay = $request->input('barangay');
        $address->address = $request->input('address');

        // Add New Guardian
        $guardian = new Guardian();
        $guardian->studentId = $request->input('studentId');
        $guardian->mothersFirstName = $request->input('mothersFirstName');
        $guardian->mothersLastName = $request->input('mothersLastName');
        $guardian->motherAge = $request->input('motherAge');
        $guardian->motherOccupation = $request->input('motherOccupation');
        $guardian->motherContact = $request->input('motherContact');
        $guardian->motherAddress = $request->input('motherAddress');

        $guardian->fathersFirstName = $request->input('fathersFirstName');
        $guardian->fathersLastName = $request->input('fathersLastName');
        $guardian->fathersSuffix = $request->input('fathersSuffix');
        $guardian->fatherAge = $request->input('fatherAge');
        $guardian->fatherOccupation = $request->input('fatherOccupation');
        $guardian->fatherContact = $request->input('fatherContact');
        $guardian->fatherAddress = $request->input('fatherAddress');

        // Add Last School Attended
        $lastSchool = new LastSchool();
        $lastSchool->studentId = $request->input('studentId');
        $lastSchool->school = $request->input('lastSchool');
        $lastSchool->genAverage = $request->input('lastSchoolAverage');

        // Validate the request data
        $password = $request->input('password');
        $repeatPassword = $request->input('password_confirmation');
        $validatedData = $request->validate([
            'studentId' => ['required', 'string', 'max:255', 'unique:students', 'unique:addresses', 'unique:guardians', 'unique:users', 'unique:lastschools'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Create a new user
        $user = new User();
        $user->studentId = $validatedData['studentId'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->completeProfile = false;
        $user->usertype = 'student';

        if ($password == $repeatPassword) {
            $student->save();
            $address->save();
            $guardian->save();
            $lastSchool->save();
            $user->save();
        } else {
            notify()->error('Passwords do not match!');
            return redirect()->route('addstudent.show');
        }

        //send email to the student
        if ($validatedData['email']) {
            $toEmail = $validatedData['email'];
            $message = 'Student ID: ' . $validatedData['studentId'] . ' Password: ' . $validatedData['password'];
            $subject = 'School Portal Login Details';

            Mail::to($toEmail)->send(new WelcomeEmail($message, $subject));
        }


        notify()->success('Student Added Successfully!');
        return redirect()->route('addstudent.show');
    }

    /**
     * Display the specified resource.
     */
    public function showProfile(string $studentId)
    {
        $studentPhoto = User::where('studentID', $studentId)->first();
        $student = DB::table('students')->where('studentId', $studentId)->first();
        if ($student === null) {
            abort(404); // or handle the case where student is not found
        }

        $address = DB::table('addresses')->where('studentId', $studentId)->first();
        $guardians = DB::table('guardians')->where('studentId', $studentId)->first();
        $lastSchool = DB::table('lastschools')->where('studentId', $studentId)->first();

        return view('student.profile-details', compact('student', 'address', 'guardians', 'lastSchool', 'studentPhoto')); // compact('student') student will be the variable that can access in blade file same for address and guardians

    }

    public function showDashboard(string $studentId)
    {
        $student = Student::where('studentId', $studentId)->first();

        $subjectCount = Enrollee::where('studentId', $studentId)
            ->where('status', 'Enrolled')
            ->selectRaw("LENGTH(REPLACE(subjects, ' ', '')) - LENGTH(REPLACE(REPLACE(subjects, ' ', ''), ',', '')) + 1 AS subject_count")
            ->first();

        $subjectCount = $subjectCount ? $subjectCount->subject_count : 0;

        return view('student.dashboard', compact('student', 'subjectCount'));
    }

    public function showGrades(string $studentId)
    {
        $enrolled = Enrollee::where('studentId', $studentId)
            ->where('status', 'Enrolled')
            ->get();
        $grades = [];

        if ($enrolled->isNotEmpty()) {
            $grades = Grade::where('studentId', $studentId)->get();
        }

        return view('student.grades', compact('grades'));
    }


    public function showSubjectList(string $studentId)
{
    $enrollee = Enrollee::where('studentId', $studentId)
        ->where('status', 'Enrolled')
        ->first();
    $allSubjects = [];
    $subjectTeachers = [];
    
    if ($enrollee) {
        $subjects = $enrollee->subjects;
        $subjectList = explode(' ', $subjects);
    
        foreach ($subjectList as $subject) {
            // Format the subject name
            $formattedSubject = str_replace(',', '', ucwords(strtolower($subject)));
            $allSubjects[] = $formattedSubject;
    
            $gradeLevel = $enrollee->gradeLevel;
            $section = $enrollee->section;
    
            // Find the subject in the Subject table
            $subjectTeacher = Subject::where('gradeLevel', $gradeLevel)
                ->where('section', $section)
                ->where('subjectTitle', $formattedSubject)
                ->first();
    
            if ($subjectTeacher) {
                $teacherId = $subjectTeacher->teacherId;
                $teacher = Teacher::where('teacherId', $teacherId)->first();
                if ($teacher) {
                    $subjectTeachers[$formattedSubject] = $teacher->firstName . ' ' . $teacher->lastName;
                } else {
                    $subjectTeachers[$formattedSubject] = 'Teacher not found';
                }
            } else {
                $subjectTeachers[$formattedSubject] = 'Teacher not assigned';
            }
        }
    
        return view('student.subject-list', compact('allSubjects', 'subjectTeachers'));
    }
    
    return view('student.subject-list', compact('allSubjects'));
}

    

    public function showEditStudent(string $id)
    {
        $students = Student::find($id);
        $studentId = $students->studentId;

        $address = Address::where('studentId', $studentId)->first();
        $guardians = Guardian::where('studentId', $studentId)->first();
        $lastSchool = LastSchool::where('studentId', $studentId)->first();
        $studentPhoto = User::where('studentID', $studentId)->first();
        // dd($address);
        return view('admin.edit-student', compact('students', 'address', 'guardians', 'lastSchool', 'studentPhoto'));
    }

    public function showInvoice()
    {
        $studentId = Auth::user()->studentId;
        $enrollee = Enrollee::where('studentId', $studentId)
                            ->first();
        $classType = $enrollee ? $enrollee->classType : null;
        $gradeLevel = $enrollee ? $enrollee->gradeLevel : null;
        
        $student = Enrollee::where('studentId', $studentId)
            ->where('classType', $classType)
            ->first();

            //this is for Special Science Class Invoice
        if($classType == "Special Science Class")
        {
            $monthlyTF = 0;
            $monthlyCF = 200;
            $genyoELearning = 200;
            $energyFee = 200;
            $wholeYearTF = 0;
            $newStudent = 0;
            $miscFee = 1340;
            $otherSF = 4530;
            $membershipFee = 200;

            switch($gradeLevel){
                case "Grade 7":
                    $monthlyTF = 924;
                    $wholeYearTF = 15240;
                    $newStudent = 100;
                    break;
                case "Grade 8":
                    $monthlyTF = 936;
                    $wholeYearTF = 15360;
                    break;
                case "Grade 9":
                    $monthlyTF = 942;
                    $wholeYearTF = 15420;
                    break;
                case "Grade 10":
                    $monthlyTF = 947;
                    $wholeYearTF = 15470;
                    break;
            }

            $tuitionFee = FeeList::where('feeName', "Tuition Fee")
                ->where('classType', "Special Science Class")
                ->where('gradeLevel', $student->gradeLevel)
                ->first();

            $feeHistory = Fee::where('studentId', $studentId)->get();
            $totalAmountPaid = Fee::where('studentId', $studentId)->sum('amountPaid');
        }
        elseif($classType == "Regular Class")
        {   
            //this is for Regular Class Invoice
            $monthlyTF = 0;
            $monthlyCF = 175;
            $genyoELearning = 200;
            $energyFee = 200;
            $wholeYearTF = 0;
            $newStudent = 0;
            $miscFee = 1340;
            $otherSF = 4230;
            $membershipFee = 200;

            switch($gradeLevel) {
                case "Grade 7":
                    $monthlyTF = 882;
                    $wholeYearTF = 14570;
                    $newStudent = 100;
                    break;
                case "Grade 8":
                    $monthlyTF = 893;
                    $wholeYearTF = 14680;
                    break;
                case "Grade 9":
                    $monthlyTF = 899;
                    $wholeYearTF = 14740;
                    break;
                case "Grade 10":
                    $monthlyTF = 904;
                    $wholeYearTF = 14790;
                    break;
            }

            $tuitionFee = FeeList::where('feeName', "Tuition Fee")
                ->where('classType', "Regular Class")
                ->where('gradeLevel', $student->gradeLevel)
                ->first();

            $feeHistory = Fee::where('studentId', $studentId)->get();
            $totalAmountPaid = Fee::where('studentId', $studentId)->sum('amountPaid');
        }
        return view('student.invoice', compact('tuitionFee', 'feeHistory', 'totalAmountPaid','monthlyTF','monthlyCF', 'genyoELearning', 'energyFee', 'wholeYearTF', 'newStudent', 'miscFee', 'otherSF', 'membershipFee'));
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
        // Add New Student
        // $student = new Student();

        // Update Student
        $student = Student::find($id);
        $studentId = $student->studentId;
        $studentPhoto = User::where('studentId', $studentId)->first();

        if ($request->hasFile('displayPhoto')) {
            $file = $request->file('displayPhoto');

            // Generate a unique filename
            $filename = $file->hashName();

            // Move the uploaded file to a safe location
            $file->storeAs('public/images/display-photo', $filename);

            // Update the student's displayPhoto attribute with the filename
            $studentPhoto->displayPhoto = $filename;
        }

        $student->firstName = $request->input('firstName');
        $student->middleName = $request->input('middleName');
        $student->lastName = $request->input('lastName');
        $student->suffix = $request->input('suffixName');
        $student->studentId = $request->input('studentId');
        $student->gender = $request->input('gender');
        $student->birthday = $request->input('birthday');
        $student->age = $request->input('age');
        $student->mobileNumber = $request->input('mobileNumber');
        $student->landlineNumber = $request->input('landlineNumber');
        $student->religion = $request->input('religion');
        $student->placeOfBirth = $request->input('birthplace');
        $student->save();
        $studentPhoto->save();

        // Update Address
        $address = Address::where('studentId', $studentId)->first();
        $address->region = $request->input('region');
        $address->province = $request->input('province');
        $address->city = $request->input('city');
        $address->baranggay = $request->input('barangay');
        $address->address = $request->input('address');
        $address->save();

        // Update Guardian
        $guardian = Guardian::where('studentId', $studentId)->first();
        $guardian->mothersFirstName = $request->input('mothersFirstName');
        $guardian->mothersLastName = $request->input('mothersLastName');
        $guardian->motherAge = $request->input('motherAge');
        $guardian->motherOccupation = $request->input('motherOccupation');
        $guardian->motherContact = $request->input('motherContact');
        $guardian->motherAddress = $request->input('motherAddress');

        $guardian->fathersFirstName = $request->input('fathersFirstName');
        $guardian->fathersLastName = $request->input('fathersLastName');
        $guardian->fathersSuffix = $request->input('fathersSuffix');
        $guardian->fatherAge = $request->input('fatherAge');
        $guardian->fatherOccupation = $request->input('fatherOccupation');
        $guardian->fatherContact = $request->input('fatherContact');
        $guardian->fatherAddress = $request->input('fatherAddress');
        $guardian->save();

        $user = User::where('studentId', $studentId)->first();
        $user->completeProfile = True;
        $user->save();

        notify()->success('Student Record Updated Successfully!');
        return redirect()->route('profile-details.show', ['studentId' => $studentId]);
    }

    public function updateAdmin(Request $request, string $id)
    {
        // Add New Student
        // $student = new Student();

        // Update Student
        $student = Student::find($id);
        $studentId = $student->studentId;
        //  dd($teacher);

        $student->firstName = $request->input('firstName');
        $student->middleName = $request->input('middleName');
        $student->lastName = $request->input('lastName');
        $student->suffix = $request->input('suffixName');
        $student->gender = $request->input('gender');
        $student->birthday = $request->input('birthday');
        $student->age = $request->input('age');
        $student->mobileNumber = $request->input('mobileNumber');
        $student->landlineNumber = $request->input('landlineNumber');
        $student->religion = $request->input('religion');
        $student->placeOfBirth = $request->input('birthplace');
        $student->save();

        // Update Address
        $address = Address::where('studentId', $studentId)->first();
        $address->region = $request->input('region');
        $address->province = $request->input('province');
        $address->city = $request->input('city');
        $address->baranggay = $request->input('barangay');
        $address->address = $request->input('address');
        $address->save();

        // Update Guardian
        $guardian = Guardian::where('studentId', $studentId)->first();
        $guardian->mothersFirstName = $request->input('mothersFirstName');
        $guardian->mothersLastName = $request->input('mothersLastName');
        $guardian->motherAge = $request->input('motherAge');
        $guardian->motherOccupation = $request->input('motherOccupation');
        $guardian->motherContact = $request->input('motherContact');
        $guardian->motherAddress = $request->input('motherAddress');

        $guardian->fathersFirstName = $request->input('fathersFirstName');
        $guardian->fathersLastName = $request->input('fathersLastName');
        $guardian->fathersSuffix = $request->input('fathersSuffix');
        $guardian->fatherAge = $request->input('fatherAge');
        $guardian->fatherOccupation = $request->input('fatherOccupation');
        $guardian->fatherContact = $request->input('fatherContact');
        $guardian->fatherAddress = $request->input('fatherAddress');
        $guardian->save();

        // Update School Attended
        $lastSchool = LastSchool::where('studentId', $studentId)->first();
        $lastSchool->school = $request->input('lastSchool');
        $lastSchool->genAverage = $request->input('lastSchoolAverage');
        $lastSchool->save();

        notify()->success('Student Record Updated Successfully!');
        return redirect()->route('edit-student.show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
