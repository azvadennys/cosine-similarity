<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalTugas extends Model
{
    use HasFactory;
    protected $fillable = ['tugas_id', 'pertanyaan', 'tipe', 'pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'jawaban_benar', 'alasan_jawaban'];
}
