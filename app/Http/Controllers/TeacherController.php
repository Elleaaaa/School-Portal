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
use App\Models\Attendance;
use App\Models\File;
use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Services\MessageLogService;

class TeacherController extends Controller
{

    public $studentTotalCount;
    public $myStudentsIds;
    public $myStudents;
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

        if ($validatedData['email']) {
            $logs = new Log();
            $logs->studentId = Auth::user()->studentId;
            $logs->type = "add_teacher";
            $logs->activity = "Added new teacher with ID " . $validatedData['studentId'];
            $logs->save();
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

        $this->showStudentsGrade();
        $studentTotalCount = $this->studentTotalCount;

        // for ascending order of gradelevel
        $grades = [
            "Grade 7",
            "Grade 8",
            "Grade 9",
            "Grade 10",
            "Grade 11",
            "Grade 12"
        ];

        $handleSections = Subject::where('teacherId', $teacherId)
            ->select('gradeLevel', 'section')
            ->distinct()
            ->count();

        $sections = Subject::where('teacherId', $teacherId)
            ->select('gradeLevel', 'section')
            ->orderByRaw("FIELD(gradeLevel, '" . implode("', '", $grades) . "') ASC")
            ->distinct()
            ->get();

        $myStudents = collect();

        foreach ($sections as $section) {
            $gradeLevel = $section->gradeLevel;
            $sectionName = $section->section;

            // Get the student count for each section
            $studentCount = Enrollee::where('gradeLevel', $gradeLevel)
                ->where('section', $sectionName)
                ->where('schoolYear', now()->year . "-" . (now()->year + 1))
                ->count();

            $studentsInSection = Enrollee::where('gradeLevel', $gradeLevel)
                ->where('section', $sectionName)
                ->where('schoolYear', now()->year . "-" . (now()->year + 1))
                ->get();

            // Attach the student count to the section object
            $section->studentCount = $studentCount;
            $myStudents = $myStudents->merge($studentsInSection);
        }

        $myStudentsIds = $myStudents->pluck('studentId')->toArray();

        $absentToday = Attendance::whereIn('studentId', $myStudentsIds)
            ->where('date', date('Y-m-d'))
            ->where('status', 0) // 0 means absent
            ->count();

        $presentToday = Attendance::whereIn('studentId', $myStudentsIds)
            ->where('date', date('Y-m-d'))
            ->where('status', 1) // 1 means present
            ->count();


        // for passing to the allGenderAJAX() method
        $this->myStudentsIds = $myStudentsIds; //I'm passing the $mystudentIds to the allGenderAJAX()
        $this->myStudents = $myStudents;

        return view('teacher.dashboard', compact('teacher', 'studentTotalCount', 'handleSections', 'sections', 'absentToday', 'presentToday'));
    }

    public function getAllGenderAJAX()
    {
        $this->showDashboard(Auth::user()->studentId);
        $myStudentsIds = $this->myStudentsIds;

        $genders = Student::whereIn('studentId', $myStudentsIds)->pluck('gender');

        return response()->json($genders);
    }

    public function getAllGradeLevelAJAX()
    {
        $this->showDashboard(Auth::user()->studentId);
        $myStudentsIds = $this->myStudentsIds;

        $myStudents = Enrollee::whereIn('studentId', $myStudentsIds)->pluck('gradeLevel');

        return response()->json($myStudents);
    }

    public function showEditTeacher(string $id)
    {
        $teacher = Teacher::find($id);
        $teacherId = $teacher->teacherId;

        $address = Address::where('studentId', $teacherId)->first();
        // dd($address);
        return view('admin.edit-teacher', compact('teacher', 'address'));
    }

