<?php

namespace Database\Seeders;


use App\Models\Ads;
use App\Models\AdTransaction;
use App\Models\User;
use App\Services\TransactionsService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CreateViewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adsCount=Ads::count();
        $ad=Ads::where('id',rand(1,$adsCount))->where('available_cost','>',3)->first();
        $usersCount=User::count();
        $selectedUser=User::where('id',rand(1,$usersCount))->first();
        if($ad&&$selectedUser&&$selectedUser->id!=$ad->by_user){
            $advertiser=User::where('id',$ad->by_user)->first();
            $advertiser_aff=User::where('id',$advertiser->affiliate_id)->first();
            $user_aff=User::where('id',$selectedUser->affiliate_id)->first();
            if(rand(0,9)<7){
                $data['time']=rand(1,$ad->max_time);
                $price=$this->priceCalculator($ad->available_cost,$data['time'],false);
            }else{
                $data['time']=0;
                $price=$this->priceCalculator($ad->available_cost,0,true);
            }

            $user_price=40*$price/100;
            $transactionService=new TransactionsService();
            $transaction['amount']=$user_price;
            $transaction['comment']="Earnings from Ad ".$ad->slug;
            $transaction['transaction_type']='deposit';
            $transaction['user_id']=$selectedUser->slug;
            $transactionService->createTransaction($transaction);
            $transaction_id=$transactionService->getLastTransaction($selectedUser->id);
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
            $ad_transaction['by_user']=$selectedUser->id;
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
        }

    }
    private function priceCalculator($available_cost,$time,$click){
        if($available_cost>1&&$time!=0){
            $total_price=(0.01+(rand(0,30)/100))*($time/2);
        }elseif($click&&($available_cost>3)){
            $total_price=0.25+(rand(0,2*10)/10);
        }else{
            $total_price=$available_cost;
        }
        return $total_price;
    }
}
