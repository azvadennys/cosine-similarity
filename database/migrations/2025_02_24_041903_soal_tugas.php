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
        // Migration untuk tabel soal_tugas
        Schema::create('soal_tugas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tugas_id')->constrained('tugas')->onDelete('cascade');
            $table->enum('tipe', ['pg', 'essay']); // pg = pilihan ganda, essay = isian
            $table->text('pertanyaan');

            // Untuk PG
            $table->string('pilihan_a')->nullable();
            $table->string('pilihan_b')->nullable();
            $table->string('pilihan_c')->nullable();
            $table->string('pilihan_d')->nullable();
            $table->string('jawaban_benar')->nullable(); // A/B/C/D atau string langsung
            $table->string('alasan_jawaban')->nullable(); // Untuk Cosine Similarity

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soal_tugas');
    }
};
