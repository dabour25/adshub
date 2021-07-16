<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Requests\Transactions\CreateTransactionValidator;
use App\Services\TransactionsService;
use App\Services\UsersService;

class UsersController extends Controller
{
    public function create(){
        return view('admin.transactions.create');
    }
    public function store(CreateTransactionValidator $createTransactionValidator,TransactionsService $transactionsService){
        $data=$createTransactionValidator->request()->except('_token');
        $response=$transactionsService->createTransaction($data);
        if($response!='success'){
            session()->push('m','danger');
            session()->push('m',$response);
            return back();
        }
        session()->push('m','success');
        session()->push('m','Transaction Created Successfully');
        return back();
    }
    public function index(UsersService $usersService){
        $users=$usersService->getUsers();
        return view('admin.users.index',compact('users'));
    }
    public function show($slug,UsersService $usersService){
        $user=$usersService->getUser($slug);
        return view('admin.users.show',compact('user'));
    }
}
