<?php $page['section']=$page['section']??null; ?>
<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Ads Hub | {{$page['title']??''}}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{asset('assets/img/adshub-logo-tiny.png')}}" rel="icon">
    <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('assets/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    @if(app()->getLocale()=='en')
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    @elseif(app()->getLocale()=='ar')
        <link href="{{asset('assets/css/style-ar.css')}}" rel="stylesheet">
@endif
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{asset('/sweetalert2/dist')}}/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="{{asset('/sweetalert2/dist')}}/sweetalert2.min.css">
</head>

<body>

<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
        <div class="contact-info d-flex align-items-center">
            <i class="bi bi-envelope"></i> <a href="mailto:h.dabour25@yahoo.com">h.dabour25@yahoo.com</a>
            <i class="bi bi-phone"></i> +201140984296
        </div>
        <div class="d-none d-lg-flex social-links align-items-center">
            @if(app()->getLocale()=='en')
                <a href="/lang/ar" class=""><i class="fa fa-language"></i> عربى</a>
            @elseif(app()->getLocale()=='ar')
                <a href="/lang/en" class=""><i class="fa fa-language"></i>English</a>
            @endif
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
    </div>
</div>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

        <h1 class="logo me-auto"><a href="/"><img src="{{asset('/assets/img/adshub-logo-tiny.png')}}" width="60px;"></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="nav-link scrollto {{$page['section']=="Home"?'active':''}}" href="/">@lang('strings.Home')</a></li>
                @if(auth()->user())
                    <li><a class="nav-link scrollto {{$page['section']=="view ads"?'active':''}}" href="/view-ads">@lang('strings.View Ads')</a></li>
                @endif
                <li><a class="nav-link scrollto {{$page['section']=="terms"?'active':''}}" href="/terms">@lang('strings.Terms&Conditions')</a></li>
                <li class="dropdown"><a href="#" class="{{$page['section']=="user"?'active':''}}"><span>{{auth()->user()?auth()->user()->name:__('strings.User')}}</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        @if(auth()->user())
                            <li><a href="/transactions">@lang('strings.Balance'): {{auth()->user()->balance}} @lang('strings.LE')</a></li>
                            <li><a href="/profile">@lang('strings.Profile')</a> </li>
                            @if(auth()->user()->user_status=='admin')
                                <li><a href="/admin">@lang('strings.Admin Dashboard')</a></li>
                            @endif
                            <li><a href="/auth/logout">@lang('strings.Logout')</a></li>
                        @else
                            <li><a href="/auth/login">@lang('strings.Login')</a></li>
                            <li><a href="/auth/register">@lang('strings.Register')</a></li>
                        @endif
                    </ul>
                </li>
                <li><a class="nav-link scrollto {{$page['section']=="contact"?'active':''}}" href="/contact">@lang('strings.Contact')</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

        <a href="/create-ad" class="appointment-btn scrollto">@lang('strings.Create New Ad')</a>

    </div>
</header><!-- End Header -->

<main id="main">

    @if(session()->has('status')&&session()->get('status')!='success')
        <div class="alert alert-{{session()->get('status')}}" style="margin-top: 150px;">
            <p>{{ session()->get('message') }}</p>
        </div>
        {{session()->forget(['status','message'])}}
    @elseif(session()->has('status')&&session()->get('status')=='success')
        <script>
            Swal.fire(
                '@lang("strings.Success")!',
                '{{session()->get('message')}}',
                'success'
            )
        </script>
        {{session()->forget(['status','message'])}}
    @endif
    @yield('content')
</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer">

    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3>AdsHub</h3>
                    <p>
                        <strong>@lang("strings.Phone"):</strong> +201140984296<br>
                        <strong>@lang("strings.Email"):</strong> h.dabour25@yahoo.com<br>
                    </p>
                </div>

                <div class="col-lg-2 col-md-6 footer-links">
                    <h4>@lang("strings.Useful Links")</h4>
                    <ul>
                        <li><i class="bx bx-chevron-{{app()->isLocale('en')?'right':'left'}}"></i> <a href="/">@lang("strings.Home")</a></li>
                        <li><i class="bx bx-chevron-{{app()->isLocale('en')?'right':'left'}}"></i> <a href="/terms">@lang("strings.Terms&Conditions")</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>@lang("strings.User Links")</h4>
                    <ul>
                        @if(auth()->user())
                            <li><i class="bx bx-chevron-{{app()->isLocale('en')?'right':'left'}}"></i> <a href="/create-ad">@lang("strings.Create Ad")</a></li>
                            <li><i class="bx bx-chevron-{{app()->isLocale('en')?'right':'left'}}"></i> <a href="/view-ads">@lang("strings.View Ads")</a></li>
                            <li><i class="bx bx-chevron-{{app()->isLocale('en')?'right':'left'}}"></i> <a href="/profile">@lang("strings.Profile")</a></li>
                        @else
                            <li><i class="bx bx-chevron-{{app()->isLocale('en')?'right':'left'}}"></i> <a href="/login">@lang("strings.Login")</a></li>
                            <li><i class="bx bx-chevron-{{app()->isLocale('en')?'right':'left'}}"></i> <a href="/register">@lang("strings.Register")</a></li>
                        @endif
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 footer-newsletter">
                    <h4>@lang("strings.Join Our Newsletter")</h4>
                    <p>@lang("strings.Get Latest News of") AdsHub</p>
                    <form action="" method="post">
                        <input type="email" name="email"><input type="submit" value="Subscribe">
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="container d-md-flex py-4" style="direction: ltr;">

        <div class="me-md-auto text-center text-md-start">
            <div class="copyright">
                &copy; Copyright {{date('Y')}} <strong><span>Ads Hub EG</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/ -->
                Developed by <a href="https://www.facebook.com/dabour25">Ahmed Magdy</a>
            </div>
        </div>
        <div class="social-links text-center text-md-right pt-3 pt-md-0">
            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
    </div>
</footer><!-- End Footer -->

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
<script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
<script src="{{asset('assets/vendor/purecounter/purecounter.js')}}"></script>
<script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>

<!-- Template Main JS File -->
<script src="{{asset('assets/js/main.js')}}"></script>

</body>

</html>

