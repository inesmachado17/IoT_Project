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
            'value'         => $this->faker->numberBetween(0, 100),
            'date'          => $this->faker->dateTimeBetween('-24 hours')
        ];
    }
}
