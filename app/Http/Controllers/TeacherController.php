<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $address->baranggay = $request->input('baranggay');
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
 
        if($password == $repeatPassword){
            $teacher->save();
            $address->save();
            $user->save();
        } else {
            return redirect()->route('addteacher.show')->with('failed', 'Passwords do not match');
        }

        return redirect()->route('addteacher.show')->with('success', 'Teacher Added Successfully');
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
        $teacher = DB::table('teachers')->where('teacherId', $teacherId)->first();
        if ($teacher === null) {
            abort(404); // or handle the case where student is not found
        }
        return view('teacher.profile-details', compact('teacher'));
    }

    public function showDashboard(string $teacherId)
    {
        $teacher = Teacher::find($teacherId);
        return view('teacher.dashboard', compact('teacher'));
    }

    public function showEditTeacher( string $id)
    {
        $teacher = Teacher::find($id);
        $teacherId = $teacher->teacherId;

        $address = Address::where('studentId', $teacherId)->first();
        // dd($address);
        return view('admin.edit-teacher', compact('teacher', 'address'));
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
         $teacher = Teacher::find($id);
         $teacherId = $teacher->teacherId;

         if ($request->hasFile('displayPhoto')) {
            $file = $request->file('displayPhoto');
        
            // Generate a unique filename
            $filename = $file->hashName();
        
            // Move the uploaded file to a safe location
            $file->storeAs('public/images/display-photo', $filename);
        
            // Update the student's displayPhoto attribute with the filename
            $teacher->displayPhoto = $filename;
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

         // Add New Address
         $address = Address::where('studentId', $teacherId)->first();
         $address->studentId = $request->input('studentId'); // studentId is use because its in Address table
         $address->region = $request->input('region');
         $address->province = $request->input('province');
         $address->city = $request->input('city');
         $address->baranggay = $request->input('barangay');
         $address->address = $request->input('address');
         $address->save();
 
         return redirect()->route('profile-teacher.show', ['teacherId' => $teacherId])->with('success', 'Student record updated successfully');
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
        
         return redirect()->route('edit-teacher.show', ['id' => $id])->with('success', 'Teacher record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
