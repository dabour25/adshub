@extends('layouts.app')
@section('content')
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
    @stop
