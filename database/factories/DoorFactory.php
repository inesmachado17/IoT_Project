<?php


namespace Database\Factories;

use App\Models\Door;
use Illuminate\Database\Eloquent\Factories\Factory;


class DoorFactory extends Factory
{
    protected $model = Door::class;

    public function definition(): array
    {
        return [
            'name'          => $this->faker->word(),
            'auth'          => $this->faker->boolean(),
            'updated_at'    => now(),
            'created_at'    => now()
        ];
    }
}
