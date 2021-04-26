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
            'value' => $this->faker->numberBetween(-20, 20),
            'date'  => $this->faker->dateTime()
        ];
    }
}
