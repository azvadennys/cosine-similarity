<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Tugas extends Model
{
    use HasFactory;
    protected $fillable = ['judul', 'deskripsi', 'kelas_id', 'batas_waktu'];

    public function jawaban()
    {
        return $this->hasMany(JawabanTugas::class);
    }
    public function sudahMengirimJawaban()
    {
        return $this->jawaban()->where('user_id', Auth::id())->exists();
    }
    public function soal()
    {
        return $this->hasMany(SoalTugas::class);
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
