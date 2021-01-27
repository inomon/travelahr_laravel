<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>{{ $pageName ?? null }} - Lets go, travelAHHR!</title>

        <!-- Bootstrap core -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

        <!-- Custom fonts for this template -->
        <link href="/assets/theme/landing-page/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
        <link href="/assets/theme/landing-page/vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:wght@600&family=Indie+Flower&display=swap" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="/assets/theme/landing-page/css/landing-page.css" rel="stylesheet">
    </head>
    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-light bg-light fixed-top">
            <div class="container">
                <a class="navbar-brand" href="/"><span class="prefix-brand">travel</span>AHHR</a>

                @if (!$showFooterForm)
                    <div class="col-4">
                        @include('blocks.places-form', ['selectedCity' => $selectedCity??null])
                    </div>
                @else
                    <!-- to hold the space -->
                    <div class="form-row"></div>
                @endif
            </div>
        </nav>

        @yield('content')

        @if ($showFooterForm)
            <!-- Testimonials -->
            <section class="testimonials text-center bg-light">
                <div class="container">
                <h2 class="mb-5">What people are saying...</h2>
                <div class="row">
                    <div class="col-lg-4">
                    <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                        <img class="img-fluid rounded-circle mb-3" src="/assets/theme/landing-page/img/testimonials-1.jpg" alt="">
                        <h5>Margaret E.</h5>
                        <p class="font-weight-light mb-0">"This is fantastic! Thanks so much guys!"</p>
                    </div>
                    </div>
                    <div class="col-lg-4">
                    <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                        <img class="img-fluid rounded-circle mb-3" src="/assets/theme/landing-page/img/testimonials-2.jpg" alt="">
                        <h5>Fred S.</h5>
                        <p class="font-weight-light mb-0">"It's just amazing. I've been using it so much!"</p>
                    </div>
                    </div>
                    <div class="col-lg-4">
                    <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                        <img class="img-fluid rounded-circle mb-3" src="/assets/theme/landing-page/img/testimonials-3.jpg" alt="">
                        <h5>Sarah W.</h5>
                        <p class="font-weight-light mb-0">"Thanks so much for suggesting that place!"</p>
                    </div>
                    </div>
                </div>
                </div>
            </section>
            <!-- Call to Action -->
            <section class="call-to-action text-white text-center mt-5">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row">
                    <div class="col-xl-9 mx-auto">
                        <h2 class="mb-4">Lets go!</h2>
                    </div>
                    <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                        @include('blocks.places-form')
                    </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- Footer -->
        <footer class="footer bg-light">
            <div class="container">
                <div class="row">
                <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
                    <ul class="list-inline mb-2">
                    <li class="list-inline-item">
                        <a href="#">About</a>
                    </li>
                    <li class="list-inline-item">&sdot;</li>
                    <li class="list-inline-item">
                        <a href="#">Contact</a>
                    </li>
                    <li class="list-inline-item">&sdot;</li>
                    <li class="list-inline-item">
                        <a href="#">Terms of Use</a>
                    </li>
                    <li class="list-inline-item">&sdot;</li>
                    <li class="list-inline-item">
                        <a href="#">Privacy Policy</a>
                    </li>
                    </ul>
                    <p class="text-muted small mb-4 mb-lg-0">&copy; travelAHHR 2021. All Rights Reserved.</p>
                </div>
                <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
                    <ul class="list-inline mb-0">
                    <li class="list-inline-item mr-3">
                        <a href="#">
                        <i class="fab fa-facebook fa-2x fa-fw"></i>
                        </a>
                    </li>
                    <li class="list-inline-item mr-3">
                        <a href="#">
                        <i class="fab fa-twitter-square fa-2x fa-fw"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                        <i class="fab fa-instagram fa-2x fa-fw"></i>
                        </a>
                    </li>
                    </ul>
                </div>
                </div>
            </div>
        </footer>

    </body>
</html>
