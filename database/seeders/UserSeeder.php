<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 80; $i++) {
            User::factory()->mahasiswa()->create([
                'name' => 'Mahasiswa ' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'email' => 'mahasiswa' . str_pad($i, 3, '0', STR_PAD_LEFT) . '@gmail.com',
            ]);
        }

        // Buat 1 admin
        User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
        ]);

        // Buat 1 Dosen
        User::factory()->dosen()->create([
            'name' => 'Dosen User',
            'email' => 'dosen@gmail.com',
        ]);

        // Buat 1 Mahasiswa
        User::factory()->mahasiswa()->create([
            'name' => 'Mahasiswa User',
            'email' => 'mahasiswa@gmail.com',
        ]);



        // Buat 5 dosen
        // User::factory(5)->dosen()->create();

        // Buat 10 mahasiswa
        // User::factory(15)->mahasiswa()->create();
    }
}
