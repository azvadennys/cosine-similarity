@extends('index')

@section('content')
    <div class="container">
        <a href="{{ route('kelas.show', $tugas->kelas->id) }}" class="btn btn-primary btn-sm mb-4">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <h2 class="mt-4">Tugas: {{ $tugas->judul }}</h2>
        <p class="mb-2">{{ $tugas->deskripsi }}</p>
        <p class="mb-4">Batas Waktu: {{ \Carbon\Carbon::parse($tugas->batas_waktu)->format('d M Y H:i') }}</p>

        <h4 class="mb-4">Daftar Soal</h4>
        <div class="row">
            @foreach ($tugas->soal as $soal)
                <div class="col-md-12 mb-4">
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
                                <div><strong>Penjelasan:</strong> {{ $soal->alasan_jawaban }}</div>
                            @else
                                <div><strong>Jenis:</strong> Esai</div>
                                <div><strong>Jawaban Benar:</strong> {{ $soal->jawaban_benar }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <hr>

        <h4>Daftar Pengguna yang Sudah Mengerjakan</h4>

        @if($penggunaYangMengerjakan->isEmpty())
            <p>Belum ada pengguna yang mengerjakan tugas ini.</p>
        @else
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Nilai</th>
                                <th>Waktu Selesai</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penggunaYangMengerjakan as $pengguna)
                            @php
                            $id_user = $pengguna['id'];
                            @endphp
                                <tr>
                                    <td>{{ $pengguna['name'] }}</td>
                                    <td>{{ $pengguna['email'] }}</td>
                                    <td>{{ $pengguna['rata_rata_nilai'] }}</td>
                                    <td>{{ $pengguna['created_at'] }}</td>
                                    <td><a href="{{ route('tugas.hasil.admin', [$tugas->id, $id_user]) }}" class="btn btn-sm btn-primary">Detail</a></td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection
