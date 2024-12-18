<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liceo De Bay</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Construction Html5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="author" content="Themefisher">
    <meta name="generator" content="Themefisher Educenter HTML Template v1.0">

    <!-- theme meta -->
    <meta name="theme-name" content="educenter" />

    <!-- ** Plugins Needed for the Project ** -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/website/bootstrap/bootstrap.min.css') }}">
    <!-- slick slider -->
    <link rel="stylesheet" href="{{ asset('plugins/website/slick/slick.css') }}">
    <!-- themefy-icon -->
    <link rel="stylesheet" href="{{ asset('plugins/website/themify-icons/themify-icons.css') }}">
    <!-- animation css -->
    <link rel="stylesheet" href="{{ asset('plugins/website/animate/animate.css') }}">
    <!-- aos -->
    <link rel="stylesheet" href="{{ asset('plugins/website/aos/aos.css') }}">
    <!-- venobox popup -->
    <link rel="stylesheet" href="{{ asset('plugins/website/venobox/venobox.css') }}">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/website/style.css') }}">

    <!--Favicon-->
    <link rel="shortcut icon" href="{{ asset('images/website/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('images/website/favicon.png') }}" type="image/x-icon">
</head>

<body>
      <!-- preloader start -->
      <div class="preloader">
        <img src="{{ asset('images/website/1481.gif') }}" alt="preloader">
    </div>
    <!-- preloader end -->
    
    <!-- header -->
    <header class="fixed-top header">
        <!-- top header -->
        <div class="top-header py-2 bg-white">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-4 text-center text-lg-left">
                        <a class="text-color mr-3" href="tel:+639824672789"><strong>CALL</strong> +639824672789</a>
                        <ul class="list-inline d-inline">
                            <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color"
                                    href="https://facebook.com/"><i class="ti-facebook"></i></a></li>
                            <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color"
                                    href="https://twitter.com"><i class="ti-twitter-alt"></i></a></li>
                            <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color"
                                    href="https://github.com"><i class="ti-github"></i></a></li>
                            <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color"
                                    href="https://instagram.com/"><i class="ti-instagram"></i></a></li>
                        </ul>
                    </div>
                    <div class="col-lg-8 text-center text-lg-right">
                        <ul class="list-inline">
                            <li class="list-inline-item"><a
                                    class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block"
                                    href="{{ route('notice.show') }}">notice</a></li>
                            <li class="list-inline-item"><a
                                    class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block"
                                    href="{{ route('scholarship.show') }}">SCHOLARSHIP</a></li>
                            <li class="list-inline-item"><a
                                    class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="{{ url('login') }}">login</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- navbar -->
        <div class="navigation w-100">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-dark p-0">
                    <a class="navbar-brand" href="{{ route('homepage.show') }}"> <img src="{{ asset('images/website/logo/baylogo.jpg') }}" width="87" height="87" alt="logo"></a>
                    <a class="navbar-brand" style="font-size:2vw;" href="{{ route('homepage.show') }}">LICEO <br />D E  &nbsp;B A Y</a>
                    <button class="navbar-toggler rounded-0" type="button" data-toggle="collapse"
                        data-target="#navigation" aria-controls="navigation" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navigation">
                        <ul class="navbar-nav ml-auto text-center">
                            <li class="nav-item {{ Request::routeIs('homepage.show') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('homepage.show') }}">Home</a>
                            </li>
                            <li class="nav-item @@about {{ Request::routeIs('about.show') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('about.show') }}">About</a>
                            </li>
                            <li class="nav-item @@events {{ Request::routeIs('event.show') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('event.show') }}">EVENTS</a>
                            </li>
                            <li class="nav-item @@blog {{ Request::routeIs('blog.show') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('blog.show') }}">BLOG</a>
                            </li>
                            <li class="nav-item @@teacher {{ Request::routeIs('teacher.show') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('teacher.show') }}">TEACHERS</a>
                            </li>
                            {{-- <li class="nav-item dropdown view">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                    role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Pages
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="teacher.html">Teacher</a></li>
                                    <li><a class="dropdown-item" href="teacher-single.html">Teacher Single</a></li>
                                    <li><a class="dropdown-item" href="notice.html">Notice</a></li>
                                    <li><a class="dropdown-item" href="notice-single.html">Notice Details</a></li>
                                    <li><a class="dropdown-item" href="research.html">Research</a></li>
                                    <li><a class="dropdown-item" href="scholarship.html">Scholarship</a></li>
                                    <li><a class="dropdown-item" href="course-single.html">Course Details</a></li>
                                    <li><a class="dropdown-item" href="event-single.html">Event Details</a></li>
                                    <li><a class="dropdown-item" href="blog-single.html">Blog Details</a></li>

                                    <li class="dropdown-item dropdown dropleft">
                                        <a class="dropdown-toggle" href="#" id="navbarDropdownSubmenu"
                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Sub Menu
                                        </a>
                                        <ul class="dropdown-menu dropdown-submenu"
                                            aria-labelledby="navbarDropdownSubmenu">
                                            <li><a class="dropdown-item" href="#!">Sub Menu 01</a></li>
                                            <li><a class="dropdown-item" href="#!">Sub Menu 02</a></li>
                                            <li><a class="dropdown-item" href="#!">Sub Menu 03</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li> --}}
                            <li class="nav-item @@contact {{ Request::routeIs('contact.show') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('contact.show') }}">CONTACT</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <!-- /header -->

</body>

</html>
