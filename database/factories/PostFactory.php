<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(rand(5,10),true),

            'content' => $this->faker->sentences(15,true),

            'image' => 'https://via.placeholder.com/1500' ,
        ];
    }
}
