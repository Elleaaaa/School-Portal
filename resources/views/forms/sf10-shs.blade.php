<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="icon" href="{{ asset('images/icons/baylogo.png') }}">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 9px;
            margin: 0;
            padding: 0;
        }

        @page {
            margin-bottom: 0px;
            margin-top: 30px;
        }

        .header p {
            margin: 0px;
        }

        .title {
            width: 100%;
            text-align: center;
            background-color: rgb(206, 222, 235);
            margin: 1px 1px;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .underline {
            display: inline-block;
            border-bottom: 1px solid #000;
            width: 115px;
        }

        .tab {
            display: inline-block;
            width: 3.2em;
        }

        .learner-info {
            margin-top: -5px;
            margin-bottom: -5px;
        }

        .learner-info p {
            margin-top: 0px;
            margin-bottom: 3px;
        }

        .eligibility {
            width: 100%;
            margin-top: -13px;
        }

        .eligibility p {
            margin-top: 1px;
            margin-bottom: 1px;
        }

        .other-credentials {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0px;
        }

        .other-credentials td {
            vertical-align: middle;
            /* Align text vertically */
            padding: 0px;
        }

        .other-credentials input[type="checkbox"] {
            vertical-align: bottom;
            margin-right: 5px;
            /* Add space between checkbox and text */
            position: relative;
            top: -2px;
            /* Adjust this value to align perfectly with the text */
            font-size: 12px;
        }

        /* Ensuring the paragraph aligns with inline content */
        .other-credentials p {
            display: inline;
            margin: 0;
            vertical-align: middle;
        }

        .otherCredentials {
            margin-bottom: 0px;
        }

        .otherCredentials p {
            font-size: 8px;
            margin-top: 0px;
            margin-bottom: 0px;
        }


        .scholastic-record,
        .scholastic-record th,
        .scholastic-record td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .scholastic-record th {
            background-color: rgb(206, 222, 235);
        }

        .scholastic-record td {
            font-size: 9px;
        }

        .scholastic-record {
            width: 100%;
            margin-top: 5px;
        }

        .scholastic-record td:first-child {
            /* Styles for the first column cells */
            text-align: center;
        }

        .scholastic p {
            margin-top: 0px;
            margin-bottom: 1px;
        }

        .scholastic {
            margin-top: -5px;
            margin-bottom: -5px;
        }

        .scholastic-footer p {
            margin-bottom: 0px;
        }

        .remedial-classes p {
            margin-bottom: 0px;
        }

        .remedial-classes {
            margin-bottom: 25px;
        }

        .remidial-classes-table,
        .remidial-classes-table th,
        .remidial-classes-table td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .remidial-classes-table td {
            font-size: 9px;
        }

        .remidial-classes-table {
            width: 100%;
        }

        .remidial-classes-table td:first-child {
            text-align: center;
        }

        .track-accomplished p {
            margin-bottom: 2px;
            margin-top: 2px;
        }

        .note-bottom {
            width: 60%;
            border: 1px solid black;
            margin: 0px 0px;
        }

        .note-bottom p {
            margin: 0px 0px;
        }
    </style>
</head>

<body>
    <div class="firstPage">
        <div class="header">
            <div style="float: left;">
                <img src="{{ $imagelogo }}" style="width: 90px;" alt="Logo">
            </div>
            <div style="float: left; text-align: center; margin-left: 55px;">
                <p>Republic of the Philippines</p>
                <p>Department of Education</p>
                <p style="font-size: 14px; font-weight: bold;">SENIOR HIGH SCHOOL STUDENT PERMANENT RECORD</p>
            </div>
            <div style="float: right;">
                <img src="{{ $imagelogo1 }}" style="width: 75px;" alt="Logo">
            </div>
        </div>

        {{-- Clear the float --}}
        <div style="clear: both;"></div>

        <div class="title">
            <p>LEARNER'S INFORMATION</p>
        </div>

        <div class="learner-info">
            <p>LAST NAME: &nbsp;<span class="underline" style="width: 130px;">{{ $lastName }}</span> &nbsp;&nbsp;
                FIRST NAME: &nbsp;<span class="underline" style="width: 130px;">{{ $firstName }}</span> &nbsp;&nbsp;
                NAME EXT. (Jr,I,II): &nbsp;<span class="underline" style="width: 40px;">{{ $suffixName }}</span>
                &nbsp;&nbsp;
                MIDDLE NAME: &nbsp;<span class="underline" style="width: 120px;">{{ $middleName }}</span></p>
            <p>LRN: &nbsp;<span class="underline" style="width: 150px;"> {{ $LRN }}</span> &nbsp;
                Date of Birth (MM/DD/YYYY): &nbsp;<span class="underline"
                    style="width: 70px;">{{ $birthday }}</span> &nbsp;&nbsp;
                Sex: &nbsp;<span class="underline" style="width: 50px;">{{ $sex }}</span> &nbsp;&nbsp;
                Date of SHS admission (MM/DD/YYYY): &nbsp;<span class="underline" style="width: 90px;"></span></p>
        </div>

        <div class="title">
            <p>ELIGIBILITY FOR SHS ENROLLMENT</p>
        </div>

        <div class="eligibility">
            <p>
                <input type="checkbox" checked style="vertical-align: bottom;"> High School Completer* <span
                    class="tab"></span> &nbsp;&nbsp;&nbsp;General Average: <span class="underline"
                    style="width: 50px;"></span><span class="tab"></span><span class="tab"></span>
                <input type="checkbox" checked style="vertical-align: bottom;"> Junior High School Completer <span
                    class="tab"></span> &nbsp;&nbsp;&nbsp;General Average: <span class="underline"
                    style="width: 50px;"></span>
            <p>Date of Graduation/Completion (MM/DD/YYYY): <span class="underline" style="width: 60px;"></span>
                &nbsp;&nbsp; Name of School: <span class="underline" style="width: 156px;"></span> &nbsp;&nbsp; School
                Address: <span class="underline" style="width: 156px;"></span></p>
            </p>
        </div>

        <div class="otherCredentials">
            <table class="other-credentials" style="padding: 0px;">
                <tr>
                    <td style="padding: 0px;"><input type="checkbox"> PEPT Passer &nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td style="padding: 0px;">Rating: <span class="underline" style="width: 60px;"></span> <span
                            class="tab"></span></td>
                    <td style="padding: 0px;"><input type="checkbox"> ALS A & E Passer &nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td style="padding: 0px;">Rating: <span class="underline" style="width: 60px;"></span> <span
                            class="tab"></span></td>
                    <td style="padding: 0px;"><input type="checkbox"> Others (Pls. Specify): <span class="underline"
                            style="width: 184px;"></span></td>
                </tr>
            </table>
            <p>Date of Examination/Assessment (MM/DD/YYYY): <span class="underline" style="width: 125px;"></span> <span
                    class="tab"></span> Name and Address of Community Learning Center: <span class="underline"
                    style="width: 155px;"></span></p>
            <p><em>*High School Completers are students who graduated from secondary school under the old curriculum
                    <span class="tab"></span> ***ALS A&E - Alternative Learning System Accreditation and Equivalency
                    Test for JHS</em></p>
            <p><em>**PEPT - Philipine Education Placement Test for JHS</em></p>
        </div>

        <div class="title" style="margin-top: -5px">
            <p>SCHOLASTIC RECORD</p>
        </div>

        <div>
            <div class="scholastic">
                <p>
                    <strong>SCHOOL:</strong><span class="underline" style="width: 220px">Liceo De Bay</span>
                    <strong>SCHOOL ID:</strong><span class="underline" style="width: 103px">402413</span>
                    <strong>GRADE LEVEL:</strong><span class="underline" style="width: 70px">11</span>
                    <strong>SY: </strong><span class="underline" style="width: 70px">{{ $grade111Sy }}</span>
                    <strong>SEM: </strong><span class="underline" style="width: 40px">First</span>
                </p>
                <p>
                    <strong>TRACK/STRAND:</strong> <span class="underline"
                        style="width: 365px">{{ $grade111Strand }}</span>
                    <strong>SECTION:</strong> <span class="underline"
                        style="width: 235px">{{ $grade111Section }}</span>
                </p>
            </div>

            <table class="scholastic-record">
                <tr>
                    <th rowspan="2" style="width: 14%;">Indicate if Subject is CORE, APPLIED, or SPECIALIZED</th>
                    <th rowspan="2" style="width: 50%;">SUBJECTS</th>
                    <th colspan="2">QUARTER</th>
                    <th rowspan="2" style="width: 9%;">SEMI FINAL GRADE</th>
                    <th rowspan="2" style="width: 9%;">ACTION TAKEN</th>
                </tr>
                <tr>
                    <th style="width: 9%;">1</th>
                    <th style="width: 9%;">2</th>
                </tr>
                @php
                    $grade11FirstSem = collect($gradesData)
                        ->where('gradeLevel', 'Grade 11')
                        ->where('semester', 'First Semester');
                @endphp
                @foreach ($grade11FirstSem as $grade)
                    <tr>
                        <td>
                            @if ($grade['subjectType'] === 'Core')
                                Core
                            @elseif ($grade['subjectType'] === 'Applied')
                                Applied
                            @elseif ($grade['subjectType'] === 'Specialized')
                                Specialized
                            @elseif ($grade['subjectType'] === 'Other_Subjects')
                                Other_Subjects
                            @endif
                        </td>
                        <td>{{ $grade['subject'] ?? '' }}</td>
                        <td>{{ $grade['midterm'] ?? 'N/A' }}</td>
                        <td>{{ $grade['finals'] ?? 'N/A' }}</td>
                        <td>asd</td>
                        <td>asd</td>
                    </tr>
                @endforeach

                <tr>
                    <td style="padding-bottom: 9px"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: right; background-color: rgb(206, 222, 235);">
                        <strong>General Ave. for the Semester:</strong>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
            </table>

            <div class="scholastic-footer">
                <p style="margin-top: 5px;"><strong>REMARKS:</strong> <span class="tab"></span> <span
                        class="underline" style="width: 93.3%; margin-left: 50px"></span></p>
                <p>
                    <strong>Prepared By:
                        <span class="tab"></span> <span class="tab"></span> </span> <span
                            class="tab"></span> <span class="tab"></span> <span class="tab"></span>
                        Certified True and Correct:
                        <span class="tab"></span> <span class="tab"></span> <span class="tab"></span> <span
                            class="tab"></span> <span class="tab"></span> <span class="tab"></span> <span
                            class="tab"></span> <span class="tab"></span>
                        Date Checked (MM/DD/YYYY):</strong>
                </p>
                <p style="margin-top: 30px;">
                    <span style="border-top: 1px solid black; display: inline-block; width: 200px; text-align: center">
                        Signature of Adviser over Printed Name </span> <span class="tab"></span>
                    <span style="border-top: 1px solid black; display: inline-block; width: 320px; text-align: center">
                        Signature of Authorized Person over Printed Name, Designation </span> <span
                        class="tab"></span><span class="tab"></span>
                    <span style="border-top: 1px solid black; display: inline-block; width: 100px; text-align: center">
                        <span style="color: white;">Date</span> </span>
                </p>
            </div>

            <div class="remedial-classes">
                <p>
                    <strong>REMEDIAL CLASSES &nbsp;&nbsp; Conducted from (MM/DD/YYYY): <span class="underline"
                            style="width: 50px;"></span>
                        to (MM/DD/YYYY): <span class="underline" style="width: 50px;"></span>
                        SCHOOL: <span class="underline" style="width: 140px;"></span>
                        SCHOOL ID: <span class="underline" style="width: 55px;"></span></strong>
                </p>

                <table class="remidial-classes-table">
                    <tr>
                        <th style="width: 14%;">Indicate if Subject is CORE, APPLIED, or SPECIALIZED</th>
                        <th style="width: 50%;">SUBJECTS</th>
                        <th style="width: 9%;">SEMI FINAL GRADE</th>
                        <th style="width: 9%;">REMEDIAL CLASS MARK</th>
                        <th style="width: 9%;">RECOMPUTED FINAL GRADE</th>
                        <th style="width: 9%;">ACTION TAKEN</th>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 9px;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 9px;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 9px;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 9px;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>

                <p>Name of Teacher/Adviser: <span class="underline" style="width: 350px;"></span> <span
                        class="tab"></span> Signature: <span class="underline" style="width: 190px;"></span></p>
            </div>
        </div>

        <div>
            <div class="scholastic">
                <p><strong>SCHOOL:</strong> <span class="underline" style="width: 220px">Liceo De Bay</span>
                    <strong>SCHOOL ID:</strong> <span class="underline" style="width: 103px">402413</span>
                    <strong>GRADE LEVEL:</strong> <span class="underline" style="width: 70px">11</span>
                    <strong>SY:</strong> <span class="underline" style="width: 70px">{{ $grade112Sy }}</span>
                    <strong>SEM:</strong> <span class="underline" style="width: 40px">Second</span>
                </p>
                <p><strong>TRACK/STRAND:</strong> <span class="underline"
                        style="width: 365px">{{ $grade112Strand }}</span>
                    <strong>SECTION:</strong> <span class="underline"
                        style="width: 235px">{{ $grade112Section }}</span>
                </p>
            </div>

            <table class="scholastic-record">
                <tr>
                    <th rowspan="2" style="width: 14%;">Indicate if Subject is CORE, APPLIED, or SPECIALIZED</th>
                    <th rowspan="2" style="width: 50%;">SUBJECTS</th>
                    <th colspan="2">QUARTER</th>
                    <th rowspan="2" style="width: 9%;">SEMI FINAL GRADE</th>
                    <th rowspan="2" style="width: 9%;">ACTION TAKEN</th>
                </tr>
                <tr>
                    <th style="width: 9%;">1</th>
                    <th style="width: 9%;">2</th>
                </tr>
                @php
                    $grade11SecondSem = collect($gradesData)
                        ->where('gradeLevel', 'Grade 11')
                        ->where('semester', 'Second Semester');
                @endphp
                @foreach ($grade11SecondSem as $grade)
                    <tr>
                        <td>
                            @if ($grade['subjectType'] === 'Core')
                                Core
                            @elseif ($grade['subjectType'] === 'Applied')
                                Applied
                            @elseif ($grade['subjectType'] === 'Specialized')
                                Specialized
                            @elseif ($grade['subjectType'] === 'Other_Subjects')
                                Other_Subjects
                            @endif
                        </td>
                        <td>{{ $grade['subject'] ?? '' }}</td>
                        <td>{{ $grade['midterm'] ?? 'N/A' }}</td>
                        <td>{{ $grade['finals'] ?? 'N/A' }}</td>
                        <td>asd</td>
                        <td>asd</td>
                    </tr>
                @endforeach
                <tr>
                    <td style="padding-bottom: 9px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: right; background-color: rgb(206, 222, 235);">
                        <strong>General Ave. for the Semester:</strong>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
            </table>

            <div class="scholastic-footer">
                <p style="margin-top: 5px;"><strong>REMARKS:</strong> <span class="tab"></span> <span
                        class="underline" style="width: 93.3%; margin-left: 50px"></span></p>
                <p>
                    <strong>Prepared By:
                        <span class="tab"></span> <span class="tab"></span> </span> <span
                            class="tab"></span> <span class="tab"></span> <span class="tab"></span>
                        Certified True and Correct:
                        <span class="tab"></span> <span class="tab"></span> <span class="tab"></span> <span
                            class="tab"></span> <span class="tab"></span> <span class="tab"></span> <span
                            class="tab"></span> <span class="tab"></span>
                        Date Checked (MM/DD/YYYY):</strong>
                </p>
                <p style="margin-top: 30px;">
                    <span style="border-top: 1px solid black; display: inline-block; width: 200px; text-align: center">
                        Signature of Adviser over Printed Name </span> <span class="tab"></span>
                    <span style="border-top: 1px solid black; display: inline-block; width: 320px; text-align: center">
                        Signature of Authorized Person over Printed Name, Designation </span> <span
                        class="tab"></span><span class="tab"></span>
                    <span style="border-top: 1px solid black; display: inline-block; width: 100px; text-align: center">
                        <span style="color: white;">Date</span> </span>
                </p>
            </div>

            <div class="remedial-classes">
                <p>
                    <strong>REMEDIAL CLASSES &nbsp;&nbsp; Conducted from (MM/DD/YYYY): <span class="underline"
                            style="width: 50px;"></span>
                        to (MM/DD/YYYY): <span class="underline" style="width: 50px;"></span>
                        SCHOOL: <span class="underline" style="width: 140px;"></span>
                        SCHOOL ID: <span class="underline" style="width: 55px;"></span></strong>
                </p>

                <table class="remidial-classes-table">
                    <tr>
                        <th style="width: 14%;">Indicate if Subject is CORE, APPLIED, or SPECIALIZED</th>
                        <th style="width: 50%;">SUBJECTS</th>
                        <th style="width: 9%;">SEMI FINAL GRADE</th>
                        <th style="width: 9%;">REMEDIAL CLASS MARK</th>
                        <th style="width: 9%;">RECOMPUTED FINAL GRADE</th>
                        <th style="width: 9%;">ACTION TAKEN</th>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 9px;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 9px;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 9px;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 9px;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>

                <p>Name of Teacher/Adviser: <span class="underline" style="width: 350px;"></span> <span
                        class="tab"></span> Signature: <span class="underline" style="width: 190px;"></span></p>
            </div>
        </div>

    </div>

    {{-- SECOND PAGE --}}
    <div style="page-break-before: always;"></div>

    <div class="secondPage">
        <div>
            <div class="scholastic">
                <p><strong>SCHOOL:</strong> <span class="underline" style="width: 220px">Liceo De Bay</span>
                    <strong>SCHOOL ID:</strong> <span class="underline" style="width: 103px">402413</span>
                    <strong>GRADE LEVEL:</strong> <span class="underline" style="width: 70px">Grade 12</span>
                    <strong>SY:</strong> <span class="underline" style="width: 70px">{{ $grade121Sy }}</span>
                    <strong>SEM:</strong> <span class="underline" style="width: 40px">Second</span>
                </p>
                <p><strong>TRACK/STRAND:</strong> <span class="underline"
                        style="width: 365px">{{ $grade121Strand }}</span>
                    <strong>SECTION:</strong> <span class="underline"
                        style="width: 235px">{{ $grade121Section }}</span>
                </p>
            </div>

            <table class="scholastic-record">
                <tr>
                    <th rowspan="2" style="width: 14%;">Indicate if Subject is CORE, APPLIED, or SPECIALIZED</th>
                    <th rowspan="2" style="width: 50%;">SUBJECTS</th>
                    <th colspan="2">QUARTER</th>
                    <th rowspan="2" style="width: 9%;">SEMI FINAL GRADE</th>
                    <th rowspan="2" style="width: 9%;">ACTION TAKEN</th>
                </tr>
                <tr>
                    <th style="width: 9%;">1</th>
                    <th style="width: 9%;">2</th>
                </tr>
                @php
                    $grade12FirstSem = collect($gradesData)
                        ->where('gradeLevel', 'Grade 12')
                        ->where('semester', 'First Semester');
                @endphp
                @foreach ($grade12FirstSem as $grade)
                    <tr>
                        <td>
                            @if ($grade['subjectType'] === 'Core')
                                Core
                            @elseif ($grade['subjectType'] === 'Applied')
                                Applied
                            @elseif ($grade['subjectType'] === 'Specialized')
                                Specialized
                            @elseif ($grade['subjectType'] === 'Other_Subjects')
                                Other_Subjects
                            @endif
                        </td>
                        <td>{{ $grade['subject'] ?? '' }}</td>
                        <td>{{ $grade['midterm'] ?? 'N/A' }}</td>
                        <td>{{ $grade['finals'] ?? 'N/A' }}</td>
                        <td>asd</td>
                        <td>asd</td>
                    </tr>
                @endforeach
                <tr>
                    <td style="padding-bottom: 9px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: right; background-color: rgb(206, 222, 235);">
                        <strong>General Ave. for the Semester:</strong>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
            </table>

            <div class="scholastic-footer">
                <p style="margin-top: 5px;"><strong>REMARKS:</strong> <span class="tab"></span> <span
                        class="underline" style="width: 93.3%; margin-left: 50px"></span></p>
                <p>
                    <strong>Prepared By:
                        <span class="tab"></span> <span class="tab"></span> </span> <span
                            class="tab"></span> <span class="tab"></span> <span class="tab"></span>
                        Certified True and Correct:
                        <span class="tab"></span> <span class="tab"></span> <span class="tab"></span> <span
                            class="tab"></span> <span class="tab"></span> <span class="tab"></span> <span
                            class="tab"></span> <span class="tab"></span>
                        Date Checked (MM/DD/YYYY):</strong>
                </p>
                <p style="margin-top: 30px;">
                    <span style="border-top: 1px solid black; display: inline-block; width: 200px; text-align: center">
                        Signature of Adviser over Printed Name </span> <span class="tab"></span>
                    <span style="border-top: 1px solid black; display: inline-block; width: 320px; text-align: center">
                        Signature of Authorized Person over Printed Name, Designation </span> <span
                        class="tab"></span><span class="tab"></span>
                    <span style="border-top: 1px solid black; display: inline-block; width: 100px; text-align: center">
                        <span style="color: white;">Date</span> </span>
                </p>
            </div>

            <div class="remedial-classes">
                <p>
                    <strong>REMEDIAL CLASSES &nbsp;&nbsp; Conducted from (MM/DD/YYYY): <span class="underline"
                            style="width: 50px;"></span>
                        to (MM/DD/YYYY): <span class="underline" style="width: 50px;"></span>
                        SCHOOL: <span class="underline" style="width: 140px;"></span>
                        SCHOOL ID: <span class="underline" style="width: 55px;"></span></strong>
                </p>

                <table class="remidial-classes-table">
                    <tr>
                        <th style="width: 14%;">Indicate if Subject is CORE, APPLIED, or SPECIALIZED</th>
                        <th style="width: 50%;">SUBJECTS</th>
                        <th style="width: 9%;">SEMI FINAL GRADE</th>
                        <th style="width: 9%;">REMEDIAL CLASS MARK</th>
                        <th style="width: 9%;">RECOMPUTED FINAL GRADE</th>
                        <th style="width: 9%;">ACTION TAKEN</th>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 9px;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 9px;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 9px;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 9px;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>

                <p>Name of Teacher/Adviser: <span class="underline" style="width: 350px;"></span> <span
                        class="tab"></span> Signature: <span class="underline" style="width: 190px;"></span></p>
            </div>
        </div>

        <div>
            <div class="scholastic">
                <p><strong>SCHOOL:</strong> <span class="underline" style="width: 220px">Liceo De Bay</span>
                    <strong>SCHOOL ID:</strong> <span class="underline" style="width: 103px">402413</span>
                    <strong>GRADE LEVEL:</strong> <span class="underline" style="width: 70px">12</span>
                    <strong>SY:</strong> <span class="underline" style="width: 70px">{{ $grade122Sy }}</span>
                    <strong>SEM:</strong> <span class="underline" style="width: 40px">Second</span></p>
                <p><strong>TRACK/STRAND:</strong> <span class="underline" style="width: 365px">{{ $grade122Strand }}</span>
                    <strong>SECTION:</strong> <span class="underline" style="width: 235px">{{ $grade122Section }}</span></p>
            </div>

            <table class="scholastic-record">
                <tr>
                    <th rowspan="2" style="width: 14%;">Indicate if Subject is CORE, APPLIED, or SPECIALIZED</th>
                    <th rowspan="2" style="width: 50%;">SUBJECTS</th>
                    <th colspan="2">QUARTER</th>
                    <th rowspan="2" style="width: 9%;">SEMI FINAL GRADE</th>
                    <th rowspan="2" style="width: 9%;">ACTION TAKEN</th>
                </tr>
                <tr>
                    <th style="width: 9%;">1</th>
                    <th style="width: 9%;">2</th>
                </tr>
                @php
                    $grade12SecondSem = collect($gradesData)
                        ->where('gradeLevel', 'Grade 12')
                        ->where('semester', 'Second Semester');
                @endphp
                @foreach ($grade12SecondSem as $grade)
                    <tr>
                        <td>
                            @if ($grade['subjectType'] === 'Core')
                                Core
                            @elseif ($grade['subjectType'] === 'Applied')
                                Applied
                            @elseif ($grade['subjectType'] === 'Specialized')
                                Specialized
                            @elseif ($grade['subjectType'] === 'Other_Subjects')
                                Other_Subjects
                            @endif
                        </td>
                        <td>{{ $grade['subject'] ?? '' }}</td>
                        <td>{{ $grade['midterm'] ?? 'N/A' }}</td>
                        <td>{{ $grade['finals'] ?? 'N/A' }}</td>
                        <td>asd</td>
                        <td>asd</td>
                    </tr>
                @endforeach
                <tr>
                    <td style="padding-bottom: 9px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: right; background-color: rgb(206, 222, 235);">
                        <strong>General Ave. for the Semester:</strong>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
            </table>

            <div class="scholastic-footer">
                <p style="margin-top: 5px;"><strong>REMARKS:</strong> <span class="tab"></span> <span
                        class="underline" style="width: 93.3%; margin-left: 50px"></span></p>
                <p>
                    <strong>Prepared By:
                        <span class="tab"></span> <span class="tab"></span> </span> <span
                            class="tab"></span> <span class="tab"></span> <span class="tab"></span>
                        Certified True and Correct:
                        <span class="tab"></span> <span class="tab"></span> <span class="tab"></span> <span
                            class="tab"></span> <span class="tab"></span> <span class="tab"></span> <span
                            class="tab"></span> <span class="tab"></span>
                        Date Checked (MM/DD/YYYY):</strong>
                </p>
                <p style="margin-top: 30px;">
                    <span style="border-top: 1px solid black; display: inline-block; width: 200px; text-align: center">
                        Signature of Adviser over Printed Name </span> <span class="tab"></span>
                    <span style="border-top: 1px solid black; display: inline-block; width: 320px; text-align: center">
                        Signature of Authorized Person over Printed Name, Designation </span> <span
                        class="tab"></span><span class="tab"></span>
                    <span style="border-top: 1px solid black; display: inline-block; width: 100px; text-align: center">
                        <span style="color: white;">Date</span> </span>
                </p>
            </div>

            <div class="remedial-classes">
                <p>
                    <strong>REMEDIAL CLASSES &nbsp;&nbsp; Conducted from (MM/DD/YYYY): <span class="underline"
                            style="width: 50px;"></span>
                        to (MM/DD/YYYY): <span class="underline" style="width: 50px;"></span>
                        SCHOOL: <span class="underline" style="width: 140px;"></span>
                        SCHOOL ID: <span class="underline" style="width: 55px;"></span></strong>
                </p>

                <table class="remidial-classes-table">
                    <tr>
                        <th style="width: 14%;">Indicate if Subject is CORE, APPLIED, or SPECIALIZED</th>
                        <th style="width: 50%;">SUBJECTS</th>
                        <th style="width: 9%;">SEMI FINAL GRADE</th>
                        <th style="width: 9%;">REMEDIAL CLASS MARK</th>
                        <th style="width: 9%;">RECOMPUTED FINAL GRADE</th>
                        <th style="width: 9%;">ACTION TAKEN</th>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 9px;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 9px;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 9px;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 9px;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>

                <p>Name of Teacher/Adviser: <span class="underline" style="width: 350px;"></span> <span
                        class="tab"></span> Signature: <span class="underline" style="width: 190px;"></span></p>
            </div>
        </div>

        <div class="title">
            <p style="color: rgb(206, 222, 235); margin-top: -5px;">For Design</p>
        </div>

        <div class="track-accomplished">
            <p><strong>Track/Strand Accomplished: <span class="underline" style="width: 410px;"></span> <span
                        class="tab"></span> SHS General Average: <span class="underline"
                        style="width: 57px;"></span></strong></p>
            <p><strong>Awards/Honors Received: <span class="underline" style="width: 333px;"></span> <span
                        class="tab"></span> Date of SHS Graduation (MM/DD/YYYY): <span class="underline"
                        style="width: 70px;"></span></strong></p>
            <p style="margin-bottom: 30px;"><strong>Certified by: <span class="tab"></span> <span
                        class="tab"></span> <span class="tab"></span> <span class="tab"></span> <span
                        class="tab"></span> <span class="tab"></span> <span class="tab"></span> <span
                        class="tab"></span> <span class="tab"></span> <span class="tab"></span> <span
                        class="tab"></span> <span class="tab"></span> <span class="tab"></span> Place School
                    Seal Here:</strong></p>
            <p> <span
                    style="border-top: 1px solid black; display: inline-block; width: 220px; text-align: center">Signature
                    of School Head over Printed Name</span> <span class="tab"></span> <span
                    style="border-top: 1px solid black; display: inline-block; width: 150px; text-align: center">Date</span>
            </p>
        </div>

        <div class="note-bottom">
            <p><strong>NOTE:</strong></p>
            <p><em>This Permanent record or a photocopy of this permanent record that bears the seal of the school and
                    the original signature in ink of the School Head shall be considered valid for all legal purposes.
                    Any erasure or alteration made on this copy should be validated by the School Head</em></p>
            <p><em>If the student transfers to another school, the originating school should produce one (1) certified
                    true copy of this permanent record for safekeeping. The recieving school shall continue filling up
                    the original form.</em></p>
            <p><em>Upon graduation, the school from which the student graduated should keep the original form and
                    produce one (1) certified true copy for the Division Office.</em></p>
        </div>

        <div>
            <p style="margin-top: 0px;"><strong>REMARKS:</strong> (Please indicate the purpose for which this permanent
                record will be used)</p>
        </div>

        <div>
            <p><strong>Date Issued (MM/DD/YYYY) <span class="underline" style="width: 70px;"></span></strong></p>
        </div>
    </div>
</body>

</html>
