<?php


namespace Database\Factories;

use App\Models\Lamp;
use Illuminate\Database\Eloquent\Factories\Factory;


class LampFactory extends Factory
{
    protected $model = Lamp::class;

    public function definition(): array
    {
        return [
            'name'          => $this->faker->word(),
            'setting'       => $this->faker->numberBetween(0, 100),
            'updated_at'    => now(),
            'created_at'    => now()
        ];
    }
}
