@extends('admin/layouts/app')
@section('content')
    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Requests</li>
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
                        <h4>New Requests</h4>
                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Request ID</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Reason</th>
                                <th scope="col">Method</th>
                                <th scope="col">User</th>
                                <th scope="col">Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($newRequests as $k=>$newRequest)
                                <tr>
                                    <th scope="row">{{$k+1}}</th>
                                    <td>
                                        <a href="/admin/requests/{{$newRequest->request_id}}">
                                            {{$newRequest->request_id}}
                                        </a>
                                    </td>
                                    <td>{{$newRequest->amount}}</td>
                                    <td>{{$newRequest->reason}}</td>
                                    <td>{{$newRequest->method}}</td>
                                    <td>{{$newRequest->user->slug}}</td>
                                    <td>{{$newRequest->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $newRequests->links() }}
            </div>
        </div>
    </div>

    </div>
    <!-- /.content-wrapper -->

    </div>
@stop
