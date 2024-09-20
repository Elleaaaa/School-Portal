<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
    body {
        font-family: Arial, Helvetica, sans-serif; /* Use common sans-serif fonts */
        font-size: 10px;
        margin: 0;
        padding: 0;
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

    .eligibility p input{
      font-size: 12px;
      vertical-align: middle;
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
                <p style="font-size: 14px; font-weight: bold;">Learner Permanent Record  for Junior High School (SF10-JHS)</p>
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

        <div>
            <p style="margin: 5px 0px;">LAST NAME: &nbsp;<span class="underline"></span> &nbsp;&nbsp; FIRST NAME: &nbsp;<span class="underline"></span> &nbsp;&nbsp; NAME EXT. (Jr,I,II): &nbsp;<span class="underline" style="width: 40px;"></span> &nbsp;&nbsp; MIDDLE NAME: &nbsp;<span class="underline"></span></p>
            <p style="margin: 5px 0px;">Learner Reference Number (LRN): &nbsp;<span class="underline"></span> &nbsp; <span class="tab"></span> Birthdate (mm/dd/yyyy): &nbsp;<span class="underline"></span> <span class="tab"></span>&nbsp; Sex: &nbsp;<span class="underline"></span></p>
        </div>

        <div class="title">
            <h3>ELIGIBILITY FOR JHS ENROLLMENT</h3>
        </div>

        <div class="eligibility">
            <p<input type="checkbox" checked> Elementary School Completer <span class="tab"></span><span class="tab"></span> &nbsp;&nbsp;&nbsp;General Average: <span class="underline" style="width: 50px;"></span> <span class="tab"></span> <span class="tab"></span> &nbsp;&nbsp; Citation (if Any): <span class="underline" style="width: 198px;"></span></p>
            <p>Name of Elementary School: <span class="underline" style="width: 180px;"></span> <span class="tab"></span> School ID: <span class="underline" style="width: 50px;"></span> <span class="tab"></span> Address of School: <span class="underline" style="width: 143px;"></span></p>
        </div>
        <div>
            <p>Other Credential Presented</p>
            {{-- <p>
            <input type="checkbox" > PEPT Passer &nbsp;&nbsp;&nbsp;
                Rating: <span class="underline" style="width: 50px;"> &nbsp;&nbsp;&nbsp;
                <input type="checkbox" > ALS A & E Passer &nbsp;&nbsp;&nbsp;
                Rating: <span class="underline" style="width: 50px;"></span> &nbsp;&nbsp;&nbsp;
                <input type="checkbox" > Others (Pls. Specify): <span class="underline" style="width: 50px;">
            </p> --}}
           <table>
               <tr>
                <td></td>
               </tr>
           </table>
        </div>
                
    </div>
</body>
</html>