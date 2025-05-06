@extends('index')

@section('content')
    <div class="container">
        <h2 class="mt-4">Tugas: {{ $tugas->judul }}</h2>
        <p class="mb-2">{{ $tugas->deskripsi }}</p>
        <p class="mb-4">Batas Waktu: {{ \Carbon\Carbon::parse($tugas->batas_waktu)->format('d M Y H:i') }}</p>

        <h4 class="mb-4">Daftar Soal</h4>
        <div class="list-group">
            @foreach ($tugas->soal as $soal)
                <div class="list-group-item list-group-item-action mb-3">
                    <strong>{{ $loop->iteration }}. {{ $soal->pertanyaan }}</strong>

                    <div class="mt-2">
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
            @endforeach
        </div>

        <hr>

        <h4>Daftar Pengguna yang Sudah Mengerjakan</h4>
        <ul>
            @forelse ($penggunaYangMengerjakan as $pengguna)
                <li>{{ $pengguna }}</li>
            @empty
                <p>Belum ada pengguna yang mengerjakan tugas ini.</p>
            @endforelse
        </ul>
    </div>
@endsection
