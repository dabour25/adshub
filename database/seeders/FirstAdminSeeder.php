<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;

class FirstAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create($this->admin_data());
    }
    public function admin_data(){
        return [
            'name'=>'Admin',
            'slug'=>'adm-Xeuggy490',
            'email'=>'admin@admin.com',
            'email_verified_at'=>Date::now(),
            'phone'=>'01140984296',
            'paypal_email'=>'h.dabour25@yahoo.com',
            'balance'=>0,
            'password'=>Hash::make('Admin2021'),
            'user_status'=>'admin',
        ];
    }
}
