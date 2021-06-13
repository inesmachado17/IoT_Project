<?php

namespace Database\Seeders;

use App\Models\Door;
use App\Models\FireAlarm;
use App\Models\Humidity;
use App\Models\Lamp;
use App\Models\Light;
use App\Models\Motion;
use App\Models\Smoke;
use App\Models\Sprinkler;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name'              => 'Admin',
                'email'             => 'admin@test.com',
                'email_verified_at' => now(),
                'role'              => 'admin',
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token'    => Str::random(10),
            ],
            [
                'name'              => 'User',
                'email'             => 'user@test.com',
                'email_verified_at' => now(),
                'role'              => 'user',
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token'    => Str::random(10),
            ]
        ]);

        // Sensors
        $this->createSensorsData('temperatures', 50, function () {
            return random_int(-20, 20);
        });
        $this->createSensorsData('humidities', 50, function () {
            return random_int(0, 100);
        });
        $this->createSensorsData('lights', 50, function () {
            return random_int(200, 5000);
        });
        $this->createSensorsData('motions', 50, function () {
            return random_int(0, 100) > 80;
        });
        $this->createSensorsData('smokes', 50, function () {
            return random_int(0, 100);
        });

        // Actuators
        $this->createBlinds();
        $this->createAirConditioners();
        $this->createSprinklers();
        $this->createAlarms();
        $this->createDoors();
        $this->createLamps();

        DB::table('fire_alarms')->insert([
            'state'      => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function createSensorsData(string $tableName, int $totalItems, callable $cb): void
    {
        $now = Carbon::now('UTC');
        $items = [];

        for ($i = 0; $i < $totalItems; $i++) {
            $now = $now->copy()->subMinutes(28);

            array_push($items, [
                'value' => $cb(),
                'date'  => $now
            ]);
        }

        DB::table($tableName)->insert(array_reverse($items));
    }

    private function createBlinds()
    {
        DB::table('blinds')->insert([
            [
                'name'          => 'Sala',
                'setting'       => 50,
                'value'         => 0,
                'state'         => 0,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
            [
                'name'          => 'Quarto',
                'setting'       => 50,
                'value'         => 0,
                'state'         => 0,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
        ]);
    }

    private function createAirConditioners()
    {
        DB::table('air_conditioners')->insert([
            [
                'name'          => 'Central',
                'setting'       => 18,
                'value'         => 20,
                'state'         => 0,
                'automatic'     => 1,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
            [
                'name'          => 'Sala',
                'setting'       => 18,
                'value'         => 20,
                'state'         => 0,
                'automatic'     => 0,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
        ]);
    }

    private function createSprinklers()
    {
        DB::table('sprinklers')->insert([
            [
                'name'          => 'Relvado frente',
                'setting'       => 72,
                'state'         => 0,
                'value'         => 10,
                'automatic'     => 0,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
            [
                'name'          => 'Horta',
                'setting'       => 72,
                'state'         => 0,
                'value'         => 10,
                'automatic'     => 1,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
        ]);
    }

    private function createAlarms()
    {
        DB::table('smoke_alarms')->insert([
            [
                'name'          => 'Garagem',
                'value'         => 0,
                'setting'       => 8,
                'state'         => 0,
                'automatic'     => 1,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
        ]);
    }

    private function createDoors()
    {
        DB::table('doors')->insert([
            [
                'name'          => 'Porta principal',
                'state'         => 0,
                'locked'        => 0,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
            [
                'name'          => 'Portão garagem',
                'state'         => 0,
                'locked'        => 0,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
        ]);
    }

    private function createLamps()
    {
        DB::table('lamps')->insert([
            [
                'name'          => 'Portão da rua',
                'setting'       => 25,
                'value'         => 0,
                'state'         => 0,
                'automatic'     => 1,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
            [
                'name'          => 'Sala',
                'setting'       => 0,
                'value'         => 0,
                'state'         => 0,
                'automatic'     => 0,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
            [
                'name'          => 'Quarto',
                'setting'       => 0,
                'value'         => 0,
                'state'         => 0,
                'automatic'     => 0,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
        ]);
    }
}
