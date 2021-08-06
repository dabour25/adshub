<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserData;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserDataFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserData::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $country=$this->faker->randomElement(['Egypt','USA','Saudi Arabia',null]);
        $city=$this->citySelector($country);
        $nationality=$this->faker->randomElement(['Egyptian','American','Saudi',null]);
        return [
            'user_id'=>1,
            'country'=>$country,
            'city'=>$city,
            'address'=>Str::random(30),
            'age'=>$this->faker->dateTimeBetween('-20 years','-5 years'),
            'nationality'=>$nationality,
            'gender'=>$this->faker->randomElement(['male','female']),
            'interests'=>null,
        ];
    }

    public function citySelector($country){
        if($country=='Egypt'){
            return $this->faker->randomElement(['Cairo','Alexandria','Giza',null]);
        }elseif($country=='USA'){
            return $this->faker->randomElement(['California','New Jersey','New York',null]);
        }elseif($country=='Saudi Arabia'){
            return $this->faker->randomElement(['Dammam','Jeddah','Mecca',null]);
        }
    }
}
