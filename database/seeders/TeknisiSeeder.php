<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\UserRole;

class TeknisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          User::create([
            'name' => 'Teknisi',
            'email' => 'teknisi@fixlab.test',
            'password' => Hash::make('password'),
            'role' => UserRole::TECHNICIAN,
        ]);
    }
}
