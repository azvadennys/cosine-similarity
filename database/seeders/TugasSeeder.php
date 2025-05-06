<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\SoalTugas;
use App\Models\Tugas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Loop through each Kelas
        Kelas::all()->each(function ($kelas) {
            // Create Tugas for each Kelas
            $tugas = Tugas::factory()->create([
                'kelas_id' => $kelas->id, // Link the tugas to the current kelas
            ]);

            // Create 1 SoalTugas with 'pg' (multiple choice) for this Tugas
            SoalTugas::factory()->state(['tugas_id' => $tugas->id])->create();

            // Create 1 SoalTugas with 'essay' for this Tugas
            SoalTugas::factory()->state(['tugas_id' => $tugas->id])->create();
        });
    }
}
