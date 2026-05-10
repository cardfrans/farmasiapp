<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Membuat Akun Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@apotek.com',
            'password' => Hash::make('password123'), // Password: password123
            'role' => 'admin', // <-- SET ROLE SEBAGAI ADMIN
        ]);

        // 2. Membuat Akun User Biasa (Untuk bahan pengujian)
        User::create([
            'name' => 'Pembeli Biasa',
            'email' => 'user@apotek.com',
            'password' => Hash::make('password123'),
            'role' => 'user', // <-- SET ROLE SEBAGAI USER
        ]);
    }
}