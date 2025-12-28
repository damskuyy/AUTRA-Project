<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $users = [
            [
                'name' => 'Admin Utama',
                'email' => 'admin@autra.com',
                'role' => 'admin',
                'status' => 'active',
                'password' => Hash::make('adminautra123'),
            ],
            [
                'name' => 'Guru TOI',
                'email' => 'guru@autra.com',
                'role' => 'guru',
                'status' => 'active',
                'password' => Hash::make('guruautra123'),
            ],
            [
                'name' => 'Siswa TOI',
                'email' => 'siswa@autra.com',
                'role' => 'siswa',
                'status' => 'active',
                'password' => Hash::make('siswaautra123'),
            ],
            [
                'name' => 'Teknisi TOI',
                'email' => 'teknisi@autra.com',
                'role' => 'guru',
                'status' => 'inactive',
                'password' => Hash::make('teknisiautra123'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
