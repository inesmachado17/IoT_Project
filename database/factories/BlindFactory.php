<?php

namespace Database\Factories;

use App\Models\Blind;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlindFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blind::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'          => $this->faker->word(),
            'size'          => $this->faker->numberBetween(120, 150),
            'updated_at'    => now(),
            'created_at'    => now()
        ];
    }
}
