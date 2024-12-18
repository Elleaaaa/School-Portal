<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <!-- footer -->
<footer>
    <!-- newsletter -->
    {{-- <div class="newsletter">
        <div class="container">
            <div class="row">
                <div class="col-md-9 ml-auto bg-primary py-5 newsletter-block">
                    <h3 class="text-white">Subscribe Now</h3>
                    <form action="#">
                        <div class="input-wrapper">
                            <input type="email" class="form-control border-0" id="newsletter" name="newsletter"
                                placeholder="Enter Your Email...">
                            <button type="submit" value="send" class="btn btn-primary">Join</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- footer content -->
    <div class="footer bg-footer section border-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-8 mb-5 mb-lg-0">
                    <!-- logo -->
                    <a class="logo-footer" href="index.html"><img class="img-fluid mb-4"
                            src="{{ asset('images/website/logo/baylogo.jpg') }}" width="120px" alt="logo"></a>
                    <ul class="list-unstyled">
                        <li class="mb-2">Liceo De Bay</li>
                        <li class="mb-2">0 Rizal Ave. San Agustin, BAY Laguna</li>
                        <li class="mb-2">(049) 536-0922</li>
                        <li class="mb-2">liceodebay_1967@yahoo.com.ph</li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0"></div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0"></div>
                <!-- company -->
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
                    <h4 class="text-white mb-5">COMPANY</h4>
                    <ul class="list-unstyled">
                        <li class="mb-3"><a class="text-color" href="about.html">About Us</a></li>
                        <li class="mb-3"><a class="text-color" href="teacher.html">Our Teacher</a></li>
                        <li class="mb-3"><a class="text-color" href="contact.html">Contact</a></li>
                        <li class="mb-3"><a class="text-color" href="blog.html">Blog</a></li>
                    </ul>
                </div>
                <!-- links -->
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
                    <h4 class="text-white mb-5">LINKS</h4>
                    <ul class="list-unstyled">
                        <li class="mb-3"><a class="text-color" href="courses.html">Courses</a></li>
                        <li class="mb-3"><a class="text-color" href="events.html">Events</a></li>
                        <li class="mb-3"><a class="text-color" href="notice.html">Notice</a></li>
                        <li class="mb-3"><a class="text-color" href="scholarship.html">Scholarship</a></li>
                    </ul>
                </div>
                <!-- support -->
                {{-- <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
                    <h4 class="text-white mb-5">SUPPORT</h4>
                    <ul class="list-unstyled">
                        <li class="mb-3"><a class="text-color" href="https://themefisher.com/blog">Forums</a></li>
                        <li class="mb-3"><a class="text-color" href="https://docs.themefisher.com/">Documentation</a>
                        </li>
                        <li class="mb-3"><a class="text-color" href="#!">Language</a></li>
                        <li class="mb-3"><a class="text-color" href="#!">Release Status</a></li>
                    </ul>
                </div> --}}
                <!-- support -->
                {{-- <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
                    <h4 class="text-white mb-5">RECOMMEND</h4>
                    <ul class="list-unstyled">
                        <li class="mb-3"><a class="text-color" href="https://themefisher.com/">WordPress</a></li>
                        <li class="mb-3"><a class="text-color" href="https://themefisher.com/">LearnPress</a></li>
                        <li class="mb-3"><a class="text-color" href="https://themefisher.com/">WooCommerce</a></li>
                        <li class="mb-3"><a class="text-color" href="https://themefisher.com/">bbPress</a></li>
                    </ul>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- copyright -->
    <div class="copyright py-4 bg-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 text-sm-left text-center">
                    {{-- <p class="mb-0">Copyright &copy;
                        <script>
                            var CurrentYear = new Date().getFullYear()
                            document.write(CurrentYear)
                        </script>
                        , designed & developed by <a href="https://themefisher.com/" class="text-muted">Themefisher</a>
                    </p> --}}
                </div>
                <div class="col-sm-5 text-sm-right text-center">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a class="d-inline-block p-2"
                                href="https://facebook.com/themefisher/"><i class="ti-facebook text-primary"></i></a>
                        </li>
                        <li class="list-inline-item"><a class="d-inline-block p-2"
                                href="https://twitter.com/themefisher"><i class="ti-twitter-alt text-primary"></i></a>
                        </li>
                        <li class="list-inline-item"><a class="d-inline-block p-2"
                                href="https://github.com/themefisher"><i class="ti-github text-primary"></i></a></li>
                        <li class="list-inline-item"><a class="d-inline-block p-2"
                                href="https://instagram.com/themefisher/"><i
                                    class="ti-instagram text-primary"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- /footer -->


<!-- jQuery -->
<script src="{{ asset('plugins/website/jQuery/jquery.min.js') }}"></script>
<!-- Bootstrap JS -->
<script src="{{ asset('plugins/website/bootstrap/bootstrap.min.js') }}"></script>
<!-- slick slider -->
<script src="{{ asset('plugins/website/slick/slick.min.js') }}"></script>
<!-- aos -->
<script src="{{ asset('plugins/website/aos/aos.js') }}"></script>
<!-- venobox popup -->
<script src="{{ asset('plugins/website/venobox/venobox.min.js') }}"></script>
<!-- filter -->
<script src="{{ asset('plugins/website/filterizr/jquery.filterizr.min.js') }}"></script>

<!-- Main Script -->
<script src="{{ asset('js/website/js/script.js') }}"></script>

{{-- BotPress --}}
<script src="https://cdn.botpress.cloud/webchat/v2.2/inject.js"></script>
<script src="https://files.bpcontent.cloud/2024/10/16/13/20241016135041-AGJV7U92.js"></script>

    
</body>
</html>