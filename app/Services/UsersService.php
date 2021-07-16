<?php

namespace App\Services;

use App\Models\User;

class UsersService{
    public function getUser($user_id){
        return User::where('id',$user_id)->orWhere('email',$user_id)->orWhere('slug',$user_id)
            ->orWhere('phone',$user_id)->first();
    }
    public function getUsers(){
        return User::paginate(50);
    }
}
