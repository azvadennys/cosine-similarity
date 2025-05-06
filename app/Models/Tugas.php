<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;
    protected $fillable = ['judul', 'deskripsi', 'kelas_id', 'batas_waktu'];

    public function jawaban()
    {
        return $this->hasMany(JawabanTugas::class);
    }
    public function soal()
    {
        return $this->hasMany(SoalTugas::class);
    }
}
