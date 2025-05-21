<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicsClinicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Este exemplo assume que as tabelas `medics`, `clinics` e `cities` já possuem registros.

        // Obter todos os IDs da tabela de médicos (medics)
        $medics = DB::table('medics')->pluck('id');

        // Obter todos os IDs da tabela de clínicas (clinics)
        $clinics = DB::table('clinics')->pluck('id');

        // Obter todos os IDs da tabela de cidades (cities)
        $cities = DB::table('cities')->pluck('id');

        // Garantir que existam dados
        if ($medics->isEmpty() || $clinics->isEmpty() || $cities->isEmpty()) {
            $this->command->info('As tabelas "medics", "clinics" e "cities" precisam conter dados.');
            return;
        }

        // Criar entradas na tabela medics_clinics
        foreach ($medics as $medicId) {
            DB::table('medics_clinics')->insert([
                'medic_id' => $medicId,
                'clinic_id' => $clinics->random(),
                'city_id' => $cities->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Seeder de medics_clinics foi executado com sucesso.');
    }
}
