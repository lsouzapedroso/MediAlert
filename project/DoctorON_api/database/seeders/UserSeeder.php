<?php

namespace Database\Seeders;

use app\Http\Requests\Appointment\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Christian Ramires',
            'email' => 'christian.ramires@example.com',
            'password' => Hash::make('password'),
        ]);

        User::factory(10)->create();
    }
}
