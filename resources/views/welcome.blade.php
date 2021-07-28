<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Ads Hub | {{$page}}</title>
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
                <li><a class="nav-link scrollto active" href="/">@lang('strings.Home')</a></li>
                @if(auth()->user())
                    <li><a class="nav-link scrollto {{$page=='View Ads'?'active':''}}" href="/view-ads">@lang('strings.View Ads')</a></li>
                @endif
                <li><a class="nav-link scrollto" href="/terms">@lang('strings.Terms&Conditions')</a></li>
                <li class="dropdown"><a href="#"><span>{{auth()->user()?auth()->user()->name:__('strings.User')}}</span> <i class="bi bi-chevron-down"></i></a>
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
                <li><a class="nav-link scrollto" href="/contact">@lang('strings.Contact')</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

        <a href="/create-ad" class="appointment-btn scrollto">@lang('strings.Create New Ad')</a>

    </div>
</header><!-- End Header -->

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
    <div class="container">
        <h1>@lang('strings.WELCOME TO ADS HUB')</h1>
        <h2>@lang('strings.Easiest Way to Gain Money')</h2>
        <a href="/register" class="btn-get-started scrollto">@lang('strings.Get Started')</a>
    </div>
</section><!-- End Hero -->

<main id="main">

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
        <div class="container">

            <div class="row">
                <div class="col-lg-4 d-flex align-items-stretch">
                    <div class="content">
                        <h3>@lang('strings.Watch Ads and Get Earnings')</h3>
                        <p>
                            @lang('strings.You can Easly watch some advertises and get cash in your balance without any pay before')
                        </p>
                        <div class="text-center">
                            <a href="/terms" class="more-btn">@lang('strings.Terms&Conditions') <i class="bx bx-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 d-flex align-items-stretch">
                    <div class="icon-boxes d-flex flex-column justify-content-center">
                        <div class="row">
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class="bx bx-image"></i>
                                    <h4>@lang('strings.Images')</h4>
                                    <p>@lang('strings.watch now direct ads images and earn money')</p>
                                </div>
                            </div>
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class="bx bxl-wordpress"></i>
                                    <h4>@lang('strings.Web Pages')</h4>
                                    <p>@lang("strings.Visit websites of advertisers and earn money, don't worry it 100% safe and tested")</p>
                                </div>
                            </div>
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class="bx bxl-youtube"></i>
                                    <h4>@lang('strings.Youtube and Videos')</h4>
                                    <p>
                                        @lang('strings.youtube_service_text')
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div><!-- End .content-->
                </div>
            </div>

        </div>
    </section><!-- End Why Us Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-5 col-lg-6 video-box d-flex justify-content-center align-items-stretch position-relative">
                    <!--<a href="#" class="glightbox play-btn mb-4"></a>-->
                </div>

                <div class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5">
                    <h3>@lang("strings.Advertisers")</h3>
                    <p>@lang("strings.advertisers_text")</p>

                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-pen"></i></div>
                        <h4 class="title"><a href="">@lang('strings.Control')</a></h4>
                        <p class="description">@lang("strings.You can control the impression price, the number of viewers for the ad, and the click price of the link")</p>
                    </div>

                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-target-lock"></i></div>
                        <h4 class="title"><a href="">@lang("strings.Targeting")</a></h4>
                        <p class="description">@lang("strings.You can target your audience by age, nationality, religion, gender or place of residence")</p>
                    </div>

                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-block"></i></div>
                        <h4 class="title"><a href="">@lang("strings.No more Reject")</a></h4>
                        <p class="description">@lang("strings.Our policies in accepting ads are simple as described in the site's terms and conditions")</p>
                    </div>

                </div>
            </div>

        </div>
    </section><!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
        <div class="container">

            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="count-box">
                        <i class="fas fa-user"></i>
                        <span data-purecounter-start="0" data-purecounter-end="{{$statistics_Data['users']}}" data-purecounter-duration="1" class="purecounter"></span>
                        <p>@lang("strings.Users")</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                    <div class="count-box">
                        <i class="fa fa-eye"></i>
                        <span data-purecounter-start="0" data-purecounter-end="{{$statistics_Data['total_views']}}" data-purecounter-duration="1" class="purecounter"></span>
                        <p>@lang("strings.Watched Ads")</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                    <div class="count-box">
                        <i class="fas fa-dollar-sign"></i>
                        <span data-purecounter-start="0" data-purecounter-end="{{$statistics_Data['total_earnings']}}" data-purecounter-duration="1" class="purecounter"></span>
                        <p>@lang("strings.Total Earnings")</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                    <div class="count-box">
                        <i class="fa fa-money-bill"></i>
                        <span data-purecounter-start="0" data-purecounter-end="{{$statistics_Data['totalAds']}}" data-purecounter-duration="1" class="purecounter"></span>
                        <p>@lang("strings.Total Ads")</p>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Counts Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
        <div class="container">

            <div class="section-title">
                <h2>@lang("strings.Services")</h2>
                <p>@lang("strings.We have multi solutions to earn money, like  videos and images, visit websites and commissions of Affiliate, and more") ..</p>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bxl-youtube"></i></div>
                        <h4><a href="">@lang("strings.Support Youtube channels")</a></h4>
                        <p>@lang("strings.you can create advertise to gain more views and subscribers on your yt channel")</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                    <div class="icon-box">
                        <div class="icon"><i class="fas fa-bullhorn"></i></div>
                        <h4><a href="">@lang("strings.Affiliate program")</a></h4>
                        <p>@lang("strings.help us to gain this site and get commissions 5% for each view, 5% for each advertiser payment").</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bxl-wordpress"></i></div>
                        <h4><a href="">@lang("strings.support websites visits")</a></h4>
                        <p>@lang("strings.Gain more traffic on your website, select visitors which can interest of your site").</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
                    <div class="icon-box">
                        <div class="icon"><i class="fas fa-dna"></i></div>
                        <h4><a href="">@lang("strings.Dual Account")</a></h4>
                        <p>@lang("strings.you can be advertiser and viewer at same time, you can also earn money then make ads").</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-money"></i></div>
                        <h4><a href="">@lang("strings.Transfer Money")</a></h4>
                        <p>@lang("strings.you can send and receive money, don't forget you can charge balance using vodafone cash and transfer to any one over world")</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
                    <div class="icon-box">
                        <div class="icon"><i class="fas fa-camera"></i></div>
                        <h4><a href="">@lang("strings.TV channel Support")</a></h4>
                        <p>@lang("strings.we can support channels by selling videos ads to it")</p>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Services Section -->

    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq section-bg">
        <div class="container">

            <div class="section-title">
                <h2>@lang("strings.Frequently Asked Questions")</h2>
                <p>@lang("strings.Feel free and know more about us"):</p>
            </div>

            <div class="faq-list">
                <ul>
                    <li data-aos="fade-up">
                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">@lang("strings.What are the ways to receive money")<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
                            <p>
                                @lang("strings.there are two methods (Vodafone cash EG - Paypal Global)")
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="100">
                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed">@lang("strings.What is the earnings from Views and Clicks")<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                @lang("strings.price_text").
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="200">
                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-3" class="collapsed">@lang("strings.How much price To gain good views/visits") <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                @lang("strings.At Usual 100 EGP can get 70-130 Views, 30-70 Clicks").
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="300">
                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">@lang("strings.If I was Advertiser and Affiliate for watcher at same time")<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                @lang("strings.You will get cash back 5% for each watcher registered with your link and view your ad").
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="400">
                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-5" class="collapsed">@lang("strings.What about security") <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                - @lang("strings.secure_ans1")
                                <br>
                                - @lang("strings.secure_ans2")
                                <br>
                                - @lang("strings.secure_ans3")
                            </p>
                        </div>
                    </li>

                </ul>
            </div>

        </div>
    </section><!-- End Frequently Asked Questions Section -->

<!-- ======= Footer ======= -->
<footer id="footer">

    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3>AdsHub</h3>
                    <p>
                        Fully Egyptian<br>
                        Site<br>
                        <br>
                        <strong>Phone:</strong> +201140984296<br>
                        <strong>Email:</strong> h.dabour25@yahoo.com<br>
                    </p>
                </div>

                <div class="col-lg-2 col-md-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="/">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="/terms">Terms And Conditions</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>User Links</h4>
                    <ul>
                        @if(auth()->user())
                            <li><i class="bx bx-chevron-right"></i> <a href="/create-ad">Create Ad</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="/view-ads">View Ads</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="/profile">Profile</a></li>
                        @else
                            <li><i class="bx bx-chevron-right"></i> <a href="/login">Login</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="/register">Register</a></li>
                        @endif
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 footer-newsletter">
                    <h4>Join Our Newsletter</h4>
                    <p>Get Latest News of AdsHub</p>
                    <form action="" method="post">
                        <input type="email" name="email"><input type="submit" value="Subscribe">
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="container d-md-flex py-4">

        <div class="me-md-auto text-center text-md-start">
            <div class="copyright">
                &copy; Copyright {{date('Y')}} <strong><span>Ads Hub</span></strong>. All Rights Reserved
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
