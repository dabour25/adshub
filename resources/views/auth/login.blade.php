@extends('layouts/app')
@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>@lang("strings.Login")</h2>
                <ol>
                    <li><a href="/">@lang("strings.Home")</a></li>
                    <li>@lang("strings.Login")</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <form action="/auth/login" method="post" style="width:80%;margin: auto;">
                        @csrf
                        <br>
                        <label>@lang("strings.Email") @lang("strings.or") @lang("strings.Phone")</label>
                        <input type="text" name="user_id" class="form-control {{$errors->has('user_id')?'border-danger':''}}" value="{{old('user_id')}}">
                        @if ($errors->has('user_id'))
                            <div class="text-danger" role="alert">
                                {{ $errors->first('user_id') }}
                            </div>
                        @endif
                        <label>@lang("strings.Password")</label>
                        <input type="password" name="password" class="form-control" id="password">
                        <br>
                        <button class="appointment-btn" type="submit" id="login">@lang("strings.Login")</button>
                    </form>
                </div>
                <div class="col-md-3">
                    <img src="{{asset('/assets/img/vectors')}}/sign-in.png" width="100%">
                </div>
            </div>
        </div>
    </section>
    {!! session()->get('enc_script') !!}
@stop
