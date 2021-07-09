@extends('layouts/app')
@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Your Last 50 Transactions</h2>
                <ol>
                    <li><a href="/">Home</a></li>
                    <li><a href="/profile">Profile</a></li>
                    <li>Transactions</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-5 card p-3">Your Final Balance: {{auth()->user()->balance}} EGP</div>
                <div class="col-md-2"></div>
                <div class="col-md-5 card p-3">Your Pending Balance: {{auth()->user()->pending_balance}} EGP</div>
            </div>
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Transaction ID</th>
                    <th>Amount</th>
                    <th>New Balance</th>
                    <th>Date</th>
                </thead>
                <tbody>
                @foreach($transactions as $k=>$transaction)
                    <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$transaction->transaction_id}}</td>
                        <td style="color: {{$transaction->transaction_type=='deposit'?'green':'red'}}">{{$transaction->transaction_type=='deposit'?'+ ':'- '}}{{$transaction->amount}} EGP</td>
                        <td>{{$transaction->new_balance}} EGP</td>
                        <td>{{$transaction->created_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@stop
