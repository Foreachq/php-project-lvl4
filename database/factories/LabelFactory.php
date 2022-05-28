<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class LabelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->realText(10),
            'description' => $this->faker->realText(10),
        ];
    }
}
