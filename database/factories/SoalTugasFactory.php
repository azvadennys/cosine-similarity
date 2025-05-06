<?php

namespace Database\Factories;

use App\Models\Tugas;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SoalTugas>
 */
class SoalTugasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Default data for the factory
        $data = [
            'tugas_id' => Tugas::factory(), // Create a Tugas instance for each SoalTugas
            'tipe' => $this->faker->randomElement(['pg', 'essay']), // Randomly select between 'pg' and 'essay'
            'pertanyaan' => $this->faker->sentence,
            'jawaban_benar' => $this->faker->word, // Default value, will be overwritten later based on 'tipe'
            'alasan_jawaban' => $this->faker->text,
        ];

        // Conditional logic based on 'tipe'
        if ($data['tipe'] == 'pg') {
            // Multiple choice options for 'pg' type
            $data['pilihan_a'] = $this->faker->word;
            $data['pilihan_b'] = $this->faker->word;
            $data['pilihan_c'] = $this->faker->word;
            $data['pilihan_d'] = $this->faker->word;
            $data['jawaban_benar'] = $this->faker->randomElement(['A', 'B', 'C', 'D']); // Correct answer for multiple choice
        } else {
            // For essay type, 'jawaban_benar' and 'alasan_jawaban' are the same
            $data['jawaban_benar'] = $this->faker->paragraph;
            $data['alasan_jawaban'] = $data['jawaban_benar'];
        }

        return $data;
    }
}
