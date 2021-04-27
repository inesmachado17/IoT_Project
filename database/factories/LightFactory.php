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
            'name'          => $this->faker->word(),
            'state'         => $this->faker->randomNumber(),
            'trigger'       => $this->faker->randomNumber(),
            'updated_at'    => now(),
            'created_at'    => now()
        ];
    }
}
