@extends('admin/layouts/app')
@section('content')
    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Old Ads</li>
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
        <!-- Page Content -->
            <div class="container">
                <div class="card-body">
                    <div class="table-responsive">
                        <h4>Ads</h4> <a href="/admin/ads" class="btn btn-primary my-2">See New Ads</a>
                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Ad Slug</th>
                                <th scope="col">Available Cost</th>
                                <th scope="col">Approval</th>
                                <th scope="col">Type</th>
                                <th scope="col">Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($oldAds as $k=>$ad)
                                <tr>
                                    <th scope="row">{{$k+1}}</th>
                                    <td>{{$ad->title}}</td>
                                    <td>
                                        <a href="/admin/ads/{{$ad->slug}}">
                                            {{$ad->slug}}
                                        </a>
                                    </td>
                                    <td>{{$ad->available_cost}}</td>
                                    <td>{{$ad->approved==1?'Rejected':'Approved'}}</td>
                                    <td>{{$ad->ad_type}}</td>
                                    <td>{{$ad->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $oldAds->links() }}
            </div>
        </div>
    </div>

    </div>
    <!-- /.content-wrapper -->

    </div>
@stop
