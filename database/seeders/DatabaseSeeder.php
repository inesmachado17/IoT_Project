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
                'email'             => 'admin@teste.com',
                'email_verified_at' => now(),
                'role'              => 'admin',
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token'    => Str::random(10),
            ],
            [
                'name'              => 'User',
                'email'             => 'user@teste.com',
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
            return random_int(0, 500);
        });

        // Actuators
        $this->createBlinds();
        $this->createAirConditioners();
        $this->createSprinklers();
        $this->createDoors();
        $this->createLamps();

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
                'name'          => 'Janela Esq. da Sala',
                'size'          => 120,
                'state'         => 50,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
            [
                'name'          => 'Janela Dir. da Sala',
                'size'          => 120,
                'state'         => 50,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
            [
                'name'          => 'Janela do Quarto A',
                'size'          => 120,
                'state'         => 75,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
            [
                'name'          => 'Janela do Quarto B',
                'size'          => 120,
                'state'         => 75,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
            [
                'name'          => 'Varanda da Sala',
                'size'          => 170,
                'state'         => 25,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
            [
                'name'          => 'Basculante da Casa de Banho Grande',
                'size'          => 60,
                'state'         => 0,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
            [
                'name'          => 'Basculante da Casa de Banho Pequena',
                'size'          => 60,
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
                'setting'       => 21,
                'state'         => 1,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
            [
                'name'          => 'Escritório',
                'setting'       => 22,
                'state'         => 0,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
            [
                'name'          => 'Sala de Jogos',
                'setting'       => 21,
                'state'         => 0,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
            [
                'name'          => 'Quarto do Pânico',
                'setting'       => 15,
                'state'         => 1,
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
                'timer'         => 30,
                'state'         => 1,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
            [
                'name'          => 'Relvado traseiras',
                'timer'         => 45,
                'state'         => 0,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
            [
                'name'          => 'Parque',
                'timer'         => 21,
                'state'         => 0,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
            [
                'name'          => 'Estufa',
                'timer'         => 15,
                'state'         => 1,
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
                'auth'          => 0,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
            [
                'name'          => 'Porta traseiras',
                'state'         => 1,
                'auth'          => 1,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
            [
                'name'          => 'Portão garagem',
                'state'         => 0,
                'auth'          => 0,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
            [
                'name'          => 'Portão jardim',
                'state'         => 0,
                'auth'          => 0,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
        ]);
    }

    private function createLamps()
    {
        DB::table('lamps')->insert([
            [
                'name'          => 'Sala de estar',
                'setting'       => 70,
                'timer'         => 30,
                'state'         => 1,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
            [
                'name'          => 'Sala de jantar',
                'setting'       => 0,
                'timer'         => 45,
                'state'         => 0,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
            [
                'name'          => 'Cozinha',
                'setting'       => 25,
                'timer'         => 21,
                'state'         => 0,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
            [
                'name'          => 'Quarto principal',
                'setting'       => 0,
                'timer'         => 15,
                'state'         => 1,
                'updated_at'    => now(),
                'created_at'    => now()
            ],
        ]);
    }
}
