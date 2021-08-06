<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserData;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;

class FixUserDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData=UserData::all();
        foreach ($userData as $data){
            UserData::where('id',$data->id)->update(['user_id'=>$data->id]);
        }
    }
}
