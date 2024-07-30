<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Enrollee;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Mail\WelcomeEmail;
use App\Models\File;
use Illuminate\Support\Facades\Mail;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.add-teacher');
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
        // ADD TEACHER
        $teacher = new Teacher();

        $teacher->firstName = $request->input('firstName');
        $teacher->middleName = $request->input('middleName');
        $teacher->lastName = $request->input('lastName');
        $teacher->suffix = $request->input('suffixName');
        $teacher->teacherId = $request->input('teacherId');
        $teacher->gender = $request->input('gender');
        $teacher->birthday = $request->input('birthday');
        $teacher->age = $request->input('age');
        $teacher->mobileNumber = $request->input('mobileNumber');
        $teacher->landlineNumber = $request->input('landlineNumber');
        $teacher->religion = $request->input('religion');
        $teacher->placeOfBirth = $request->input('birthplace');

        // Add New Address
        $address = new Address();
        $address->studentId = $request->input('teacherId');
        $address->region = $request->input('region');
        $address->province = $request->input('province');
        $address->city = $request->input('city');
        $address->baranggay = $request->input('barangay');
        $address->address = $request->input('address');

        // Validate the request data
        $password = $request->input('password');
        $repeatPassword = $request->input('password_confirmation');
        $validatedData = $request->validate([
            'teacherId' => ['required', 'string', 'max:255', 'unique:teachers'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Create a new user
        $user = new User();
        $user->studentId = $validatedData['teacherId'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->usertype = 'teacher';
        //  dd($request->all());

        if ($password == $repeatPassword) {
            $teacher->save();
            $address->save();
            $user->save();
        } else {
            notify()->error('Passwords do not match!');
            return redirect()->route('addteacher.show');
        }

        //send email to the teacher
        if ($validatedData['email']) {
            $toEmail = $validatedData['email'];
            $message = 'Your ID: ' . $validatedData['teacherId'] . ' Your Password: ' . $validatedData['password'];
            $subject = 'School Portal Login Details';

            Mail::to($toEmail)->send(new WelcomeEmail($message, $subject));
        }

        notify()->success('Teacher Added Successfully!');
        return redirect()->route('addteacher.show');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function showProfile(string $teacherId)
    {
        $teacherPhoto = User::where('studentId', $teacherId)->first();
        $teacher = DB::table('teachers')->where('teacherId', $teacherId)->first();
        if ($teacher === null) {
            abort(404); // or handle the case where student is not found
        }
        $address = DB::table('addresses')->where('studentId', $teacherId)->first();
        return view('teacher.profile-details', compact('teacher', 'address', 'teacherPhoto'));
    }

    public function showDashboard(string $teacherId)
    {
        $teacher = Teacher::where('teacherId', $teacherId)->first();
        return view('teacher.dashboard', compact('teacher'));
    }

    public function showEditTeacher(string $id)
    {
        $teacher = Teacher::find($id);
        $teacherId = $teacher->teacherId;

        $address = Address::where('studentId', $teacherId)->first();
        // dd($address);
        return view('admin.edit-teacher', compact('teacher', 'address'));
    }

    // this will display student based on handle section, if there is no section, it will based on handle subjects
    public function showStudents()
    {
        $id = Auth::user()->studentId;
        $handleStudents = Section::where('teacherId', $id)->first();
        $handleSubjects = Subject::where('teacherId', $id)->first();
        $myStudents = null;

        if ($handleStudents) {
            $gradeLevel = $handleStudents->gradeLevel;
            $section = $handleStudents->sectionName;
            $myStudents = Enrollee::where('gradeLevel', $gradeLevel)
                ->where('section', $section)
                ->get();
        } elseif ($handleSubjects) {
            $subject = $handleSubjects->subject;
            $myStudents = Enrollee::whereRaw("FIND_IN_SET(?, REPLACE(subjects, ' ', ''))", [$subject])
                ->get();
        } else {
            return view('teacher.my-students', [
                'myStudents' => collect(),
                'images' => User::all(),
                'studentDetails' => collect(),
                'message' => 'No Students Yet',
            ]);
        }

        $myStudentsIds = $myStudents->pluck('studentId')->toArray();
        $studentDetails = Student::whereIn('studentId', $myStudentsIds)->get();
        $images = User::all();
        return view('teacher.my-students', compact('myStudents', 'images', 'studentDetails'));
    }


    /**
     * Show the students of logged in teacher
     */
    public function showStudentsGrade()
    {
        $id = Auth::user()->studentId;
        $advisorySection = Section::where('teacherId', $id)->first();
        $handleSubjects = Subject::where('teacherId', $id)->first();
        $myStudents = collect(); // Initialize as an empty collection
    
        if ($advisorySection) {
            $gradeLevel = $advisorySection->gradeLevel;
            $section = $advisorySection->sectionName;
            $myStudents = Enrollee::where('gradeLevel', $gradeLevel)
                ->where('section', $section)
                ->get();
        } elseif ($handleSubjects) {
            $subject = $handleSubjects->subject;
            $myStudents = Enrollee::whereRaw("FIND_IN_SET(?, REPLACE(subjects, ' ', ''))", [$subject])
                ->get();
        }
    
        $myStudentsIds = $myStudents->pluck('studentId')->toArray();
        $students = Student::whereIn('studentId', $myStudentsIds)->get();
        $images = User::all();
    
        // Show the grade of the student
        $grade = collect(); // Initialize as an empty collection
    
        if ($advisorySection) {
            $gradeLevel = $advisorySection->gradeLevel;
            $section = $advisorySection->sectionName;
            $grade = Grade::where('gradeLevel', $gradeLevel)
                ->where('section', $section)
                ->get();
        } elseif ($handleSubjects) {
            $subject = $handleSubjects->subjectTitle;
            $grade = Grade::whereRaw("FIND_IN_SET(?, REPLACE(subject, ' ', ''))", [$subject])
                ->get();
        }
    
        $gradeStudentsIds = $grade->pluck('studentId')->toArray();
        $studentGrade = Grade::whereIn('studentId', $gradeStudentsIds)->get();
    
        return view('teacher.grading', compact('images', 'studentGrade', 'students', 'grade'));
    }
    

    public function showHandleSections()
    {
        $id = Auth::user()->studentId;
        $handleSections = Subject::where('teacherId', $id)
            ->select('gradeLevel', 'section')
            ->distinct()
            ->get();
        return view('teacher.grade-by-section', compact('handleSections'));
    }

    public function showStudentsGradeBySection(string $gradeLevel, string $section)
    {
        $id = Auth::user()->studentId;

        // Fetch subjects for the given teacher, grade level, and section
        $subjects = Subject::where('teacherId', $id)
            ->where('gradeLevel', $gradeLevel)
            ->where('section', $section)
            ->get();

        // Fetch students enrolled in the specified grade level and section
        $myStudents = Enrollee::where('gradeLevel', $gradeLevel)
            ->where('section', $section)
            ->get();

        // Initialize an empty collection for grades
        $grade = collect();

        // Fetch grades for each subject
        foreach ($subjects as $subject) {
            $subjectGrades = Grade::where('subject', $subject->subject)
                ->where('gradeLevel', $gradeLevel)
                ->where('section', $section)
                ->get();

            // Merge grades into the $grades collection
            $grade = $grade->merge($subjectGrades);
        }

        // Get the IDs of students
        $myStudentsIds = $myStudents->pluck('studentId')->toArray();
        // Fetch student details based on IDs
        $students = Student::whereIn('studentId', $myStudentsIds)->get();
        // Fetch user images for relevant users if needed
        $images = User::all();

        // foreach($students as $student)
        // {
        //     dd($student->firstName);
        // }

        // Return the view with the required data
        return view('teacher.grading-by-section', compact('subjects', 'grade', 'students', 'images'));
    }






    public function showSubjectList(string $teacherId)
    {
        $subjects = Subject::where('teacherId', $teacherId)->get();

        return view('teacher.subjects', compact('subjects'));
    }

    public function showSubDetails(string $subjectId)
    {
        $teacherId = Auth::user()->studentId;
        $subject = Subject::where('id', $subjectId)
            ->where('teacherId', $teacherId)
            ->first();
        $files = File::where('teacherId', $teacherId)
            ->where('subjectId', $subjectId)
            ->get();

        return view('teacher.subject-details', compact('subject', 'files', 'teacherId', 'subjectId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Add New Student
        // $student = new Student();

        // Update Student
        $teacher = Teacher::find($id);
        $teacherId = $teacher->teacherId;
        $teacherPhoto = User::where('studentId', $teacherId)->first();

        if ($request->hasFile('displayPhoto')) {
            $file = $request->file('displayPhoto');

            // Generate a unique filename
            $filename = $file->hashName();

            // Move the uploaded file to a safe location
            $file->storeAs('public/images/display-photo', $filename);

            // Update the student's displayPhoto attribute with the filename
            $teacherPhoto->displayPhoto = $filename;
        }

        $teacher->firstName = $request->input('firstName');
        $teacher->middleName = $request->input('middleName');
        $teacher->lastName = $request->input('lastName');
        $teacher->suffix = $request->input('suffixName');
        $teacher->teacherId = $request->input('studentId');
        $teacher->gender = $request->input('gender');
        $teacher->birthday = $request->input('birthday');
        $teacher->age = $request->input('age');
        $teacher->mobileNumber = $request->input('mobileNumber');
        $teacher->landlineNumber = $request->input('landlineNumber');
        $teacher->religion = $request->input('religion');
        $teacher->placeOfBirth = $request->input('birthplace');
        $teacher->save();
        $teacherPhoto->save();

        // Add New Address
        $address = Address::where('studentId', $teacherId)->first();
        $address->studentId = $request->input('studentId'); // studentId is use because its in Address table
        $address->region = $request->input('region');
        $address->province = $request->input('province');
        $address->city = $request->input('city');
        $address->baranggay = $request->input('barangay');
        $address->address = $request->input('address');
        $address->save();

        notify()->success('Record Updated Successfully!');
        return redirect()->route('profile-teacher.show', ['teacherId' => $teacherId]);
    }

    public function updateAdmin(Request $request, string $id)
    {
        // Add New Student
        // $student = new Student();

        // Update Student
        $teacher = Teacher::find($id);
        $teacherId = $teacher->teacherId;
        //  dd($teacher);

        $teacher->firstName = $request->input('firstName');
        $teacher->middleName = $request->input('middleName');
        $teacher->lastName = $request->input('lastName');
        $teacher->suffix = $request->input('suffixName');
        $teacher->gender = $request->input('gender');
        $teacher->birthday = $request->input('birthday');
        $teacher->age = $request->input('age');
        $teacher->mobileNumber = $request->input('mobileNumber');
        $teacher->landlineNumber = $request->input('landlineNumber');
        $teacher->religion = $request->input('religion');
        $teacher->placeOfBirth = $request->input('birthplace');
        $teacher->save();

        // Add New Address
        $address = Address::where('studentId', $teacherId)->first();
        $address->region = $request->input('region');
        $address->province = $request->input('province');
        $address->city = $request->input('city');
        $address->baranggay = $request->input('barangay');
        $address->address = $request->input('address');
        $address->save();

        notify()->success('Teacher Record Updated Successfully!');
        return redirect()->route('edit-teacher.show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
