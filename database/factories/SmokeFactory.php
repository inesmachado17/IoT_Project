<?php

namespace Database\Factories;

use App\Models\Smoke;
use Illuminate\Database\Eloquent\Factories\Factory;

class SmokeFactory extends Factory
{
    protected $model = Smoke::class;

    public function definition(): array
    {
        return [
            'value' => $this->faker->numberBetween(0, 500),
            'date'  => now()
        ];
    }
}
