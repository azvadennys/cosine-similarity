@extends('index')

@section('content')
    <div class="container">
        <h2 class="mt-4">Mengerjakan Tugas: {{ $tugas->judul }}</h2>
        <p class="mb-4">{{ $tugas->deskripsi }}</p>
        <p><strong>Batas Waktu: </strong>{{ \Carbon\Carbon::parse($tugas->batas_waktu)->format('d M Y H:i') }}</p>

        <form action="{{ route('tugas.simpanJawaban', $tugas->id) }}" method="POST">
            @csrf
            @foreach ($tugas->soal as $soal)
                <div class="mb-4">
                    <label class="form-label"><strong>{{ $loop->iteration }}. {{ $soal->pertanyaan }}</strong></label>
                    <input type="hidden" name="soal[{{ $soal->id }}]" value="{{ $soal->id }}">

                    @if ($soal->tipe == 'pg')
                        <div class="form-check">
                            <input type="radio" name="jawaban[{{ $soal->id }}]" value="A"
                                class="form-check-input" required>
                            <label class="form-check-label">A. {{ $soal->pilihan_a }}</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="jawaban[{{ $soal->id }}]" value="B"
                                class="form-check-input" required>
                            <label class="form-check-label">B. {{ $soal->pilihan_b }}</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="jawaban[{{ $soal->id }}]" value="C"
                                class="form-check-input" required>
                            <label class="form-check-label">C. {{ $soal->pilihan_c }}</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="jawaban[{{ $soal->id }}]" value="D"
                                class="form-check-input" required>
                            <label class="form-check-label">D. {{ $soal->pilihan_d }}</label>
                        </div>
                    @else
                        <textarea name="jawaban[{{ $soal->id }}]" class="form-control" rows="4" required></textarea>
                    @endif
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Kirim Jawaban</button>
        </form>
    </div>
@endsection
@section('scripts')
    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Jawaban Anda tidak dapat diubah setelah dikirim.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Kirim!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    </script>
@endsection
