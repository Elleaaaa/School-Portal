<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Attendance;
use App\Models\Enrollee;
use App\Models\Fee;
use App\Models\SuperAdmin;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showDashboard(string $supAdminId)
    {
        $supAdmin = User::where('studentId', $supAdminId)->first();
        $enrolledCount = Enrollee::where('status', "Enrolled")->count();
        $teachersCount = Teacher::where('status', "active")->count();
        $pendingCount = Enrollee::where('status', "Pending")->count();

        $tuitionTotalPaidCount = Fee::where('feeType', 'Tuition Fee')
                            ->where('status', 'Fully Paid')
                            ->count();
        $tuitionTotalNotPaidCount = Fee::where('feeType', 'Tuition Fee')
                            ->where('status', 'Not Fully Paid')
                            ->distinct('studentId')
                            ->count();

        
        $currentYear = now()->year; // Get the current year
        $nextYear = now()->addYear()->year;

        $grade7 = Enrollee::where('gradelevel', "Grade 7")
                            ->where('status', "Enrolled")
                            ->where('schoolYear', $currentYear . "-" . $nextYear)
                            ->count();
        $grade8 = Enrollee::where('gradelevel', "Grade 8")
                            ->where('status', "Enrolled")
                            ->where('schoolYear', $currentYear . "-" . $nextYear)
                            ->count();
        $grade9 = Enrollee::where('gradelevel', "Grade 8")
                            ->where('status', "Enrolled")
                            ->where('schoolYear', $currentYear . "-" . $nextYear)
                            ->count();
        $grade10 = Enrollee::where('gradelevel', "Grade 8")
                            ->where('status', "Enrolled")
                            ->where('schoolYear', $currentYear . "-" . $nextYear)
                            ->count();
        $grade11 = Enrollee::where('gradelevel', "Grade 8")
                            ->where('status', "Enrolled")
                            ->where('schoolYear', $currentYear . "-" . $nextYear)
                            ->count();
        $grade12 = Enrollee::where('gradelevel', "Grade 8")
                            ->where('status', "Enrolled")
                            ->where('schoolYear', $currentYear . "-" . $nextYear)
                            ->count();

        $absentToday = Attendance::where('date', date('Y-m-d'))
                            ->where('status', 0)
                            ->count();
   
        $presentToday = Attendance::where('date', date('Y-m-d'))
                                ->where('status', 1)
                                ->count();

        return view('superadmin.dashboard', compact('supAdmin', 'enrolledCount', 'teachersCount', 'tuitionTotalPaidCount', 'tuitionTotalNotPaidCount', 'pendingCount', 'grade7', 'grade8', 'grade9', 'grade10', 'grade11', 'grade12', 'absentToday', 'presentToday'));
    }

    
    public function showProfile(string $supAdminId)
    {
        $user = User::where('studentId', $supAdminId)->first();
        $supAdmin = SuperAdmin::where('supAdminId', $supAdminId)->first();

        return view('superadmin.profile-details', compact('supAdmin', 'user'));
    }

    public function update(Request $request, string $supAdminId)
    {
         // Add New Student
         // $student = new Student();

         // Update Admin profile
         $superAdmin = SuperAdmin::where('supAdminId', $supAdminId)->first();
         $superAdminPhoto = User::where('studentId', $supAdminId)->first();
         $superAdminId = $superAdmin->supAdminId;
         if ($request->hasFile('displayPhoto')) {
            $file = $request->file('displayPhoto');
        
            // Generate a unique filename
            $filename = $file->hashName();
        
            // Move the uploaded file to a safe location
            $file->storeAs('public/images/display-photo', $filename);
        
            // Update the student's displayPhoto attribute with the filename
            $superAdminPhoto->displayPhoto = $filename;
        }
        
         $superAdmin->firstName = $request->input('firstName');
         $superAdmin->middleName = $request->input('middleName');
         $superAdmin->lastName = $request->input('lastName');
         $superAdmin->suffix = $request->input('suffixName');
         $superAdmin->supAdminId = $request->input('studentId');
         $superAdmin->gender = $request->input('gender');
         $superAdmin->birthday = $request->input('birthday');
         $superAdmin->age = $request->input('age');
         $superAdmin->mobileNumber = $request->input('mobileNumber');
         $superAdmin->landlineNumber = $request->input('landlineNumber');
         $superAdmin->religion = $request->input('religion');
         $superAdmin->placeOfBirth = $request->input('birthplace');
         $superAdmin->save();
         $superAdminPhoto->save();
 
         // Add New Address
         $address = Address::where('studentId', $supAdminId)->first();
         $address->studentId = $request->input('studentId');
         $address->region = $request->input('region');
         $address->province = $request->input('province');
         $address->city = $request->input('city');
         $address->baranggay = $request->input('barangay');
         $address->address = $request->input('address');
         $address->save();

         notify()->success('Record Updated Successfully!');
         return redirect()->route('profile-superadmin.show', ['supAdminId' => $superAdminId]);
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
