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
            'value' => $this->faker->boolean(25),
            'date'  => now()
        ];
    }
}

