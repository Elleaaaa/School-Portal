<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Improved School Hierarchy</title>

    <style>
        body {
            background-color: #f4f6f9;
        }

        .hierarchy-container {
            position: relative;
            text-align: center;
        }

        .hierarchy-level {
            margin-bottom: 60px;
            position: relative;
        }

        .hierarchy-card {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .hierarchy-card:hover {
            transform: translateY(-5px);
        }

        .connector-vertical {
            width: 2px;
            background-color: #6c757d;
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            height: 467px;
        }

        .connector-horizontal {
            height: 2px;
            background-color: #6c757d;
            position: absolute;
            top: 50%;
            z-index: -1;
        }

        .circle {
            width: 10px;
            height: 10px;
            background-color: #6c757d;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>

<body>
    @include('layouts/websitelayout')
    <!-- page title -->
    <section class="page-title-section overlay"
        data-background="{{ asset('images/website/backgrounds/page-title.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-inline custom-breadcrumb mb-2">
                        <li class="list-inline-item"><a class="h2 text-primary font-secondary"
                                href="index.html">Home</a></li>
                        <li class="list-inline-item text-white h3 font-secondary nasted">Notice</li>
                    </ul>
                    <p class="text-lighten mb-0">Our courses offer a good compromise between the continuous assessment
                        favoured by some universities and the emphasis placed on final exams by others.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- /page title -->

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="container py-5">
                        <h1 class="text-center mb-5">School Hierarchy</h1>
                        <div class="hierarchy-container">
                            <!-- Principal -->
                            <div class="hierarchy-level position-relative">
                                <div class="hierarchy-card mx-auto" style="width: 200px;">
                                    <strong>Principal</strong>
                                </div>
                                <div class="connector-vertical"></div>
                            </div>

                            <!-- Coordinators -->
                            <div class="hierarchy-level d-flex justify-content-center position-relative">
                                <div class="hierarchy-card mx-3" style="width: 180px;">Academic Coordinator</div>
                                <div class="hierarchy-card mx-3" style="width: 180px;">Discipline Coordinator</div>
                                <div class="hierarchy-card mx-3" style="width: 180px;">Guidance Counselor</div>
                                <div class="connector-horizontal" style="width: 25%;"></div>
                            </div>

                            <!-- Registrar, Assessor, Cashier -->
                            <div class="hierarchy-level d-flex justify-content-center position-relative">
                                <div class="hierarchy-card mx-3" style="width: 150px;">Registrar</div>
                                <div class="hierarchy-card mx-3" style="width: 150px;">Assessor</div>
                                <div class="hierarchy-card mx-3" style="width: 150px;">Cashier</div>
                                <div class="connector-horizontal" style="width: 30%;"></div>
                            </div>

                            <!-- Teachers, School Nurse, Librarian -->
                            <div class="hierarchy-level d-flex justify-content-center position-relative">
                                <div class="hierarchy-card mx-3" style="width: 150px;">Teachers</div>
                                <div class="hierarchy-card mx-3" style="width: 150px;">School Nurse</div>
                                <div class="hierarchy-card mx-3" style="width: 150px;">Librarian</div>
                                <div class="connector-horizontal" style="width: 30%;"></div>
                            </div>

                            <!-- Janitor and Guard -->
                            <div class="hierarchy-level d-flex justify-content-center">
                                <div class="hierarchy-card mx-3" style="width: 120px;">Janitor</div>
                                <div class="hierarchy-card mx-3" style="width: 120px;">Guard</div>
                                <div class="connector-horizontal" style="width: 10%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts/websitefooter')
</body>

</html>
