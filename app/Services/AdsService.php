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
    public function getNewAds($user_id=null){
        if($user_id){
            return Ads::where('user_id',$user_id)->where('seen',0)->orderBy('id','desc')->limit(50)->get();
        }else{
            return Ads::orderBy('id','desc')->where('seen',0)->paginate(30);
        }
    }
    public function getOldAds($user_id=null){
        if($user_id){
            return Ads::where('user_id',$user_id)->where('seen',1)->orderBy('id','desc')->limit(50)->get();
        }else{
            return Ads::orderBy('id','desc')->where('seen',1)->paginate(30);
        }
    }
    public function getAd($ad_id){
        return Ads::where('slug',$ad_id)->first();
    }
    public function createAd($request){
        $data=$request->request()->except('_token');
        $type=$data['ad_type'];
        if($data['total_cost']>Auth::user()->balance){
            return "You Haven't enough balance";
        }
        if($type=='image'){
            $data['slug']="ADI-".rand(10,99).Auth::user()->id.Str::random(4);
            $data['available_cost']=$data['total_cost'];
            $data["by_user"]=Auth::user()->id;
            $extension=$request->request()->file('ad_view')->getClientOriginalExtension();
            $path=public_path('/images/ads_images');
            $image_name =$data['slug'].'.'.$extension;
            $request->request()->file('ad_view')->move($path,$image_name);
            $data['ad_view']=$image_name;
            Ads::create($data);
            $this->createTransaction($data['total_cost']);
            return 'success';
        }elseif($type=='page'){
            $data['link']=$data['ad_view'];
            $data['slug']="ADP-".rand(10,99).Auth::user()->id.Str::random(4);
            $data['available_cost']=$data['total_cost'];
            $data["by_user"]=Auth::user()->id;
            Ads::create($data);
            $this->createTransaction($data['total_cost']);
            return 'success';
        }elseif($type=="youtube"){
            $data['link']=$data['link']??$data['ad_view'];
            $data['slug']="ADY-".rand(10,99).Auth::user()->id.Str::random(4);
            $data['available_cost']=$data['total_cost'];
            $data["by_user"]=Auth::user()->id;
            Ads::create($data);
            $this->createTransaction($data['total_cost']);
            return 'success';
        }else{
            return "Unsupported Type";
        }
    }
    public function approveAd($data){
        $ad=Ads::where('slug',$data['ad_id'])->first();
        $ad->approved=2;
        $ad->seen=1;
        $ad->save();
        return true;
    }
    public function rejectAd($ad_id){
        $ad=Ads::where('slug',$ad_id)->first();
        $ad->approved=1;
        $ad->seen=1;
        $ad->save();
        $transactionService=new TransactionsService();
        $transaction['comment']="Rejected Ad";
        $transaction['user_id']=$ad->by_user;
        $transaction['amount']=$ad->total_cost;
        $transaction['transaction_type']="deposit";
        $transactionService->createTransaction($transaction);
    }
}
