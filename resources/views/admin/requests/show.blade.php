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
                    <a href="/admin/requests">Requests</a>
                </li>
                <li class="breadcrumb-item active">Request: {{$request_data->request_id}}</li>
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
                    <h4><strong>Request ID:</strong> {{$request_data->request_id}}</h4>
                    <h4><strong>Amount:</strong> {{$request_data->amount}} L.E</h4>
                    <h4><strong>Reason:</strong> {{$request_data->reason}}</h4>
                    <h4><strong>Method:</strong> {{$request_data->method}}</h4>
                </div>
                <div class="col-md-6">
                    <h4><strong>User Name:</strong> {{$request_data->user->name}}</h4>
                    <h4><strong>User Email:</strong> {{$request_data->user->email}}</h4>
                    <h4><strong>User Paypal:</strong> {{$request_data->user->paypal_email??'--'}}</h4>
                    <h4><strong>User Phone:</strong> {{$request_data->user->phone}}</h4>
                </div>
            </div>
            @if($request_data->request_status==0)
            <form action="/admin/requests" method="post">
                @csrf
                @if($request_data->reason=='deposit')
                <label>Real Amount</label>
                <input type="text" value="{{old('amount')}}" name="amount" class="form-control">
                @endif
                <input type="hidden" value="{{$request_data->request_id}}" name="request_id">
                <br>
                <button type="submit" class="btn btn-primary">Make Transaction</button>
                <a href="/admin/cancel-request/{{$request_data->request_id}}" class="btn btn-danger">Cancel Request</a>
            </form>
            @else
                <h4 class="my-3">Request Status: <span style="color:{{$request_data->request_status==1?'green':'red'}};">{{$request_data->request_status==1?'Approved':'Canceled'}}</span></h4>
            @endif
        </div>
    </div>
@stop
