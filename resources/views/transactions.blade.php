@extends('layouts/app')
@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>@lang("strings.Your Last 50 Transactions")</h2>
                <ol>
                    <li><a href="/">@lang("strings.Home")</a></li>
                    <li><a href="/profile">@lang("strings.Profile")</a></li>
                    <li>@lang("strings.Transactions")</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page">
        <div class="container">
            <a href="/cash-request" class="appointment-btn my-1">@lang("strings.New Request")</a>
            <div class="row">
                <div class="col-md-5 card p-3">@lang("strings.Your Final Balance"): {{auth()->user()->balance}} @lang("strings.EGP")</div>
                <div class="col-md-2"></div>
                <div class="col-md-5 card p-3">@lang("strings.Your Pending Balance"): {{auth()->user()->pending_balance}} @lang("strings.EGP")</div>
            </div>
            <table class="table transactions-table">
                <thead>
                    <th>#</th>
                    <th>@lang("strings.Transaction ID")</th>
                    <th>@lang("strings.Amount")</th>
                    <th>@lang("strings.New Balance")</th>
                    <th>@lang("strings.Date")</th>
                </thead>
                <tbody>
                @foreach($transactions as $k=>$transaction)
                    <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$transaction->transaction_id}}</td>
                        <td style="color: {{$transaction->transaction_type=='deposit'?'#9df99d':'#ff4949'}}">{{$transaction->transaction_type=='deposit'?'+ ':'- '}}{{$transaction->amount}} @lang("strings.EGP")</td>
                        <td>{{$transaction->new_balance}} @lang("strings.EGP")</td>
                        <td>{{$transaction->created_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@stop
