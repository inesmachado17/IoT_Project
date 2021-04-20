<?php


namespace Database\Factories;

use App\Models\FireAlarm;
use Illuminate\Database\Eloquent\Factories\Factory;

class FireAlarmFactory extends Factory
{
    protected $model = FireAlarm::class;

    public function definition()
    {
        return [
            'name'          => $this->faker->word(),
            'action'        => $this->faker->word(),
            'updated_at'    => now(),
            'created_at'    => now()
        ];
    }
}
