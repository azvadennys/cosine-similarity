<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanTugas extends Model
{
    use HasFactory;

    protected $table = "jawaban_tugas";
    protected $fillable = ['user_id', 'tugas_id', 'soal_tugas_id', 'jawaban', 'is_benar'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function soal()
    {
        return $this->belongsTo(SoalTugas::class);
    }
}
