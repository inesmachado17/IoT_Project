<?php

namespace Database\Factories;

use App\Models\Motion;
use Illuminate\Database\Eloquent\Factories\Factory;

class MotionFactory extends Factory
{
    protected $model = Motion::class;

    public function definition(): array
    {
        return [
            'name'          => $this->faker->word(),
            'state'         => $this->faker->randomNumber(),
            'trigger'       => $this->faker->randomNumber(),
            'updated_at'    => now(),
            'created_at'    => now()
        ];
    }
}

