<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Migration untuk tabel jawaban_mahasiswa
        Schema::create('jawaban_tugas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('tugas_id')->constrained('tugas')->onDelete('cascade');
            $table->foreignId('soal_tugas_id')->constrained('soal_tugas')->onDelete('cascade');

            $table->text('jawaban'); // isi jawaban user
            $table->text('penjelasan_jawaban'); // isi jawaban user
            $table->float('nilai_cosine_similarity'); // isi jawaban user
            $table->boolean('is_benar')->nullable(); // khusus untuk PG bisa ditentukan otomatis

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_tugas');
    }
};
