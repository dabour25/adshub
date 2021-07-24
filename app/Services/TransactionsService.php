<?php

namespace App\Services;

use App\Models\Contact;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransactionsService{
    public function getLastTransaction($user_id=null){
        if($user_id){
            return Transaction::where('user_id',$user_id)->orderBy('id','desc')->first();
        }else{
            return Transaction::orderBy('id','desc')->first();
        }
    }
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
    public function transfer($data){
        $userService=new UsersService();
        $receiver=$userService->getUser($data['slug']);
        if(!$receiver){
            return ['status'=>'danger','message'=>'Receiver Not Found'];
        }
        if($data['amount']>Auth::user()->balance){
            return ['status'=>'danger','message'=>'You haven\'t enough balance'];
        }
        $sender_transaction['amount']=$receiver_transaction['amount']=$data['amount'];
        $sender_transaction['comment']="Send Money to ".$receiver->slug;
        $sender_transaction['transaction_type']='withdraw';
        $sender_transaction['user_id']=Auth::user()->slug;
        $receiver_transaction['comment']="Receive Money from ".Auth::user()->slug;
        $receiver_transaction['transaction_type']='deposit';
        $receiver_transaction['user_id']=$receiver->slug;
        $this->createTransaction($receiver_transaction);
        $this->createTransaction($sender_transaction);
        return ['status'=>'success','message'=>'Money '.$data['amount'].' Transferred Successfully to '.$receiver->name];
    }
}
