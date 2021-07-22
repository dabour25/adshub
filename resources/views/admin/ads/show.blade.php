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
                    <a href="/admin/ads">Ads</a>
                </li>
                <li class="breadcrumb-item active">Ad: {{$ad_data->slug}}</li>
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
                    <h4><strong>Ad Slug:</strong> {{$ad_data->slug}}</h4>
                    <h4><strong>Title:</strong> {{$ad_data->title}}</h4>
                    <h4><strong>Total Cost:</strong> {{$ad_data->total_cost}}</h4>
                    <h4><strong>Available Cost:</strong> {{$ad_data->available_cost}}</h4>
                    <h4><strong>Spent Cost:</strong> {{$ad_data->spent_cost}}</h4>
                </div>
                <div class="col-md-6">
                    <h4><strong>User Name:</strong> {{$ad_data->user->name}}</h4>
                    <h4><strong>User Email:</strong> {{$ad_data->user->email}}</h4>
                    <h4><strong>User Paypal:</strong> {{$ad_data->user->paypal_email??'--'}}</h4>
                    <h4><strong>User Phone:</strong> {{$ad_data->user->phone}}</h4>
                </div>
            </div>
            <hr>
            @if($ad_data->ad_type=='image')
                <img src="{{asset('/images/ads')}}/{{$ad_data->ad_view}}" style="max-width: 300px;">
                <h4><strong>Link:</strong>{{$ad_data->link??'--'}}</h4>
            @elseif($ad_data->ad_type=='page')
                <a href="#" onclick="openAd()" class="btn btn-primary">Open</a>
            <script>
                function openAd() {
                    var ad_window=window.open('{{$ad_data->ad_view}}','newwindow','width=800,height=500');
                    var time=0;
                    let refreshIntervalId=setInterval(function () {
                        if(ad_window.closed){
                            alert('window is closed');
                            clearInterval(refreshIntervalId);
                        }
                        if(time>={{$ad_data->max_time*1000}}){
                            ad_window.close();
                            clearInterval(refreshIntervalId);
                        }
                        time+=10;
                    },10);
                }
            </script>
                <h4><strong>Link:</strong>{{$ad_data->link??'--'}}</h4>
            @elseif($ad_data->ad_type=='youtube')
            @endif
            <hr>
            @if($ad_data->approved==0)
            <form action="/admin/ads" method="post">
                @csrf
                <input type="hidden" value="{{$ad_data->slug}}" name="ad_id">
                <br>
                <button type="submit" class="btn btn-primary">Approve Ad</button>
                <a href="/admin/cancel-ad/{{$ad_data->slug}}" class="btn btn-danger">Reject Ad</a>
            </form>
            @else
                <h4 class="my-3">Ad Status: <span style="color:{{$request_data->request_status==1?'green':'red'}};">{{$ad_data->approved==1?'Rejected':'Approved'}}</span></h4>
            @endif
        </div>
    </div>
@stop
