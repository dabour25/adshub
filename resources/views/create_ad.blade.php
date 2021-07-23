@extends('layouts/app')
@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Create New Ad</h2>
                <ol>
                    <li><a href="/">Home</a></li>
                    <li>Create New Ad</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page">
        <div class="container">
            <label>Select Ad type</label>
            <select id="type" class="form-control">
                <option value="">Select Type</option>
                <option value="image" {{old('ad_type')=='image'?'selected':''}}>Image</option>
                <option value="page" {{old('ad_type')=='page'?'selected':''}}>Web Page</option>
                <option value="youtube" {{old('ad_type')=='youtube'?'selected':''}}>Youtube Video</option>
                <option value="video" disabled>Video (Soon)</option>
            </select>
            <div id="image-div" style="display: none;">
                <form action="/create-ad" method="post" enctype="multipart/form-data">
                    @csrf
                    <label>Ad title</label>
                    <input type="text" class="form-control {{$errors->has('title')?'border-danger':''}}" name="title">
                    @if ($errors->has('title'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                    <label>Total Cost</label>
                    <input type="text" class="form-control {{$errors->has('total_cost')?'border-danger':''}}" name="total_cost" placeholder="You have balance {{auth()->user()->balance}} EGP">
                    @if ($errors->has('total_cost'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('total_cost') }}
                        </div>
                    @endif
                    <label>Max Time (seconds):</label>
                    <input type="text" class="form-control {{$errors->has('max_time')?'border-danger':''}}" name="max_time" placeholder="max value is 30s">
                    @if ($errors->has('max_time'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('max_time') }}
                        </div>
                    @endif
                    <label>Image Clickable Link (redirect)</label>
                    <input type="text" class="form-control {{$errors->has('link')?'border-danger':''}}" name="link" placeholder="enter your web url or leave empty">
                    @if ($errors->has('link'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('link') }}
                        </div>
                    @endif
                    <label>Image (Ad):</label>
                    <input type="file" class="form-control {{$errors->has('ad_view')?'border-danger':''}}" name="ad_view">
                    @if ($errors->has('ad_view'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('ad_view') }}
                        </div>
                    @endif
                    <input type="hidden" name="ad_type" value="image">
                    <h5>Customize audience available soon</h5>
                    <button class="appointment-btn my-2" type="submit">Create Ad</button>
                </form>
            </div>
            <div id="page-div" style="display: none;">
                <form action="/create-ad" method="post">
                    @csrf
                    <label>Ad title</label>
                    <input type="text" class="form-control {{$errors->has('title')?'border-danger':''}}" name="title" value="{{old('title')}}">
                    @if ($errors->has('title'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                    <label>Total Cost</label>
                    <input type="text" class="form-control {{$errors->has('total_cost')?'border-danger':''}}" name="total_cost" placeholder="You have balance {{auth()->user()->balance}} EGP" value="{{old('total_cost')}}">
                    @if ($errors->has('total_cost'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('total_cost') }}
                        </div>
                    @endif
                    <label>Max visit Time (seconds):</label>
                    <input type="text" class="form-control {{$errors->has('max_time')?'border-danger':''}}" name="max_time" placeholder="max value is 40s" value="{{old('max_time')}}">
                    @if ($errors->has('max_time'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('max_time') }}
                        </div>
                    @endif
                    <label>URL (Ad):</label>
                    <input type="text" class="form-control {{$errors->has('ad_view')?'border-danger':''}}" name="ad_view" placeholder="enter your web url or leave empty" value="{{old('ad_view')}}">
                    @if ($errors->has('ad_view'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('ad_view') }}
                        </div>
                    @endif
                    <input type="hidden" name="ad_type" value="page">
                    <h5>Customize audience available soon</h5>
                    <button class="appointment-btn my-2" type="submit">Create Ad</button>
                </form>
            </div>
            <div id="youtube-div" style="display: none;">
                <form action="/create-ad" method="post">
                    @csrf
                    <label>Ad title</label>
                    <input type="text" class="form-control {{$errors->has('title')?'border-danger':''}}" name="title" value="{{old('title')}}">
                    @if ($errors->has('title'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                    <label>Total Cost</label>
                    <input type="text" class="form-control {{$errors->has('total_cost')?'border-danger':''}}" name="total_cost" placeholder="You have balance {{auth()->user()->balance}} EGP" value="{{old('total_cost')}}">
                    @if ($errors->has('total_cost'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('total_cost') }}
                        </div>
                    @endif
                    <label>Max watch Time (seconds):</label>
                    <input type="text" class="form-control {{$errors->has('max_time')?'border-danger':''}}" name="max_time" placeholder="max value is 180s" value="{{old('max_time')}}">
                    @if ($errors->has('max_time'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('max_time') }}
                        </div>
                    @endif
                    <label>Video URL (Ad):</label>
                    <input type="text" class="form-control {{$errors->has('ad_view')?'border-danger':''}}" name="ad_view" placeholder="enter your web url or leave empty" value="{{old('ad_view')}}">
                    @if ($errors->has('ad_view'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('ad_view') }}
                        </div>
                    @endif
                    <label>Channel URL (optional):</label>
                    <input type="text" class="form-control {{$errors->has('link')?'border-danger':''}}" name="link" placeholder="enter your channel url,Subscribe link" value="{{old('link')}}">
                    @if ($errors->has('link'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('link') }}
                        </div>
                    @endif
                    <input type="hidden" name="ad_type" value="youtube">
                    <h5>Customize audience available soon</h5>
                    <button class="appointment-btn my-2" type="submit">Create Ad</button>
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
