<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FormController extends Controller
{

    // fill up form for COR
    public function requestCOR()
    {        
        return view('forms.correquest');
    }

    // show the printed COR
    public function printCOR(Request $request)
    {
        $fname = $request->input('firstName');
        $mname = $request->input('middleName');
        $lname = $request->input('lastName');
        $suffix = $request->input('suffixName');
        $name = $fname . " " . $mname . " " . $lname . " " . $suffix;

        $purpose = $request->input('purpose');

        $grade = $request->input('grade');
        $strand = $request->input('strand');

        $date = Carbon::now()->format('F j, Y');
        $schoolyear = Carbon::now()->format('Y') . '-' . Carbon::now()->addYear()->format('Y');

        $data = ['name' => trim($name),
        'grade' => $grade,
        'strand' => $strand,
        'date' => $date,
        'schoolyear' => $schoolyear,
        'purpose' => $purpose,
        'imagelogo1' => public_path('img/logo/sanpablologo.png'),
        'imagelogo2' => public_path('img/logo/baylogo.png')
        ];
       
        $pdf = PDF::loadView('forms.cor', $data);
        
        // Download PDF with A4 size
        return $pdf->setPaper('A4', 'portrait')->stream('certificate_of_registration.pdf');
    }

     // fill up form for Good Moral
    public function requestGoodMoral()
    {        
        return view('forms.goodmoralrequest');
    }

    public function printGoodMoral(Request $request)
    {
        $fname = $request->input('firstName');
        $mname = $request->input('middleName');
        $lname = $request->input('lastName');
        $suffix = $request->input('suffixName');
        $name = $fname . " " . $mname . " " . $lname . " " . $suffix;

        $grade = $request->input('grade');
        $strand = $request->input('strand');

        $date = Carbon::now()->format('F j, Y');
        $schoolyear = Carbon::now()->format('Y') . '-' . Carbon::now()->addYear()->format('Y');

        $data = ['name' => trim($name),
        'grade' => $grade,
        'strand' => $strand,
        'date' => $date,
        'schoolyear' => $schoolyear,
        'imagelogo1' => public_path('img/logo/sanpablologo.png'),
        'imagelogo2' => public_path('img/logo/baylogo.png')
        ];
       
        $pdf = PDF::loadView('forms.goodmoral', $data);
        
        // Download PDF with A4 size
        return $pdf->setPaper('A4', 'portrait')->stream('Good_Moral.pdf');
    }
}
