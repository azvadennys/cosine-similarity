<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kelas;
use App\Models\KelasMahasiswa;
use App\Models\SoalTugas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat 10 kelas
        // Kelas::factory(15)->create()->each(function ($kelas) {
        //     // Untuk setiap kelas, assign 5 mahasiswa
        //     KelasMahasiswa::factory(5)->create([
        //         'kelas_id' => $kelas->id,
        //     ]);
        // });

        Kelas::insert([
            [
                'nama_kelas' => 'Basis Data',
                'deskripsi' => 'Mata kuliah mengenai konsep-konsep dasar pengelolaan data.',
                'kode_bergabung' => 'BD01',
                'dosen_id' => 82, // Gantilah dengan ID dosen yang sesuai
                'created_at' => now(),
            ],
            [
                'nama_kelas' => 'Sistem Digital',
                'deskripsi' => 'Mata kuliah mengenai desain dan aplikasi sistem digital.',
                'kode_bergabung' => 'SD02',
                'dosen_id' => 82, // Gantilah dengan ID dosen yang sesuai
                'created_at' => now(),
            ],
            [
                'nama_kelas' => 'Komunikasi Data',
                'deskripsi' => 'Mata kuliah mengenai transmisi dan penerimaan data.',
                'kode_bergabung' => 'KD03',
                'dosen_id' => 82, // Gantilah dengan ID dosen yang sesuai
                'created_at' => now(),
            ],
            [
                'nama_kelas' => 'Pemrograman Berorientasi Objek',
                'deskripsi' => 'Mata kuliah mengenai konsep-konsep pemrograman berorientasi objek.',
                'kode_bergabung' => 'PB04',
                'dosen_id' => 82, // Gantilah dengan ID dosen yang sesuai
                'created_at' => now(),
            ],
            [
                'nama_kelas' => 'Jaringan Komputer',
                'deskripsi' => 'Mata kuliah mengenai dasar-dasar jaringan komputer dan protokol jaringan.',
                'kode_bergabung' => 'JK05',
                'dosen_id' => 82, // Gantilah dengan ID dosen yang sesuai
                'created_at' => now(),
            ],
            [
                'nama_kelas' => 'Kecerdasan Buatan',
                'deskripsi' => 'Mata kuliah mengenai penerapan konsep kecerdasan buatan dalam berbagai bidang.',
                'kode_bergabung' => 'KB06',
                'dosen_id' => 82, // Gantilah dengan ID dosen yang sesuai
                'created_at' => now(),
            ],
        ]);

        $kelas = Kelas::all();
        foreach ($kelas as $index) {
            for ($i = 1; $i <= 80; $i++) {
                KelasMahasiswa::create([
                    "kelas_id" => $index->id,
                    "mahasiswa_id" => $i
            ]);
            }
        }
    }
}
