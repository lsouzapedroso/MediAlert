<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CitiesSeeder::class,
            MedicSeeder::class,
            PatientSeeder::class,
            ClinicSeeder::class,
            MedicsClinicsSeeder::class,
            UsersClinicsSeeder::class,
        ]);
    }
}
