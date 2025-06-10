<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\SoalTugas;
use App\Models\Tugas;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Loop through each Kelas
        // Kelas::all()->each(function ($kelas) {
        //     // Create Tugas for each Kelas
        //     $tugas = Tugas::factory()->create([
        //         'kelas_id' => $kelas->id, // Link the tugas to the current kelas
        //     ]);

        //     // Create 1 SoalTugas with 'pg' (multiple choice) for this Tugas
        //     SoalTugas::factory()->state(['tugas_id' => $tugas->id])->create();

        //     // Create 1 SoalTugas with 'essay' for this Tugas
        //     SoalTugas::factory()->state(['tugas_id' => $tugas->id])->create();
        // });

        // Ambil semua kelas yang ada
        $kelas = DB::table('kelas')->get();

        // Loop untuk setiap kelas dan buat tugas untuk masing-masing
        foreach ($kelas as $kelasItem) {
            DB::table('tugas')->insert([
                'judul' => 'Tugas untuk ' . $kelasItem->nama_kelas,
                'deskripsi' => 'Ini adalah deskripsi tugas untuk mata kuliah ' . $kelasItem->nama_kelas,
                'kelas_id' => $kelasItem->id, // ID kelas terkait
                'batas_waktu' => Carbon::now()->addDays(7), // Set batas waktu 7 hari dari sekarang
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
