<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_ID' => factory(App\User::class),
            'title' => $this->faker->title,
            'user_nickname'=>factory(App\User::class),
            'content' =>$this->faker->content,
            'views' =>$this->faker->views,
        ];
    }
}
