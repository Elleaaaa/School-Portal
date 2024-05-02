<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Admin;
use App\Models\Enrollee;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
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
    public function showDashboard(string $studentId)
    {
        $admin = User::find($studentId);
        return view('admin.dashboard', compact('admin'));
    }

    public function showStudentList()
    {
        $students = Student::all();
        $images = User::all();
        // $students = Student::where('userType', 'student')->get(); // filter by usertype
        return view('admin.student-list', compact('students', 'images'));
    }

    public function showTeacherList()
    {
        // $students = Student::where('userType', 'student')->get(); // filter by usertype
        $teachers = Teacher::all();
        $subjects = Subject::all();
        $addresses = Address::all();
        $images = User::all();
        return view('admin.teacher-list', compact('teachers', 'subjects', 'addresses', 'images'));
    }

    public function showSubjectList()
    {
        $subjects = Subject::all(); 
        return view('admin.subject-list', compact('subjects'));
    }

    public function showAddSubject()
    {
        $teachers = Teacher::all();
        return view('admin.add-subject', compact('teachers'));
    }

    public function showEditSubject()
    {
        return view('admin.edit-subject');
    }

    public function showEnrolledStudents()
    {
        $enrollees = Enrollee::where('status', 'Enrolled')->get();
        return view('admin.student-enrolled-list', compact('enrollees'));
    }

    public function showPendingStudents()
    {
        $enrollees = Enrollee::where('status', 'Pending')->get();
        return view('admin.student-pending-list', compact('enrollees'));
    }

    public function showProfile(string $adminId)
    {
        $user = User::where('studentId', $adminId)->first();
        $admin = DB::table('admins')->where('adminId', $adminId)->first();
        if ($admin === null) {
            abort(404); // or handle the case where student is not found
        }
        return view('admin.profile-details', compact('admin', 'user'));
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

         // Update Admin profile
         $admin = Admin::find($id);
         $adminPhoto = User::find($id);
         $adminId = $admin->adminId;
         if ($request->hasFile('displayPhoto')) {
            $file = $request->file('displayPhoto');
        
            // Generate a unique filename
            $filename = $file->hashName();
        
            // Move the uploaded file to a safe location
            $file->storeAs('public/images/display-photo', $filename);
        
            // Update the student's displayPhoto attribute with the filename
            $adminPhoto->displayPhoto = $filename;
        }
        
         $admin->firstName = $request->input('firstName');
         $admin->middleName = $request->input('middleName');
         $admin->lastName = $request->input('lastName');
         $admin->suffix = $request->input('suffixName');
         $admin->adminId = $request->input('studentId');
         $admin->gender = $request->input('gender');
         $admin->birthday = $request->input('birthday');
         $admin->age = $request->input('age');
         $admin->mobileNumber = $request->input('mobileNumber');
         $admin->landlineNumber = $request->input('landlineNumber');
         $admin->religion = $request->input('religion');
         $admin->placeOfBirth = $request->input('birthplace');
         $admin->save();
         $adminPhoto->save();
 
         // Add New Address
         $address = Address::where('studentId', $adminId)->first();
         $address->studentId = $request->input('studentId');
         $address->region = $request->input('region');
         $address->province = $request->input('province');
         $address->city = $request->input('city');
         $address->baranggay = $request->input('barangay');
         $address->address = $request->input('address');
         $address->save();
 
         return redirect()->route('profile-admin.show', ['adminId' => $adminId])->with('success', 'Student record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
