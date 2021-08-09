<?php

namespace Database\Seeders;


use App\Models\Ads;
use App\Models\User;
use App\Services\TransactionsService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CreateAdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersCount=User::count();
        $selectedUser=rand(1,$usersCount);
        $selectedUser=User::where('id',$selectedUser)->first();
        if($selectedUser->balance>4){
            $data['ad_type']=rand(1,3); //1 image - 2 page - 3 youtube
            $data['total_cost']=rand(3,$selectedUser->balance);
            $data['title']='Ad'.Str::random(10).rand(100,9999);
            $data['max_time']=rand(20,50);
            if($data['ad_type']==1){
                $data['slug']="ADI-".rand(10,99).$selectedUser->id.Str::random(4);
                $data['available_cost']=$data['total_cost'];
                $data["by_user"]=$selectedUser->id;
                $data['ad_type']='image';
                $image_name =$this->randImg();
                $data['ad_view']=$image_name;
                $ad=Ads::create($data);
                $this->createTransaction($data['total_cost'],$selectedUser);
            }elseif($data['ad_type']==2){
                $data['ad_type']='page';
                $data['link']=$data['ad_view']=$this->randUrl();
                $data['slug']="ADP-".rand(10,99).$selectedUser->id.Str::random(4);
                $data['available_cost']=$data['total_cost'];
                $data["by_user"]=$selectedUser->id;
                $ad=Ads::create($data);
                $this->createTransaction($data['total_cost'],$selectedUser);
            }elseif($data['ad_type']==3){
                $data['ad_type']='youtube';
                $data['link']=$data['ad_view']=$this->randYt();
                $data['slug']="ADY-".rand(10,99).$selectedUser->id.Str::random(4);
                $data['available_cost']=$data['total_cost'];
                $data["by_user"]=$selectedUser->id;
                $ad=Ads::create($data);
                $this->createTransaction($data['total_cost'],$selectedUser);
            }
            $randApprove=rand(0,9);
            if($randApprove<6){
                $ad->approved=2;
                $ad->seen=1;
                $ad->save();
            }elseif($randApprove<9){
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
    }
    public function randImg(){
        $list=['c1','c2','c3','c4','c5','c6','c7','c8','c9','c10','c11','c12','c13','c14','c15','c16','c17','c18','c19','c20','c21','c22'];
        $selectedImg=rand(0,21);
        if($selectedImg<16){
            return $list[$selectedImg].'.png';
        }
        return $list[$selectedImg].'.jpg';
    }
    public function randUrl(){
        $list=[
            'https://www.facebook.com',
            'https://www.youtube.com',
            'https://www.instagram.com',
            'https://www.linkedin.com',
            'https://www.github.com',
        ];
        return $list[rand(0,4)];
    }
    public function randYt(){
        return 'https://www.youtube.com/watch?v='.Str::random(11);
    }
    public function createTransaction($amount,$selectedUser){
        $transactionService=new TransactionsService();
        $data['comment']="Create Ad";
        $data['transaction_type']="withdraw";
        $data['amount']=$amount;
        $data['user_id']=$selectedUser->id;
        $transactionService->createTransaction($data);
    }
}
