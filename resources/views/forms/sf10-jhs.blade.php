<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            /* Use common sans-serif fonts */
            font-size: 10px;
            margin: 0;
            padding: 0;
        }

        @page {
            margin-bottom: 0px;
            margin-top: 5px;
        }

        .header p {
            margin: 0px;
        }

        .title {
            width: 100%;
            border: 1px solid black;
            text-align: center;
            background-color: antiquewhite;
        }

        .title h3 {
            margin: 1px;
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

        .eligibility {
            width: 100%;
            border: solid 1px black;
            margin-top: 2px;
        }

        .eligibility p {
            margin-top: 1px;
            margin-bottom: 1px;
            margin-left: 10px;
        }

        .eligibility p input {
            font-size: 12px;
            vertical-align: middle;
        }

        .other-credentials {
            width: 100%;
            border-collapse: collapse;
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
            margin-left: 11px;
        }

        /* Ensuring the paragraph aligns with inline content */
        .other-credentials p {
            display: inline;
            margin: 0;
            vertical-align: middle;
        }

        .scholastic-record,
        .scholastic-record th,
        .scholastic-record td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .scholastic-record td {
            font-size: 10px;
        }

        .scholastic-record {
            width: 100%;
            margin-top: 5px;
        }

        .certification {
            width: 100%;
            border: 1px solid black;
        }

        .student-info-record span {
            text-align: center;
            font-size: 9px;
        }

        .second-page .scholastic-record td {
            font-size: 8.5px;
        }

        .second-page .scholastic-record th {
            font-size: 9px;
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
                <p style="font-size: 14px; font-weight: bold;">Learner Permanent Record for Junior High School
                    (SF10-JHS)</p>
            </div>
            <div style="float: right;">
                <img src="{{ $imagelogo1 }}" style="width: 75px;" alt="Logo">
            </div>
        </div>

        {{-- Clear the float --}}
        <div style="clear: both;"></div>

        <p class="text-center" style="margin: 0px;"><em>(Formerly Form 137)</em></p>
        <div class="title">
            <h3>LEARNER'S INFORMATION</h3>
        </div>

        <div style="font-size: 9px;">
            <p style="margin: 5px 0px;">
                LAST NAME: &nbsp;<span class="underline" style="width: 130px;">{{ $lastName }}</span> &nbsp;&nbsp;
                FIRST NAME: &nbsp;<span class="underline" style="width: 130px;">{{ $firstName }}</span> &nbsp;&nbsp;
                NAME EXT. (Jr,I,II): &nbsp;<span class="underline" style="width: 40px;">{{ $suffixName }}</span>
                &nbsp;&nbsp;
                MIDDLE NAME: &nbsp;<span class="underline" style="width: 120px;">{{ $middleName }}</span></p>
            <p style="margin: 5px 0px;">
                Learner Reference Number (LRN): &nbsp;<span class="underline"
                    style="width: 140px;">{{ $LRN }}</span> &nbsp; <span class="tab"></span> Birthdate
                (mm/dd/yyyy): &nbsp;<span class="underline" style="width: 128px;">{{ $birthday }}</span> <span
                    class="tab"></span>&nbsp;
                Sex: &nbsp;<span class="underline">{{ $sex }}</span></p>
        </div>

        <div class="title">
            <h3>ELIGIBILITY FOR JHS ENROLLMENT</h3>
        </div>

        <div class="eligibility">
            <p<input type="checkbox" checked style="vertical-align: bottom;"> Elementary School Completer <span
                    class="tab"></span><span class="tab"></span> &nbsp;&nbsp;&nbsp;General Average: <span
                    class="underline" style="width: 50px;"></span> <span class="tab"></span> <span
                    class="tab"></span> &nbsp;&nbsp; Citation (if Any): <span class="underline"
                    style="width: 204px;"></span></p>
                <p>Name of Elementary School: <span class="underline" style="width: 160px;"></span> <span
                        class="tab"></span> School ID: <span class="underline" style="width: 50px;"></span> <span
                        class="tab"></span> Address of School: <span class="underline" style="width: 163px;"></span>
                </p>
        </div>
        <div>
            <p style="margin: 1px 0px">Other Credential Presented</p>
            <table class="other-credentials" style="padding: 0px;">
                <tr>
                    <td style="padding: 0px;"><input type="checkbox"> PEPT Passer &nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td style="padding: 0px;">Rating: <span class="underline" style="width: 60px;"></span> <span
                            class="tab"></span> &nbsp;&nbsp;</td>
                    <td style="padding: 0px;"><input type="checkbox"> ALS A & E Passer &nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td style="padding: 0px;">Rating: <span class="underline" style="width: 60px;"></span> <span
                            class="tab"></span> &nbsp;&nbsp;</td>
                    <td style="padding: 0px;"><input type="checkbox"> Others (Pls. Specify): <span class="underline"
                            style="width: 90px;"></span></td>
                </tr>
            </table>
            <p style="margin: 0px 0px 0px 30px">Date of Examination/Assessment (mm/dd/yyyy): <span class="underline"
                    style="width: 125px;"></span> <span class="tab"></span> Name and Address of Testing Center: <span
                    class="underline" style="width: 145px;"></span></p>
        </div>

        <div class="title" style="margin-top: 15px;">
            <h3>SCHOLASTIC RECORD</h3>
        </div>

        <table class="scholastic-record">
            <tr>
                <th colspan="8" class="text-left student-info-record" style="font-size: 9px; font-weight: normal;">
                    <p style="margin: 3px 0px;">School: <span class="underline" style="width: 150px"></span>
                        &nbsp;&nbsp; School ID: <span class="underline" style="width: 80px"></span> &nbsp;&nbsp;
                        District: <span class="underline"></span> &nbsp;&nbsp; Division: <span class="underline"></span>
                        &nbsp;&nbsp; Region: <span class="underline" style="width: 42px;"></span></p>
                    <p style="margin: 0px 0px;">
                        Classified as Grade: <span class="underline" style="width: 50px;">7</span> &nbsp;&nbsp;
                        Section: <span class="underline" style="width: 50px"></span> &nbsp;&nbsp;
                        School Year: <span class="underline" style="width: 50px"></span>
                        &nbsp;&nbsp;
                        Name of Adviser/Teacher: <span class="underline"></span> &nbsp;&nbsp;
                        Signature: <span class="underline" style="width: 93px"></span></p>
                </th>
            </tr>
            <tr>
                <th rowspan="2" colspan="2">LEARNING AREAS</th>
                <th colspan="4">Quarterly Rating</th>
                <th rowspan="2" style="width: 70px;">FINAL RATING</th>
                <th rowspan="2" style="width: 160px;">REMARKS</th>
            </tr>
            <tr>
                <td class="text-center" style="width: 60px;"><strong>1</strong></td>
                <td class="text-center" style="width: 60px;"><strong>2</strong></td>
                <td class="text-center" style="width: 60px;"><strong>3</strong></td>
                <td class="text-center" style="width: 60px;"><strong>4</strong></td>
            </tr>
            {{-- GRADE 7 RECORD --}}
            @php
                // Ensure $gradesData is a collection
                $gradesForGrade7 = collect($gradesData)->where('gradeLevel', 'Grade 7');
            @endphp
            @foreach ($gradesForGrade7 as $grade)
                <tr>
                    <td colspan="2">{{ $grade['subject'] ?? '' }}</td>
                    <td>{{ $grade['firstQGrade'] ?? 'N/A' }}</td>
                    <td>{{ $grade['secondQGrade'] ?? 'N/A' }}</td>
                    <td>{{ $grade['thirdQGrade'] ?? 'N/A' }}</td>
                    <td>{{ $grade['fourthQGrade'] ?? 'N/A' }}</td>
                    <td>{{ $grade['average'] ?? 'N/A' }}</td>
                    <td>{{ $grade['average'] >= 75 ? 'Passed' : 'Failed' }}</td>
                </tr>
            @endforeach

            <tr>
                <td colspan="2" style="padding: 6px;"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 6px;"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="4" class="text-center"><strong><em>General Average</em></strong></td>
                <td style="text-align: right"></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="8" style="background-color: antiquewhite; padding: 2px"></td>
            </tr>
            <tr>
                <td colspan="8">
                    <p style="margin-bottom: 0px; margin-left: 30px; font-weight: bold">Remedial Classes <span
                            class="tab"></span> Conducted from (mm/dd/yyyy) &nbsp; <span class="underline"></span>
                        &nbsp; to (mm/dd/yyyy) &nbsp; <span class="underline"></span></p>
                </td>
            </tr>
            <tr class="text-center" style="font-weight: bold">
                <td>Learning Areas</td>
                <td>Final Rating</td>
                <td colspan="3">Remedial Class Mark</td>
                <td colspan="2">Recomputed Final Grade</td>
                <td>Remarks</td>
            </tr>
            <tr>
                <td style="padding: 6px;"></td>
                <td></td>
                <td colspan="3"></td>
                <td colspan="2"></td>
                <td></td>
            </tr>
            <tr>
                <td style="padding: 6px;"></td>
                <td></td>
                <td colspan="3"></td>
                <td colspan="2"></td>
                <td></td>
            </tr>
        </table>

        <table class="scholastic-record">
            <tr>
                <th colspan="8" class="text-left student-info-record"
                    style="font-size: 9px; font-weight: normal;">
                    <p style="margin: 3px 0px;">School: <span class="underline" style="width: 150px"></span>
                        &nbsp;&nbsp; School ID: <span class="underline" style="width: 80px"></span> &nbsp;&nbsp;
                        District: <span class="underline"></span> &nbsp;&nbsp; Division: <span
                            class="underline"></span> &nbsp;&nbsp; Region: <span class="underline"
                            style="width: 42px;"></span></p>
                    <p style="margin: 0px 0px;">Classified as Grade: <span class="underline"
                            style="width: 50px;">8</span> &nbsp;&nbsp; Section: <span class="underline"
                            style="width: 50px"></span> &nbsp;&nbsp; School Year: <span class="underline"
                            style="width: 50px"></span> &nbsp;&nbsp; Name of Adviser/Teacher: <span
                            class="underline"></span> &nbsp;&nbsp; Signature: <span class="underline"
                            style="width: 93px"></span></p>
                </th>
            </tr>
            <tr>
                <th rowspan="2" colspan="2">LEARNING AREAS</th>
                <th colspan="4">Quarterly Rating</th>
                <th rowspan="2" style="width: 70px;">FINAL RATING</th>
                <th rowspan="2" style="width: 160px;">REMARKS</th>
            </tr>
            <tr>
                <td class="text-center" style="width: 60px;"><strong>1</strong></td>
                <td class="text-center" style="width: 60px;"><strong>2</strong></td>
                <td class="text-center" style="width: 60px;"><strong>3</strong></td>
                <td class="text-center" style="width: 60px;"><strong>4</strong></td>
            </tr>
            {{-- GRADE 7 RECORD --}}
            @php
                // Ensure $gradesData is a collection
                $gradesForGrade8 = collect($gradesData)->where('gradeLevel', 'Grade 8');
            @endphp
            @foreach ($gradesForGrade8 as $grade)
                <tr>
                    <td colspan="2">{{ $grade['subject'] ?? '' }}</td>
                    <td>{{ $grade['firstQGrade'] ?? 'N/A' }}</td>
                    <td>{{ $grade['secondQGrade'] ?? 'N/A' }}</td>
                    <td>{{ $grade['thirdQGrade'] ?? 'N/A' }}</td>
                    <td>{{ $grade['fourthQGrade'] ?? 'N/A' }}</td>
                    <td>{{ $grade['average'] ?? 'N/A' }}</td>
                    <td>{{ $grade['average'] >= 75 ? 'Passed' : 'Failed' }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2" style="padding: 6px;"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 6px;"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="4" class="text-center"><strong><em>General Average</em></strong></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="8" style="background-color: antiquewhite; padding: 2px"></td>
            </tr>
            <tr>
                <td colspan="8">
                    <p style="margin-bottom: 0px; margin-left: 30px; font-weight: bold">Remedial Classes <span
                            class="tab"></span> Conducted from (mm/dd/yyyy) &nbsp; <span class="underline"></span>
                        &nbsp; to (mm/dd/yyyy) &nbsp; <span class="underline"></span></p>
                </td>
            </tr>
            <tr class="text-center" style="font-weight: bold">
                <td>Learning Areas</td>
                <td>Final Rating</td>
                <td colspan="3">Remedial Class Mark</td>
                <td colspan="2">Recomputed Final Grade</td>
                <td>Remarks</td>
            </tr>
            <tr>
                <td style="padding: 6px;"></td>
                <td></td>
                <td colspan="3"></td>
                <td colspan="2"></td>
                <td></td>
            </tr>
            <tr>
                <td style="padding: 6px;"></td>
                <td></td>
                <td colspan="3"></td>
                <td colspan="2"></td>
                <td></td>
            </tr>
        </table>



        <div class="title" style="margin-top: 15px;">
            <h3>CERTIFICATION</h3>
        </div>
        <div class="certification">
            <table class="certification-table">
                <tr>
                    <td>
                        <p style="margin-bottom: 3px">I CERTIFY that this is a true record of <span
                                class="underline"></span> &nbsp;&nbsp; with LRN <span class="underline"></span>
                            &nbsp;&nbsp; and that he/she is eligible for admission to Grade <span class="underline"
                                style="width: 34px;"></span></p>
                        <p style="margin-top: 0px;">Name of School: <span class="underline"
                                style="width: 200px;"></span> School ID: <span class="underline"></span> Last School
                            Year Attended: <span class="underline"></span></p>
                        <p style="margin-top: 40px; margin-bottom: 0px;"><span
                                style="border-top: 1px solid #000; width: 150px; display: inline-block; text-align: center;">Date</span>
                            <span class="tab"></span> <span class="tab"></span><span
                                style="border-top: 1px solid #000; width: 300px; display: inline-block; text-align: center;">Signature
                                of Principal/School Head over Printed Name</span> <span class="tab"></span><span
                                class="tab"></span> (Affix School Seal Here)
                        </p>
                    </td>
                </tr>
            </table>
        </div>

        {{-- SECOND PAGE --}}
        <div style="page-break-before: always;"></div>

        <div class="second-page">
            <table class="scholastic-record">
                <tr>
                    <th colspan="8" class="text-left student-info-record"
                        style="font-size: 9px; font-weight: normal;">
                        <p style="margin: 3px 0px;">School: <span class="underline" style="width: 150px"></span>
                            &nbsp;&nbsp; School ID: <span class="underline" style="width: 80px"></span> &nbsp;&nbsp;
                            District: <span class="underline"></span> &nbsp;&nbsp; Division: <span
                                class="underline"></span> &nbsp;&nbsp; Region: <span class="underline"
                                style="width: 42px;"></span></p>
                        <p style="margin: 0px 0px;">Classified as Grade: <span class="underline"
                                style="width: 50px;">9</span> &nbsp;&nbsp; Section: <span class="underline"
                                style="width: 50px"></span> &nbsp;&nbsp; School Year: <span class="underline"
                                style="width: 50px"></span> &nbsp;&nbsp; Name of Adviser/Teacher: <span
                                class="underline"></span> &nbsp;&nbsp; Signature: <span class="underline"
                                style="width: 93px"></span></p>
                    </th>
                </tr>
                <tr>
                    <th rowspan="2" colspan="2">LEARNING AREAS</th>
                    <th colspan="4">Quarterly Rating</th>
                    <th rowspan="2" style="width: 70px;">FINAL RATING</th>
                    <th rowspan="2" style="width: 160px;">REMARKS</th>
                </tr>
                <tr>
                    <td class="text-center" style="width: 60px;"><strong>1</strong></td>
                    <td class="text-center" style="width: 60px;"><strong>2</strong></td>
                    <td class="text-center" style="width: 60px;"><strong>3</strong></td>
                    <td class="text-center" style="width: 60px;"><strong>4</strong></td>
                </tr>
                {{-- GRADE 9 RECORD --}}
                @php
                    // Ensure $gradesData is a collection
                    $gradesForGrade9 = collect($gradesData)->where('gradeLevel', 'Grade 9');
                @endphp
                @foreach ($gradesForGrade9 as $grade)
                    <tr>
                        <td colspan="2">{{ $grade['subject'] ?? '' }}</td>
                        <td>{{ $grade['firstQGrade'] ?? 'N/A' }}</td>
                        <td>{{ $grade['secondQGrade'] ?? 'N/A' }}</td>
                        <td>{{ $grade['thirdQGrade'] ?? 'N/A' }}</td>
                        <td>{{ $grade['fourthQGrade'] ?? 'N/A' }}</td>
                        <td>{{ $grade['average'] ?? 'N/A' }}</td>
                        <td>{{ $grade['average'] >= 75 ? 'Passed' : 'Failed' }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2" style="padding: 6px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 6px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="4" class="text-center"><strong><em>General Average</em></strong></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="8" style="background-color: antiquewhite; padding: 2px"></td>
                </tr>
                <tr>
                    <td colspan="8">
                        <p style="margin-bottom: 0px; margin-left: 30px; font-weight: bold">Remedial Classes <span
                                class="tab"></span> Conducted from (mm/dd/yyyy) &nbsp; <span
                                class="underline"></span> &nbsp; to (mm/dd/yyyy) &nbsp; <span
                                class="underline"></span></p>
                    </td>
                </tr>
                <tr class="text-center" style="font-weight: bold">
                    <td>Learning Areas</td>
                    <td>Final Rating</td>
                    <td colspan="3">Remedial Class Mark</td>
                    <td colspan="2">Recomputed Final Grade</td>
                    <td>Remarks</td>
                </tr>
                <tr>
                    <td style="padding: 6px;"></td>
                    <td></td>
                    <td colspan="3"></td>
                    <td colspan="2"></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="padding: 6px;"></td>
                    <td></td>
                    <td colspan="3"></td>
                    <td colspan="2"></td>
                    <td></td>
                </tr>
            </table>

            <table class="scholastic-record">
                <tr>
                    <th colspan="8" class="text-left student-info-record"
                        style="font-size: 9px; font-weight: normal;">
                        <p style="margin: 3px 0px;">School: <span class="underline" style="width: 150px"></span>
                            &nbsp;&nbsp; School ID: <span class="underline" style="width: 80px"></span> &nbsp;&nbsp;
                            District: <span class="underline"></span> &nbsp;&nbsp; Division: <span
                                class="underline"></span> &nbsp;&nbsp; Region: <span class="underline"
                                style="width: 42px;"></span></p>
                        <p style="margin: 0px 0px;">Classified as Grade: <span class="underline"
                                style="width: 50px;">10</span> &nbsp;&nbsp; Section: <span class="underline"
                                style="width: 50px"></span> &nbsp;&nbsp; School Year: <span class="underline"
                                style="width: 50px"></span> &nbsp;&nbsp; Name of Adviser/Teacher: <span
                                class="underline"></span> &nbsp;&nbsp; Signature: <span class="underline"
                                style="width: 93px"></span></p>
                    </th>
                </tr>
                <tr>
                    <th rowspan="2" colspan="2">LEARNING AREAS</th>
                    <th colspan="4">Quarterly Rating</th>
                    <th rowspan="2" style="width: 70px;">FINAL RATING</th>
                    <th rowspan="2" style="width: 160px;">REMARKS</th>
                </tr>
                <tr>
                    <td class="text-center" style="width: 60px;"><strong>1</strong></td>
                    <td class="text-center" style="width: 60px;"><strong>2</strong></td>
                    <td class="text-center" style="width: 60px;"><strong>3</strong></td>
                    <td class="text-center" style="width: 60px;"><strong>4</strong></td>
                </tr>
                {{-- GRADE 10 RECORD --}}
                @php
                    // Ensure $gradesData is a collection
                    $gradesForGrade10 = collect($gradesData)->where('gradeLevel', 'Grade 10');
                @endphp
                @foreach ($gradesForGrade10 as $grade)
                    <tr>
                        <td colspan="2">{{ $grade['subject'] ?? '' }}</td>
                        <td>{{ $grade['firstQGrade'] ?? 'N/A' }}</td>
                        <td>{{ $grade['secondQGrade'] ?? 'N/A' }}</td>
                        <td>{{ $grade['thirdQGrade'] ?? 'N/A' }}</td>
                        <td>{{ $grade['fourthQGrade'] ?? 'N/A' }}</td>
                        <td>{{ $grade['average'] ?? 'N/A' }}</td>
                        <td>{{ $grade['average'] >= 75 ? 'Passed' : 'Failed' }}</td>
                    </tr>
                @endforeach

                <tr>
                    <td colspan="2" style="padding: 6px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 6px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="4" class="text-center"><strong><em>General Average</em></strong></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="8" style="background-color: antiquewhite; padding: 2px"></td>
                </tr>
                <tr>
                    <td colspan="8">
                        <p style="margin-bottom: 0px; margin-left: 30px; font-weight: bold">Remedial Classes <span
                                class="tab"></span> Conducted from (mm/dd/yyyy) &nbsp; <span
                                class="underline"></span> &nbsp; to (mm/dd/yyyy) &nbsp; <span
                                class="underline"></span></p>
                    </td>
                </tr>
                <tr class="text-center" style="font-weight: bold">
                    <td>Learning Areas</td>
                    <td>Final Rating</td>
                    <td colspan="3">Remedial Class Mark</td>
                    <td colspan="2">Recomputed Final Grade</td>
                    <td>Remarks</td>
                </tr>
                <tr>
                    <td style="padding: 6px;"></td>
                    <td></td>
                    <td colspan="3"></td>
                    <td colspan="2"></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="padding: 6px;"></td>
                    <td></td>
                    <td colspan="3"></td>
                    <td colspan="2"></td>
                    <td></td>
                </tr>
            </table>

            <table class="scholastic-record">
                <tr>
                    <th colspan="8" class="text-left student-info-record"
                        style="font-size: 9px; font-weight: normal;">
                        <p style="margin: 3px 0px;">School: <span class="underline" style="width: 150px"></span>
                            &nbsp;&nbsp; School ID: <span class="underline" style="width: 80px"></span> &nbsp;&nbsp;
                            District: <span class="underline"></span> &nbsp;&nbsp; Division: <span
                                class="underline"></span> &nbsp;&nbsp; Region: <span class="underline"
                                style="width: 42px;"></span></p>
                        <p style="margin: 0px 0px;">Classified as Grade: <span class="underline"
                                style="width: 50px;"></span> &nbsp;&nbsp; Section: <span class="underline"
                                style="width: 50px"></span> &nbsp;&nbsp; School Year: <span class="underline"
                                style="width: 50px"></span> &nbsp;&nbsp; Name of Adviser/Teacher: <span
                                class="underline"></span> &nbsp;&nbsp; Signature: <span class="underline"
                                style="width: 93px"></span></p>
                    </th>
                </tr>
                <tr>
                    <th rowspan="2" colspan="2">LEARNING AREAS</th>
                    <th colspan="4">Quarterly Rating</th>
                    <th rowspan="2" style="width: 70px;">FINAL RATING</th>
                    <th rowspan="2" style="width: 160px;">REMARKS</th>
                </tr>
                <tr>
                    <td class="text-center" style="width: 60px;"><strong>1</strong></td>
                    <td class="text-center" style="width: 60px;"><strong>2</strong></td>
                    <td class="text-center" style="width: 60px;"><strong>3</strong></td>
                    <td class="text-center" style="width: 60px;"><strong>4</strong></td>
                </tr>
                <tr>
                    <td colspan="2"> <strong>Religion</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Filipino</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>English</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Mathematics</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Science</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Araling Panlipunan</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Technology and Livelihood Education (TLE)</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>MAPEH</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-left: 10px;"><em>Music</em></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="background-color: antiquewhite"></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-left: 10px;"><em>Arts</em></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="background-color: antiquewhite"></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-left: 10px;"><em>Physical Education</em></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="background-color: antiquewhite"></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-left: 10px;"><em>Health</em></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="background-color: antiquewhite"></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Edukasyon sa Pagpapakatao (EsP)</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Information Communication technology (ICT)</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 6px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 6px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="4" class="text-center"><strong><em>General Average</em></strong></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="8" style="background-color: antiquewhite; padding: 2px"></td>
                </tr>
                <tr>
                    <td colspan="8">
                        <p style="margin-bottom: 0px; margin-left: 30px; font-weight: bold">Remedial Classes <span
                                class="tab"></span> Conducted from (mm/dd/yyyy) &nbsp; <span
                                class="underline"></span> &nbsp; to (mm/dd/yyyy) &nbsp; <span
                                class="underline"></span></p>
                    </td>
                </tr>
                <tr class="text-center" style="font-weight: bold">
                    <td>Learning Areas</td>
                    <td>Final Rating</td>
                    <td colspan="3">Remedial Class Mark</td>
                    <td colspan="2">Recomputed Final Grade</td>
                    <td>Remarks</td>
                </tr>
                <tr>
                    <td style="padding: 6px;"></td>
                    <td></td>
                    <td colspan="3"></td>
                    <td colspan="2"></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="padding: 6px;"></td>
                    <td></td>
                    <td colspan="3"></td>
                    <td colspan="2"></td>
                    <td></td>
                </tr>
            </table>

            <div class="title" style="margin-top: 15px;">
                <h3>CERTIFICATION</h3>
            </div>
            <div class="certification">
                <table class="certification-table">
                    <tr>
                        <td>
                            <p style="margin-bottom: 3px">I CERTIFY that this is a true record of <span
                                    class="underline"></span> &nbsp;&nbsp; with LRN <span class="underline"></span>
                                &nbsp;&nbsp; and that he/she is eligible for admission to Grade <span class="underline"
                                    style="width: 34px;"></span></p>
                            <p style="margin-top: 0px;">Name of School: <span class="underline"
                                    style="width: 200px;"></span> School ID: <span class="underline"></span> Last
                                School Year Attended: <span class="underline"></span></p>
                            <p style="margin-top: 40px; margin-bottom: 0px;"><span
                                    style="border-top: 1px solid #000; width: 150px; display: inline-block; text-align: center;">Date</span>
                                <span class="tab"></span> <span class="tab"></span><span
                                    style="border-top: 1px solid #000; width: 300px; display: inline-block; text-align: center;">Signature
                                    of Principal/School Head over Printed Name</span> <span class="tab"></span><span
                                    class="tab"></span> (Affix School Seal Here)
                            </p>
                        </td>
                    </tr>
                </table>
            </div>

        </div>

    </div>
</body>

</html>
