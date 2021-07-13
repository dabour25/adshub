@extends('layouts/app')
@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>New Request</h2>
                <ol>
                    <li><a href="/">Home</a></li>
                    <li><a href="/profile">Profile</a></li>
                    <li><a href="/transactions">Transactions</a></li>
                    <li>New Request</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page">
        <div class="container">
            @if(auth()->user()->pending_balance!=0)
                <h1>You Must Haven't any pending balance/pending requests to make new request</h1>
            @else
                <form action="/cash-request" method="post" style="width: 60%;margin: auto;">
                    @csrf
                    <label>Select Request Type</label>
                    <select class="form-control {{$errors->has('type')?'border-danger':''}}" name="type">
                        <option value="deposit" {{old('type')=='deposit'?'selected':''}}>Deposit</option>
                        <option value="withdraw" {{old('type')=='withdraw'?'selected':''}}>Withdraw</option>
                    </select>
                    @if ($errors->has('type'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('type') }}
                        </div>
                    @endif
                    <label>Amount <span id="withdraw-amount"></span></label>
                    <input type="text" name="amount" class="form-control {{$errors->has('amount')?'border-danger':''}}" value="{{old('amount')}}">
                    @if ($errors->has('amount'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('amount') }}
                        </div>
                    @endif
                    <label>Select Payment Method</label>
                    <select class="form-control {{$errors->has('method')?'border-danger':''}}" name="method">
                        @if(substr(auth()->user()->phone,0,3)=='010'||substr(auth()->user()->phone,0,5)=='+2010')
                        <option value="vf_cash" {{old('method')=='vf cash'?'selected':''}}>Vodafone cash</option>
                        @endif
                        @if(!empty(auth()->user()->paypal_email))
                        <option value="paypal" {{old('method')=='paypal'?'selected':''}}>Paypal</option>
                        @endif
                    </select>
                    @if ($errors->has('method'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('method') }}
                        </div>
                    @endif
                    <div>
                        <ul>
                            @if(substr(auth()->user()->phone,0,3)!='010')
                                <li>Your registered Paypal account is: {{auth()->user()->paypal_email}}</li>
                            @elseif(substr(auth()->user()->phone,0,5)!='+2010')
                                <li>Your registered Paypal account is: {{auth()->user()->paypal_email}}</li>
                            @else
                                <li>Your registered Vodafone cash number is: {{auth()->user()->phone}}</li>
                            @endif
                            <li>if any data wasn't real plz change it before request</li>
                        </ul>
                    </div>
                    <br>
                    <button class="btn btn-primary" type="submit">Make Request</button>
                </form>
            @endif
            <span class="card m-2">
                <h4>Notes !</h4>
                <ul>
                    <li>Minimum withdraw amount 50 EGP and Maximum 1000 EGP</li>
                    <li>Minimum Deposit amount 20 EGP and Maximum 3000 EGP</li>
                    <li>All transactions Completed or canceled within 48 Hours</li>
                </ul>
            </span>
        </div>
    </section>
@stop
