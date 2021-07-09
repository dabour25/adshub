<?php

namespace App\Http\Controllers;


use App\Services\TransactionsService;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
{
    public function index(TransactionsService $transactionsService){
        $page='Transactions';
        $transactions=$transactionsService->getTransactions(Auth::user()->id);
        return view('transactions',compact('page','transactions'));
    }


}
