<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use App\Models\Discount;
use App\Models\Enrollee;
use App\Models\Fee;
use App\Models\FeeList;
use App\Models\Student;
use App\Models\Notification;
use App\Models\Scholar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $studentId = $request->input('studentId');
        $students = Student::where('studentId', $studentId)->first();

        $cashierId = Auth::user()->studentId;

        $cashiers = Cashier::where('cashierId', $cashierId)->first();

        $feeLists = FeeList::where('status', 'active')->get();

        $feeHistory = Fee::where('studentId', $cashierId)->get();
        return view('cashier.add-fees', compact('students', 'cashiers', 'feeLists', 'feeHistory'));
    }

    public function getDiscount(Request $request)
    {
        $studentId = $request->get('studentId');

        // Find the scholar
        $scholar = Scholar::where('studentId', $studentId)->first();

        // Initialize the discount amount and percentage
        $discountAmount = 0;
        $discountPercentage = 0;

        // Check if scholar exists
        if ($scholar) {
            // Find the discount based on scholarType
            $discount = Discount::where('discountType', $scholar->scholarType)->first(['amount', 'percentage']);

            if ($discount) {
                // Check if amount or percentage is present
                $discountAmount = $discount->amount ?? 0;
                $discountPercentage = $discount->percentage ?? 0;
            }
        }

        // Return both the discount percentage and amount
        return response()->json([
            'discountAmount' => $discountAmount,
            'discountPercentage' => $discountPercentage
        ]);
    }



    public function paymentHistory()
    {
        $studentId = Auth::user()->studentId;
        $feeHistory = Fee::where('studentId', $studentId)->orderByDesc('created_at')->get();
        return view('student.payments-history', compact('feeHistory'));
    }

    public function paymentHistoryAdmin()
    {
        $feeHistory = Fee::all();
        return view('student.payments-history', compact('feeHistory'));
    }

    // use to fetch student details to populate input fields in payment
    public function fetchStudentDetails(Request $request)
    {
        $studentId = $request->input('studentId');
        $student = Student::where('studentId', $studentId)->first();

        if ($student) {
            return response()->json($student);
        } else {
            return response()->json(['error' => 'Student not found'], 404);
        }
    }

    public function fetchStudentGlevel(Request $request)
    {
        $studentId = $request->input('studentId');
        $student = Enrollee::where('studentId', $studentId)->first();

        if ($student) {
            return response()->json($student);
        } else {
            return response()->json(['error' => 'Student not found'], 404);
        }
    }


    public static function generateFeeId()
    {
        $timestamp = time();
        $random = mt_rand(100000, 999999);
        $feeId = $timestamp . "-" . $random;
        return $feeId;
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {

    //     $studentId = $request->input('studentId');
    //     $lastPayment = Fee::where('studentId', $studentId)->latest()->first();

    //     $feeid = null;

    //     // If there's a last payment, retrieve its associated fee type
    //     if ($lastPayment) {
    //         $feeid = $lastPayment->feeId;
    //     }

    //     $discountedPrice = $request->input('discountedPrice');
    //     $amountPaid = $request->input('amountPaid');

    //     // Retrieve all payment records for the specific student
    //     $paymentRecords = Fee::where('studentId', $studentId)->get();

    //     // Initialize the variable to store the total of previous amounts paid
    //     $addedPreviousPaid = 0;

    //     // Loop through each payment record and accumulate the amount paid
    //     foreach ($paymentRecords as $paymentRecord) {
    //         $addedPreviousPaid += $paymentRecord->amountPaid;
    //     }

    //     $newAddedPaid = $addedPreviousPaid + $amountPaid;

    //     // Calculate the remaining amount after deducting the previous amount paid
    //     $amountLeft = $discountedPrice - $newAddedPaid;


    //     // Set status
    //     if ($amountLeft == 0) {
    //         $status = "Fully Paid";
    //     } else {
    //         $status = "Not Fully Paid";
    //     }


    //     // Add New Fee
    //     $fee = new Fee();

    //     $fee->feeId = self::generateFeeId();
    //     $fee->feeReceiptId = self::generateFeeId();
    //     $fee->studentId =  $request->input('studentId');
    //     $fee->firstName = $request->input('firstName');
    //     $fee->middleName = $request->input('middleName');
    //     $fee->lastName = $request->input('lastName');
    //     $fee->suffixName = $request->input('suffixName');
    //     $fee->feeType = $request->input('feeType');
    //     $fee->amount = $request->input('amount');
    //     $fee->amountPaid = $request->input('amountPaid');
    //     $fee->discount = $request->input('discount');
    //     $fee->discountAmount = $request->input('discountAmount');
    //     $fee->discountedPrice = $request->input('discountedPrice');
    //     $fee->reciever = $request->input('reciever');
    //     $fee->status = $status;
    //     $fee->amountLeft = $amountLeft;
    //     $fee->save();

    //     $notif = new Notification();
    //     $notif->userId = $request->input('studentId');
    //     $notif->title = "Payment Successful!";
    //     $notif->message = "You paid an Amount of ". number_format(($amountPaid),2). " Your Remaining Balance is ". number_format(($amountLeft),2). " recieved by: ". $request->input('reciever');
    //     $notif->type = "tuition payment";
    //     $notif->userRole = "student";
    //     $notif->save();

    //     notify()->success('Paid Successfully!');
    //     return redirect()->route('addfees.show');
    // }

    // public function store(Request $request)
    // {

    //     $studentId = $request->input('studentId');
    //     $lastPayment = Fee::where('studentId', $studentId)->latest()->first();

    //     $feeid = null;

    //     // If there's a last payment, retrieve its associated fee type
    //     if ($lastPayment) {
    //         $feeid = $lastPayment->feeId;
    //     }

    //     $discountedPrice = $request->input('discountedPrice');
    //     $amountPaid = $request->input('amountPaid');

    //     // Retrieve all payment records for the specific student
    //     $paymentRecords = Fee::where('studentId', $studentId)->get();

    //     // Initialize the variable to store the total of previous amounts paid
    //     $addedPreviousPaid = 0;

    //     // Loop through each payment record and accumulate the amount paid
    //     foreach ($paymentRecords as $paymentRecord) {
    //         $addedPreviousPaid += $paymentRecord->amountPaid;
    //     }

    //     $newAddedPaid = $addedPreviousPaid + $amountPaid;

    //     // Calculate the remaining amount after deducting the previous amount paid
    //     $amountLeft = $discountedPrice - $newAddedPaid;


    //     // Set status
    //     if ($amountLeft == 0) {
    //         $status = "Fully Paid";
    //     } else {
    //         $status = "Not Fully Paid";
    //     }


    //     // Add New Fee
    //     $fee = new Fee();

    //     $fee->feeId = self::generateFeeId();
    //     $fee->feeReceiptId = self::generateFeeId();
    //     $fee->studentId =  $request->input('studentId');
    //     $fee->firstName = $request->input('firstName');
    //     $fee->middleName = $request->input('middleName');
    //     $fee->lastName = $request->input('lastName');
    //     $fee->suffixName = $request->input('suffixName');
    //     $fee->feeType = $request->input('feeType');
    //     $fee->amount = $request->input('amount');
    //     $fee->amountPaid = $request->input('amountPaid');
    //     $fee->discount = $request->input('discount');
    //     $fee->discountAmount = $request->input('discountAmount');
    //     $fee->discountedPrice = $request->input('discountedPrice');
    //     $fee->reciever = $request->input('reciever');
    //     $fee->status = $status;
    //     $fee->amountLeft = $amountLeft;
    //     $fee->save();

    //     $notif = new Notification();
    //     $notif->userId = $request->input('studentId');
    //     $notif->title = "Payment Successful!";
    //     $notif->message = "You paid an Amount of " . number_format(($amountPaid), 2) . " Your Remaining Balance is " . number_format(($amountLeft), 2) . " recieved by: " . $request->input('reciever');
    //     $notif->type = "tuition payment";
    //     $notif->userRole = "student";
    //     $notif->save();

    //     notify()->success('Paid Successfully!');
    //     return redirect()->route('addfees.show');
    // }

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

        // Check if the total payments exceed the amount to be paid
        if ($amountLeft <= 0) {
            notify()->error('Payment exceeds the amount due. Please check your payment details!');
        } else {
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
            $notif->message = "You paid an Amount of " . number_format(($amountPaid), 2) . " Your Remaining Balance is " . number_format(($amountLeft), 2) . " recieved by: " . $request->input('reciever');
            $notif->type = "tuition payment";
            $notif->userRole = "student";
            $notif->save();

            notify()->success('Paid Successfully!');
        }

        return redirect()->route('addfees.show');
    }

    public function getPaymentsAJAX()
    {
        $studentId = Auth::user()->studentId;
        $startOfYear = now()->startOfYear()->toDateString();
        $endOfYear = now()->endOfYear()->toDateString();

        // Fetch payments data
        $paymentsData = Fee::where('studentId', $studentId)
            ->whereBetween('created_at', [$startOfYear, $endOfYear])
            ->get(['created_at', 'amountPaid', 'amountLeft']);

        // Group payments by month
        $monthlyData = $paymentsData->groupBy(function ($payment) {
            return \Carbon\Carbon::parse($payment->created_at)->format('Y-m'); // Group by year-month
        })->map(function ($month) {
            return [
                'amountPaid' => $month->sum('amountPaid'), // Sum amountsPaid for each month
                'amountLeft' => $month->last()->amountLeft  // Sum amountsLeft for each month
            ];
        });

        // Generate month labels for the year
        $months = [];
        $amountPaidData = [];
        $amountLeftData = [];
        $date = \Carbon\Carbon::parse($startOfYear)->startOfMonth();
        while ($date->lte($endOfYear)) {
            $monthKey = $date->format('Y-m');
            $months[] = $date->format('M Y'); // Label format
            $amountPaidData[] = $monthlyData->has($monthKey) ? $monthlyData[$monthKey]['amountPaid'] : 0;
            $amountLeftData[] = $monthlyData->has($monthKey) ? $monthlyData[$monthKey]['amountLeft'] : 0;
            $date->addMonth();
        }

        // Return JSON response
        return response()->json([
            'months' => $months,
            'amountPaid' => $amountPaidData,
            'amountLeft' => $amountLeftData
        ]);
    }

    public function getAllPaymentsAJAX()
    {
        $startOfYear = now()->startOfYear()->toDateString();
        $endOfYear = now()->endOfYear()->toDateString();

        // Fetch payments data
        $paymentsData = Fee::whereBetween('created_at', [$startOfYear, $endOfYear])
            ->get(['created_at', 'amountPaid', 'amountLeft']);

        // Group by year-month and sum amountPaid for each month
        $monthlyData = $paymentsData->groupBy(function ($payment) {
            return \Carbon\Carbon::parse($payment->created_at)->format('Y-m'); // Group by year-month
        })->map(function ($month) {
            return [
                'amountPaid' => $month->sum('amountPaid'), // Sum amountsPaid for each month
            ];
        });

        // Generate month labels for the year
        $months = [];
        $amountPaidData = [];
        $amountLeftData = [];
        $date = \Carbon\Carbon::parse($startOfYear)->startOfMonth();
        while ($date->lte($endOfYear)) {
            $monthKey = $date->format('Y-m');
            $months[] = $date->format('M Y'); // Label format
            $amountPaidData[] = $monthlyData->has($monthKey) ? $monthlyData[$monthKey]['amountPaid'] : 0;
            $date->addMonth();
        }

        // Return JSON response
        return response()->json([
            'months' => $months,
            'amountPaid' => $amountPaidData,
        ]);
    }

    public function getAmountFeeAJAX(Request $request)
    {
        $feeName = $request->input('feeName');
        $gradeLevel = $request->input('gradeLevel');
        $classType = $request->input('classType');

        // Retrieve the fee based on the fee name, grade level, and class type
        $fee = FeeList::where('feeName', $feeName)
            ->where('gradeLevel', $gradeLevel)
            ->where('classType', $classType)
            ->first();

        if ($fee) {
            return response()->json(['amount' => $fee->amount]);
        }

        return response()->json(['amount' => 0]); // or handle accordingly
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
