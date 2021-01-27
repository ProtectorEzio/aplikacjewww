<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        return [
            'nickname' => $this->faker->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => md5($this->faker->password),
            'usertype' => $this -> faker->randomElement(['User','User','User', 'Admin']) 
        ];
    }
}