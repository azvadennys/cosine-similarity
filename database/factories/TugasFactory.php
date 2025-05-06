<?php

namespace Database\Factories;

use App\Models\Kelas;
use App\Models\Tugas;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tugas>
 */
class TugasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Tugas::class;

    public function definition(): array
    {
        return [
            'judul' => $this->faker->sentence,
            'deskripsi' => $this->faker->paragraph,
            'kelas_id' => Kelas::factory(), // Assuming Kelas factory exists
            'batas_waktu' => $this->faker->dateTimeBetween('now', '+1 month'),
        ];
    }
}
