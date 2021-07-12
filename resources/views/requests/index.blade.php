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
                        <option value="vf cash" {{old('method')=='vf cash'?'selected':''}}>Vodafone cash</option>
                        <option value="paypal" {{old('method')=='paypal'?'selected':''}}>Paypal</option>
                    </select>
                    @if ($errors->has('method'))
                        <div class="text-danger" role="alert">
                            {{ $errors->first('method') }}
                        </div>
                    @endif
                    <br>
                    <button class="btn btn-primary" type="submit">Make Request</button>
                </form>
            @endif
        </div>
    </section>
@stop
