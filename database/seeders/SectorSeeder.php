<?php

namespace Database\Seeders;

use App\Models\Sector;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SectorSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $sectors = ['Agricultura', 'Indústria', 'Construção', 'Mineração', 'Transportes', 'Comércio', 'Serviços'];

        foreach ($sectors as $sector) {
            Sector::create([
                'name' => $sector,
                'description' => $faker->sentence(10)
            ]);
        }
    }
}