    // this will display student based on handle subjects
    public function showStudents()
    {
        $id = Auth::user()->studentId;

        // Fetch distinct sections for the teacher
        $handleSections = Subject::where('teacherId', $id)
            ->select('gradeLevel', 'section')
            ->distinct()
            ->get();

        // Initialize an empty collection for students
        $myStudents = collect();

        // Fetch subjects handled by the teacher
        $handleSubjects = Subject::where('teacherId', $id)->get();

        if ($handleSubjects->isNotEmpty()) {
            // Loop through each section
            foreach ($handleSections as $section) {
                // Find students for each subject and section
                foreach ($handleSubjects as $subject) {
                    $students = Enrollee::whereRaw("FIND_IN_SET(?, REPLACE(subjects, ' ', ''))", [$subject->subject])
                        ->where('gradeLevel', $section->gradeLevel)
                        ->where('section', $section->section)
                        ->get();

                    // Merge the found students into the $myStudents collection
                    $myStudents = $myStudents->merge($students);
                }
            }
        }

        // Remove duplicates by student ID
        $myStudents = $myStudents->unique('studentId');

        // Get unique student IDs from the merged students collection
        $myStudentsIds = $myStudents->pluck('studentId')->toArray();
        // Fetch student details based on IDs
        $studentDetails = Student::whereIn('studentId', $myStudentsIds)->get();

        // Retrieve images only for the relevant students
        $images = User::whereIn('studentId', $myStudentsIds)->get();

        // Return the view with the required data
        return view('teacher.my-students', compact('myStudents', 'images', 'studentDetails'));
    }



    /**
     * Show the students of logged in teacher
     */
    public function showStudentsGrade()
    {
        $id = Auth::user()->studentId;
        $handleSubjects = Subject::where('teacherId', $id)->get();
        $myStudents = collect(); // Initialize an empty collection for students
        $grades = collect(); // Initialize an empty collection for grades

        $currentYear = Carbon::now()->year;
        $nextYear = $currentYear + 1;
        $latestSY = "{$currentYear}-{$nextYear}";

        $handleSections = Subject::where('teacherId', $id)
            ->select('gradeLevel', 'section')
            ->distinct()
            ->get();

        if ($handleSubjects->isNotEmpty()) { // Check if collection is not empty
            // Loop through each section
            foreach ($handleSections as $section) {
                // Loop through each subject and find students and grades
                foreach ($handleSubjects as $subject) {
                    // Find students for each subject and section
                    $students = Enrollee::whereRaw("FIND_IN_SET(?, REPLACE(subjects, ' ', ''))", [$subject->subject])
                        ->where('gradeLevel', $section->gradeLevel)
                        ->where('section', $section->section)
                        ->where('schoolYear', $latestSY)
                        ->get();

                    // Merge the found students into the $myStudents collection
                    $myStudents = $myStudents->merge($students);

                    // Find grades for each subject and section
                    $subjectGrades = Grade::whereRaw("FIND_IN_SET(?, REPLACE(subject, ' ', ''))", [$subject->subject])
                        ->where('gradeLevel', $section->gradeLevel)
                        ->where('section', $section->section)
                        ->where('schoolYear', $latestSY)
                        ->get();

                    // Merge the found grades into the $grades collection
                    $grades = $grades->merge($subjectGrades);
                }
            }
        }

        // Remove duplicates by student ID
        $myStudents = $myStudents->unique('studentId');
        $grades = $grades->unique('studentId');

        // Get unique student IDs from the merged students collection
        $myStudentsIds = $myStudents->pluck('studentId')->toArray();
        $students = Student::whereIn('studentId', $myStudentsIds)->get();

        // Get unique student IDs from the merged grades collection
        $gradeStudentsIds = $grades->pluck('studentId')->toArray();
        $studentGrade = Grade::whereIn('studentId', $gradeStudentsIds)->get();

        // Retrieve images (assuming they are stored in User model)
        $images = User::all();

        // this is for passing the value to the showDashboard() method
        $studentTotalCount = $myStudents->count();
        $this->studentTotalCount = $studentTotalCount;

        return view('teacher.grading', compact('images', 'studentGrade', 'students', 'grades'));
    }





