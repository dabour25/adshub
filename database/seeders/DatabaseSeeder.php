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
        $this->call([
            FirstAdminSeeder::class,
        ]);
        //Tests Only
        //User::factory(100000)->create();
        //UserData::factory(100000)->create();
        /*$this->call([
            FixUserDataSeeder::class,
        ]);*/
        for($i=0;$i<25000;$i++){
            $this->call([
                //CreateRequestsSeeder::class,
                CreateAdsSeeder::class,
                //CreateViewsSeeder::class,
            ]);
        }
    }
}
