<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cashier;
use App\Models\Fee;
use App\Models\Teacher;
use App\Models\Enrollee;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\User;

class CashierController extends Controller
{
    public function showDashboard(string $cashierId)
    {
        $cashier = User::where('studentId', $cashierId)->first();
        $enrolledCount = Enrollee::where('status', "Enrolled")->count();
        $teachersCount = Teacher::where('status', "active")->count();
        $tuitionTotalPaidCount = Fee::where('feeType', 'Tuition Fee')
                            ->where('status', 'Fully Paid')
                            ->count();
        $tuitionTotalNotPaidCount = Fee::where('feeType', 'Tuition Fee')
                            ->where('status', 'Not Fully Paid')
                            ->distinct('studentId')
                            ->count();

        return view('cashier.dashboard', compact('cashier', 'enrolledCount', 'teachersCount', 'tuitionTotalPaidCount', 'tuitionTotalNotPaidCount'));
    }

    public function showProfile(string $cashierId)
    {
        $user = User::where('studentId', $cashierId)->first();
        $cashier = Cashier::where('cashierId', $cashierId)->first();

        return view('cashier.profile-details', compact('cashier', 'user'));
    }

    public function update(Request $request, string $cashierId)
    {

         // Update Cashier profile
         $cashier = Cashier::where('cashierId', $cashierId)->first();
         $cashierPhoto = User::where('studentId', $cashierId)->first();
         $cashierId = $cashier->cashierId;
         if ($request->hasFile('displayPhoto')) {
            $file = $request->file('displayPhoto');
        
            // Generate a unique filename
            $filename = $file->hashName();
        
            // Move the uploaded file to a safe location
            $file->storeAs('public/images/display-photo', $filename);
        
            // Update the student's displayPhoto attribute with the filename
            $cashierPhoto->displayPhoto = $filename;
        }
        
         $cashier->firstName = $request->input('firstName');
         $cashier->middleName = $request->input('middleName');
         $cashier->lastName = $request->input('lastName');
         $cashier->suffix = $request->input('suffixName');
         $cashier->cashierId = $request->input('studentId');
         $cashier->gender = $request->input('gender');
         $cashier->birthday = $request->input('birthday');
         $cashier->age = $request->input('age');
         $cashier->mobileNumber = $request->input('mobileNumber');
         $cashier->landlineNumber = $request->input('landlineNumber');
         $cashier->religion = $request->input('religion');
         $cashier->placeOfBirth = $request->input('birthplace');
         $cashier->save();
         $cashierPhoto->save();
 
         // Add New Address
         $address = Address::where('studentId', $cashierId)->first();
         $address->studentId = $request->input('studentId');
         $address->region = $request->input('region');
         $address->province = $request->input('province');
         $address->city = $request->input('city');
         $address->baranggay = $request->input('barangay');
         $address->address = $request->input('address');
         $address->save();

         notify()->success('Record Updated Successfully!');
         return redirect()->route('profile-cashier.show', ['cashierId' => $cashierId]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
