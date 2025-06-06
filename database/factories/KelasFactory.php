<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kelas>
 */
class KelasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Ensure a user with role 'dosen' exists, if not create one
        $dosen = User::where('role', 'dosen')->inRandomOrder()->first();

        if (!$dosen) {
            // Create a dosen user if none exists
            $dosen = User::factory()->create([
                'role' => 'dosen'
            ]);
        }

        $kode_bergabung = strtoupper(Str::random(4));

        // Ensure that the generated code is unique
        while (Kelas::where('kode_bergabung', $kode_bergabung)->exists()) {
            $kode_bergabung = strtoupper(Str::random(4));
        }

        return [
            'nama_kelas' => $this->faker->unique()->sentence(3),
            'deskripsi' => $this->faker->paragraph,
            'dosen_id' => $dosen->id,  // Assign dosen's id
            'kode_bergabung' =>  $kode_bergabung // You may want to replace this with dynamic code
        ];
    }
}
