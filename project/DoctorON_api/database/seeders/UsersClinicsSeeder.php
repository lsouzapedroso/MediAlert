<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersClinicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obter todos os IDs das tabelas `users` e `clinics`
        $users = DB::table('users')->pluck('id');
        $clinics = DB::table('clinics')->pluck('id');

        // Verificar se existem usuários e clínicas
        if ($users->isEmpty() || $clinics->isEmpty()) {
            $this->command->info('As tabelas "users" e "clinics" precisam conter registros antes de executar o UsersClinicsSeeder.');
            return;
        }

        // Inserir dados na tabela `users_clinics`
        foreach ($users as $userId) {
            DB::table('users_clinics')->insert([
                'user_id' => $userId,
                'clinic_id' => $clinics->random(), // Relacionar com uma clínica aleatória
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Seeder de users_clinics executado com sucesso.');
    }
}
