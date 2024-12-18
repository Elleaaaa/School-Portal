<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">
    <title>Educenter - Education HTML Template</title>

    <style>
    

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
                        <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="index.html">Home</a>
                        </li>
                        <li class="list-inline-item text-white h3 font-secondary nasted">Our teacher</li>
                    </ul>
                    <p class="text-lighten mb-0">Our courses offer a good compromise between the continuous assessment
                        favoured by some universities and the emphasis placed on final exams by others.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- /page title -->

    <!-- teachers -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- teacher category list -->
                    <ul class="list-inline text-center filter-controls mb-5">
                        <li class="list-inline-item m-3 text-uppercase active" data-filter="all">All</li>
                        <li class="list-inline-item m-3 text-uppercase" data-filter="Grade 7">Grade 7</li>
                        <li class="list-inline-item m-3 text-uppercase" data-filter="Grade 8">Grade 8</li>
                        <li class="list-inline-item m-3 text-uppercase" data-filter="Grade 9">Grade 9</li>
                        <li class="list-inline-item m-3 text-uppercase" data-filter="Grade 10">Grade 10</li>
                        <li class="list-inline-item m-3 text-uppercase" data-filter="Grade 11">Grade 11</li>
                        <li class="list-inline-item m-3 text-uppercase" data-filter="Grade 12">Grade 12</li>
                    </ul>
                </div>
            </div>
            <!-- teacher list -->
            <div class="row filtr-container">
                @foreach ($teachers as $teacher)
                    <div data-category="{{ $teacher->handledGradeLevels->join(', ') }}"
                        class="col-lg-3 col-sm-4 mb-5 filtr-item">
                        <div class="card border-0 rounded-0 hover-shadow">
                            <img class="card-img-top rounded-0"
                                src="{{ asset('storage/images/display-photo/' . $teacher->image->displayPhoto) }}"
                                alt="teacher">
                            <div class="card-body">
                                <a href="teacher-single.html">
                                    <h4 class="card-title">{{ $teacher->firstName }} {{ $teacher->lastName }}
                                        {{ $teacher->suffix }}</h4>
                                </a>
                                {{-- <p>Teacher</p> --}}
                                {{-- <ul class="list-inline">
                                    <li class="list-inline-item"><a class="text-color"><i class="ti-facebook"></i></a>
                                    </li>
                                    <li class="list-inline-item"><a class="text-color"><i
                                                class="ti-twitter-alt"></i></a></li>
                                    <li class="list-inline-item"><a class="text-color"><i class="ti-google"></i></a>
                                    </li>
                                    <li class="list-inline-item"><a class="text-color"><i class="ti-linkedin"></i></a>
                                    </li>
                                </ul> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
    <!-- /teachers -->

    @include('layouts/websitefooter')

</body>

</html>
