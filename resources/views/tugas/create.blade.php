@extends('index')

@section('content')
    <div class="container">
        <h2 class="mb-4">Buat Tugas Baru</h2>

        <form action="{{ route('tugas.store') }}" method="POST">
            @csrf
            <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">

            <div class="mb-3">
                <label class="form-label">Judul Tugas</label>
                <input type="text" name="judul" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Batas Waktu</label>
                <input type="datetime-local" name="batas_waktu" class="form-control">
            </div>

            <hr>
            <h4>Soal Tugas</h4>
            <div id="soal-container" class="row justify-content-center">
                <!-- Soal akan ditambahkan di sini -->
            </div>

            <button type="button" class="btn btn-sm btn-success mb-3" id="tambah-soal">+ Tambah Soal</button>
            <button type="submit" class="btn btn-sm btn-primary mb-3">Simpan Tugas</button>

        </form>
    </div>
@endsection

@section('scripts')
    <script>
        let soalIndex = 0;

        document.getElementById('tambah-soal').addEventListener('click', function() {
            const container = document.getElementById('soal-container');

            const soalHtml = `

        <div class="col-12 col-md-6">
            <div class="card mb-3 p-3 border border-secondary position-relative soal-block">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-soal" aria-label="Close"></button>

                <div class="mb-2">
                    <label class="form-label">Tipe Soal</label>
                    <select name="soal[${soalIndex}][tipe]" class="form-select tipe-select" data-index="${soalIndex}" required>
                        <option value="pg">Pilihan Ganda</option>
                        <option value="essay">Essay</option>
                    </select>
                </div>

                <div class="mb-2">
                    <label class="form-label">Pertanyaan</label>
                    <textarea name="soal[${soalIndex}][pertanyaan]" class="form-control" required></textarea>
                </div>

                <div class="opsi-pg" id="opsi-pg-${soalIndex}">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Pilihan A</label>
                            <input name="soal[${soalIndex}][pilihan_a]" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Pilihan B</label>
                            <input name="soal[${soalIndex}][pilihan_b]" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Pilihan C</label>
                            <input name="soal[${soalIndex}][pilihan_c]" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Pilihan D</label>
                            <input name="soal[${soalIndex}][pilihan_d]" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Jawaban Benar</label>
                        <select name="soal[${soalIndex}][jawaban_benar]" class="form-select" required>
                            <option value="">-- Pilih Jawaban --</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Alasan Jawaban</label>
                        <textarea name="soal[${soalIndex}][alasan_jawaban]" class="form-control" required></textarea>
                    </div>
                </div>

                <div class="opsi-essay" id="opsi-essay-${soalIndex}" style="display:none;">
                    <div class="mb-2">
                        <label class="form-label">Jawaban Soal</label>
                        <textarea name="soal[${soalIndex}][jawaban_benar]" class="form-control"></textarea>
                    </div>
                </div>

            </div>
        </div>
        `;

            container.insertAdjacentHTML('beforeend', soalHtml);
            soalIndex++;
        });

        // Hapus soal
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-soal')) {
                e.target.closest('.soal-block').remove();
            }
        });

        // Toggle PG vs Essay
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('tipe-select')) {
                const index = e.target.dataset.index;
                const pgContainer = document.getElementById(`opsi-pg-${index}`);
                const essayContainer = document.getElementById(`opsi-essay-${index}`);

                if (e.target.value === 'pg') {
                    // Tipe Pilihan Ganda
                    pgContainer.style.display = 'block';
                    essayContainer.style.display = 'none';

                    // Set semua input pilihan ganda menjadi required
                    const pgInputs = pgContainer.querySelectorAll('input, select');
                    pgInputs.forEach(input => {
                        input.setAttribute('required', 'required');
                    });

                    // Hapus required untuk elemen essay
                    const essayInputs = essayContainer.querySelectorAll('input, textarea');
                    essayInputs.forEach(input => {
                        input.removeAttribute('required');
                    });
                } else {
                    // Tipe Essay
                    pgContainer.style.display = 'none';
                    essayContainer.style.display = 'block';

                    // Set semua input essay menjadi required
                    const essayInputs = essayContainer.querySelectorAll('input, textarea');
                    essayInputs.forEach(input => {
                        input.setAttribute('required', 'required');
                    });

                    // Hapus required untuk elemen pilihan ganda
                    const pgInputs = pgContainer.querySelectorAll('input, select');
                    pgInputs.forEach(input => {
                        input.removeAttribute('required');
                    });
                }
            }
        });
    </script>
@endsection
