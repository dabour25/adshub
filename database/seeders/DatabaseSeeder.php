<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserData;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            FirstAdminSeeder::class,
        ]);
        //Tests Only
//        User::factory(10000)->create();
//        UserData::factory(10000)->create();
//        $this->call([
//            FixUserDataSeeder::class,
//        ]);
        for($i=0;$i<10000;$i++){
            $this->call([
                CreateRequestsSeeder::class,
            ]);
        }
    }
}
