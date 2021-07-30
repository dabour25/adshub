<?php

namespace App\Services;


use App\Models\Ads;
use App\Models\AdTransaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;

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
            return __("strings.You Haven't enough balance");
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
            return __("strings.Unsupported Type");
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
    public function getAdsForShow(){
        $filters['approved']=2;
        $filters['hideForUser']=Auth::user()->id;
        $filters['canView']=1;
        $filters['orderBy']='available_cost';
        $filters['orderType']='desc';
        $hiddenAdsToday=AdTransaction::where('by_user',Auth::user()->id)->whereDate('created_at', Carbon::today())->get();
        $hiddenList=[];
        foreach ($hiddenAdsToday as $hidden){
            $hiddenList[]=$hidden->ad_id;
        }
        $availableAds=Ads::Filter($filters)->whereNotIn('id', $hiddenList)->paginate(10);
        return $availableAds;
    }
    private function priceCalculator($available_cost,$time,$click){
        if($available_cost>1){
            $total_price=(0.01+(rand(0,30)/100))*($time/2);
        }else{
            $total_price=$available_cost;
        }
        if($click&&($available_cost>3)){
            $total_price=0.25+(rand(0,2*10)/10);
        }else{
            $total_price=$available_cost;
        }
        return $total_price;
    }
    public function earnAd($data){
        $ad=Ads::where('slug',$data['slug'])->first();
        if(!$ad){
            return ["data"=>__("strings.Ad Not Found"),"status"=>404];
        }
        $advertiser=User::where('id',$ad->by_user)->first();
        $advertiser_aff=User::where('id',$advertiser->affiliate_id)->first();
        $user_aff=User::where('id',Auth::user()->affiliate_id)->first();
        $price=$this->priceCalculator($ad->available_cost,$data['time'],$data['click']);
        if($price==0){
            return ["data"=>"Sorry,this ad run out of money","status"=>406];
        }
        $user_price=40*$price/100;
        try{
            DB::beginTransaction();
            $transactionService=new TransactionsService();
            $transaction['amount']=$user_price;
            $transaction['comment']="Earnings from Ad ".$ad->slug;
            $transaction['transaction_type']='deposit';
            $transaction['user_id']=Auth::user()->slug;
            $transactionService->createTransaction($transaction);
            $transaction_id=$transactionService->getLastTransaction(Auth::user()->id);
            if($advertiser_aff){
                $adv_aff_price=5*$price/100;
                $transaction['amount']=$adv_aff_price;
                $transaction['comment']="Affiliate from Ad ".$ad->slug;
                $transaction['transaction_type']='deposit';
                $transaction['user_id']=$advertiser_aff->id;
                $transactionService->createTransaction($transaction);
            }
            if($user_aff){
                $usr_aff_price=5*$price/100;
                $transaction['amount']=$usr_aff_price;
                $transaction['comment']="Affiliate from Ad ".$ad->slug;
                $transaction['transaction_type']='deposit';
                $transaction['user_id']=$user_aff->id;
                $transactionService->createTransaction($transaction);
            }
            $ad_transaction['transaction_id']='ADT-'.Str::random(6);
            $ad_transaction['amount']=$price;
            $ad_transaction['watch_time']=$data['time'];
            $ad_transaction['click']=$data['time']==0?1:0;
            $ad_transaction['by_user']=Auth::user()->id;
            $ad_transaction['from_user']=$advertiser->id;
            $ad_transaction['ad_id']=$ad->id;
            $ad_transaction['trans_id']=$transaction_id->id;
            AdTransaction::create($ad_transaction);
            $ad->spent_cost+=$price;
            $ad->available_cost-=$price;
            if($data['time']==0){
                $ad->clicks+=1;
            }else{
                $ad->views+=1;
            }
            $ad->save();
            DB::commit();
            return ["data"=>__("strings.Transaction Completed"),"status"=>200];
        }catch (\Exception $exception){
            DB::rollback();
            dd($exception);
            return ["data"=>__("strings.Something wrong happened"),"status"=>500];
        }
    }
    public function userAds($slug){
        $userService=new UsersService();
        $user=$userService->getUser($slug);
        return Ads::where('by_user',$user->id)->orderBy('id','desc')->paginate(20);
    }
}
