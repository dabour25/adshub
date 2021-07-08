@extends('layouts/app')
@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Login</h2>
                <ol>
                    <li><a href="/">Home</a></li>
                    <li>Login</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page">
        <div class="container">
            <form action="/auth/login" method="post" style="width: 60%;margin: auto;">
                @csrf
                <label>Email or Phone</label>
                <input type="text" name="user_id" class="form-control {{$errors->has('user_id')?'border-danger':''}}" value="{{old('user_id')}}">
                @if ($errors->has('user_id'))
                    <div class="text-danger" role="alert">
                        {{ $errors->first('user_id') }}
                    </div>
                @endif
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <br>
                <button class="btn btn-primary" type="submit">Login</button>
            </form>
        </div>
    </section>
@stop
