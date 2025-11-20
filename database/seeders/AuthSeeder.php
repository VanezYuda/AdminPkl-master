<?php

namespace Database\Seeders;

use App\Models\Auth;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Admin Kantin
        Auth::create([
            'nama' => 'Admin Kantin',
            'username' => 'admin',
            'password' => 'admin', // kalau lupa tinggal lihat di file ini
            'role' => 'admin',
        ]);

        // Kasir 1
        Auth::create([
            'nama' => 'Kasir 1',
            'username' => 'kasir1',
            'password' => 'kasir1',
            'role' => 'staff',
        ]);

        // Kasir 2
        Auth::create([
            'nama' => 'Kasir 2',
            'username' => 'kasir2',
            'password' => 'kasir2',
            'role' => 'staff',
        ]);
    }
}
