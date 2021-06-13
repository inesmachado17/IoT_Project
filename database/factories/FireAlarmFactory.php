<?php


namespace Database\Factories;

use App\Models\FireAlarm;
use Illuminate\Database\Eloquent\Factories\Factory;

class FireAlarmFactory extends Factory
{
    protected $model = FireAlarm::class;

    public function definition(): array
    {
        return [
            'updated_at'    => now(),
            'created_at'    => now()
        ];
    }
}
