<?php

namespace App\Http\Controllers;


use App\Services\TransactionsService;
use Illuminate\Support\Facades\Auth;

class RequestsController extends Controller
{
    public function index(){
        $page='New Request';
        return view('requests.index',compact('page'));
    }


}
