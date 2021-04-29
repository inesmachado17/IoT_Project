<?php

namespace Database\Seeders;

use App\Models\AirConditioner;
use App\Models\Door;
use App\Models\FireAlarm;
use App\Models\Humidity;
use App\Models\Lamp;
use App\Models\Light;
use App\Models\Motion;
use App\Models\Smoke;
use App\Models\Blind;
use App\Models\Sprinkler;
use App\Models\Temperature;
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
            'name' => 'Admin',
            'email' => 'admin@teste.com',
            'email_verified_at' => now(),
            'role' => 'admin',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'user@teste.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $this->createBlinds();

        //Blind::factory()->count(10)->create();
        Humidity::factory()->count(5)->create();
        Light::factory()->count(5)->create();
        Motion::factory()->count(5)->create();
        Smoke::factory()->count(5)->create();
        Temperature::factory()->count(5)->create();
        AirConditioner::factory()->count(5)->create();
        Door::factory()->count(5)->create();
        FireAlarm::factory()->count(5)->create();
        Lamp::factory()->count(5)->create();
        Sprinkler::factory()->count(5)->create();
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
}
