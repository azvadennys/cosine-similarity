@extends('index')

@section('content')
    <div class="container">
        <a href="{{ route('kelas.show', $tugas->kelas->id) }}" class="btn btn-primary btn-sm mb-4"><i
                class="bi bi-arrow-left"></i> Kembali</a>
        <h2 class="mt-4">Tugas: {{ $tugas->judul }}</h2>
        <h5 class="mt-4">Mahasiswa: {{ $tugas->jawaban->first()->user->name }}</h5>
        <p class="mb-2">{{ $tugas->deskripsi }}</p>
        <p class="mb-4">Batas Waktu: {{ \Carbon\Carbon::parse($tugas->batas_waktu)->format('d M Y H:i') }}</p>

        <!-- Menampilkan Nilai Rata-rata dengan alert -->
        <div class="alert alert-info mb-4">
            <strong>Nilai Rata-rata Tugas:</strong> {{ $userJawaban->avg('nilai_cosine_similarity') }}
        </div>

        <h4 class="mb-4">Daftar Soal</h4>
        <div class="row">
            @foreach ($tugas->soal as $soal)
                <div class="col-12 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <strong>{{ $loop->iteration }}. {{ $soal->pertanyaan }}</strong>
                        </div>
                        <div class="card-body">
                            @if ($soal->tipe == 'pg')
                                <div><strong>Pilihan:</strong></div>
                                <ul class="list-unstyled">
                                    <li>A. {{ $soal->pilihan_a }}</li>
                                    <li>B. {{ $soal->pilihan_b }}</li>
                                    <li>C. {{ $soal->pilihan_c }}</li>
                                    <li>D. {{ $soal->pilihan_d }}</li>
                                </ul>
                                <div><strong>Jawaban Benar:</strong> {{ $soal->jawaban_benar }}</div>
                                <div><strong>Penjelasan Jawaban:</strong> {{ $soal->alasan_jawaban }}</div>

                                <!-- Menampilkan jawaban pengguna dan nilai -->
                                @php
                                    $jawabanPengguna = $userJawaban->where('soal_tugas_id', $soal->id)->first();
                                @endphp
                                <div class="mt-3">
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Jawaban Pengguna</th>
                                                <th>Alasan Jawaban Pengguna</th>
                                                <th>Nilai</th>
                                                @if(auth()->user()->role != "mahasiswa")
                                                <th>Detail</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    {{ $jawabanPengguna->jawaban }}
                                                </td>
                                                <td>
                                                    {{ $jawabanPengguna->penjelasan_jawaban }}
                                                </td>
                                                <td>
                                                    {{ $jawabanPengguna->nilai_cosine_similarity }}
                                                </td>
                                                 @if(auth()->user()->role != "mahasiswa")
                                                <td>
                                                    <button class="btn btn-primary btn-sm toggle-detail"
                                                        data-bs-toggle="collapse" href="#collapseDetail{{ $soal->id }}"
                                                        role="button" aria-expanded="false"
                                                        aria-controls="collapseDetail{{ $soal->id }}">
                                                        Lihat Detail
                                                    </button>
                                                </td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>

                                    <!-- Menampilkan detail jawaban -->
                                    <div class="collapse" id="collapseDetail{{ $soal->id }}">
                                        <div class="card card-body">
                                            @if(isset($soal->report))
                                                {!! $soal->report !!}
                                            @else
                                                Belum ada jawaban dari pengguna untuk analisis.
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div><strong>Jawaban Benar:</strong> {{ $soal->jawaban_benar }}</div>

                                <!-- Menampilkan jawaban pengguna untuk soal esai -->
                                @php
                                    $jawabanPengguna = $userJawaban->where('soal_tugas_id', $soal->id)->first();
                                @endphp
                                <div class="mt-3">
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Jawaban Pengguna</th>
                                                <th>Nilai</th>
                                                 @if(auth()->user()->role != "mahasiswa")
                                                <th>Detail</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    {{ $jawabanPengguna->jawaban }}
                                                </td>
                                                <td>
                                                    {{ $jawabanPengguna->nilai_cosine_similarity }}
                                                </td>
                                                 @if(auth()->user()->role != "mahasiswa")
                                                <td>
                                                    <button class="btn btn-primary btn-sm toggle-detail"
                                                        data-bs-toggle="collapse" href="#collapseDetail{{ $soal->id }}"
                                                        role="button" aria-expanded="false"
                                                        aria-controls="collapseDetail{{ $soal->id }}">
                                                        Lihat Detail
                                                    </button>
                                                </td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>

                                    <!-- Menampilkan detail jawaban -->
                                    <div class="collapse" id="collapseDetail{{ $soal->id }}">
                                        <div class="card card-body">
                                            @if(isset($soal->report))
                                                {!! $soal->report !!}
                                            @else
                                                Belum ada jawaban dari pengguna untuk analisis.
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <hr>

        <!-- Nilai Keseluruhan -->
        <h4>Nilai Keseluruhan</h4>
        <div class="card mb-4">
            <div class="card-body">
                <strong>Total Nilai:</strong> {{ $userJawaban->sum('nilai_cosine_similarity') }}<br>
                <strong>Rata-rata Nilai:</strong> {{ $userJawaban->avg('nilai_cosine_similarity') }}
            </div>
        </div>
    </div>

    <!-- JavaScript untuk mengubah teks tombol saat collapse dibuka -->
    <script>
        document.querySelectorAll('.toggle-detail').forEach(button => {
            button.addEventListener('click', function() {
                const isExpanded = button.getAttribute('aria-expanded') === 'true';
                if (isExpanded) {
                    button.textContent = 'Tutup Detail'; // Ganti teks menjadi "Tutup Detail"
                } else {
                    button.textContent = 'Lihat Detail'; // Ganti teks menjadi "Lihat Detail"
                }
            });
        });
    </script>
@endsection
