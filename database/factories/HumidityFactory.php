<?php

namespace Database\Factories;

use App\Models\Humidity;
use Illuminate\Database\Eloquent\Factories\Factory;

class HumidityFactory extends Factory
{
    protected $model = Humidity::class;

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
