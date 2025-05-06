<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\SoalTugas;
use App\Models\Tugas;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function create($kelas_id)
    {
        $kelas = Kelas::where('id', $kelas_id)->first();
        return view('tugas.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'kelas_id' => 'required|exists:kelas,id',
            'batas_waktu' => 'nullable|date',
            'soal' => 'required|array|min:1',
        ]);

        $tugas = Tugas::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kelas_id' => $request->kelas_id,
            'batas_waktu' => $request->batas_waktu,
        ]);

        foreach ($request->soal as $item) {
            if ($item['tipe'] == "pg") {
                SoalTugas::create([
                    'tugas_id' => $tugas->id,
                    'tipe' => $item['tipe'],
                    'pertanyaan' => $item['pertanyaan'],
                    'pilihan_a' => $item['pilihan_a'] ?? null,
                    'pilihan_b' => $item['pilihan_b'] ?? null,
                    'pilihan_c' => $item['pilihan_c'] ?? null,
                    'pilihan_d' => $item['pilihan_d'] ?? null,
                    'jawaban_benar' => $item['jawaban_benar'] ?? null,
                    'alasan_jawaban' => $item['alasan_jawaban'] ?? null,
                ]);
            } else {
                SoalTugas::create([
                    'tugas_id' => $tugas->id,
                    'tipe' => $item['tipe'],
                    'pertanyaan' => $item['pertanyaan'],
                    'jawaban_benar' => $item['jawaban_benar_essay'] ?? null,
                    'alasan_jawaban' => $item['jawaban_benar_essay'] ?? null,
                ]);
            }
        }

        return redirect()->route('kelas.show', $request->kelas_id)->with('success', 'Tugas dan soal berhasil dibuat');
    }

    public function show($tugasId)
    {
        $tugas = Tugas::with(['soal', 'jawaban' => function ($query) {
            $query->with('user');
        }])->findOrFail($tugasId);

        // Mendapatkan daftar pengguna yang telah mengerjakan tugas ini
        $penggunaYangMengerjakan = $tugas->jawaban->pluck('user.name');

        return view('tugas.show', compact('tugas', 'penggunaYangMengerjakan'));
    }

    public function destroy($tugasId)
    {
        $tugas = Tugas::findOrFail($tugasId);
        $judulTugas = $tugas->judul;

        // Hapus tugas
        $tugas->delete();

        return back()->with('success', 'Berhasil Menghapus Tugas ' . $judulTugas);
    }
}
