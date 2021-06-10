<?php


namespace Database\Factories;

use App\Models\Sprinkler;
use Illuminate\Database\Eloquent\Factories\Factory;

class SprinklerFactory extends Factory
{
    protected $model = Sprinkler::class;

    public function definition(): array
    {
        return [
            'name'          => $this->faker->word(),
            'setting'       => $this->faker->numberBetween(1, 5),
            'updated_at'    => now(),
            'created_at'    => now()
        ];
    }
}
