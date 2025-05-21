<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('medics')->insert([
                'name' => "Medic $i",
                'specialization' => "Specialization $i",
                'crm' => $this->generateRandomCRM(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function generateRandomCRM(): string
    {
        $number = sprintf('%07d', rand(1, 9999999));
        $letters = chr(rand(65, 90)) . chr(rand(65, 90));

        return "{$number}-{$letters}";
    }

}
