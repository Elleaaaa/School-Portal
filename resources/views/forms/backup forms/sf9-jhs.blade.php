<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress Report Card</title>

    <style>
        body {
            font-family: 'Times New Roman', Times, serif, sans-serif;
            font-size: 10px;
            margin: 0;
            padding: 0;
        }

        .report-card1 {
            width: 100%;
        }

        .header-section1 {
            width: 100%;
            border-collapse: collapse;
        }

        .header-section1 td {
            vertical-align: top;
            padding: 5px;
        }

        .left-header1 {
            width: 50%;
        }

        .right-header1 {
            width: 50%;
            text-align: center;
            font-size: 11px;
        }

        h1,
        h2,
        h4 {
            margin: 0;
            padding: 0;
        }

        .text-center {
            text-align: center;
        }

        .underline {
            display: inline-block;
            border-bottom: 1px solid #000;
            width: 150px;
        }

        .long-underline {
            width: 250px;
        }

        .text-small {
            font-size: 11px;
            margin-bottom: -5px;
        }

        .sign-box {
            width: 200px;
            border-top: 1px solid #000;
            text-align: center;
            margin-top: 30px;
            font-weight: bold;
        }

        .tab {
            display: inline-block;
            width: 2em;
        }

        .progress {
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            font-size: 20px;
            font-weight: bold;
            color: blue;
            margin-bottom: -12px;
            margin-top: 40px;
        }

        .right-title {
            text-transform: uppercase;
            font-size: 13px;
        }

        .student-info p {
            text-align: left;
        }


        .grade-table,
        .grade-table th,
        .grade-table td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .attendance-table,
        .attendance-table th,
        .attendance-table td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .core-values,
        .core-values th,
        .core-values td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .grading-system-table,
        .grading-system-table th,
        .grading-system-table td {
            border: none;
            margin-top: -10px;
        }

        .left-grade {
            float: left;
            /* Floats to the left */
            width: 49%;
            /* Adjust the width as needed */
        }

        .right-grade {
            float: right;
            /* Floats to the right */
            width: 49%;
            /* Adjust the width as needed */
        }
    </style>

</head>

