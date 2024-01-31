<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Zipcode;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $zipcodes = json_decode(file_get_contents(__DIR__.'/zipcodes.json'), true);
        foreach ($zipcodes as $entry) {
            Zipcode::create([
                'region' => $entry['Region'],
                'provinces' => $entry['Provinces'],
                'city_municipality' => $entry['City/Municipality'],
                'zip_code' => $entry['Zip Code'],
            ]);
        }
    }
}
