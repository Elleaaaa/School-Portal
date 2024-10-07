<?php

namespace App\Http\Controllers;

use App\Models\Enrollee;
use App\Models\Grade;
use App\Models\Log;
use App\Models\SHSGrade;
use App\Models\Student;
use App\Models\Subject;
use Dompdf\Dompdf;
use Dompdf\Options;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class FormController extends Controller
{

    // fill up form for COR
    public function requestCOR()
    {
        return view('forms.correquest');
    }

    // fill up form for Good Moral
    public function requestGoodMoral()
    {
        return view('forms.goodmoralrequest');
    }

    // fill up form for  SF9 JHS
    public function requestSF9JHS()
    {
        return view('forms.sf9-jhsrequest');
    }

    // fill up form for  SF9 SHS
    public function requestSF9SHS()
    {
        return view('forms.sf9-shsrequest');
    }

    // fill up form for  SF10 JHS
    public function requestSF10JHS()
    {
        return view('forms.sf10-jhsrequest');
    }

    // fill up form for  SF10 SHS
    public function requestSF10SHS()
    {
        return view('forms.sf10-shsrequest');
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

        $data = [
            'name' => trim($name),
            'grade' => $grade,
            'strand' => $strand,
            'date' => $date,
            'schoolyear' => $schoolyear,
            'purpose' => $purpose,
            'imagelogo1' => public_path('img/logo/sanpablologo.png'),
            'imagelogo2' => public_path('img/logo/baylogo.png')
        ];

        $logs = new Log();
        $logs->studentId = Auth::user()->studentId;
        $logs->type = "request_cor";
        $logs->activity = Auth::user()->studentId . " requested COR for " . $name;
        $logs->save();

        $pdf = PDF::loadView('forms.cor', $data);

        // Download PDF with A4 size
        return $pdf->setPaper('A4', 'portrait')->stream('certificate_of_registration.pdf');
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

        $data = [
            'name' => trim($name),
            'grade' => $grade,
            'strand' => $strand,
            'date' => $date,
            'schoolyear' => $schoolyear,
            'imagelogo1' => public_path('img/logo/sanpablologo.png'),
            'imagelogo2' => public_path('img/logo/baylogo.png')
        ];

        $logs = new Log();
        $logs->studentId = Auth::user()->studentId;
        $logs->type = "request_goodmoral";
        $logs->activity = Auth::user()->studentId . " requested Good Moral for " . $name;
        $logs->save();

        $pdf = PDF::loadView('forms.goodmoral', $data);

        // Download PDF with A4 size
        return $pdf->setPaper('A4', 'portrait')->stream('Good_Moral.pdf');
    }



    public function printSF9JHS(Request $request)
    {
        try {
            $fname = $request->input('firstName');
            $mname = $request->input('middleName');
            $lname = $request->input('lastName');
            $suffix = $request->input('suffixName');
            $name = trim("$fname $mname $lname $suffix");

            $studentId = $request->input('studentId');
            $schoolYearNow = Carbon::now()->format('Y') . '-' . Carbon::now()->addYear()->format('Y');

            // Check if student exists
            $studentDetails = Student::where('studentId', $studentId)->first();
            if (!$studentDetails) {
                emotify('error', 'Student not found!');
                return redirect()->back();
            }

            // Check if enrollee exists
            $enrolleeDetails = Enrollee::where('studentId', $studentId)->get();
            if ($enrolleeDetails->isEmpty()) {
                emotify('error', 'Student not enrolled!');
                return redirect()->back();
            }
            // get the latest student grade level and section
            $latestEnrollee = $enrolleeDetails->sortByDesc('created_at')->first();
            $studentGradeLevel = $latestEnrollee->gradeLevel ?? 'N/A';
            $section = $latestEnrollee->section ?? 'N/A';

            $subjectsByGrade = [];

            // Loop through each enrollee record to fetch the subjects by grade level
            foreach ($enrolleeDetails as $enrollee) {
                $gradeLevel = $enrollee->gradeLevel;

                // Assuming the subjects field contains a comma-separated string of subject names
                if (!empty($enrollee->subjects)) {
                    $subjectList = explode(',', $enrollee->subjects);

                    foreach ($subjectList as $subject) {
                        $formattedSubject = trim($subject);

                        // Add MAPEH before Music if Music is present
                        if ($formattedSubject === 'Music') {
                            // Add MAPEH subject just before Music
                            if (!in_array('MAPEH', $subjectsByGrade[$gradeLevel] ?? [])) {
                                $subjectsByGrade[$gradeLevel][] = 'MAPEH';
                            }
                        }

                        // Add subjects to the respective grade level in the array
                        if (!isset($subjectsByGrade[$gradeLevel])) {
                            $subjectsByGrade[$gradeLevel] = [];
                        }

                        // Avoid duplicates if necessary
                        if (!in_array($formattedSubject, $subjectsByGrade[$gradeLevel])) {
                            $subjectsByGrade[$gradeLevel][] = $formattedSubject;
                        }
                    }
                }
            }


            // Flatten the subjects array to pass it to the query
            $flattenedSubjects = [];
            foreach ($subjectsByGrade as $subjects) {
                $flattenedSubjects = array_merge($flattenedSubjects, $subjects);
            }

            // Fetch grades for the flattened subjects
            $grades = Grade::where('studentId', $studentId)
                ->whereIn('subject', $flattenedSubjects)
                ->get();

            // Get grades for schoolYear Now
            $grades = $grades->where('schoolYear', $schoolYearNow);

            // Get all subjects and their first quarter grades
            $gradesData = [];
            $musicGrades = [];
            $artsGrades = [];
            $peGrades = [];
            $healthGrades = [];

            foreach ($grades as $grade) {
                // Get the grade values for quarters 1-4
                $firstQGrade = $grade->firstQGrade ?? 'N/A';
                $secondQGrade = $grade->secondQGrade ?? 'N/A';
                $thirdQGrade = $grade->thirdQGrade ?? 'N/A';
                $fourthQGrade = $grade->fourthQGrade ?? 'N/A';

                // Store individual subject grades for average calculation
                if ($grade->subject === 'Music') {
                    $musicGrades[] = [$firstQGrade, $secondQGrade, $thirdQGrade, $fourthQGrade];
                } elseif ($grade->subject === 'Arts') {
                    $artsGrades[] = [$firstQGrade, $secondQGrade, $thirdQGrade, $fourthQGrade];
                } elseif ($grade->subject === 'Physical Education') {
                    $peGrades[] = [$firstQGrade, $secondQGrade, $thirdQGrade, $fourthQGrade];
                } elseif ($grade->subject === 'Health') {
                    $healthGrades[] = [$firstQGrade, $secondQGrade, $thirdQGrade, $fourthQGrade];
                }

                // Store subject and grades
                $gradesData[] = [
                    'schoolYear' => $grade->schoolYear,
                    'subject' => $grade->subject,
                    'firstQGrade' => $firstQGrade,
                    'secondQGrade' => $secondQGrade,
                    'thirdQGrade' => $thirdQGrade,
                    'fourthQGrade' => $fourthQGrade,
                ];
            }

            // Calculate the average for MAPEH for each quarter
            function calculateAverage($gradesArray)
            {
                $validGrades = array_filter($gradesArray, function ($grade) {
                    return is_numeric($grade);
                });

                // If there are no valid grades, return 0 instead of 'N/A'
                return count($validGrades) > 0 ? array_sum($validGrades) / count($validGrades) : 0;
            }

            $mapehFirstQGrade = calculateAverage(array_column(array_merge($musicGrades, $artsGrades, $peGrades, $healthGrades), 0));
            $mapehSecondQGrade = calculateAverage(array_column(array_merge($musicGrades, $artsGrades, $peGrades, $healthGrades), 1));
            $mapehThirdQGrade = calculateAverage(array_column(array_merge($musicGrades, $artsGrades, $peGrades, $healthGrades), 2));
            $mapehFourthQGrade = calculateAverage(array_column(array_merge($musicGrades, $artsGrades, $peGrades, $healthGrades), 3));

            // Create MAPEH entry
            $mapehEntry = [
                'subject' => 'MAPEH',
                'firstQGrade' => number_format($mapehFirstQGrade, 2),
                'secondQGrade' => number_format($mapehSecondQGrade, 2),
                'thirdQGrade' => number_format($mapehThirdQGrade, 2),
                'fourthQGrade' => number_format($mapehFourthQGrade, 2),
            ];

            // Find the position of Music to insert MAPEH before it
            $musicIndex = array_search('Music', array_column($gradesData, 'subject'));
            if ($musicIndex !== false) {
                array_splice($gradesData, $musicIndex, 0, [$mapehEntry]); // Insert MAPEH before Music
            }

            // Add the remaining data
            foreach ($gradesData as &$grade) {
                // Calculate the average for each subject
                $gradesArray = array_filter([
                    $grade['firstQGrade'],
                    $grade['secondQGrade'],
                    $grade['thirdQGrade'],
                    $grade['fourthQGrade'],
                ]);

                $average = count($gradesArray) > 0 ? array_sum($gradesArray) / count($gradesArray) : 'N/A';
                $grade['average'] = number_format($average, 2);
            }

            $data = [
                'imagelogo' => public_path('img/logo/baylogo.png'),
                'name' => $name,
                'LRN' => $studentId,
                'birthday' => $studentDetails->birthday ?? 'N/A',
                'age' => $studentDetails->age ?? 'N/A',
                'gender' => $studentDetails->gender ?? 'N/A',
                'gradeLevel' => $studentGradeLevel,
                'section' => $section,
                'grades' => $grades,
                'gradesData' => $gradesData,
            ];

            // to save logs
            $logs = new Log();
            $logs->studentId = Auth::user()->studentId;
            $logs->type = "request_jhs_sf9";
            $logs->activity = Auth::user()->studentId . " requested SF9 for " . $name;
            $logs->save();

            // Generate the PDF
            $pdf = PDF::loadView('forms.sf9-jhs', $data);
            // Download PDF with A4 size
            return $pdf->setPaper('A4', 'portrait')->stream('SF9_JHS.pdf');
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while generating the report: ' . $e->getMessage()], 500);
        }
    }



    public function printSF9SHS(Request $request)
    {
        $fname = $request->input('firstName');
        $mname = $request->input('middleName');
        $lname = $request->input('lastName');
        $suffix = $request->input('suffixName');
        $name = trim("$fname $mname $lname $suffix");

        $studentId = $request->input('studentId');

        // Check if student exists
        $studentDetails = Student::where('studentId', $studentId)->first();
        if (!$studentDetails) {
            emotify('error', 'Student not found!');
            return redirect()->back();
        }

        // Check if enrollee exists
        $enrolleeDetails = Enrollee::where('studentId', $studentId)->get(); // Get all records
        if ($enrolleeDetails->isEmpty()) {
            emotify('error', 'Student not enrolled!');
            return redirect()->back();
        }

        // Extract all school years and semesters
        $schoolYears = $enrolleeDetails->pluck('schoolYear');
        $semesters = $enrolleeDetails->pluck('semester');

        // Check if enrollee is currently enrolled
        $enrollee = Enrollee::where('studentId', $studentId)
            ->where('status', 'Enrolled')
            ->whereIn('schoolYear', $schoolYears)
            ->whereIn('semester', $semesters)
            ->get();

        if ($enrollee->isEmpty()) {
            return response()->json(['error' => 'Student not yet enrolled.'], 400);
        }

        $allSubjects = [];

        // Loop through the enrollee records to extract the subjects
        foreach ($enrollee as $enrolleeRecord) {
            $subjects = $enrolleeRecord->subjects; // Get subjects for each enrollee record
            $subjectList = explode(',', $subjects);

            foreach ($subjectList as $subject) {
                // Format the subject name and add to the list
                $formattedSubject = trim($subject);
                $allSubjects[] = $formattedSubject;
            }
        }

        // Fetch the grades for all subjects across the school years and semesters
        $grades = SHSGrade::where('studentId', $studentId)
            ->whereIn('subject', $allSubjects)
            ->whereIn('schoolYear', $schoolYears)
            ->whereIn('semester', $semesters)
            ->get();

        // Calculate averages for each subject
        $averages = [];
        foreach ($allSubjects as $subject) {
            $grade = $grades->where('subject', $subject)->first();
            $average = null;

            if ($grade) {
                $totalGrades = intval($grade->midterm) + intval($grade->finals);
                $countGrades = 0;

                // Count how many quarters have valid grades
                if ($grade->midterm) $countGrades++;
                if ($grade->finals) $countGrades++;

                // Calculate average if there are valid grades
                if ($countGrades > 0) {
                    $average = $totalGrades / $countGrades;
                }
            }

            // Store the average in the averages array
            $averages[$subject] = $average;
        }

        // Initialize total and count for calculating the final rating
        $totalFinalRating = 0;
        $countFinalRating = 0;

        foreach ($averages as $subject => $average) {
            // Skip MAPEHGrades as it stores quarterly grades and not the final average
            if (!is_array($average)) {
                // Only consider subjects that have a valid average
                if ($average) {
                    $totalFinalRating += $average;
                    $countFinalRating++;
                }
            }
        }

        // Get the final rating or GWA
        $finalRating = ($countFinalRating > 0) ? ($totalFinalRating / $countFinalRating) : 0;
        // Format with two decimal places
        $finalRating = number_format($finalRating, 2);

        // Retrieve the first enrollee record to access non-collection fields like section and semester
        $firstEnrollee = $enrolleeDetails->first();

        // Prepare the data for use (e.g., in a PDF or a view)
        $data = [
            'imagelogo' => public_path('img/logo/baylogo.png'),
            'name' => $name,
            'LRN' => $studentId,
            'birthday' => $studentDetails->birthday ?? 'N/A',
            'age' => $studentDetails->age ?? 'N/A',
            'gender' => $studentDetails->gender ?? 'N/A',  // Fixed typo here
            'gradeLevel' => $firstEnrollee->gradeLevel ?? 'N/A',  // Get from the first enrollee record
            'section' => $firstEnrollee->section ?? 'N/A',  // Get from the first enrollee record
            'grades' => $grades,
            'subjects' => $allSubjects,
            'averages' => $averages,
            'semester' => $firstEnrollee->semester ?? 'N/A',  // Get from the first enrollee record
            'finalRating' => $finalRating,
        ];

        // to save logs
        $logs = new Log();
        $logs->studentId = Auth::user()->studentId;
        $logs->type = "request_shs_sf9";
        $logs->activity = Auth::user()->studentId . " requested SF9 for " . $name;
        $logs->save();

        $pdf = PDF::loadView('forms.sf9-shs', $data);

        // Download PDF with A4 size
        return $pdf->setPaper('A4', 'portrait')->stream('SF9_SHS.pdf');
    }


    public function printSF10JHS(Request $request)
    {
        $fname = $request->input('firstName');
        $mname = $request->input('middleName');
        $lname = $request->input('lastName');
        $suffix = $request->input('suffixName');
        $name = trim("$fname $mname $lname $suffix");

        $studentId = $request->input('studentId');

        // Check if student exists
        $studentDetails = Student::where('studentId', $studentId)->first();
        if (!$studentDetails) {
            emotify('error', 'Student not found!');
            return redirect()->back();
        }

        // Check if enrollee exists
        $enrolleeDetails = Enrollee::where('studentId', $studentId)->first();
        if (!$enrolleeDetails) {
            emotify('error', 'Student not enrolled!');
            return redirect()->back();
        }

        $schoolyear = Carbon::now()->format('Y') . '-' . Carbon::now()->addYear()->format('Y');

        $enrolleeDetails = Enrollee::where('studentId', $studentId)->get();
        if ($enrolleeDetails->isEmpty()) {
            emotify('error', 'Student not enrolled!');
            return redirect()->back();
        }

        $subjectsByGrade = [];

        // Loop through each enrollee record to fetch the subjects by grade level
        foreach ($enrolleeDetails as $enrollee) {
            $gradeLevel = $enrollee->gradeLevel;

            // Assuming the subjects field contains a comma-separated string of subject names
            if (!empty($enrollee->subjects)) {
                $subjectList = explode(',', $enrollee->subjects);

                foreach ($subjectList as $subject) {
                    $formattedSubject = trim($subject);

                    // Add MAPEH before Music if Music is present
                    if ($formattedSubject === 'Music') {
                        // Add MAPEH subject just before Music
                        if (!in_array('MAPEH', $subjectsByGrade[$gradeLevel] ?? [])) {
                            $subjectsByGrade[$gradeLevel][] = 'MAPEH';
                        }
                    }

                    // Add subjects to the respective grade level in the array
                    if (!isset($subjectsByGrade[$gradeLevel])) {
                        $subjectsByGrade[$gradeLevel] = [];
                    }

                    // Avoid duplicates if necessary
                    if (!in_array($formattedSubject, $subjectsByGrade[$gradeLevel])) {
                        $subjectsByGrade[$gradeLevel][] = $formattedSubject;
                    }
                }
            }
        }


        // Flatten the subjects array to pass it to the query
        $flattenedSubjects = [];
        foreach ($subjectsByGrade as $subjects) {
            $flattenedSubjects = array_merge($flattenedSubjects, $subjects);
        }

        // Fetch grades for the flattened subjects
        $grades = Grade::where('studentId', $studentId)
            ->whereIn('subject', $flattenedSubjects)
            ->get();

        // Get all subjects and their first quarter grades
        $gradesData = [];
        $musicGrades = [];
        $artsGrades = [];
        $peGrades = [];
        $healthGrades = [];

        foreach ($grades as $grade) {
            // Get the grade values for quarters 1-4
            $firstQGrade = $grade->firstQGrade ?? 'N/A';
            $secondQGrade = $grade->secondQGrade ?? 'N/A';
            $thirdQGrade = $grade->thirdQGrade ?? 'N/A';
            $fourthQGrade = $grade->fourthQGrade ?? 'N/A';

            // Store individual subject grades for average calculation
            if ($grade->subject === 'Music') {
                $musicGrades[] = [$firstQGrade, $secondQGrade, $thirdQGrade, $fourthQGrade];
            } elseif ($grade->subject === 'Arts') {
                $artsGrades[] = [$firstQGrade, $secondQGrade, $thirdQGrade, $fourthQGrade];
            } elseif ($grade->subject === 'Physical Education') {
                $peGrades[] = [$firstQGrade, $secondQGrade, $thirdQGrade, $fourthQGrade];
            } elseif ($grade->subject === 'Health') {
                $healthGrades[] = [$firstQGrade, $secondQGrade, $thirdQGrade, $fourthQGrade];
            }

            // Store subject and grades
            $gradesData[] = [
                'subject' => $grade->subject,
                'gradeLevel' => $grade->gradeLevel,
                'firstQGrade' => $firstQGrade,
                'secondQGrade' => $secondQGrade,
                'thirdQGrade' => $thirdQGrade,
                'fourthQGrade' => $fourthQGrade,
            ];
        }

        // Calculate the average for MAPEH for each quarter
        function calculateAve($gradesArray)
        {
            $validGrades = array_filter($gradesArray, function ($grade) {
                return is_numeric($grade);
            });

            // If there are no valid grades, return 0 instead of 'N/A'
            return count($validGrades) > 0 ? array_sum($validGrades) / count($validGrades) : 0;
        }

        $mapehFirstQGrade = calculateAve(array_column(array_merge($musicGrades, $artsGrades, $peGrades, $healthGrades), 0));
        $mapehSecondQGrade = calculateAve(array_column(array_merge($musicGrades, $artsGrades, $peGrades, $healthGrades), 1));
        $mapehThirdQGrade = calculateAve(array_column(array_merge($musicGrades, $artsGrades, $peGrades, $healthGrades), 2));
        $mapehFourthQGrade = calculateAve(array_column(array_merge($musicGrades, $artsGrades, $peGrades, $healthGrades), 3));

        // Create MAPEH entry
        $mapehEntry = [
            'subject' => 'MAPEH',
            'firstQGrade' => number_format($mapehFirstQGrade, 2),
            'secondQGrade' => number_format($mapehSecondQGrade, 2),
            'thirdQGrade' => number_format($mapehThirdQGrade, 2),
            'fourthQGrade' => number_format($mapehFourthQGrade, 2),
        ];

        // Find the position of Music to insert MAPEH before it
        $musicIndex = array_search('Music', array_column($gradesData, 'subject'));
        if ($musicIndex !== false) {
            array_splice($gradesData, $musicIndex, 0, [$mapehEntry]); // Insert MAPEH before Music
        }

        // Add the remaining data
        foreach ($gradesData as &$grade) {
            // Calculate the average for each subject
            $gradesArray = array_filter([
                $grade['firstQGrade'],
                $grade['secondQGrade'],
                $grade['thirdQGrade'],
                $grade['fourthQGrade'],
            ]);

            $average = count($gradesArray) > 0 ? array_sum($gradesArray) / count($gradesArray) : 'N/A';
            $grade['average'] = number_format($average, 2);
        }

        // to save logs
        $logs = new Log();
        $logs->studentId = Auth::user()->studentId;
        $logs->type = "request_jhs_sf10";
        $logs->activity = Auth::user()->studentId . " requested SF10 for " . $name;
        $logs->save();

        $data = [
            'imagelogo' => public_path('img/logo/depedsymbol.png'),
            'imagelogo1' => public_path('img/logo/depedlogo.png'),
            'firstName' => $fname,
            'middleName' => $mname,
            'lastName' => $lname,
            'suffixName' => $suffix,
            'name' => $name,
            'schoolyear' => $schoolyear,
            'LRN' => $studentId,
            'birthday' => $studentDetails->birthday ?? 'N/A',
            'sex' => $studentDetails->gender ?? 'N/A',
            'gradesData' => $gradesData,
        ];

        $pdf = PDF::loadView('forms.sf10-jhs', $data);

        $pdf->setOption('margin-bottom', 0);
        // Download PDF with Long size
        return $pdf->setPaper([0, 0, 612, 936], 'portrait')->stream('SF10_JHS.pdf');
    }



    public function printSF10SHS(Request $request)
    {
        $fname = $request->input('firstName');
        $mname = $request->input('middleName');
        $lname = $request->input('lastName');
        $suffix = $request->input('suffixName');
        $name = trim("$fname $mname $lname $suffix");

        $studentId = $request->input('studentId');

        // GRADE 11 FIRST SEMESTER DETAILS
        $grade111Details = Enrollee::where('studentId', $studentId)
            ->where('gradeLevel', 'Grade 11')
            ->where('semester', 'First Semester')
            ->first();

        // GRADE 11 SECOND SEMESTER DETAILS
        $grade112Details = Enrollee::where('studentId', $studentId)
            ->where('gradeLevel', 'Grade 11')
            ->where('semester', 'Second Semester')
            ->first();

        // GRADE 12 FIRST SEMESTER DETAILS
        $grade121Details = Enrollee::where('studentId', $studentId)
            ->where('gradeLevel', 'Grade 12')
            ->where('semester', 'First Semester')
            ->first();

        // GRADE 12 SECOND SEMESTER DETAILS
        $grade122Details = Enrollee::where('studentId', $studentId)
            ->where('gradeLevel', 'Grade 12')
            ->where('semester', 'Second Semester')
            ->first();

        $grade111Sy = $grade111Details->schoolYear ?? '';
        $grade111Section = $grade111Details->section ?? '';
        $grade111Strand = $grade111Details->strand ?? '';

        $grade112Sy = $grade112Details->schoolYear ?? '';
        $grade112Section = $grade112Details->section ?? '';
        $grade112Strand = $grade112Details->strand ?? '';

        $grade121Sy = $grade121Details->schoolYear ?? '';
        $grade121Section = $grade121Details->section ?? '';
        $grade121Strand = $grade121Details->strand ?? '';

        $grade122Sy = $grade122Details->schoolYear ?? '';
        $grade122Section = $grade122Details->section ?? '';
        $grade122Strand = $grade122Details->strand ?? '';

        // Check if student exists
        $studentDetails = Student::where('studentId', $studentId)->first();
        if (!$studentDetails) {
            emotify('error', 'Student not found!');
            return redirect()->back();
        }

        // Check if enrollee exists
        $enrolleeDetails = Enrollee::where('studentId', $studentId)->first();
        if (!$enrolleeDetails) {
            emotify('error', 'Student not enrolled!');
            return redirect()->back();
        }

        $schoolyear = Carbon::now()->format('Y') . '-' . Carbon::now()->addYear()->format('Y');

        $enrolleeDetails = Enrollee::where('studentId', $studentId)->get();
        if ($enrolleeDetails->isEmpty()) {
            emotify('error', 'Student not enrolled!');
            return redirect()->back();
        }

        $subjectsByGradeAndSemester = [];


        // Loop through each enrollee record to fetch the subjects by grade level and semester
        foreach ($enrolleeDetails as $enrollee) {
            $gradeLevel = $enrollee->gradeLevel;
            $semester = $enrollee->semester;

            // Assuming the subjects field contains a comma-separated string of subject names
            if (!empty($enrollee->subjects)) {
                $subjectListForEnrollee = explode(',', $enrollee->subjects);

                foreach ($subjectListForEnrollee as $subject) {
                    $formattedSubject = trim($subject);

                    // Add subjects to the respective grade level and semester in the array
                    if (!isset($subjectsByGradeAndSemester[$gradeLevel])) {
                        $subjectsByGradeAndSemester[$gradeLevel] = [];
                    }

                    if (!isset($subjectsByGradeAndSemester[$gradeLevel][$semester])) {
                        $subjectsByGradeAndSemester[$gradeLevel][$semester] = [];
                    }

                    // Avoid duplicates in subjectsByGradeAndSemester
                    if (!in_array($formattedSubject, $subjectsByGradeAndSemester[$gradeLevel][$semester])) {
                        $subjectsByGradeAndSemester[$gradeLevel][$semester][] = $formattedSubject;
                    }
                }
            }
        }

        // Flatten the subjects array to pass it to the query while keeping gradeLevel and semester
        $flattenedSubjects = [];
        foreach ($subjectsByGradeAndSemester as $gradeLevel => $semesters) {
            foreach ($semesters as $semester => $subjects) {
                foreach ($subjects as $subject) {
                    $flattenedSubjects[] = [
                        'subject' => $subject,
                        'gradeLevel' => $gradeLevel,
                        'semester' => $semester,
                    ];
                }
            }
        }

        // Build the query with flattened subject data
        $gradesQuery = SHSGrade::where('studentId', $studentId);

        foreach ($flattenedSubjects as $subjectData) {
            $gradesQuery->orWhere(function ($query) use ($subjectData) {
                $query->where('subject', $subjectData['subject'])
                    ->where('gradeLevel', $subjectData['gradeLevel'])
                    ->where('semester', $subjectData['semester']);
            });
        }

        $grades = $gradesQuery->get();

        $gradesData = [];

        foreach ($grades as $grade) {
            // Get the grade values for quarters 1-4
            $midterm = $grade->midterm ?? 'N/A';
            $finals = $grade->finals ?? 'N/A';

            $subject = Subject::where('subject', $grade->subject)->first();
            $subjectType = $subject ? $subject->subjectType : 'Unknown';

            // Store subject and grades
            $gradesData[] = [
                'subject' => $grade->subject,
                'subjectType' => $subjectType,
                'semester' => $grade->semester,
                'gradeLevel' => $grade->gradeLevel,
                'midterm' => $midterm,
                'finals' => $finals,
            ];
        }

        //code for the average here
        //no calculation yet


        // to save logs
        $logs = new Log();
        $logs->studentId = Auth::user()->studentId;
        $logs->type = "request_shs_sf10";
        $logs->activity = Auth::user()->studentId . " requested SF10 for " . $name;
        $logs->save();

        $data = [
            'imagelogo' => public_path('img/logo/depedsymbol.png'),
            'imagelogo1' => public_path('img/logo/depedlogo.png'),
            'lastName' => $lname,
            'firstName' => $fname,
            'middleName' => $mname,
            'suffixName' => $suffix,
            'name' => $name,
            'schoolyear' => $schoolyear,
            'LRN' => $studentId,
            'birthday' => $studentDetails->birthday ?? 'N/A',
            'sex' => $studentDetails->gender ?? 'N/A',
            'gradesData' => $gradesData,
            'grade111Sy' => $grade111Sy,
            'grade111Section' => $grade111Section,
            'grade111Strand' => $grade111Strand,
            'grade112Sy' => $grade112Sy,
            'grade112Section' => $grade112Section,
            'grade112Strand' => $grade112Strand,
            'grade121Sy' => $grade121Sy,
            'grade121Section' => $grade121Section,
            'grade121Strand' => $grade121Strand,
            'grade122Sy' => $grade122Sy,
            'grade122Section' => $grade122Section,
            'grade122Strand' => $grade122Strand,
        ];

        $pdf = PDF::loadView('forms.sf10-shs', $data);

        $pdf->setOption('margin-bottom', 0);
        // Download PDF with Long size
        return $pdf->setPaper([0, 0, 612, 936], 'portrait')->stream('SF10_SHS.pdf');
    }
}