<body>

    <div class="report-card1">
        <table class="header-section1">
            <tr>
                <!-- Parent's Signature and Grading Periods -->
                <td class="left-header1">
                    <p class="text-center" style="font-size: 13px;"><strong>PARENT'S SIGNATURE</strong></p>
                    <p><strong>First Quarter:</strong> <span class="underline" style="width: 220px"></span></p>
                    <p><strong>Second Quarter:</strong> <span class="underline" style="width: 210px"></span></p>
                    <p><strong>Third Quarter:</strong> <span class="underline" style="width: 215px"></span></p>
                    <p><strong>Fourth Quarter:</strong> <span class="underline" style="width: 210px"></span></p>

                    <p class="text-center" style="font-size: 13px; font-weight: bold">IMPORTANT</p>
                    <p class="text-small">1. This card must be signed by the parent or guardian each grading period.</p>
                    <p class="text-small">2. This card must be returned clean within three (3) days to the Class
                        Adviser.</p>
                    <p class="text-small">3. A rating below 75% constitutes a failure.</p>
                    <p class="text-small">4. A final average of 75% is necessary for promotion.</p>
                    <p class="text-small">5. The grade for each grading period from first to fourth quarter is computed
                        according to the performance of the pupils/students using the raw score with corresponding
                        equivalent grade. For the final grades, the averaging system will be used.</p>
                    <p class="text-small">6. The computation of grades of honor students will be based on DepEd Order
                        No. 36, s. 2016.</p>
                    <p class="text-small">7. Tardiness and irregularity in attendance interfere greatly with the
                        students' progress. It is important that all students must BE PRESENT and ON TIME.</p>
                    <p class="text-small">8. Parents/Guardians are encouraged to confer (at will or upon the school’s
                        invitation) with the Administration and Faculty when the need arises.</p>
                </td>

                <!-- Republic of the Philippines Information -->
                <td class="right-header1">
                    <div class="right-title">
                        <p>Republic of the Philippines</p>
                        <p style="font-weight: bold; margin: -10px 0px -10px 0px;">Department of Education</p>
                        <p style="margin-bottom: 40px;">Region IV-CALABARZON</p>
                    </div>
                    <div style="overflow: auto;">
                        <!-- Logo -->
                        <div style="float: left; padding-left: 50px;">
                            <img src="{{ $imagelogo }}" style="width: 75px;" alt="Logo">
                        </div>
                        <!-- Text next to the logo -->
                        <div style="overflow: hidden; margin-bottom: 15px; margin-left: -40px; margin-top: 5px;">
                            <p style="margin-top: 15px; font-size: 13px;">DIVISION OF LAGUNA</p>
                            <p style="font-weight: bold; margin: -10px 0px -10px 0px; font-size: 15px; color: blue;">
                                LICEO DE BAY</p>
                            <p style="font-size: 13px;">K-12 Basic Education Curriculum</p>
                        </div>
                    </div>

                    <p class="progress">PROGRESS REPORT CARD</p>
                    <p>School Year 2024-2025</p>

                    <div class="student-info text-left">
                        <p><strong>Name:</strong> <span class="underline"
                                style="width: 300px">{{ $name }}</span></p>
                        <p><strong>LRN:</strong> <span class="underline" style="width: 305px">{{ $LRN }}</span>
                        </p>
                        <p><strong>Birthday:</strong> <span class="underline"
                                style="width: 100px;">{{ $birthday }}</span>
                            <strong>Age:</strong> <span class="underline"
                                style="width: 66px;">{{ $age }}</span>
                            <strong>Sex:</strong> <span class="underline"
                                style="width: 66px;">{{ $gender }}</span>
                        </p>
                        <p><strong>Grade:</strong> <span class="underline"
                                style="width: 80px;">{{ $gradeLevel }}</span>
                            <strong>Section:</strong> <span class="underline"
                                style="width: 175px">{{ $section }}</span>
                        </p>
                    </div>

                    <div style="text-align: left;">
                        <p><strong>Dear Parent,</strong></p>
                        <p style="font-size: 12px;"><span class="tab"></span>This report card shows the ability and
                            progress your child has made in the
                            different learning areas as well as his/her progress in character development. <br /> <span
                                class="tab"></span>The
                            school welcomes you if you desire to know more about the progress of your child.</p>
                    </div>


                    <p class="sign-box" style="text-align: center; margin-left: 130px;">Adviser</p>
                    <p class="sign-box">Principal</p>
                </td>
            </tr>
        </table>
    </div>

    <div style="page-break-before: always;"></div>
    <div class="grades-page">
        <div>
            <p>NAME: <span class="underline">{{ $name }}</span></p>
        </div>
        <div class="left-grade">
            <p><strong>REPORT ON LEARNING PROGRESS AND ACHIEVEMENT</strong></p>
            <table class="grade-table">
                <tr style="font-size: 9px;">
                    <th style="width: 110px;">LEARNING AREAS</th>
                    <th style="width: 30px;">1</th>
                    <th style="width: 30px;">2</th>
                    <th style="width: 30px;">3</th>
                    <th style="width: 30px;">4</th>
                    <th style="width: 45px;">FINAL <br />RATING</th>
                    <th style="width: 30px;">REMARKS</th>
                </tr>
                @foreach ($subjects as $subject)
                    @php
                        // Get the grade for the current subject
                        $grade = $grades->where('subject', $subject)->first();
                    @endphp
                    <tr>
                        <td>{{ $subject }}</td>
                        @if ($subject === 'MAPEH')
                        {{-- Display the MAPEH Grades --}}
                        <td>{{ isset($averages['MAPEHGrades']['firstQGrade']) ? number_format($averages['MAPEHGrades']['firstQGrade'], 2) : '' }}</td>
                        <td>{{ isset($averages['MAPEHGrades']['secondQGrade']) ? number_format($averages['MAPEHGrades']['secondQGrade'], 2) : '' }}</td>
                        <td>{{ isset($averages['MAPEHGrades']['thirdQGrade']) ? number_format($averages['MAPEHGrades']['thirdQGrade'], 2) : '' }}</td>
                        <td>{{ isset($averages['MAPEHGrades']['fourthQGrade']) ? number_format($averages['MAPEHGrades']['fourthQGrade'], 2) : '' }}</td>
                        {{-- MAPEH Average --}}
                        <td style="background: lightblue">{{ isset($averages[$subject]) ? number_format($averages[$subject], 2) : '' }}</td>
                    @else
                        {{-- Display regular subjects --}}
                        <td>{{ $grade ? $grade->firstQGrade : '' }}</td>
                        <td>{{ $grade ? $grade->secondQGrade : '' }}</td>
                        <td>{{ $grade ? $grade->thirdQGrade : '' }}</td>
                        <td>{{ $grade ? $grade->fourthQGrade : '' }}</td>
            
                        @if (in_array($subject, ['Music', 'Arts', 'Health', 'Physical Education']))
                            <td style="background: lightblue"></td>
                        @else
                            <td>{{ isset($averages[$subject]) ? number_format($averages[$subject], 2) : '' }}</td>
                        @endif
                    @endif
                        <td></td>
                    </tr>
                @endforeach
                
                <tr>
                    <td style="height: 10px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="height: 10px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>HGP</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><strong><em>GENERAL AVERAGE</em></strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{ $finalRating }}</td>
                    <td></td>
                </tr>
            </table>
            <div>
                <p class="text-center">Grading System: <strong>AVERAGING</strong></p>
                <table class="grading-system-table">
                    <tr>
                        <td width="120px"><strong>Descriptors</strong></td>
                        <td width="120px" class="text-center"><strong>Grading Scale</strong></td>
                        <td class="text-center"><strong>Remarks</strong></td>
                    </tr>
                    <tr>
                        <td>Outstanding</td>
                        <td class="text-center">90-100</td>
                        <td class="text-center">Passed</td>
                    </tr>
                    <tr>
                        <td>Very Satisfactory</td>
                        <td class="text-center">85-89</td>
                        <td class="text-center">Passed</td>
                    </tr>
                    <tr>
                        <td>Satisfactory</td>
                        <td class="text-center">80-84</td>
                        <td class="text-center">Passed</td>
                    </tr>
                    <tr>
                        <td>Fairly Satisfactory</td>
                        <td class="text-center">75-79</td>
                        <td class="text-center">Passed</td>
                    </tr>
                    <tr>
                        <td>Did Not Meet Expectation</td>
                        <td class="text-center">below 75</td>
                        <td class="text-center">Failed</td>
                    </tr>
                </table>
            </div>
            <div>
                <p class="text-center" style="margin-bottom: 3px;"><strong>ATTENDANCE RECORD</strong></p>
                <table class="attendance-table" style="font-size: 9px;">
                    <tr>
                        <td width="60px"></td>
                        <td class="text-center" width="17px">Aug</td>
                        <td class="text-center" width="17px">Sep</td>
                        <td class="text-center" width="17px">Oct</td>
                        <td class="text-center" width="17px">Nov</td>
                        <td class="text-center" width="17px">Dec</td>
                        <td class="text-center" width="17px">Jan</td>
                        <td class="text-center" width="17px">Feb</td>
                        <td class="text-center" width="17px">Mar</td>
                        <td class="text-center" width="17px">Apr</td>
                        <td class="text-center" width="17px">May</td>
                        <td class="text-center" width="17px">Jun</td>
                        <td class="text-center" width="17px">Jul</td>
                        <td class="text-center" width="35px"><strong>TOTAL</strong></td>
                    </tr>
                    <tr>
                        <td>No. of School Days</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>No. of School Days Present</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>No. of Times Tardy</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="right-grade">
            <p><strong>REPORT ON LEARNING PROGRESS AND ACHIEVEMENT</strong></p>
            <table class="core-values">
                <tr>
                    <th width="90px" rowspan="2">Core Value</th> <!-- Spans 2 rows -->
                    <th width="130px" rowspan="2">Behavior Statements</th> <!-- Spans 2 rows -->
                    <th width="140px" colspan="4">Quarter</th> <!-- This cell spans 4 columns -->
                </tr>
                <tr>
                    <td class="text-center">1</td>
                    <td class="text-center">2</td>
                    <td class="text-center">3</td>
                    <td class="text-center">4</td>
                </tr>
                <tr>
                    <td class="text-center" rowspan="2">Maka-Diyos</td>
                    <td>Expresses one's spiritual beliefs while respecting the spiritual beliefs of others.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Shows adherence to ethical principles by upholding the truth.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-center" rowspan="2">Makatao</td>
                    <td>Is sensitive to individual, social and cultural differences.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Demonstrates contributions toward solidarity.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-center">Makakalikasan</td>
                    <td>Careees for the environment and utilizes resources wisely, judiciously, and economically.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-center" rowspan="2">Makabansa</td>
                    <td>Demonstrates pride in being a Filipino; exercises the rights and responsibilities of a Filipino
                        citizen.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Demonstrates appropriate behavior in carrying out activities in the school, community, and the
                        country.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
            <div>
                <p class="text-center" style="margin-top: 2px; font-size: 9.5px;"> <em> AO Always
                        Observed&nbsp;&nbsp;&nbsp;SO Sometimes Observed&nbsp;&nbsp;&nbsp;RO Rarely
                        Observed&nbsp;&nbsp;&nbsp;NO Not Observed </em></p>

            </div>
            <div>
                <p class="text-center" style="margin-bottom: -8px"><strong>CERTIFICATE OF TRANSFER</strong></p>
                <p>Eligible for transfer and Admission to Grade &nbsp;&nbsp;&nbsp;<span class="underline"></span></p>
                <p>Lacks subjects in &nbsp;&nbsp;&nbsp; <span class="underline long-underline"></span></p>
                <p>Date: &nbsp;&nbsp;&nbsp; <span class="underline"></span></p>
                <p class="sign-box" style="text-align: center; margin-left: 130px;">Teacher</p>
                <p class="sign-box">Principal</p>
            </div>
            <div>
                <p class="text-center" style="margin-bottom: -8px"><strong>CANCELLATION OF ELIGIBILITY TO
                        TRANSFER</strong></p>
                <p>Has been admitted to <span class="underline long-underline"></span></p>
                <p>School <span class="underline long-underline"></span></p>
                <p class="sign-box" style="text-align: center; margin-left: 130px;">Principal</p>
            </div>

        </div>
    </div>

</body>

</html>
