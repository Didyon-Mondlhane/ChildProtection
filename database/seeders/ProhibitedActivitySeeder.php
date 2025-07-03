<?php

namespace Database\Seeders;

use App\Models\ProhibitedActivity;
use App\Models\Sector;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProhibitedActivitySeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $sectors = Sector::all();

        $activities = [
            'Trabalho com produtos químicos perigosos',
            'Operação de máquinas pesadas',
            'Trabalho em altura superior a 2 metros',
            'Exposição a radiação',
            'Manuseio de explosivos'
        ];

        foreach ($activities as $activity) {
            ProhibitedActivity::create([
                'sector_id' => $sectors->random()->id,
                'name' => $activity,
                'description' => $faker->paragraph(3),
                'justification' => $faker->paragraph(2)
            ]);
        }
    }
}