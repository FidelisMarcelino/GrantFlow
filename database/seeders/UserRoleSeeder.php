<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dosen
        User::updateOrCreate(
            ['email' => 'dosen@email.com'],
            [
                'name' => 'Dosen',
                'password' => Hash::make('dosen123'),
                'role' => 'dosen',
            ]
        );

        // Reviewer
        User::updateOrCreate(
            ['email' => 'reviewer@email.com'],
            [
                'name' => 'Reviewer',
                'password' => Hash::make('reviewer123'),
                'role' => 'reviewer',
            ]
        );
    }
}
