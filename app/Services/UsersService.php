<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserData;

class UsersService{
    public function phone_paypal_check($phone,$paypal){
        if($paypal==''){
            if((substr($phone,0,3)!='010')&&(substr($phone,0,5)!='+2010')){
                return __("strings.If there are no paypal account , you must enter vodafone cash number");
            }
        }
        return 'Success';
    }
    public function getUser($user_id){
        return User::where('id',$user_id)->orWhere('email',$user_id)->orWhere('slug',$user_id)
            ->orWhere('phone',$user_id)->first();
    }
    public function getUsers(){
        return User::paginate(50);
    }
    public function updateUser($slug,$data){
        $user=$this->getUser($slug);
        if(!$user){
            return __("strings.User Not Found");
        }
        $checkPaypal=$this->phone_paypal_check($data['phone'],$data['paypal_email']);
        if($checkPaypal=='Success'){
            $user_new['email']=$data['email'];
            $user_new['paypal_email']=$data['paypal_email'];
            $user_new['phone']=$data['phone'];
            $user_new['name']=$data['name'];
            $user_new['user_status']=$data['user_status'];
            User::where('slug',$slug)->update($user_new);
            $user_data['country']=$data['country'];
            $user_data['city']=$data['city'];
            $user_data['address']=$data['address'];
            $user_data['age']=$data['age'];
            $user_data['nationality']=$data['nationality'];
            $user_data['gender']=$data['gender'];
            UserData::where('user_id',$user->id)->update($user_data);
            return 'success';
        }else{
            return $checkPaypal;
        }
    }
}
