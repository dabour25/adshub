@extends('layouts/app')
@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Your Ads</h2>
                <ol>
                    <li><a href="/">Home</a></li>
                    <li><a href="/profile">Profile</a></li>
                    <li>Your Ads</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page services">
        <div class="container">
            <div class="row">
                @foreach($ads as $ad)
                <div class="col-lg-2 col-md-3 d-flex align-items-stretch" id="ad-{{$ad->slug}}">
                    <div class="icon-box" style="padding: 15px;">
                        @if($ad->ad_type=='image')
                            <div class="icon"><i class="bx bx-image"></i></div>
                        @elseif($ad->ad_type=='page')
                            <div class="icon"><i class="bx bxl-wordpress"></i></div>
                        @elseif($ad->ad_type=='youtube')
                            <div class="icon"><i class="bx bxl-youtube"></i></div>
                        @endif
                        <p>{{$ad->title}}</p>
                        <a class="appointment-btn view-ad-btn mx-0 my-2" href="/user-ads/{{$ad->slug}}">Show Details</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@stop
