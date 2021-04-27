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
            'timer'          => $this->faker->numberBetween(60, 720),
            'updated_at'    => now(),
            'created_at'    => now()
        ];
    }
}
