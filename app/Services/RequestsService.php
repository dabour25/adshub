<?php

namespace App\Services;

use App\Models\Contact;
use App\Models\Request;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RequestsService{
    public function getNewRequests($user_id=null){
        if($user_id){
            return Request::where('user_id',$user_id)->where('seen',0)->orderBy('id','desc')->limit(50)->get();
        }else{
            return Request::orderBy('id','desc')->where('seen',0)->paginate(30);
        }
    }
    public function getOldRequests($user_id=null){
        if($user_id){
            return Request::where('user_id',$user_id)->where('seen',1)->orderBy('id','desc')->limit(50)->get();
        }else{
            return Request::orderBy('id','desc')->where('seen',1)->paginate(30);
        }
    }
    public function convertToSeen($request_id){
        $request=$this->getRequest($request_id);
        $request->seen=1;
        $request->save();
    }
    public function getRequest($request_id){
        return Request::where('request_id',$request_id)->first();
    }
    public function createRequest($data){
        $type=$data['type'];
        if(empty(Auth::user()->paypal_email)&&$data['method']=='paypal'){
            return ['status'=>'danger','message'=>__("strings.You haven't paypal registered email")];
        }
        if($data['method']=='vf_cash'){
            if(substr(Auth::user()->phone,0,3)!='011'&&substr(Auth::user()->phone,0,5)!='+2011'){
                return ['status'=>'danger','message'=>__("strings.your registered phone number isn't vodafone")];
            }
        }
        if($type=='deposit'){
            $requestData['request_id']='DR-'.rand(10,99).Auth::user()->id.STR::random(4);
            $requestData['amount']=$data['amount'];
            $requestData['reason']=$type;
            $requestData['method']=$data['method'];
            $requestData['user_id']=Auth::user()->id;
            Request::create($requestData);
            User::where('id',Auth::user()->id)->update(['pending_balance'=>$data['amount']]);
            return ['status'=>'success','message'=>__("strings.Request Success - Send money with selected method to vf-cash:01019742029 or paypal:h.dabour25@yahoo.com to continue request within 48 hours. after sending money wait 48 hours and if amount not be in your final balance within 48 hours,call or send message to us")];
        }else{
            $requestData['request_id']='WR-'.rand(10,99).Auth::user()->id.STR::random(4);
            $requestData['amount']=$data['amount'];
            $requestData['reason']=$type;
            $requestData['method']=$data['method'];
            $requestData['user_id']=Auth::user()->id;
            Request::create($requestData);
            User::where('id',Auth::user()->id)->update(['pending_balance'=>$data['amount']]);
            $transactionService=new TransactionsService();
            $transaction['comment']="Pending for withdraw";
            $transaction['user_id']=Auth::user()->id;
            $transaction['amount']=$data['amount'];
            $transaction['transaction_type']="withdraw";
            $transactionService->createTransaction($transaction);
            return ['status'=>'success','message'=>__("strings.Request Success - your money will send to selected method and phone/paypal account within 48 hours if there are problem with us while sending we will back money to your final balance and notify you with problem")];
        }
    }
    public function approveRequest($data){
        $request=Request::where('request_id',$data['request_id'])->first();
        $request->request_status=1;
        $request->save();
        if($request['reason']=='deposit'){
            if($data['amount']==0||empty($data['amount'])){
                return false;
            }
            if($data['amount']<$request['amount']){
                $transactionService=new TransactionsService();
                $transaction['comment']="Successful Deposit";
                $transaction['user_id']=$request['user_id'];
                $transaction['amount']=$data['amount'];
                $transaction['transaction_type']="deposit";
                $transactionService->createTransaction($transaction);
                User::where('id',Auth::user()->id)->update(['pending_balance'=>0]);
            }else{
                return false;
            }
        }else{
            $transactionService=new TransactionsService();
            $transaction['comment']="Successful Withdraw";
            $transaction['user_id']=$request['user_id'];
            $transaction['amount']=$request['amount'];
            $transaction['transaction_type']="withdraw";
            $transactionService->createTransaction($transaction);
            User::where('id',Auth::user()->id)->update(['pending_balance'=>0]);
        }
        return true;
    }
    public function cancelRequest($data){
        $request=Request::where('request_id',$data['request_id'])->first();
        $request->request_status=2;
        $request->save();
        if($request['reason']=='deposit'){
            User::where('id',Auth::user()->id)->update(['pending_balance'=>0]);
        }else{
            $transactionService=new TransactionsService();
            $transaction['comment']="Failed Withdraw";
            $transaction['user_id']=$request['user_id'];
            $transaction['amount']=$request['amount'];
            $transaction['transaction_type']="deposit";
            $transactionService->createTransaction($transaction);
            User::where('id',Auth::user()->id)->update(['pending_balance'=>0]);
        }
    }
}
