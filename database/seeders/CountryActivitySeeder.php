<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\CountryActivity;
use App\Models\ProhibitedActivity;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CountryActivitySeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $countries = Country::all();
        $activities = ProhibitedActivity::all();

        foreach ($countries as $country) {
            $selectedActivities = $activities->random(3);

            foreach ($selectedActivities as $activity) {
                CountryActivity::create([
                    'country_id' => $country->id,
                    'prohibited_activity_id' => $activity->id,
                    'indicators' => "Nível de risco: " . $faker->randomElement(['Baixo', 'Médio', 'Alto']) . 
                                  ", Conformidade: " . ($faker->boolean(70) ? 'Sim' : 'Não')
                ]);
            }
        }
    }
}