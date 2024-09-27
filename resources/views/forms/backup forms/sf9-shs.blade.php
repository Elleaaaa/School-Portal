<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Progress Report Card</title>

    <style>
        body {
            font-family: 'Times New Roman', Times, serif, sans-serif;
            font-size: 10px;
            margin: 0;
            padding: 0;
        }

        .underline {
            display: inline-block;
            border-bottom: 1px solid #000;
            width: 90px;
        }

        .long-underline {
            width: 200px;
        }

        .firstpage {
            width: 100%;
        }

        .left-firstPage {
            float: left;
            width: 49%;
        }

        .right-firstPage {
            float: right;
            width: 49%;
        }

        .attendance-table,
        .attendance-table th,
        .attendance-table td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .sign-box {
            width: 180px;
            border-top: 1px solid #000;
            text-align: center;
            margin-top: 30px;
            font-weight: bold;
        }

        .signature {
            width: 200px;
            border-top: 1px solid #000;
            font-weight: bold;
            text-align: center;
            float: right;
        }

        .tab {
            display: inline-block;
            width: 4em;
        }

        .right-title {
            text-transform: uppercase;
            font-size: 13px;
        }

        .right-header {
            text-align: center;
            font-size: 11px;
        }

        .parents-signature {
            font-size: 12px;
        }

        .transfer {
            font-size: 12px;
        }

        .transfer p {
            margin-bottom: -8px;
        }

        .cancellation {
            font-size: 12px;
        }

        .cancellation p {
            margin-bottom: -8px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .student-info p {
            text-align: left;
            font-size: 12px;
        }

        .progress {
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            font-size: 20px;
            font-weight: bold;
            color: blue;
            margin-bottom: -12px;
            margin-top: 30px;
        }

        .gradeTable {
            width: 100%;
        }

        .gradeTable,
        .gradeTable th,
        .gradeTable td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .gradeTable td {
            padding-top: 9px;
            padding-bottom: 9px;
        }

        .core-values,
        .core-values th,
        .core-values td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .verbal-description,
        .verbal-description th,
        .verbal-description td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .marking-table {
            text-align: center;
            width: 100%;
        }

        .grading-system-table {
            width: 100%;
        }

        .left-secondPage {
            float: left;
            width: 49%;
        }

        .right-secondPage {
            float: right;
            width: 49%;
        }
    </style>
</head>

<body>
    <div class="firstPage">
        <p class="text-center"><strong>DepEd SF9</strong></p>
        <div class="left-firstPage">
            <div>
                <p class="text-center" style="margin-bottom: 3px; font-size: 12px"><strong>ATTENDANCE RECORD</strong></p>
                <table class="attendance-table" style="font-size: 9px;">
                    <tr>
                        <td width="60px"></td>
                        <td class="text-center" width="15px">Aug</td>
                        <td class="text-center" width="15px">Sep</td>
                        <td class="text-center" width="15px">Oct</td>
                        <td class="text-center" width="15px">Nov</td>
                        <td class="text-center" width="15px">Dec</td>
                        <td class="text-center" width="15px">Jan</td>
                        <td class="text-center" width="15px">Feb</td>
                        <td class="text-center" width="15px">Mar</td>
                        <td class="text-center" width="15px">Apr</td>
                        <td class="text-center" width="15px">May</td>
                        <td class="text-center" width="15px">Jun</td>
                        <td class="text-center" width="15px">Jul</td>
                        <td class="text-center" width="30px"><strong>TOTAL</strong></td>
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

            <div class="parents-signature">
                <p class="text-center" style="font-size: 12px;"><strong>PARENT'S SIGNATURE</strong></p>
                <p><strong>First Quarter:</strong> <span class="underline" style="width: 240px"></span></p>
                <p><strong>Second Quarter:</strong> <span class="underline" style="width: 230px"></span></p>
                <p><strong>Third Quarter:</strong> <span class="underline" style="width: 235px"></span></p>
                <p><strong>Fourth Quarter:</strong> <span class="underline" style="width: 230px"></span></p>
            </div>

            <div class="transfer">
                <p class="text-center" style="padding: 5px 15px"><strong>CERTIFICATE OF TRANSFER</strong></p>
                <p>Eligible for transfer and Admission to Grade &nbsp;&nbsp;&nbsp;<span class="underline"></span></p>
                <p>Lacks subjects in &nbsp;&nbsp;&nbsp; <span class="underline long-underline"
                        style="width: 220px"></span></p>
                <p>Date: &nbsp;&nbsp;&nbsp; <span class="underline"></span></p>
                <p class="sign-box" style="text-align: center; margin-left: 130px;">Teacher</p>
                <p class="sign-box">Principal</p>
            </div>

            <div class="cancellation">
                <p style="padding: 15px 15px"><strong>CANCELLATION OF ELIGIBILITY TO TRANSFER</strong></p>
                <p>Has been admitted to &nbsp;&nbsp;&nbsp; <span class="underline long-underline"></span></p>
                <p>School &nbsp;&nbsp;&nbsp; <span class="underline long-underline" style="width: 268px"></span></p>
                <br />
                <br />
                <p class="sign-box" style="text-align: center;">Principal</p>
            </div>

        </div>

        <div class="right-firstpage">
            <div class="right-header">
                <div class="right-title">
                    <p>Republic of the Philippines</p>
                    <p style="font-weight: bold; margin: -10px 0px -10px 0px;">Department of Education</p>
                    <p style="margin-bottom: 30px;">Region IV-CALABARZON</p>
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
            </div>
            <div class="student-info text-left">
                <p><strong>Name:</strong> <span class="underline" style="width: 300px"></span></p>
                <p><strong>LRN:</strong> <span class="underline" style="width: 305px"></span></p>
                <p><strong>Birthday:</strong> <span class="underline" style="width: 100px;"></span>
                    <strong>Age:</strong> <span class="underline" style="width: 66px;"></span>
                    <strong>Sex:</strong> <span class="underline" style="width: 66px;"></span>
                </p>
                <p><strong>Grade:</strong> <span class="underline" style="width: 80px;"></span>
                    <strong>Section:</strong> <span class="underline" style="width: 175px"></span>
                </p>
            </div>

            <div style="font-size: 12px;">
                <p><strong>Dear Parent,</strong></p>
                <p><span class="tab"></span>This report card shows the ability and
                    progress your child has made in the
                    different learning areas as well as his/her progress in character development. <br /> <span
                        class="tab"></span>The
                    school welcomes you if you desire to know more about the progress of your child.</p>
            </div>
            <div style="font-size: 12px;">
                <br />
                <p class="signature">Adviser</p>
                <br />
                <br />
                <br />
                <p
                    style="width: 200px; text-align: center; border-top: 1px solid #000; float: left; font-weight: bold;">
                    Principal</p>
            </div>
        </div>

    </div>

    <div style="page-break-before: always;"></div>

    <div class="secondPage">
        <div>
            <p>NAME: <span class="underline long-underline"></span></p>
        </div>

        <div class="left-secondPage">
            <p><strong>REPORT ON LEARNING PROGRESS AND ACHIEVEMENT</strong></p>
            <p style="margin-bottom: 0px"><strong>First Semester</strong></p>
            <table class="gradeTable">
                <tr>
                    <th rowspan="2">SUBJECT TITLE</th>
                    <th colspan="2">Quarter</th>
                    <th rowspan="2" style="font-weight: normal; font-size: 9px">Semester <br /> Final Grade</th>
                </tr>
                <tr>
                    <td class="text-center" style="padding: 0px !important;">
                        <div><strong>1</strong></div>
                    </td>
                    <td class="text-center" style="padding: 0px !important;">
                        <div><strong>2</strong></div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="padding: 0px 0px !important;">Homeroom Guidance</td>
                    <td style="padding: 0px 0px !important;"></td>
                    <td style="padding: 0px 0px !important;"></td>
                    <td style="padding: 0px 0px !important;"></td>
                </tr>
                <tr>
                    <td class="text-right" colspan="3" style="padding: 0px 0px !important;"><strong>General
                            Average for the Semester <span class="tab"></span></strong></td>
                    <td style="padding: 0px 0px !important;"></td>
                </tr>
                <tr>
                    <td class="text-right" colspan="4" style="padding: 0px !important;">
                        <div><strong>Teacher's Initial &nbsp;</strong><span class="underline"></span></div>
                    </td>
                </tr>
            </table>

            {{-- SECOND SEMESTER --}}
            <p style="margin-bottom: 0px"><strong>Second Semester</strong></p>
            <table class="gradeTable">
                <tr>
                    <th rowspan="2">SUBJECT TITLE</th>
                    <th colspan="2">Quarter</th>
                    <th rowspan="2" style="font-weight: normal; font-size: 9px">Semester <br /> Final Grade</th>
                </tr>
                <tr>
                    <td class="text-center" style="padding: 0px !important;">
                        <div><strong>3</strong></div>
                    </td>
                    <td class="text-center" style="padding: 0px !important;">
                        <div><strong>4</strong></div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="padding: 0px 0px !important;">Homeroom Guidance</td>
                    <td style="padding: 0px 0px !important;"></td>
                    <td style="padding: 0px 0px !important;"></td>
                    <td style="padding: 0px 0px !important;"></td>
                </tr>
                <tr>
                    <td class="text-right" colspan="3" style="padding: 0px 0px !important;"><strong>General
                            Average
                            for the Semester <span class="tab"></span></strong></td>
                    <td style="padding: 0px 0px !important;"></td>
                </tr>
                <tr>
                    <td class="text-right" colspan="4" style="padding: 0px !important;">
                        <div><strong>Teacher's Initial &nbsp;</strong><span class="underline"></span></div>
                    </td>
                </tr>
            </table>

        </div>

        <div class="right-secondPage">
            <p><strong>REPORT ON LEARNING PROGRESS AND ACHIEVEMENT</strong></p>
            <br />
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
                <table class="marking-table">
                    <tr>
                        <th>Marking</th>
                        <th>Non-numerical Rating</th>
                    </tr>
                    <tr>
                        <td>AO</td>
                        <td>Always Observed</td>
                    </tr>
                    <tr>
                        <td>SO</td>
                        <td>Sometimes Observed</td>
                    </tr>
                    <tr>
                        <td>RO</td>
                        <td>Rarely Observed</td>
                    </tr>
                    <tr>
                        <td>NO</td>
                        <td>Not Obeserved</td>
                    </tr>
                </table>
            </div>

            <div style="margin-left: 30px;">
                <p>Grading System: <strong>AVERAGING</strong></p>
            </div>

            <div style="margin-left: 30px;">
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
                <p><strong>Verbal Description (HG)</strong></p>
                <table class="verbal-description">
                    <tr>
                        <td>Needs Improvement</td>
                        <td class="text-center">NI</td>
                        <td>The learner has not acquired the target competencies</td>
                    </tr>
                    <tr>
                        <td>Developing</td>
                        <td class="text-center">D</td>
                        <td>The learner acquired some of the target competency</td>
                    </tr>
                    <tr>
                        <td>Sufficiently Developed</td>
                        <td class="text-center">SD</td>
                        <td>The learner acquired the target competency</td>
                    </tr>
                    <tr>
                        <td>Developed and Commendable</td>
                        <td class="text-center">DC</td>
                        <td>The learner acquired the target competency and showed comendable application in real life
                            situation</td>
                    </tr>
                </table>
            </div>
        </div>


    </div>
</body>

</html>
