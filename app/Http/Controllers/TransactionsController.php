<?php

namespace App\Http\Controllers;


use App\Requests\Transactions\TransferValidator;
use App\Services\TransactionsService;
use App\Services\UsersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class TransactionsController extends Controller
{
    public function index(TransactionsService $transactionsService){
        $page["title"]='Transactions';
        $page["section"]='user';
        $transactions=$transactionsService->getTransactions(Auth::user()->id);
        return view('transactions',compact('page','transactions'));
    }
    public function transferShow(Request $request){
        $page["title"]="Transfer Cash";
        $page["section"]=null;
        if(!$request->get('user')){
            $user=null;
            return view('transfer_cash',compact('page','user'));
        }
        $userService=new UsersService();
        $user=$userService->getUser($request->get('user'));
        if(!$user||$user->id==Auth::user()->id){
            $user=null;
        }
        return view('transfer_cash',compact('page','user'));
    }

    public function transfer(TransferValidator $transferValidator,TransactionsService $transactionsService){
        $data=$transferValidator->request()->except('_token');
        if(!Hash::check($data['password'],Auth::user()->password)){
            Session::put('status', 'danger');
            Session::put('message', __("strings.Password Not Match our records"));
            return back();
        }
        $response=$transactionsService->transfer($data);
        Session::put('status', $response['status']);
        Session::put('message', $response['message']);
        return back();
    }

}
