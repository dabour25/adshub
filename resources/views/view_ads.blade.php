@extends('layouts/app')
@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>@lang("strings.View Ads")</h2>
                <ol>
                    <li><a href="/">@lang("strings.Home")</a></li>
                    <li>@lang("strings.View Ads")</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page services">
        <div class="container">
            @if(count($ads)>0)
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
                            @if($ad->ad_type=='image')
                                <button onclick="openAd('{{$ad->slug}}','{{url('/').'/images/ads_images/'.$ad->ad_view}}',{{$ad->max_time}})" class="appointment-btn view-ad-btn mx-0">@lang("strings.View Ad")</button>
                            @else
                                <button onclick="openAd('{{$ad->slug}}','{{$ad->ad_view}}',{{$ad->max_time}})" class="appointment-btn mx-0">@lang("strings.View Ad")</button>
                            @endif
                            @if(!$ad->link)
                                <a href="#" class="appointment-btn mx-0 my-2">@lang("strings.No Link")</a>
                            @else
                                <a onclick="visitAd('{{$ad->slug}}','{{$ad->link}}')" class="appointment-btn view-ad-btn mx-0 my-2" style="cursor: pointer">@lang("strings.Visit Link")</a>
                            @endif
                    </div>
                </div>
                @endforeach
            </div>
            @else
                <h4>@lang("strings.There are no ads available now")</h4>
            @endif
        </div>
    </section>
    <script>
        function openAd(slug,ad_view,max_time) {
            var ad_window=window.open(ad_view,'newwindow','width=800,height=500');
            var time=0;
            $(".view-ad-btn").prop('disabled', true);
            let refreshIntervalId=setInterval(function () {
                if(ad_window.closed){
                    completeAd(slug,time/1000);
                    clearInterval(refreshIntervalId);
                    $(".view-ad-btn").prop('disabled', false);
                    $("#ad-"+slug).remove();
                }
                if(time>=max_time*1000){
                    ad_window.close();
                    completeAd(slug,time/1000);
                    clearInterval(refreshIntervalId);
                    $(".view-ad-btn").prop('disabled', false);
                    $("#ad-"+slug).remove();
                }
                time+=500;
            },500);
        }
        function visitAd(slug,adLink) {
            completeAd(slug,0,true);
            window.open(adLink,'_blank');
            $("#ad-"+slug).remove();
        }
        function completeAd(slug,time,click=false) {
            var xhttp = new XMLHttpRequest();
            xhttp.responseType = 'json';
            var data = new FormData();
            data.append('slug', slug);
            data.append('time', time);
            data.append('click', click);
            data.append('_token', "{{ csrf_token() }}");
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    Swal.fire(
                        '@lang("strings.Success")!',
                        this.response,
                        'success'
                    )
                }else if(this.readyState == 4){
                    Swal.fire({
                        icon: 'error',
                        title: '@lang("strings.Oops")...',
                        text: this.response.data
                    })
                }
            };
            xhttp.open("POST", "/view-ads", true);
            xhttp.send(data);
        }
    </script>
@stop
