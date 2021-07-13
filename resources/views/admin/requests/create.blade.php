@extends('admin/layouts/app')
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Create New Transaction</li>
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

            <form action="/admin/transactions" method="post" class="mx-2">
                @csrf
                <label>User ID (id-slug-email-phone)</label>
                <input type="text" name="user_id" value="{{old('user_id')}}" class="form-control">
                <label>transaction type</label>
                <select name="transaction_type" class="form-control">
                    <option value="deposit" {{old('transaction_type')=='deposit'?'selected':''}}>Deposit</option>
                    <option value="withdraw" {{old('transaction_type')=='withdraw'?'selected':''}}>Withdraw</option>
                </select>
                <label>Amount</label>
                <input type="text" value="{{old('amount')}}" name="amount" class="form-control">
                <label for="comment">Comment</label>
                <textarea name="comment" id="comment" class="form-control">{{old('comment')}}</textarea>
                <br>
                <button type="submit" class="btn btn-success">Create Transaction</button>
            </form>

        </div>
    </div>
@stop
