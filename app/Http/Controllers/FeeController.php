<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Fee;
use App\Models\FeeList;
use App\Models\Student;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;


class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $studentId = $request->input('studentId');
        $students = Student::where('studentId', $studentId)->first();

        $adminId = Auth::user()->studentId;
        //$admins = DB::table('admins')->where('adminId', $adminId)->first(); // you can use this 
        $admins = Admin::where('adminId', $adminId)->first();                 // or this to get admin details

        $feeLists = FeeList::where('status', 'active')->get();

        $feeHistory = Fee::where('studentId', $adminId)->get();
        return view('admin.add-fees', compact('students', 'admins', 'feeLists', 'feeHistory'));
    }

    public function paymentHistory(){
        $studentId = Auth::user()->studentId;
        $feeHistory = Fee::where('studentId', $studentId)->orderByDesc('created_at')->get();
        return view('student.payments-history', compact('feeHistory'));
    }

    public function paymentHistoryAdmin(){
        $feeHistory = Fee::all();
        return view('student.payments-history', compact('feeHistory'));
    }

    // use to fetch student details to populate input fields in payment
    public function fetchStudentDetails(Request $request) {
        $studentId = $request->input('studentId');
        $student = Student::where('studentId', $studentId)->first();
        
        if ($student) {
            return response()->json($student);
        } else {
            return response()->json(['error' => 'Student not found'], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public static function generateFeeId() {
        $timestamp = time();
        $random = mt_rand(100000, 999999);
        $feeId = $timestamp . "-" .$random;
        return $feeId;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $studentId = $request->input('studentId');
        $lastPayment = Fee::where('studentId', $studentId)->latest()->first();

        $feeid = null;

        // If there's a last payment, retrieve its associated fee type
        if ($lastPayment) {
            $feeid = $lastPayment->feeId;
        }

        $discountedPrice = $request->input('discountedPrice');
        $amountPaid = $request->input('amountPaid');

        // Retrieve all payment records for the specific student
        $paymentRecords = Fee::where('studentId', $studentId)->get();

        // Initialize the variable to store the total of previous amounts paid
        $addedPreviousPaid = 0;

        // Loop through each payment record and accumulate the amount paid
        foreach ($paymentRecords as $paymentRecord) {
            $addedPreviousPaid += $paymentRecord->amountPaid;
        }

        $newAddedPaid = $addedPreviousPaid + $amountPaid;

        // Calculate the remaining amount after deducting the previous amount paid
        $amountLeft = $discountedPrice - $newAddedPaid;


        // Set status
        if ($amountLeft == 0) {
            $status = "Fully Paid";
        } else {
            $status = "Not Fully Paid";
        }

        
        // Add New Fee
        $fee = new Fee();

        $fee->feeId = self::generateFeeId();
        $fee->feeReceiptId = self::generateFeeId();
        $fee->studentId =  $request->input('studentId');
        $fee->firstName = $request->input('firstName');
        $fee->middleName = $request->input('middleName');
        $fee->lastName = $request->input('lastName');
        $fee->suffixName = $request->input('suffixName');
        $fee->feeType = $request->input('feeType');
        $fee->amount = $request->input('amount');
        $fee->amountPaid = $request->input('amountPaid');
        $fee->discount = $request->input('discount');
        $fee->discountAmount = $request->input('discountAmount');
        $fee->discountedPrice = $request->input('discountedPrice');
        $fee->reciever = $request->input('reciever');
        $fee->status = $status;
        $fee->amountLeft = $amountLeft;
        $fee->save();

        $notif = new Notification();
        $notif->userId = $request->input('studentId');
        $notif->title = "Payment Successful!";
        $notif->message = "You paid an Amount of ". $amountPaid. " Your Remaining Balance is ". $amountLeft. " recieved by: ". $request->input('reciever');
        $notif->type = "tuition payment";
        $notif->userRole = "student";
        $notif->save();

        notify()->success('Paid Successfully!');
        return redirect()->route('addfees.show');
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
