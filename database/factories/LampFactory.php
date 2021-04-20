<?php


namespace Database\Factories;

use App\Models\Lamp;
use Illuminate\Database\Eloquent\Factories\Factory;


class LampFactory extends Factory
{
    protected $model = Lamp::class;

    public function definition()
    {
        return [
            'name'          => $this->faker->word(),
            'setting'       => $this->faker->numberBetween(1, 5),
            'timer'         => $this->faker->numberBetween(60, 720),
            'updated_at'    => now(),
            'created_at'    => now()
        ];
    }

}
