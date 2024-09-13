<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Good Moral</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .letter-container {
            font-family: 'Times New Roman', Times, serif;
            padding-left: 20mm;
            padding-right: 20mm;
            font-size: 12pt;
        }

        .header {
            font-family: 'Cinzel', serif;
            position: relative;
            text-align: center;
            margin-bottom: 20px;
            color: blue;
        }

        .header img {
            max-width: 100px;
            /* Adjust image size */
        }

        .logo-left {
            float: left;
            width: 10%;
        }

        .logo-right {
            float: right;
            width: 10%;
        }

        .logo-center {
            display: inline-block;
            text-align: center;
            padding-top: 10px;
            margin-left: -50px;
            text-transform: uppercase;
            font-size: 15px;
            width: 80%;
        }

        .title {
            text-align: center;
            font-size: 16pt;
            font-weight: bold;
            margin-bottom: 15mm;
            padding-top: 20mm;
            padding-bottom: 20mm;
        }

        .content {
            margin-bottom: 20mm;
        }

        .date,
        .to,
        .details {
            display: block;
            margin-bottom: 10mm;
        }

        .OIC {
            display: block;
            margin-right: 10mm;
            margin-top: -5mm;
        }

        .signature {
            text-align: right;
            margin-bottom: 20mm;
        }

        .footer {
            text-align: left;
            font-size: 10pt;
            font-style: italic;
        }

        .title-liceo {
            font-size: 30px;
            margin: 0;
            padding: 0;
            width: 100%;
            /* Ensures the element takes the full width */
            text-align: center;
            /* Centers the text horizontally */
            letter-spacing: 13px;
            /* Adjust as needed for even spacing between letters */
            display: block;
            /* Ensures the element behaves as a block-level element */
        }

        .nomargin {
            margin: 0;
            padding: 0;
        }

        .tab {
            display: inline-block;
            width: 2em;
        }
    </style>
</head>

<body>
    <div class="letter-container">
        <div class="header">
            <div class="logo-left">
                <img src="{{ $imagelogo1 }}" alt="School Logo 2"> <!-- Image 2 on the left -->
            </div>
            <div class="logo-right">
                <img src="{{ $imagelogo2 }}" alt="School Logo 1"> <!-- Image 1 on the right -->
            </div>
            <div class="logo-center">
                <p class="nomargin">The Roman Catholic Bishop of San Pablo, Inc.</p>
                <p class="title-liceo">Liceo De Bay</p>
                <p class="nomargin">Rizal Avenue, Brgy. San Agustin, Bay, Laguna</p>
                <p class="nomargin">Tel. No. (049) 536-0922</p>
            </div>
        </div>

        <div class="title">CERTIFICATION</div>

        <div class="content">
            <span class="date"><strong>{{ $date }}</strong></span>

            <p class="to">To Whom It May Concern:</p>

            <p class="details"><span class="tab"></span>This is to certify that <strong>{{ $name }}</strong> is a graduate of  <strong>{{ $grade}}/{{$strand}}</strong> student student in this institution for the {{ $schoolyear }}.</p>

            <p class="details"><span class="tab"></span>Records show that s/he is a person of good moral character and bears no records of misdemeanor.</p>

            <p><span class="tab"></span> This certification is issued upon his/her request for scholarship requirement purposes only.</p>
        </div>

        <div class="signature">
            <p>Certified by:<br /><br /></p>
            <p><strong>(Signature over Printed Name)</strong></p>
            <p class="OIC"><em>Guidance Councelor</em></p>
        </div>

        <div class="footer">
            <p>Not valid without school seal</p>
        </div>
    </div>
</body>

</html>
