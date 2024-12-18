<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use App\Models\Discount;
use App\Models\Enrollee;
use App\Models\Fee;
use App\Models\FeeList;
use App\Models\Log;
use App\Models\Student;
use App\Models\Notification;
use App\Models\Scholar;
use Barryvdh\DomPDF\Facade\Pdf;
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



    // payment history in student tab
    public function paymentHistory()
    {
        $studentId = Auth::user()->studentId;
        $feeHistory = Fee::where('studentId', $studentId)->orderByDesc('created_at')->get();

        $totalAmount = $feeHistory->sum('amountPaid');
        $tuitionFee = $feeHistory->where('schoolYear', date('Y') . '-' . (date('Y') + 1))
            ->where('feeType', "Tuition Fee")
            ->where('studentId', $studentId)
            ->first();
        $tuitionAmount = $tuitionFee ? $tuitionFee->discountedPrice : 0;


        return view('student.payments-history', compact('feeHistory', 'totalAmount', 'tuitionAmount'));
    }

    public function paymentHistoryAdmin()
    {
        // Get the most recent payment for each student
        $feeHistory = Fee::whereIn('studentId', Fee::pluck('studentId')->toArray())
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('studentId')
            ->map(function ($payments) {
                return $payments->first(); // Get the most recent payment for each student
            });

        // Get the section for each student
        $studentsWithSections = $feeHistory->map(function ($payment) {
            $studentId = $payment->studentId; // Get the studentId of each payment
            $section = Enrollee::where('studentId', $studentId)->first(); // Get the section for each student
            return [
                'payment' => $payment,
                'section' => $section ? $section->section : null, // Get the section name (or null if not found)
            ];
        });

        return view('cashier.payments-history', compact('feeHistory', 'studentsWithSections'));
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
            $fee->feeReceiptId =  $request->input('receiptId');
            $fee->studentId =  $request->input('studentId');
            $fee->firstName = $request->input('firstName');
            $fee->middleName = $request->input('middleName');
            $fee->lastName = $request->input('lastName');
            $fee->suffixName = $request->input('suffixName');
            $fee->schoolYear = date('Y') . '-' . (date('Y') + 1);
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

            // to save logs
            $fullname = $fee->firstName . ' ' . $fee->middleName . ' ' . $fee->lastName . ' ' . $fee->suffixName;
            $logs = new Log();
            $logs->studentId = Auth::user()->studentId;
            $logs->type = "payment";
            $logs->activity = $fullname . " paid an Amount of " . number_format(($amountPaid), 2) . " recieved by: " . $request->input('reciever');
            $logs->save();

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



    public function studentPaymentHistory(String $studentId)
    {
        $cashierId = Auth::user()->studentId;
        $student = Student::where('studentId', $studentId)->first();
        $studentName = $student->firstName . ' ' . $student->middleName . ' ' . $student->lastName . ' ' . $student->suffixName;
    
        $enrollee = Enrollee::where('studentId', $studentId)->first();
        $gradeLevel = $enrollee ? $enrollee->gradeLevel : null;
        $section = $enrollee ? $enrollee->section : null;

        $scholar = Scholar::where('studentId', $studentId)->first();
        $scholarType = $scholar ? $scholar->scholarType : "N/A";

        $payments = Fee::where('studentId', $studentId)->orderBy('created_at', 'asc')->get();

        $cashier = Cashier::where('cashierId', $cashierId)->first();

        if (!$student) {
            return response()->json(['error' => 'Student not found'], 404);
        } else {

            $data = [
                'studentName' => $studentName,
                'studentId' => $studentId,
                'gradeLevel' => $gradeLevel,
                'section' => $section,
                'scholarType' => $scholarType,
                'payments' => $payments,
                'cashier' => $cashier,
                'imagelogo1' => public_path('img/logo/sanpablologo.png'),
                'imagelogo2' => public_path('img/logo/baylogo.png')
            ];
            
            $pdf = PDF::loadView('cashier.student-payment-history', $data);
            return $pdf->setPaper('A4', 'portrait')->stream('student-payment-history.pdf');
        }
    }
    
}
