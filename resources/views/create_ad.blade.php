@extends('layouts/app')
@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>@lang("strings.Create New Ad")</h2>
                <ol>
                    <li><a href="/">@lang("strings.Home")</a></li>
                    <li>@lang("strings.Create New Ad")</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page">
        <div class="container">
            <label>@lang("strings.Select Ad type")</label>
            <select id="type" class="form-control">
                <option value="">@lang("strings.Select Type")</option>
                <option value="image" {{old('ad_type')=='image'?'selected':''}}>@lang("strings.Image")</option>
                <option value="page" {{old('ad_type')=='page'?'selected':''}}>@lang("strings.Web Page")</option>
                <option value="youtube" {{old('ad_type')=='youtube'?'selected':''}}>@lang("strings.Youtube Video")</option>
                <option value="video" disabled>@lang("strings.Video") (@lang("strings.Soon"))</option>
            </select>
            <div id="image-div" style="display: none;">
                <form action="/create-ad" method="post" enctype="multipart/form-data">
                    @csrf
                    <label>@lang("strings.Ad title")</label>
                    <input type="text" class="form-control {{$errors->has('title')?'border-danger':''}}" name="title">
                    @if ($errors->has('title'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                    <label>@lang("strings.Total Cost")</label>
                    <input type="text" class="form-control {{$errors->has('total_cost')?'border-danger':''}}" name="total_cost" placeholder="@lang("strings.You have balance") {{auth()->user()->balance}} @lang("strings.EGP")">
                    @if ($errors->has('total_cost'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('total_cost') }}
                        </div>
                    @endif
                    <label>@lang("strings.Max Time") (@lang("strings.seconds")):</label>
                    <input type="text" class="form-control {{$errors->has('max_time')?'border-danger':''}}" name="max_time" placeholder="@lang("strings.max value is") 30 @lang("strings.sec")">
                    @if ($errors->has('max_time'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('max_time') }}
                        </div>
                    @endif
                    <label>@lang("strings.Image Clickable Link") (@lang("strings.redirect"))</label>
                    <input type="text" class="form-control {{$errors->has('link')?'border-danger':''}}" name="link" placeholder="@lang("strings.enter your web url or leave empty")">
                    @if ($errors->has('link'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('link') }}
                        </div>
                    @endif
                    <label>@lang("strings.Image") (@lang("strings.Ad")):</label>
                    <input type="file" class="form-control {{$errors->has('ad_view')?'border-danger':''}}" name="ad_view">
                    @if ($errors->has('ad_view'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('ad_view') }}
                        </div>
                    @endif
                    <input type="hidden" name="ad_type" value="image">
                    <h5>@lang("strings.Customize audience available soon")</h5>
                    <button class="appointment-btn my-2" type="submit">@lang("strings.Create Ad")</button>
                </form>
            </div>
            <div id="page-div" style="display: none;">
                <form action="/create-ad" method="post">
                    @csrf
                    <label>@lang("strings.Ad title")</label>
                    <input type="text" class="form-control {{$errors->has('title')?'border-danger':''}}" name="title" value="{{old('title')}}">
                    @if ($errors->has('title'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                    <label>@lang("strings.Total Cost")</label>
                    <input type="text" class="form-control {{$errors->has('total_cost')?'border-danger':''}}" name="total_cost" placeholder="@lang("strings.You have balance") {{auth()->user()->balance}} @lang("strings.EGP")" value="{{old('total_cost')}}">
                    @if ($errors->has('total_cost'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('total_cost') }}
                        </div>
                    @endif
                    <label>@lang("strings.Max visit Time") (@lang("strings.seconds")):</label>
                    <input type="text" class="form-control {{$errors->has('max_time')?'border-danger':''}}" name="max_time" placeholder="@lang("strings.max value is") 40 @lang("strings.sec")" value="{{old('max_time')}}">
                    @if ($errors->has('max_time'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('max_time') }}
                        </div>
                    @endif
                    <label>@lang("strings.URL") (@lang("strings.Ad")):</label>
                    <input type="text" class="form-control {{$errors->has('ad_view')?'border-danger':''}}" name="ad_view" placeholder="@lang("strings.enter your web url")" value="{{old('ad_view')}}">
                    @if ($errors->has('ad_view'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('ad_view') }}
                        </div>
                    @endif
                    <input type="hidden" name="ad_type" value="page">
                    <h5>@lang("strings.Customize audience available soon")</h5>
                    <button class="appointment-btn my-2" type="submit">@lang("strings.Create Ad")</button>
                </form>
            </div>
            <div id="youtube-div" style="display: none;">
                <form action="/create-ad" method="post">
                    @csrf
                    <label>@lang("strings.Ad title")</label>
                    <input type="text" class="form-control {{$errors->has('title')?'border-danger':''}}" name="title" value="{{old('title')}}">
                    @if ($errors->has('title'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                    <label>@lang("strings.Total Cost")</label>
                    <input type="text" class="form-control {{$errors->has('total_cost')?'border-danger':''}}" name="total_cost" placeholder="@lang("strings.You have balance") {{auth()->user()->balance}} @lang("strings.EGP")" value="{{old('total_cost')}}">
                    @if ($errors->has('total_cost'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('total_cost') }}
                        </div>
                    @endif
                    <label>@lang("strings.Max watch Time") (@lang("strings.seconds")):</label>
                    <input type="text" class="form-control {{$errors->has('max_time')?'border-danger':''}}" name="max_time" placeholder="@lang("strings.max value is") 180 @lang("strings.sec")" value="{{old('max_time')}}">
                    @if ($errors->has('max_time'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('max_time') }}
                        </div>
                    @endif
                    <label>@lang("strings.Video URL") (@lang("strings.Ad")):</label>
                    <input type="text" class="form-control {{$errors->has('ad_view')?'border-danger':''}}" name="ad_view" placeholder="@lang("strings.enter your video url")" value="{{old('ad_view')}}">
                    @if ($errors->has('ad_view'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('ad_view') }}
                        </div>
                    @endif
                    <label>@lang("strings.Channel URL") (@lang("strings.optional")):</label>
                    <input type="text" class="form-control {{$errors->has('link')?'border-danger':''}}" name="link" placeholder="@lang("strings.enter your channel url,Subscribe link")" value="{{old('link')}}">
                    @if ($errors->has('link'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('link') }}
                        </div>
                    @endif
                    <input type="hidden" name="ad_type" value="youtube">
                    <h5>@lang("strings.Customize audience available soon")</h5>
                    <button class="appointment-btn my-2" type="submit">@lang("strings.Create Ad")</button>
                </form>
            </div>
        </div>
    </section>
    <script>
        function changeForm(){
            if($("#type").val()=="image"){
                $("#image-div").show();
                $("#page-div").hide();
                $("#youtube-div").hide();
            }else if($("#type").val()=="page"){
                $("#image-div").hide();
                $("#page-div").show();
                $("#youtube-div").hide();
            }else if($("#type").val()=="youtube"){
                $("#image-div").hide();
                $("#page-div").hide();
                $("#youtube-div").show();
            }else{
                $("#image-div").hide();
                $("#page-div").hide();
                $("#youtube-div").hide();
            }
        }
        $("#type").change(function () {
           changeForm();
        });
        changeForm();
    </script>
@stop
