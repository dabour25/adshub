@extends('admin/layouts/app')
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/users">Users</a>
                </li>
                <li class="breadcrumb-item active">User: {{$user->slug}}</li>
            </ol>
            <!-- Page Content -->
            @if(count($errors)>0)
                <br>
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(Session::has('m'))
                <?php $a=[]; $a=session()->pull('m'); ?>
                <div class="alert alert-{{$a[0]}}" style="width: 40%">
                    {{$a[1]}}
                </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <h4><strong>User Slug:</strong> {{$user->slug}}</h4>
                    <h4><strong>Email:</strong> {{$user->email}}</h4>
                    <h4><strong>Paypal Account:</strong> {{$user->paypal_email}}</h4>
                    <h4><strong>Phone:</strong> {{$user->phone}}</h4>
                    <h4><strong>Affiliate:</strong>
                        <a href="/admin/users/{{$user->user_affiliate->slug??''}}">
                            {{$user->user_affiliate->slug??'--'}}
                        </a>
                    </h4>
                </div>
                <div class="col-md-6">
                    <h4><strong>User Name:</strong> {{$user->name}}</h4>
                    <h4><strong>Balance:</strong> {{$user->balance}}</h4>
                    <h4><strong>Pending Balance:</strong> {{$user->pending_balance}}</h4>
                    <h4><strong>Role:</strong> {{$user->user_status}}</h4>
                </div>
            </div>
            <hr>
            <h4><strong>Country:</strong> {{$user->user_data->country}}</h4>
            <h4><strong>City:</strong> {{$user->user_data->city}}</h4>
            <h4><strong>Address:</strong> {{$user->user_data->address}}</h4>
            <h4><strong>Gender:</strong> {{$user->user_data->gender}}</h4>
            <h4><strong>age:</strong> {{$user->user_data->age}}</h4>
            <h4><strong>nationality:</strong> {{$user->user_data->nationality}}</h4>
            <h4><strong>Interests:</strong> {{$user->user_data->interests}}</h4>
            <br>
            <a href="/admin/users/{{$user->slug}}/edit" class="btn btn-primary">Edit</a>
        </div>
    </div>
@stop
