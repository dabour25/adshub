<?php

namespace App\Services;

use App\Models\Contact;
use App\Models\Transaction;
use Illuminate\Support\Str;

class TransactionsService{
    public function getTransactions($user_id=null){
        if($user_id){
            return Transaction::where('user_id',$user_id)->orderBy('id','desc')->limit(50)->get();
        }else{
            return Transaction::orderBy('id','desc')->paginate(50);
        }
    }
    public function createTransaction($data){
        $userService=new UsersService();
        $checkUser=$userService->getUser($data['user_id']);
        if(!$checkUser){
            return 'User Not Found and can\'t detected';
        }
        $trans_type='D';
        if($data['transaction_type']=='withdraw'){
            if($checkUser->balance<$data['amount']){
                return 'User Balance is less than transaction withdraw amount';
            }else{
                $trans_type='W';
                $newBalance=$checkUser->balance - $data['amount'];
            }
        }else{
            $newBalance=$checkUser->balance + $data['amount'];
        }
        $transaction['transaction_id']=$trans_type.'-'.rand(10,99).Str::random(3).rand(100,999);
        $transaction['comment']=$data['comment'];
        $transaction['transaction_type']=$data['transaction_type'];
        $transaction['amount']=$data['amount'];
        $transaction['new_balance']=$newBalance;
        $transaction['user_id']=$checkUser->id;
        Transaction::create($transaction);
        $checkUser->balance=$newBalance;
        $checkUser->save();
        return 'success';
    }
}
