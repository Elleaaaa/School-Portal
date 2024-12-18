<!DOCTYPE html>

<html lang="en">
<head>

  <meta charset="utf-8">
  <title>About Us</title>


</head>

<body>

  @include('layouts/websitelayout')

<!-- page title -->
<section class="page-title-section overlay" data-background="{{ asset('images/website/liceo/ldb-pic-05.jpg') }}">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb mb-2">
          <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="index.html">Home</a></li>
          <li class="list-inline-item text-white h3 font-secondary nasted">About Us</li>
        </ul>
        <p class="text-lighten mb-0">Liceo de Bay offers a wide range of programs and courses designed to meet the diverse needs of its students. From preschool to senior high school, the institution prides itself on creating a nurturing and supportive learning environment where students can thrive and reach their full potential.</p>
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- about -->
<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <img class="img-fluid w-100 mb-4" src="{{ asset('images/website/liceo/ldb-pic-01.jpg') }}" alt="about image">
        <h2 class="section-title">ABOUT US</h2>
        <p>Liceo de Bay is a renowned educational institution located at 0 Rizal Ave. San Agustin, BAY Laguna, dedicated to providing high-quality education to students of all ages. With a strong focus on academic excellence, character development, and holistic growth, Liceo de Bay offers a wide range of programs and courses designed to meet the diverse needs of its students. From preschool to senior high school, the institution prides itself on creating a nurturing and supportive learning environment where students can thrive and reach their full potential. At Liceo de Bay, we believe in a well-rounded education that not only focuses on academic achievement but also on the values of integrity, responsibility, and respect. Our experienced faculty members are committed to providing personalized attention to each student and helping them develop the skills and knowledge necessary for success in today's competitive world. With state-of-the-art facilities, innovative teaching methods, and a vibrant campus life, Liceo de Bay is the ideal choice for parents looking for a top-tier educational institution in the BAY Laguna area.</p>
      </div>
    </div>
  </div>
</section>
<!-- /about -->

<!-- funfacts -->
<section class="section-sm bg-primary">
  <div class="container">
    <div class="row">
      <!-- funfacts item -->
      <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
        <div class="text-center">
          <h2 class="count text-white" data-count="60">0</h2>
          <h5 class="text-white">TEACHERS</h5>
        </div>
      </div>
      <!-- funfacts item -->
      <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
        <div class="text-center">
          <h2 class="count text-white" data-count="50">0</h2>
          <h5 class="text-white">COURSES</h5>
        </div>
      </div>
      <!-- funfacts item -->
      <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
        <div class="text-center">
          <h2 class="count text-white" data-count="1000">0</h2>
          <h5 class="text-white">STUDENTS</h5>
        </div>
      </div>
      <!-- funfacts item -->
      <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
        <div class="text-center">
          <h2 class="count text-white" data-count="3737">0</h2>
          <h5 class="text-white">SATISFIED CLIENT</h5>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /funfacts -->

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
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat.</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /success story -->

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
            <img class="card-img-top rounded-0" src="{{ asset('images/website/teachers/teacher-1.jpg') }}" alt="teacher">
            <div class="card-body">
              <a href="teacher-single.html">
                <h4 class="card-title">Jacke Masito</h4>
              </a>
              <div class="d-flex justify-content-between">
                <span>Teacher</span>
                <ul class="list-inline">
                  <li class="list-inline-item"><a class="text-color" href="https://facebook.com/themefisher"><i class="ti-facebook"></i></a></li>
                  <li class="list-inline-item"><a class="text-color" href="https://twitter.com/themefisher"><i class="ti-twitter-alt"></i></a></li>
                  <li class="list-inline-item"><a class="text-color" href="https://github.com/themefisher"><i class="ti-google"></i></a></li>
                  <li class="list-inline-item"><a class="text-color" href="https://instagram.com/themefisher/"><i class="ti-linkedin"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- teacher -->
        <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
          <div class="card border-0 rounded-0 hover-shadow">
            <img class="card-img-top rounded-0" src="{{ asset('images/website/teachers/teacher-2.jpg') }}" alt="teacher">
            <div class="card-body">
              <a href="teacher-single.html">
                <h4 class="card-title">Clark Malik</h4>
              </a>
              <div class="d-flex justify-content-between">
                <span>Teacher</span>
                <ul class="list-inline">
                  <li class="list-inline-item"><a class="text-color" href="https://facebook.com/themefisher"><i class="ti-facebook"></i></a></li>
                  <li class="list-inline-item"><a class="text-color" href="https://twitter.com/themefisher"><i class="ti-twitter-alt"></i></a></li>
                  <li class="list-inline-item"><a class="text-color" href="https://github.com/themefisher"><i class="ti-google"></i></a></li>
                  <li class="list-inline-item"><a class="text-color" href="https://instagram.com/themefisher/"><i class="ti-linkedin"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- teacher -->
        <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
          <div class="card border-0 rounded-0 hover-shadow">
            <img class="card-img-top rounded-0" src="{{ asset('images/website/teachers/teacher-3.jpg') }}" alt="teacher">
            <div class="card-body">
              <a href="teacher-single.html">
                <h4 class="card-title">John Doe</h4>
              </a>
              <div class="d-flex justify-content-between">
                <span>Teacher</span>
                <ul class="list-inline">
                  <li class="list-inline-item"><a class="text-color" href="https://facebook.com/themefisher"><i class="ti-facebook"></i></a></li>
                  <li class="list-inline-item"><a class="text-color" href="https://twitter.com/themefisher"><i class="ti-twitter-alt"></i></a></li>
                  <li class="list-inline-item"><a class="text-color" href="https://github.com/themefisher"><i class="ti-google"></i></a></li>
                  <li class="list-inline-item"><a class="text-color" href="https://instagram.com/themefisher/"><i class="ti-linkedin"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> --}}
  <!-- /teachers -->

  @include('layouts/websitefooter')

</body>
</html>