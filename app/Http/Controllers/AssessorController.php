<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Assessor;
use App\Models\Discount;
use App\Models\Scholar;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class AssessorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showDashboard()
    {
        return view('assessor.dashboard');
    }

    public function showProfile(string $assessorId)
    {
        $user = User::where('studentId', $assessorId)->first();
        $assessor = Assessor::where('assessorId', $assessorId)->first();

        return view('assessor.profile-details', compact('assessor', 'user'));
    }

    public function update(Request $request, string $id)
    {
        // Add New Student
        // $student = new Student();

        // Update Assessor profile
        $assessor = Assessor::find($id);
        $adminPhoto = User::find($id);
        $assessorId = $assessor->assessorId; //change
        if ($request->hasFile('displayPhoto')) {
            $file = $request->file('displayPhoto');

            // Generate a unique filename
            $filename = $file->hashName();

            // Move the uploaded file to a safe location
            $file->storeAs('public/images/display-photo', $filename);

            // Update the student's displayPhoto attribute with the filename
            $adminPhoto->displayPhoto = $filename;
        }

        $assessor->firstName = $request->input('firstName');
        $assessor->middleName = $request->input('middleName');
        $assessor->lastName = $request->input('lastName');
        $assessor->suffix = $request->input('suffixName');
        $assessor->adminId = $request->input('studentId');
        $assessor->gender = $request->input('gender');
        $assessor->birthday = $request->input('birthday');
        $assessor->age = $request->input('age');
        $assessor->mobileNumber = $request->input('mobileNumber');
        $assessor->landlineNumber = $request->input('landlineNumber');
        $assessor->religion = $request->input('religion');
        $assessor->placeOfBirth = $request->input('birthplace');
        $assessor->save();
        $adminPhoto->save();

        // Add New Address
        $address = Address::where('studentId', $assessorId)->first();
        $address->studentId = $request->input('studentId');
        $address->region = $request->input('region');
        $address->province = $request->input('province');
        $address->city = $request->input('city');
        $address->baranggay = $request->input('barangay');
        $address->address = $request->input('address');
        $address->save();

        notify()->success('Profile Updated Successfully!');
        return redirect()->route('profile-assessor.show', ['assessorId' => $assessorId]);
    }


    public function showAddDiscount()
    {
        return view('assessor.addDiscount');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addDiscount(Request $request)
    {
        $discount = new Discount();

        $discount->discountType = trim($request->input('discountType'));
        $discount->percentage = $request->input('percentage');
        $discount->amount = $request->input('amount');
        $discount->status = $request->input('status');
        $discount->save();

        notify()->success('Discount Added Successfully!');
        return redirect()->back();
    }

    public function showUpdateDiscount(string $id)
    {
        $discount = Discount::find($id);
        return view('assessor.editDiscount', compact('discount'));
    }

    public function updateDiscount(Request $request, string $id)
    {
        $discount = Discount::find($id);

        $discount->discountType = trim($request->input('discountType'));
        $discount->percentage = $request->input('percentage');
        $discount->amount = $request->input('amount');
        $discount->status = $request->input('status');

        $discount->save();

        notify()->success('Discount Updated Successfully!');
        return redirect()->back();
    }

    public function showDiscountList()
    {
        $discounts = Discount::all();
        return view('assessor.discount-list', compact('discounts'));
    }

    public function toggleStatus($id)
    {
        $feeList = Discount::findOrFail($id);

        // Toggle the status
        $feeList->status = $feeList->status === 'active' ? 'inactive' : 'active';

        // Save the changes
        $feeList->save();

        return response()->json(['status' => $feeList->status]);
    }

    public function showScholars()
    {
        $scholars = Scholar::where('status', 'active')->get();

        return view('assessor.scholar-list', compact('scholars'));
    }

    public function showAddScholar(Request $request)
    {
        return view('assessor.addScholar');
    }

    public function addScholar(Request $request)
    {
        $studentId = $request->input('studentId');
        $fname = $request->input('firstName');
        $mname = $request->input('middleName');
        $lname = $request->input('lastName');
        $suffix = $request->input('suffixName');
        $name = $fname . " " . $mname . " " . $lname . " " . $suffix;
        $scholarType = $request->input('scholarType');
        $scholarDiscount = $request->input('scholarDiscount');
        $scholarStatus = $request->input('status');

        $student = Student::where('studentId', $studentId)->first();
        $user = User::where('studentId', $studentId)->first();

        $scholar = new Scholar();
        $scholar->studentId = $studentId;
        $scholar->name = $name;
        $scholar->scholarType = $scholarType;
        $scholar->discount = $scholarDiscount;
        $scholar->mobileNumber = $student->mobileNumber ?? '';
        $scholar->email = $user->email ?? '';
        $scholar->status = $scholarStatus;
        $scholar->save();

        notify()->success('Scholar Added Successfully!');
        return view('assessor.addScholar');
    }

    public function fetchDiscountType() {
        $discountType = Discount::where('status', 'active')->pluck('discountType');
        
        if ($discountType->isNotEmpty()) {
            return response()->json($discountType);
        } else {
            return response()->json(['error' => 'No scholar types found'], 404);
        }
    }
    
    public function getDiscountByType($scholarType) {
        // Use rawurldecode to decode any URL encoded characters in the scholarType
        $scholarType = rawurldecode($scholarType);
    
        // Fetch discount based on scholar type
        $discount = Discount::where('discountType', $scholarType)->first(['amount', 'percentage']);
    
        if ($discount) {
            return response()->json($discount);
        } else {
            return response()->json(['error' => 'No discount found for the selected scholar type'], 404);
        }
    }
    
    
}
