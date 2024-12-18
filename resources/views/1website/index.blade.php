<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>Liceo De Bay</title>

</head>

<body>

    @include('layouts/websitelayout')

    <!-- hero slider -->
    <section class="hero-section overlay bg-cover" data-background="{{ asset('images/website/banner/banner5.jpg') }}">
        <div class="container">
            <div class="hero-slider">
                <!-- slider item -->
                <div class="hero-slider-item">
                    <div class="row">
                        <div class="col-md-8">
                            <h1 class="text-white" data-animation-out="fadeOutRight" data-delay-out="5"
                                data-duration-in=".3" data-animation-in="fadeInLeft" data-delay-in=".1">Your bright
                                future is our mission</h1>
                            <p class="text-muted mb-4" data-animation-out="fadeOutRight" data-delay-out="5"
                                data-duration-in=".3" data-animation-in="fadeInLeft" data-delay-in=".4">A proper
                                education sets people up to grow personally, professionally, and socially.
                                It can awaken joy, curiosity and a deep desire to solve problems and help others.
                                Plus, teaching a student can inspire them to pursue leadership roles and positively
                                impact those around them</p>
                            {{-- <a href="contact.html" class="btn btn-primary" data-animation-out="fadeOutRight"
                                data-delay-out="5" data-duration-in=".3" data-animation-in="fadeInLeft"
                                data-delay-in=".7">Apply now</a> --}}
                        </div>
                    </div>
                </div>
                <!-- slider item -->
                <div class="hero-slider-item">
                    <div class="row">
                        <div class="col-md-8">
                            <h1 class="text-white" data-animation-out="fadeOutUp" data-delay-out="5"
                                data-duration-in=".3" data-animation-in="fadeInDown" data-delay-in=".1">Your bright
                                future is our mission</h1>
                            <p class="text-muted mb-4" data-animation-out="fadeOutRight" data-delay-out="5"
                                data-duration-in=".3" data-animation-in="fadeInLeft" data-delay-in=".4">A proper
                                education sets people up to grow personally, professionally, and socially.
                                It can awaken joy, curiosity and a deep desire to solve problems and help others.
                                Plus, teaching a student can inspire them to pursue leadership roles and positively
                                impact those around them</p>
                            {{-- <a href="contact.html" class="btn btn-primary" data-animation-out="fadeOutUp"
                                data-delay-out="5" data-duration-in=".3" data-animation-in="fadeInDown"
                                data-delay-in=".7">Apply now</a> --}}
                        </div>
                    </div>
                </div>
                <!-- slider item -->
                <div class="hero-slider-item">
                    <div class="row">
                        <div class="col-md-8">
                            <h1 class="text-white" data-animation-out="fadeOutDown" data-delay-out="5"
                                data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">Your bright future
                                is our mission</h1>
                            <p class="text-muted mb-4" data-animation-out="fadeOutRight" data-delay-out="5"
                                data-duration-in=".3" data-animation-in="fadeInLeft" data-delay-in=".4">A proper
                                education sets people up to grow personally, professionally, and socially.
                                It can awaken joy, curiosity and a deep desire to solve problems and help others.
                                Plus, teaching a student can inspire them to pursue leadership roles and positively
                                impact those around them</p>
                            {{-- <a href="contact.html" class="btn btn-primary" data-animation-out="fadeOutDown"
                                data-delay-out="5" data-duration-in=".3" data-animation-in="zoomIn"
                                data-delay-in=".7">Apply now</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /hero slider -->

    <!-- banner-feature -->
    <section class="bg-gray overflow-md-hidden">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-xl-4 col-lg-5 align-self-end">
                    <img class="img-fluid w-100" src="{{ asset('images/website/banner/partners.png') }}"
                        alt="banner-feature">
                </div>
                <div class="col-xl-8 col-lg-7">
                    <div class="row feature-blocks bg-gray justify-content-between">
                        <div class="col-sm-6 col-xl-5 mb-xl-5 mb-lg-3 mb-4 text-center text-sm-left">
                            <i class="ti-book mb-xl-4 mb-lg-3 mb-4 feature-icon"></i>
                            <h3 class="mb-xl-4 mb-lg-3 mb-4">Scholorship News</h3>
                            <p>Maha DBT – Online direct benefit transfer scheme to distribute scholarships for students
                                studying in Maharashtra state by the government of Maharashtra.</p>
                        </div>
                        <div class="col-sm-6 col-xl-5 mb-xl-5 mb-lg-3 mb-4 text-center text-sm-left">
                            <i class="ti-blackboard mb-xl-4 mb-lg-3 mb-4 feature-icon"></i>
                            <h3 class="mb-xl-4 mb-lg-3 mb-4">Our Notice Board</h3>
                            <p>Notice boards keep everyone updated on upcoming events, opportunities of all sorts and
                                peer activities and achievements in school.
                                School announcements, timetables, and schedules to parents, students, and teachers tend
                                to be the most commonly displayed.</p>
                        </div>
                        <div class="col-sm-6 col-xl-5 mb-xl-5 mb-lg-3 mb-4 text-center text-sm-left">
                            <i class="ti-agenda mb-xl-4 mb-lg-3 mb-4 feature-icon"></i>
                            <h3 class="mb-xl-4 mb-lg-3 mb-4">Our Achievements</h3>
                            <p>An achievement is a great accomplishment—something achieved with great effort or skill.
                                Graduating high school is an achievement. Learning a new language is an achievement.</p>
                        </div>
                        <div class="col-sm-6 col-xl-5 mb-xl-5 mb-lg-3 mb-4 text-center text-sm-left">
                            <i class="ti-write mb-xl-4 mb-lg-3 mb-4 feature-icon"></i>
                            <h3 class="mb-xl-4 mb-lg-3 mb-4">Admission Now</h3>
                            <p>Sign up for the study in India program today & get a chance to pursue higher education
                                from top institutes in India</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /banner-feature -->

    <!-- about us -->
    <section class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 order-2 order-md-1">
                    <h2 class="section-title">About Liceo de Bay</h2>
                    <p>Keeping in mind the need of management education, university decided to establish the Department
                        of Management Studies in 1992. This department offers structured graduate and undergraduate
                        programs in Management, which are exhaustive in nature and structured to meet the challenges
                        posed by industry & job market.</p>
                    <p>The programs offered by the Department are Ph.D. Program. Two-year Full-time Master of Business
                        Administration (M.B.A.) recognized by A.I.C.T.E., New Delhi.</p>
                    <a href="about.html" class="btn btn-outline-primary">Learn more</a>
                </div>
                <div class="col-md-6 order-1 order-md-2 mb-4 mb-md-0">
                    <img class="img-fluid w-100" src="{{ asset('images/website/liceo/ldb-pic-01.jpg') }}"
                        alt="about image">
                </div>
            </div>
        </div>
    </section>
    <!-- /about us -->

    <!-- courses -->
    <section class="section-sm">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center section-title justify-content-between">
                        <h2 class="mb-0 text-nowrap mr-3">Strand Offers</h2>
                        <div class="border-top w-100 border-primary d-none d-sm-block"></div>
                        <div>
                            <a href="courses.html"
                                class="btn btn-sm btn-outline-primary ml-sm-3 d-none d-sm-block">see all</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- course list -->
            <div class="row justify-content-center">
                <!-- course item -->
                <div class="col-lg-4 col-sm-6 mb-5">
                    <div class="card p-0 border-primary rounded-0 hover-shadow">
                        <img class="card-img-top rounded-0" height="200px" src="{{ asset('images/website/liceo/STEM.jpg') }}"
                            alt="course thumb">
                        <div class="card-body">
                            {{-- <ul class="list-inline mb-2">
                                <li class="list-inline-item"><i class="ti-calendar mr-1 text-color"></i>2022-2024</li>
                                <li class="list-inline-item"><a class="text-color"
                                        href="course-single.html">Management Studies</a></li>
                            </ul> --}}
                            <a href="course-single.html">
                                <h4 class="card-title">STEM</h4>
                            </a>
                            <p class="card-text mb-4">The STEM Strand (Science, Technology, Engineering, and Mathematics) is an academic track designed for students interested in pursuing careers in fields related to science, technology, engineering, and mathematics. It focuses on subjects like physics, chemistry, biology, advanced mathematics, and research, providing students with a solid foundation in critical thinking, problem-solving, and technical skills.</p>
                            {{-- <a href="course-single.html" class="btn btn-primary btn-sm">Apply now</a> --}}
                        </div>
                    </div>
                </div>
                <!-- course item -->
                <div class="col-lg-4 col-sm-6 mb-5">
                    <div class="card p-0 border-primary rounded-0 hover-shadow">
                        <img class="card-img-top rounded-0" height="200px" src="{{ asset('images/website/liceo/ABM.jpg') }}"
                            alt="course thumb">
                        <div class="card-body">
                            {{-- <ul class="list-inline mb-2">
                                <li class="list-inline-item"><i class="ti-calendar mr-1 text-color"></i>2022-2024</li>
                                <li class="list-inline-item"><a class="text-color"
                                        href="course-single.html">Management Studies</a></li>
                            </ul> --}}
                            <a href="course-single.html">
                                <h4 class="card-title">ABM</h4>
                            </a>
                            <p class="card-text mb-4">The ABM Strand (Accountancy, Business, and Management) is an academic track designed for students interested in pursuing careers in business, finance, and entrepreneurship. It focuses on subjects such as accounting, business mathematics, economics, and marketing, equipping students with the essential skills needed for the corporate world.</p>
                            {{-- <a href="course-single.html" class="btn btn-primary btn-sm">Apply now</a> --}}
                        </div>
                    </div>
                </div>
                <!-- course item -->
                <div class="col-lg-4 col-sm-6 mb-5">
                    <div class="card p-0 border-primary rounded-0 hover-shadow">
                        <img class="card-img-top rounded-0" height="200px" src="{{ asset('images/website/liceo/GAS.png') }}"
                            alt="course thumb">
                        <div class="card-body">
                            {{-- <ul class="list-inline mb-2">
                                <li class="list-inline-item"><i class="ti-calendar mr-1 text-color"></i>2022-2024</li>
                                <li class="list-inline-item"><a class="text-color"
                                        href="course-single.html">Management Studies</a></li>
                            </ul> --}}
                            <a href="course-single.html">
                                <h4 class="card-title">GAS</h4>
                            </a>
                            <p class="card-text mb-4">The GAS Strand (General Academic Strand) is a versatile academic track that provides a broad range of subjects, making it ideal for students who are unsure about which specific career path to pursue. It offers a flexible curriculum that combines elements from various disciplines, including humanities, social sciences, business, and science. The GAS strand is designed to develop critical thinking, communication, and problem-solving skills, allowing students to explore a wide range of fields before deciding on a specific career or further education.</p>
                            {{-- <a href="course-single.html" class="btn btn-primary btn-sm">Apply now</a> --}}
                        </div>
                    </div>
                </div>

                <!-- /course list -->
                <!-- mobile see all button -->
                <div class="row">
                    <div class="col-12 text-center">
                        <a href="courses.html" class="btn btn-sm btn-outline-primary d-sm-none d-inline-block">sell
                            all</a>
                    </div>
                </div>
            </div>
    </section>
    <!-- /courses -->

    <!-- cta -->
    {{-- <section class="section bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h6 class="text-white font-secondary mb-0">Click to Join the Advance Workshop</h6>
                    <h2 class="section-title text-white">Goods and Service Tax</h2>
                    <a href="contact.html" class="btn btn-light">join now</a>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- /cta -->

    <!-- success story -->
    <section class="section bg-cover" data-background="{{ asset('images/website/backgrounds/success-story.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-4 position-relative success-video">
                    <a class="play-btn venobox" href="https://youtu.be/nA1Aqp0sPQo" data-vbtype="video">
                        <i class="ti-control-play"></i>
                    </a>
                </div>
                <div class="col-lg-6 col-sm-8">
                    <div class="bg-white p-5">
                        <h2 class="section-title">Success Stories</h2>
                        <p>Success Story of Kavayitri Bahinabai Chaudhari North Maharashtra University at 14th
                            Maharashtra State Inter-University Research Convention for UG/PG/Doctoral students/Teachers
                            held University of Mumbai.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /success story -->

    <!-- events -->
    <section class="section bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center section-title justify-content-between">
                        <h2 class="mb-0 text-nowrap mr-3">Events</h2>
                        <div class="border-top w-100 border-primary d-none d-sm-block"></div>
                        <div>
                            <a href="events.html" class="btn btn-sm btn-outline-primary ml-sm-3 d-none d-sm-block">see
                                all</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <!-- event -->
                <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
                    <div class="card border-0 rounded-0 hover-shadow">
                        <div class="card-img position-relative">
                            <img class="card-img-top rounded-0" src="{{ asset('images/website/events/event-1.jpg') }}"
                                alt="event thumb">
                            <div class="card-date"><span>18</span><br>December</div>
                        </div>
                        <div class="card-body">
                            <!-- location -->
                            <p><i class="ti-location-pin text-primary mr-2"></i>Jalgaon, Maharashtra</p>
                            <a href="event-single.html">
                                <h4 class="card-title">Parants teacher Meet.</h4>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- event -->
                <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
                    <div class="card border-0 rounded-0 hover-shadow">
                        <div class="card-img position-relative">
                            <img class="card-img-top rounded-0" src="{{ asset('images/website/events/event-2.jpg') }}"
                                alt="event thumb">
                            <div class="card-date"><span>21</span><br>December</div>
                        </div>
                        <div class="card-body">
                            <!-- location -->
                            <p><i class="ti-location-pin text-primary mr-2"></i>Jalgaon, Maharashtra</p>
                            <a href="event-single.html">
                                <h4 class="card-title">Personality Development Programme for girls student</h4>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- event -->
                <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
                    <div class="card border-0 rounded-0 hover-shadow">
                        <div class="card-img position-relative">
                            <img class="card-img-top rounded-0"
                                src="{{ asset('images/website/events/event-3.jpg') }}" alt="event thumb">
                            <div class="card-date"><span>23</span><br>December</div>
                        </div>
                        <div class="card-body">
                            <!-- location -->
                            <p><i class="ti-location-pin text-primary mr-2"></i>Jalgaon, Maharashtra</p>
                            <a href="event-single.html">
                                <h4 class="card-title">Three Days Workshop on Entrepreneurship Development programme
                                    jointly organized of School of Management Studies and Maharashtra centre for
                                    Entrepreneurship</h4>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- mobile see all button -->
            <div class="row">
                <div class="col-12 text-center">
                    <a href="course.html" class="btn btn-sm btn-outline-primary d-sm-none d-inline-block">sell all</a>
                </div>
            </div>
        </div>
    </section>
    <!-- /events -->

    <!-- teachers -->
    {{-- <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="section-title">Our Teachers</h2>
                </div>
                <!-- teacher -->
                <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
                    <div class="card border-0 rounded-0 hover-shadow">
                        <img class="card-img-top rounded-0"
                            src="{{ asset('images/website/teachers/teacher-1.jpg') }}" alt="teacher">
                        <div class="card-body">
                            <a href="teacher-single.html">
                                <h4 class="card-title">Prof. Madhulika Sonawane</h4>
                            </a>
                            <p>Teacher</p>
                            <ul class="list-inline">
                                <li class="list-inline-item"><a class="text-color"
                                        href="https://facebook.com/themefisher"><i class="ti-facebook"></i></a></li>
                                <li class="list-inline-item"><a class="text-color"
                                        href="https://twitter.com/themefisher"><i class="ti-twitter-alt"></i></a></li>
                                <li class="list-inline-item"><a class="text-color"
                                        href="https://github.com/themefisher"><i class="ti-google"></i></a></li>
                                <li class="list-inline-item"><a class="text-color"
                                        href="https://instagram.com/themefisher/"><i class="ti-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- teacher -->
                <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
                    <div class="card border-0 rounded-0 hover-shadow">
                        <img class="card-img-top rounded-0"
                            src="{{ asset('images/website/teachers/teacher-2.jpg') }}" alt="teacher">
                        <div class="card-body">
                            <a href="teacher-single.html">
                                <h4 class="card-title">Dr. Ramesh j. Sardar</h4>
                            </a>
                            <p>Teacher</p>
                            <ul class="list-inline">
                                <li class="list-inline-item"><a class="text-color"
                                        href="https://facebook.com/themefisher"><i class="ti-facebook"></i></a></li>
                                <li class="list-inline-item"><a class="text-color"
                                        href="https://twitter.com/themefisher"><i class="ti-twitter-alt"></i></a></li>
                                <li class="list-inline-item"><a class="text-color"
                                        href="https://github.com/themefisher"><i class="ti-google"></i></a></li>
                                <li class="list-inline-item"><a class="text-color"
                                        href="https://instagram.com/themefisher/"><i class="ti-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- teacher -->
                <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
                    <div class="card border-0 rounded-0 hover-shadow">
                        <img class="card-img-top rounded-0"
                            src="{{ asset('images/website/teachers/teacher-3.jpg') }}" alt="teacher">
                        <div class="card-body">
                            <a href="teacher-single.html">
                                <h4 class="card-title">Dr. Pavitra D. Patil</h4>
                            </a>
                            <p>Teacher</p>
                            <ul class="list-inline">
                                <li class="list-inline-item"><a class="text-color"
                                        href="https://facebook.com/themefisher"><i class="ti-facebook"></i></a></li>
                                <li class="list-inline-item"><a class="text-color"
                                        href="https://twitter.com/themefisher"><i class="ti-twitter-alt"></i></a></li>
                                <li class="list-inline-item"><a class="text-color"
                                        href="https://github.com/themefisher"><i class="ti-google"></i></a></li>
                                <li class="list-inline-item"><a class="text-color"
                                        href="https://instagram.com/themefisher/"><i class="ti-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- /teachers -->

    <!-- blog -->
    {{-- <section class="section pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title">Latest News</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <!-- blog post -->
                <article class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
                    <div
                        class="card rounded-0 border-bottom border-primary border-top-0 border-left-0 border-right-0 hover-shadow">
                        <img class="card-img-top rounded-0" src="{{ asset('images/website/blog/post-1.jpg') }}"
                            alt="Post thumb">
                        <div class="card-body">
                            <!-- post meta -->
                            <ul class="list-inline mb-3">
                                <!-- post date -->
                                <li class="list-inline-item mr-3 ml-0">2019-2022</li>
                                <!-- author -->
                                <li class="list-inline-item mr-3 ml-0">Dr. A. N. Barekar</li>
                            </ul>
                            <a href="blog-single.html">
                                <h4 class="card-title">“Indigenous Practices and its application for Sustainable
                                    Livelihood of Tribal communities"</h4>
                            </a>
                            <p class="card-text">A study for North Maharashtra (Khandesh) Region.</p>
                            <a href="blog-single.html" class="btn btn-primary btn-sm">read more</a>
                        </div>
                    </div>
                </article>
                <!-- blog post -->
                <article class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
                    <div
                        class="card rounded-0 border-bottom border-primary border-top-0 border-left-0 border-right-0 hover-shadow">
                        <img class="card-img-top rounded-0" src="{{ asset('images/website/blog/post-2.jpg') }}"
                            alt="Post thumb">
                        <div class="card-body">
                            <!-- post meta -->
                            <ul class="list-inline mb-3">
                                <!-- post date -->
                                <li class="list-inline-item mr-3 ml-0">2018-2021</li>
                                <!-- author -->
                                <li class="list-inline-item mr-3 ml-0">Prof. Ramesh J. Sardar</li>
                            </ul>
                            <a href="blog-single.html">
                                <h4 class="card-title">“Fostering entrepreneurial orientation among the scheduled
                                    castes of Maharashtra state: challenges and policy options.”</h4>
                            </a>
                            <p class="card-text">A study for North Maharashtra (Khandesh) Region.</p>
                            <a href="blog-single.html" class="btn btn-primary btn-sm">read more</a>
                        </div>
                    </div>
                </article>
                <!-- blog post -->
                <article class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
                    <div
                        class="card rounded-0 border-bottom border-primary border-top-0 border-left-0 border-right-0 hover-shadow">
                        <img class="card-img-top rounded-0" src="{{ asset('images/website/blog/post-3.jpg') }}"
                            alt="Post thumb">
                        <div class="card-body">
                            <!-- post meta -->
                            <ul class="list-inline mb-3">
                                <!-- post date -->
                                <li class="list-inline-item mr-3 ml-0">2020 -2022</li>
                                <!-- author -->
                                <li class="list-inline-item mr-3 ml-0">Prof. Madhulika Ajay Sonawane</li>
                            </ul>
                            <a href="blog-single.html">
                                <h4 class="card-title">Entrepreneurial Aptitude Testing &dev. For start-up’s, in female
                                    research and masters students in Sci.,Mgt.& Tech. faculties from University campus
                                    and colleges in Jalgaon City.</h4>
                            </a>
                            <p class="card-text">A study for North Maharashtra (Khandesh) Region.</p>
                            <a href="blog-single.html" class="btn btn-primary btn-sm">read more</a>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section> --}}
    <!-- /blog -->

    @include('layouts/websitefooter')

</body>

</html>
