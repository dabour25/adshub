<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Requests\Transactions\CreateTransactionValidator;
use App\Requests\UpdateUserValidator;
use App\Services\TransactionsService;
use App\Services\UsersService;

class UsersController extends Controller
{
    public function edit($user_slug,UsersService $usersService){
        $user=$usersService->getUser($user_slug);
        return view('admin.users.edit',compact('user'));
    }
    public function update($slug,UpdateUserValidator $updateUserValidator,UsersService $usersService){
        $data=$updateUserValidator->request()->except('_token','_method');
        $response=$usersService->updateUser($slug,$data);
        if($response!='success'){
            session()->push('m','danger');
            session()->push('m',$response);
            return back();
        }
        session()->push('m','success');
        session()->push('m',__("strings.User Updated Successfully"));
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
