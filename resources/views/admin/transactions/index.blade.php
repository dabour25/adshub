@extends('admin/layouts/app')
@section('content')
    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Transaction History</li>
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
                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Transaction ID</th>
                                <th scope="col">Type</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Balance</th>
                                <th scope="col">Comment</th>
                                <th scope="col">User</th>
                                <th scope="col">Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $k=>$transaction)
                                <tr>
                                    <th scope="row">{{$k+1}}</th>
                                    <td>{{$transaction->transaction_id}}</td>
                                    <td>{{$transaction->transaction_type=='deposit'?'D':'W'}}</td>
                                    <td>{{$transaction->amount}}</td>
                                    <td>{{$transaction->new_balance}}</td>
                                    <td>{{$transaction->comment}}</td>
                                    <td>{{$transaction->user->slug}}</td>
                                    <td>{{$transaction->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $transactions->links() }}
            </div>
        </div>
    </div>

    </div>
    <!-- /.content-wrapper -->

    </div>
@stop
