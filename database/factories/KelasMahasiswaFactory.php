<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Kelas;
use App\Models\KelasMahasiswa;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KelasMahasiswa>
 */
class KelasMahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Ensure that a 'Kelas' exists, if not create one.
        $kelas = Kelas::inRandomOrder()->first();
        if (!$kelas) {
            $kelas = Kelas::factory()->create();
        }

        // Ensure that a 'mahasiswa' user exists, if not create one.
        $mahasiswa = User::where('role', 'mahasiswa')->inRandomOrder()->first();
        if (!$mahasiswa) {
            $mahasiswa = User::factory()->create([
                'role' => 'mahasiswa',
            ]);
        }

        return [
            'kelas_id' => $kelas->id, // Assign a valid kelas_id
            'mahasiswa_id' => $mahasiswa->id, // Assign a valid mahasiswa_id
        ];
    }
}
