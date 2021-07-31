@extends('layouts/app')
@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>404</h2>
                <ol>
                    <li><a href="/">@lang("strings.Home")</a></li>
                    <li>404</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page services">
        <div class="container" style="text-align: center;margin: auto;">
            <img src="{{asset('/assets/img/404.png')}}" style="width: 40%;">
            <h4>@lang("strings.Page Not Found")</h4>
        </div>
    </section>
@stop
