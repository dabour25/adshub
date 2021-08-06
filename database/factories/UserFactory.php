<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name=$this->faker->name();
        if(rand(0,1)==0){
            $affiliate=rand(1,User::count());
        }else{
            $affiliate=null;
        }
        $paypal=$this->faker->randomElement([$this->faker->unique()->safeEmail(),null]);
        if(!$paypal){
            $phone="010".rand(10000000,99999999);
        }else{
            $phone=$this->faker->randomElement(['011','010','012','015']).rand(10000000,99999999);
        }
        return [
            'name' => $name,
            'slug'=>Str::slug(substr($name,0,3).'-'.Str::random(6).rand(100,999)),
            'email' => $this->faker->unique()->safeEmail(),
            'paypal_email' => $paypal,
            'phone'=>$phone,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'affiliate_id'=>$affiliate,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the user should have a personal team.
     *
     * @return $this
     */
    public function withPersonalTeam()
    {
        if (! Features::hasTeamFeatures()) {
            return $this->state([]);
        }

        return $this->has(
            Team::factory()
                ->state(function (array $attributes, User $user) {
                    return ['name' => $user->name.'\'s Team', 'user_id' => $user->id, 'personal_team' => true];
                }),
            'ownedTeams'
        );
    }
}
