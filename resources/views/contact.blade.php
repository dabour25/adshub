@extends('layouts/app')
@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Contact Us</h2>
                <ol>
                    <li><a href="/">Home</a></li>
                    <li>Contact Us</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page">
        <div class="container">
            <form action="/contact" method="post" style="width: 60%;margin: auto;">
                @csrf
                <div class="row">
                    <div class="col-md-6 form-group">
                        <input type="text" name="name" class="form-control {{$errors->has('name')?'border-danger':''}}" value="{{old('name')}}" id="name" placeholder="Your Name" required>
                        @if ($errors->has('name'))
                            <div class="text-danger" role="alert">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6 form-group mt-3 mt-md-0">
                        <input type="email" class="form-control {{$errors->has('email')?'border-danger':''}}" value="{{old('email')}}" name="email" id="email" placeholder="Your Email" required>
                        @if ($errors->has('email'))
                            <div class="text-danger" role="alert">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group mt-3">
                    <input type="text" class="form-control {{$errors->has('subject')?'border-danger':''}}" value="{{old('subject')}}" name="subject" id="subject" placeholder="Subject" required>
                    @if ($errors->has('subject'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('subject') }}
                        </div>
                    @endif
                </div>
                <div class="form-group mt-3">
                    <textarea class="form-control {{$errors->has('message')?'border-danger':''}}" name="message" rows="5" placeholder="Message" required>{{old('message')}}</textarea>
                    @if ($errors->has('message'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('message') }}
                        </div>
                    @endif
                </div>
                <div class="text-center my-1"><button type="submit" class="btn appointment-btn">Send Message</button></div>
            </form>
        </div>
    </section>
@stop
