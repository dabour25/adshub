@extends('layouts/app')
@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>@lang("strings.Register New User")</h2>
                <ol>
                    <li><a href="/">@lang("strings.Home")</a></li>
                    <li>@lang("strings.Registration")</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page">
        <div class="container">
            <form action="/auth/register" method="post" style="width: 60%;margin: auto;">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label>@lang("strings.Name")</label>
                        <input type="text" name="name" class="form-control {{$errors->has('name')?'border-danger':''}}" value="{{old('name')}}">
                        @if ($errors->has('name'))
                            <div class="text-danger" role="alert">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                        <label>@lang("strings.Email")</label>
                        <input type="text" name="email" class="form-control {{$errors->has('email')?'border-danger':''}}" value="{{old('email')}}">
                        @if ($errors->has('email'))
                            <div class="text-danger" role="alert">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                        <label>@lang("strings.Phone") (@lang("strings.vodafone if no Paypal Account"))</label>
                        <input type="text" name="phone" class="form-control {{$errors->has('phone')?'border-danger':''}}" value="{{old('phone')}}">
                        @if ($errors->has('phone'))
                            <div class="text-danger" role="alert">
                                {{ $errors->first('phone') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label>@lang("strings.Paypal Email") (@lang("strings.optional"))</label>
                        <input type="text" name="paypal_email" class="form-control {{$errors->has('paypal_email')?'border-danger':''}}" value="{{old('paypal_email')}}">
                        @if ($errors->has('paypal_email'))
                            <div class="text-danger" role="alert">
                                {{ $errors->first('paypal_email') }}
                            </div>
                        @endif
                        <label>@lang("strings.Password")</label>
                        <input type="password" name="password" id="password" class="form-control {{$errors->has('password')?'border-danger':''}}">
                        @if ($errors->has('password'))
                            <div class="text-danger" role="alert">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                        <label>@lang("strings.Password Confirm")</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                    </div>
                </div>
                <input type="hidden" name="refid" value="{{$_GET['refid']??''}}">
                <br>
                <input type="checkbox" id="terms" onclick="termsCheck()">@lang("strings.Agree Our") <a href="/terms" target="_blank">@lang("strings.Terms&Conditions")</a>
                <br>
                <button class="appointment-btn my-2" type="submit" disabled id="register">@lang("strings.Register")</button>
            </form>
        </div>
    </section>
    <script>
        function termsCheck() {
           if(document.getElementById('terms').checked){
               document.getElementById("register").disabled = false;
           } else{
               document.getElementById("register").disabled = true;
           }
        }
    </script>
    {!! session()->get('enc_script') !!}
@stop
