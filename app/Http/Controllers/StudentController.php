<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Guardian;
use App\Models\LastSchool;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

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
        $address->baranggay = $request->input('baranggay');
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
            'studentId' => ['required', 'string', 'max:255', 'unique:students'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

         // Create a new user
         $user = new User();
         $user->studentId = $validatedData['studentId'];
         $user->email = $validatedData['email'];
         $user->password = Hash::make($validatedData['password']);
         $user->usertype = 'student';

         if($password == $repeatPassword){
            $student->save();
            $address->save();
            $guardian->save();
            $lastSchool->save();
            $user->save();
        } else {
            return redirect()->route('addstudent.show')->with('failed', 'Passwords do not match');
        }

        return redirect()->route('addstudent.show')->with('success', 'Student Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function showProfile(string $studentId)
    {

        $student = DB::table('students')->where('studentId', $studentId)->first();
        if ($student === null) {
            abort(404); // or handle the case where student is not found
        }

        $address = DB::table('addresses')->where('studentId', $studentId)->first();
        $guardians = DB::table('guardians')->where('studentId', $studentId)->first();

        return view('student.profile-details', compact('student', 'address', 'guardians')); // compact('student') student will be the variable that can access in blade file same for address and guardians

    }

    public function showDashboard(string $studentId)
    {
        $student = Student::find($studentId);
        return view('student.dashboard', compact('student'));
    }

    public function showSubjectList(string $studentId)
    {

        $student = Student::find($studentId);

        return view('student.subject-list', compact('student'));
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

        if ($request->hasFile('displayPhoto')) {
            $file = $request->file('displayPhoto');

            // Generate a unique filename
            $filename = $file->hashName();

            // Move the uploaded file to a safe location
            $file->storeAs('public/images/display-photo', $filename);

            // Update the student's displayPhoto attribute with the filename
            $student->displayPhoto = $filename;
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

        // Add New Address
        $address = Address::where('studentId', $studentId)->first();
        $address->studentId = $request->input('studentId');
        $address->region = $request->input('region');
        $address->province = $request->input('province');
        $address->city = $request->input('city');
        $address->baranggay = $request->input('barangay');
        $address->address = $request->input('address');
        $address->save();

        // Add New Guardian
        $guardian = Guardian::where('studentId', $studentId)->first();
        $guardian->studentId = $request->input('studentId');
        $guardian->mothersFirstName = $request->input('mothersFirstName');
        $guardian->mothersLastName = $request->input('mothersLastName');
        $guardian->motherAge = $request->input('motherAge');
        $guardian->motherOccupation = $request->input('motherOccupation');
        $guardian->motherContact = $request->input('motherContact');
        $guardian->motherAnnualGrossIncome = $request->input('motherAnnualGrossIncome');

        $guardian->fathersFirstName = $request->input('fathersFirstName');
        $guardian->fathersLastName = $request->input('fathersLastName');
        $guardian->fathersSuffix = $request->input('fathersSuffix');
        $guardian->fatherAge = $request->input('fatherAge');
        $guardian->fatherOccupation = $request->input('fatherOccupation');
        $guardian->fatherContact = $request->input('fatherContact');
        $guardian->fatherAnnualGrossIncome = $request->input('fatherAnnualGrossIncome');
        $guardian->save();

        return redirect()->route('profile-details.show', ['studentId' => $studentId])->with('success', 'Student record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
