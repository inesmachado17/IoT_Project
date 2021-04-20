<?php


namespace Database\Factories;

use App\Models\Door;
use Illuminate\Database\Eloquent\Factories\Factory;


class DoorFactory extends Factory
{
    protected $model = Door::class;

    public function definition()
    {
        return [
            'name'          => $this->faker->word(),
            'open'          => $this->faker->boolean(),
            'updated_at'    => now(),
            'created_at'    => now()
        ];
    }
}
