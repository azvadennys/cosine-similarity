<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class, // Seeder untuk user
            // KelasSeeder::class, // Seeder untuk kelas dan kelas_mahasiswa
            // TugasSeeder::class, // Seeder untuk Tugas dan Soal Tugas
        ]);
    }
}
