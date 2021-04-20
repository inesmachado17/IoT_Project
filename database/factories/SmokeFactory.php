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
            'name'          => $this->faker->word(),
            'state'         => $this->faker->randomNumber(),
            'trigger'       => $this->faker->randomNumber(),
            'updated_at'    => now(),
            'created_at'    => now()
        ];
    }
}