    public function showHandleSections()
    {
        $id = Auth::user()->studentId;

        // to filter ascenting grade 7-10
        $grades = [
            "Grade 7",
            "Grade 8",
            "Grade 9",
            "Grade 10",
            "Grade 11",
            "Grade 12"
        ];

        // Create a mapping for the grades to ensure correct ordering
        // $gradeOrder = array_flip($grades); //incase there is bug in gradeLevel order use this

        $handleSections = Subject::where('teacherId', $id)
            ->select('gradeLevel', 'section')
            ->distinct()
            ->orderByRaw("FIELD(gradeLevel, '" . implode("', '", $grades) . "') ASC")
            ->get();

        return view('teacher.grade-by-section', compact('handleSections'));
    }

    public function showStudentsGradeBySection(string $gradeLevel, string $section)
    {
        $id = Auth::user()->studentId;

        $currentYear = Carbon::now()->year;
        $nextYear = $currentYear + 1;
        $latestSY = "{$currentYear}-{$nextYear}";

        // Fetch subjects for the given teacher, grade level, and section
        $subjects = Subject::where('teacherId', $id)
            ->where('gradeLevel', $gradeLevel)
            ->where('section', $section)
            ->get();

        // Fetch students enrolled in the specified grade level and section
        $myStudents = Enrollee::where('gradeLevel', $gradeLevel)
            ->where('section', $section)
            ->where('schoolYear', $latestSY)
            ->get();

        // Get student IDs
        $myStudentsIds = $myStudents->pluck('studentId')->toArray();

        // Initialize an empty collection for grades
        $grades = collect();

        // Fetch grades for each subject only once, filtered by student ID
        foreach ($subjects as $subject) {
            $subjectGrades = Grade::where('subject', $subject->subject)
                ->where('gradeLevel', $gradeLevel)
                ->where('section', $section)
                ->whereIn('studentId', $myStudentsIds) // Ensure grades are only for enrolled students
                ->get();

            // Merge grades into the $grades collection
            $grades = $grades->merge($subjectGrades);
        }

        // Fetch student details based on IDs
        $students = Student::whereIn('studentId', $myStudentsIds)->get();

        // Fetch user images only for relevant students
        $images = User::whereIn('studentId', $myStudentsIds)->get();

        // Return the view with the required data
        return view('teacher.grading-by-section', compact('subjects', 'grades', 'students', 'images', 'section'));
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
        $originalTeacher = $teacher->replicate();
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

        // use for activity logs
        $teacherFields = [
            'firstName',
            'middleName',
            'lastName',
            'suffix',
            'gender',
            'birthday',
            'age',
            'mobileNumber',
            'landlineNumber',
            'religion',
            'placeOfBirth',
        ];

        $teacherChanges = MessageLogService::detectChanges($originalTeacher, $teacher, $teacherFields);

        // Log the changes (if any)
        if (!empty($teacherChanges)) {
            $activityMessage = "Updated the teacher details of " . $teacher->studentId . ": " . implode(", ", $teacherChanges);

            $logs = new Log();
            $logs->studentId = Auth::user()->studentId;
            $logs->type = "edit_teacher";
            $logs->activity = $activityMessage;
            $logs->save();
        }

        // Add New Address
        $address = Address::where('studentId', $teacherId)->first();
        $originalAddress = $teacher->replicate();
        $address->region = $request->input('region');
        $address->province = $request->input('province');
        $address->city = $request->input('city');
        $address->baranggay = $request->input('barangay');
        $address->address = $request->input('address');
        $address->save();

         // use for activity logs
         $addressFields = [
            'region',
            'province',
            'city', 
            'baranggay',
            'address',
        ];

        $addressChanges = MessageLogService::detectChanges($originalAddress, $address, $addressFields);

         // Log the changes (if any)
         if (!empty($addressChanges)) {
            $activityMessage = "Updated the teacher details of " . $teacher->studentId . ": " . implode(", ", $addressChanges);

            $logs = new Log();
            $logs->studentId = Auth::user()->studentId;
            $logs->type = "edit_teacher_address";
            $logs->activity = $activityMessage;
            $logs->save();
        }

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
