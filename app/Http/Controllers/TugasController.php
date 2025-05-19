<?php

namespace App\Http\Controllers;

use App\Models\JawabanTugas;
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
            if ($item['tipe'] == 'pg') {
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
        $tugas = Tugas::with([
            'soal',
            'jawaban' => function ($query) {
                $query->with('user')->orderBy('created_at', 'asc');
            },
        ])->findOrFail($tugasId);

        // Mendapatkan daftar pengguna yang telah mengerjakan tugas ini (nama, email, waktu pengerjaan tanpa duplikat)
        $penggunaYangMengerjakan = $tugas->jawaban->pluck('user')->unique(function ($user) {
            return $user->email; // Menggunakan email untuk memastikan tidak ada duplikat
        });

        // Menambahkan waktu pengerjaan, nilai total, jumlah jawaban, dan menghitung nilai rata-rata
        $penggunaYangMengerjakan = $penggunaYangMengerjakan->map(function ($user) use ($tugas) {
            // Ambil jawaban terkait dengan user tersebut
            $jawaban = $tugas->jawaban->where('user_id', $user->id);

            // Total nilai cosine similarity
            $totalNilai = $jawaban->sum('nilai_cosine_similarity');

            // Jumlah jawaban yang dikirim
            $jumlahJawaban = $jawaban->count();

            // Menghitung nilai rata-rata
            $rataRataNilai = $jumlahJawaban > 0 ? $totalNilai / $jumlahJawaban : 0;

            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => $jawaban->first()->created_at->format('d F Y H:i'), // Menambahkan waktu pengerjaan
                'rata_rata_nilai' => number_format($rataRataNilai, 2), // Membatasi 2 angka desimal
            ];
        });

        // Menyortir berdasarkan waktu pengerjaan
        $penggunaYangMengerjakan = $penggunaYangMengerjakan->sortByDesc('rata_rata_nilai');
        return view('tugas.show', compact('tugas', 'penggunaYangMengerjakan'));
    }

    public function hasilTugasAdmin($tugasId, $user_id)
    {
        $tugas = Tugas::with([
            'soal',
            'jawaban' => function ($query) {
                $query->with('user');
            },
        ])->findOrFail($tugasId);

        // Ambil jawaban yang diinputkan oleh pengguna yang login
        $userJawaban = $tugas->jawaban->where('user_id', $user_id);
        // dd($userJawaban);
        // Melakukan analisis cosine similarity dan menghasilkan laporan untuk setiap soal
        foreach ($tugas->soal as $soal) {
            // Mendapatkan jawaban pengguna untuk soal tertentu
            $jawabanPengguna = $userJawaban->where('soal_tugas_id', $soal->id)->first();

            if ($jawabanPengguna) {
                // Inisialisasi analyzer untuk perbandingan kalimat
                $analyzer = new CosineSimilarityController();

                if ($soal->tipe == 'pg') {
                    // dd($jawabanPengguna);
                    if ($soal->jawaban_benar == $jawabanPengguna->jawaban) {
                        $analysis = $analyzer->compareSentences($soal->alasan_jawaban, $jawabanPengguna->penjelasan_jawaban);
                        $report = $analyzer->generateHtmlReport($analysis);
                    } else {
                        $report = '<div class="alert alert-danger">
                                        Pilihan jawaban ganda anda salah.
                                    </div>';
                    }
                } else {
                    // Melakukan analisis dan menghasilkan laporan
                    $analysis = $analyzer->compareSentences($soal->jawaban_benar, $jawabanPengguna->jawaban);
                    $report = $analyzer->generateHtmlReport($analysis);
                }
                // Menambahkan laporan ke soal untuk ditampilkan di Blade
                $soal->report = $report;
            }
        }

        return view('tugas.hasil', compact('tugas', 'userJawaban'));
    }

    // Controller method
    public function hasilTugas($tugasId)
    {
        $tugas = Tugas::with([
            'soal',
            'jawaban' => function ($query) {
                $query->with('user');
            },
        ])->findOrFail($tugasId);

        // Ambil jawaban yang diinputkan oleh pengguna yang login
        $userJawaban = $tugas->jawaban->where('user_id', auth()->user()->id);
        // dd($userJawaban);
        // Melakukan analisis cosine similarity dan menghasilkan laporan untuk setiap soal
        foreach ($tugas->soal as $soal) {
            // Mendapatkan jawaban pengguna untuk soal tertentu
            $jawabanPengguna = $userJawaban->where('soal_tugas_id', $soal->id)->first();

            if ($jawabanPengguna) {
                // Inisialisasi analyzer untuk perbandingan kalimat
                $analyzer = new CosineSimilarityController();

                if ($soal->tipe == 'pg') {
                    // dd($jawabanPengguna);
                    if ($soal->jawaban_benar == $jawabanPengguna->jawaban) {
                        $analysis = $analyzer->compareSentences($soal->alasan_jawaban, $jawabanPengguna->penjelasan_jawaban);
                        $report = $analyzer->generateHtmlReport($analysis);
                    } else {
                        $report = '<div class="alert alert-danger">
                                        Pilihan jawaban ganda anda salah.
                                    </div>';
                    }
                } else {
                    // Melakukan analisis dan menghasilkan laporan
                    $analysis = $analyzer->compareSentences($soal->jawaban_benar, $jawabanPengguna->jawaban);
                    $report = $analyzer->generateHtmlReport($analysis);
                }
                // Menambahkan laporan ke soal untuk ditampilkan di Blade
                $soal->report = $report;
            }
        }

        return view('tugas.hasil', compact('tugas', 'userJawaban'));
    }

    public function destroy($tugasId)
    {
        $tugas = Tugas::findOrFail($tugasId);
        $judulTugas = $tugas->judul;

        // Hapus tugas
        $tugas->delete();

        return back()->with('success', 'Berhasil Menghapus Tugas ' . $judulTugas);
    }

    public function kerjakan($tugasId)
    {
        $tugas = Tugas::with([
            'soal',
            'jawaban' => function ($query) {
            $query->with('user');
            },
        ])->findOrFail($tugasId);

        // dd($tugas);

        // Mendapatkan daftar pengguna yang telah mengerjakan tugas ini
        $penggunaYangMengerjakan = $tugas->jawaban->pluck('user.name');

        return view('tugas.kerjakan', compact('tugas', 'penggunaYangMengerjakan'));
    }

    public function simpanJawaban(Request $request, $tugasId)
    {
        $detailTugas = Tugas::where('id', $tugasId)->first();
        // dd($detailTugas);

        foreach ($request->soal as $idSoal) {
            $dataSoal = SoalTugas::where('id', $idSoal)->first();
            // dd($dataSoal);
            $analyzer = new CosineSimilarityController();

            $is_benar = null;
            // dd($request->tipe[$item]);
            if ($request->tipe[$idSoal] == 'pg') {
                if ($dataSoal->jawaban_benar == $request->jawaban[$idSoal]) {
                    $analysis = $analyzer->compareSentences($dataSoal->alasan_jawaban, $request->alasan[$idSoal]);
                    $similarity_percentage = $analysis['similarity_percentage'];
                    $is_benar = true;
                } else {
                    $similarity_percentage = 0;
                }
                // dd($analysis);
                JawabanTugas::create([
                    'user_id' => auth()->user()->id,
                    'tugas_id' => $tugasId,
                    'soal_tugas_id' => $idSoal,
                    'jawaban' => $request->jawaban[$idSoal],
                    'penjelasan_jawaban' => $request->alasan[$idSoal],
                    'nilai_cosine_similarity' => $similarity_percentage,
                    'is_benar' => $is_benar,
                ]);
            } else {
                $analysis = $analyzer->compareSentences($dataSoal->alasan_jawaban, $request->jawaban[$idSoal]);
                $similarity_percentage = $analysis['similarity_percentage'];
                JawabanTugas::create([
                    'user_id' => auth()->user()->id,
                    'tugas_id' => $tugasId,
                    'soal_tugas_id' => $idSoal,
                    'jawaban' => $request->jawaban[$idSoal],
                    'penjelasan_jawaban' => $request->jawaban[$idSoal],
                    'nilai_cosine_similarity' => $similarity_percentage,
                    'is_benar' => $is_benar,
                ]);
            }
        }
        return redirect()
            ->route('kelas.show', ['kelas' => $detailTugas->kelas_id])
            ->with('success', 'Terimakasih anda telah mengerjakan tugas');
    }
}
