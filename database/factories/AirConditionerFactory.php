<?php


namespace Database\Factories;

use App\Models\AirConditioner;
use Illuminate\Database\Eloquent\Factories\Factory;

class AirConditionerFactory extends Factory
{
    protected $model = AirConditioner::class;

    public function definition(): array
    {
        return [
            'name'          => $this->faker->word(),
            'setting'       => $this->faker->numberBetween(1, 5),
            'value'         => $this->faker->numberBetween(1, 5),
            'updated_at'    => now(),
            'created_at'    => now()
        ];
    }
}
