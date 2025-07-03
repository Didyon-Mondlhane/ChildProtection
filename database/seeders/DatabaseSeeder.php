<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            SectorSeeder::class,
            ProhibitedActivitySeeder::class,
            CountrySeeder::class,
            CountryClassificationSeeder::class,
            CountryActivitySeeder::class,
        ]);
    }
}