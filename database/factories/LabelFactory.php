<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class LabelFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->realText(5),
            'description' => $this->faker->realText(10),
        ];
    }
}
