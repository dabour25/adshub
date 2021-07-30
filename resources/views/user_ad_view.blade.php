@extends('layouts/app')
@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>@lang("strings.Your Ad") {{$ad->title}}</h2>
                <ol>
                    <li><a href="/">@lang("strings.Home")</a></li>
                    <li><a href="/profile">@lang("strings.Profile")</a></li>
                    <li><a href="/user-ads">@lang("strings.Your Ads")</a></li>
                    <li>@lang("strings.Ad"): {{$ad->title}}</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4><strong>@lang("strings.Title"):</strong> {{$ad->title}}</h4>
                    <h4><strong>@lang("strings.Total Cost"):</strong> {{$ad->total_cost}} @lang("strings.EGP")</h4>
                    <h4><strong>@lang("strings.Available Cost"):</strong> {{$ad->available_cost}} @lang("strings.EGP")</h4>
                    <h4><strong>@lang("strings.Spent Cost"):</strong> {{$ad->spent_cost}} @lang("strings.EGP")</h4>
                </div>
                <div class="col-md-6">
                    <h4><strong>@lang("strings.Views"):</strong> {{$ad->views}}</h4>
                    <h4><strong>@lang("strings.Clicks"):</strong> {{$ad->clicks}}</h4>
                    <h4><strong>@lang("strings.Max Time"):</strong> {{$ad->max_time}} S</h4>
                </div>
            </div>
            <hr>
            @if($ad->ad_type=='image')
                <img src="{{asset('/images/ads_images')}}/{{$ad->ad_view}}" style="max-width: 300px;">
                <h4><strong>@lang("strings.Link") : </strong>{{$ad->link??'--'}}</h4>
            @elseif($ad->ad_type=='page')
                <a href="#" onclick="openAd()" class="btn btn-primary">Open</a>
                <script>
                    function openAd() {
                        var ad_window=window.open('{{$ad->ad_view}}','newwindow','width=800,height=500');
                        var time=0;
                        let refreshIntervalId=setInterval(function () {
                            if(ad_window.closed){
                                clearInterval(refreshIntervalId);
                            }
                            if(time>={{$ad->max_time*1000}}){
                                ad_window.close();
                                clearInterval(refreshIntervalId);
                            }
                            time+=10;
                        },10);
                    }
                </script>
                <h4><strong>@lang("strings.Link") : </strong>{{$ad->link??'--'}}</h4>
            @elseif($ad->ad_type=='youtube')
                <a href="#" onclick="openAd()" class="btn btn-primary">Open Video</a>
                <script>
                    function openAd() {
                        var ad_window=window.open('{{$ad->ad_view}}','newwindow','width=800,height=500');
                        var time=0;
                        let refreshIntervalId=setInterval(function () {
                            if(ad_window.closed){
                                clearInterval(refreshIntervalId);
                            }
                            if(time>={{$ad->max_time*1000}}){
                                ad_window.close();
                                clearInterval(refreshIntervalId);
                            }
                            time+=10;
                        },10);
                    }
                </script>
                <h4><strong>@lang("strings.Link") : </strong>{{$ad->link??'--'}}</h4>
            @endif
            <hr>
            @if($ad->approved==0)
                <h4 class="my-3">@lang("strings.Ad Status"): <span style="color:{{$ad_data->approved==2?'green':'red'}};">@lang("strings.In Review")</span></h4>
            @else
                <h4 class="my-3">@lang("strings.Ad Status"): <span style="color:{{$ad->approved==2?'#9df99d':'#ff4949'}};">{{$ad->approved==1?__("strings.Rejected"):__("strings.Approved")}}</span></h4>
            @endif
        </div>
    </section>
@stop
