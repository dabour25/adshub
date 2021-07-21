<?php

namespace App\Services;


use App\Models\Ads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdsService{
    private function createTransaction($amount){
        $transactionService=new TransactionsService();
        $data['comment']="Create Ad";
        $data['transaction_type']="withdraw";
        $data['amount']=$amount;
        $data['user_id']=Auth::user()->id;
        $transactionService->createTransaction($data);
    }
    public function createAd($data){
        $type=$data['ad_type'];
        if($data['total_cost']>Auth::user()->balance){
            return "You Haven't enough balance";
        }
        if($type=='image'){

        }elseif($type=='page'){
            $data['link']=$data['ad_view'];
            $data['slug']="ADP-".rand(10,99).Auth::user()->id.Str::random(4);
            $data['available_cost']=$data['total_cost'];
            $data["by_user"]=Auth::user()->id;
            Ads::create($data);
            $this->createTransaction($data['total_cost']);
            return 'success';
        }elseif($type=="youtube"){

        }else{
            return "Unsupported Type";
        }
    }
}
