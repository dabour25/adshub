@extends('layouts/app')
@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Transfer Money</h2>
                <ol>
                    <li><a href="/">Home</a></li>
                    <li>Transfer Money</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page">
        <div class="container">
            @if(empty($user))
                <h4>User Not Found or You can't send money to yourself</h4>
            @else
                <form action="/transfer" method="post">
                    @csrf
                    <h5>Make Sure that user name is right before sending</h5>
                    <label>Send Money to {{$user->name}} (Amount in EGP)</label>
                    <input type="text" class="form-control {{$errors->has('title')?'border-danger':''}}" name="amount" value="{{old('amount')}}" placeholder="Your Available Balance is {{auth()->user()->balance}} EGP">
                    @if ($errors->has('amount'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('amount') }}
                        </div>
                    @endif
                    <label>Your Password To make sure that you:</label>
                    <input type="password" class="form-control {{$errors->has('title')?'border-danger':''}}" name="password">
                    @if ($errors->has('password'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                    <input type="hidden" name="slug" value="{{$user->slug}}">
                    <button type="submit" class="appointment-btn my-2">Send</button>
                </form>
            @endif
        </div>
    </section>
@stop
