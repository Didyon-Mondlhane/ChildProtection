<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CountrySeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $countries = [
            ['name' => 'Portugal', 'continent' => 'Europa'],
            ['name' => 'Brasil', 'continent' => 'América'],
            ['name' => 'Angola', 'continent' => 'África'],
            ['name' => 'Moçambique', 'continent' => 'África'],
            ['name' => 'Espanha', 'continent' => 'Europa'],
            ['name' => 'França', 'continent' => 'Europa']
        ];

        foreach ($countries as $countryData) {
            Country::create([
                'name' => $countryData['name'],
                'continent' => $countryData['continent'],
                'region' => $faker->word,
                'gdp' => $faker->randomFloat(2, 100, 10000),
                'hdi' => $faker->randomFloat(3, 0.3, 1),
                'official_language' => $faker->languageCode,
                'independence_year' => $faker->numberBetween(1500, 2000),
                'ilo_conventions' => $faker->numberBetween(0, 10),
                'hazardous_activities_approval_year' => $faker->numberBetween(1990, 2023),
                'sst_legislation_robustness' => $faker->randomElement(['Fraca', 'Moderada', 'Forte']),
                'youth_percentage' => $faker->randomFloat(2, 10, 40),
                'children_percentage' => $faker->randomFloat(2, 5, 30),
                'gdp_contributing_sectors' => "Agricultura: 30%, Indústria: 40%, Serviços: 30%",
                'employment_sectors' => "Agricultura: 20%, Indústria: 30%, Serviços: 50%",
                'education_level' => $faker->randomElement(['Baixo', 'Médio', 'Alto'])
            ]);
        }
    }
}