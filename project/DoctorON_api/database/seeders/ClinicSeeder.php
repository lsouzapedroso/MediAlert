<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obter todos os IDs de cidades na tabela `cities`
        $cities = DB::table('cities')->pluck('id');

        // Verificar se existem cidades
        if ($cities->isEmpty()) {
            $this->command->info('A tabela "cities" precisa conter registros antes de executar o ClinicSeeder.');
            return;
        }

        // Inserir dados na tabela `clinics`
        foreach (range(1, 10) as $index) {
            DB::table('clinics')->insert([
                'name' => "Clinic $index",
                'address' => "Address $index, Street $index",
                'city_id' => $cities->random(), // Atribuir uma cidade aleatória
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Seeder de clinics executado com sucesso.');
    }
}
