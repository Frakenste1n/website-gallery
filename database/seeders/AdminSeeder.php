<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin1@gmail.com', // Ganti dengan email admin yang diinginkan
            'password' => Hash::make('12345678'), // Ganti dengan password yang diinginkan
            'role' => 'admin', // Pastikan ada kolom 'role' di tabel user untuk membedakan admin
        ]);
    }
}
