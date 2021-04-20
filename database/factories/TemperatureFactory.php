<?php

namespace Database\Factories;

use App\Models\Temperature;
use Illuminate\Database\Eloquent\Factories\Factory;

class TemperatureFactory extends Factory
{
    protected $model = Temperature::class;

    public function definition()
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
