<?php

namespace Database\Factories;
use App\Models\Light;
use Illuminate\Database\Eloquent\Factories\Factory;

class LightFactory extends Factory
{
    protected $model = Light::class;

    public function definition(): array
    {
        return [
            'value' => $this->faker->numberBetween(200, 5000),
            'date'  => now()
        ];
    }
}
