@extends('admin/layouts/app')
@section('content')
<div id="content-wrapper">
    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/admin">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
        </ol>

        <!-- Icon Cards-->
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-primary o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-comments"></i>
                        </div>
                            @if($messages_count!=0)
                            <div class="mr-5">{{$messages_count}} New Messages</div>
                            @else
                            <div class="mr-5">No New Messages</div>
                            @endif
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="/admin/messages">
                        <span class="float-left">View Details</span>
                        <span class="float-right">
                <i class="fas fa-angle-right"></i>
              </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-danger o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-list"></i>
                        </div>
                        @if($requests_count!=0)
                            <div class="mr-5">{{$requests_count}} New Requests</div>
                        @else
                            <div class="mr-5">No New Requests</div>
                        @endif
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="/admin/requests">
                        <span class="float-left">View Requests</span>
                        <span class="float-right">
                <i class="fas fa-angle-right"></i>
              </span>
                    </a>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-success o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-user"></i>
                        </div>
                        <div class="mr-5">Users Register: {{$usercount}}</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-warning o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-bullhorn"></i>
                        </div>
                        @if($ads_count!=0)
                            <div class="mr-5">{{$ads_count}} New Ads</div>
                        @else
                            <div class="mr-5">No New Ads</div>
                        @endif
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="/admin/ads">
                        <span class="float-left">View Ads</span>
                        <span class="float-right">
                <i class="fas fa-angle-right"></i>
              </span>
                    </a>
                </div>
            </div>
        </div>
@stop
