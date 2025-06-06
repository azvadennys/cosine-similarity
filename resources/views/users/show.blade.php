@extends('index')

@section('content')
    <div class="container">

        <a href="{{ route('kelas.index') }}" class="btn btn-primary btn-sm mb-4">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <h1 class="mt-4">Kelas {{ $kelas->nama_kelas }}</h1>
        <h3 class="mb-2">Dosen: {{ $kelas->dosen->name }}</h3>
        <p class="mb-4">{{ $kelas->deskripsi }}</p>

        <div class="row">
            <!-- Card Mahasiswa -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0 text-white">Mahasiswa yang Bergabung</h5>
                    </div>
                    <div class="card-body p-2">
                        <table class="table table-bordered table-striped mb-0" id="tablemahasiswa">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kelas->mahasiswas as $index => $mhs)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $mhs->name }}</td>
                                        <td>{{ $mhs->email }}</td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Card Tugas -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-white">Daftar Tugas</h5>
                        <a href="{{ route('tugas.create', $kelas->id) }}" class="btn btn-light btn-sm text-success">
                            Buat Tugas
                        </a>
                    </div>

                    <div class="card-body p-2">
                        <table class="table table-bordered table-striped mb-0" id="tabletugas">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Deadline</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kelas->tugas as $index => $tugas)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $tugas->judul }}</td>
                                        <td>{{ \Carbon\Carbon::parse($tugas->batas_waktu)->format('d M Y H:i') }}</td>

                                        <td>
                                            <div class="d-flex justify-content-center">
                                                @if (auth()->user()->role == 'mahasiswa')
                                                    @if ($tugas->sudahMengirimJawaban())
                                                        <button class="btn btn-sm btn-success mx-1">Selesai</button>
                                                        <a href="{{ route('tugas.hasil', $tugas->id) }}"
                                                            class="btn btn-sm btn-primary mx-1">Detail</a>
                                                    @else
                                                        <a href="{{ route('tugas.kerjakan', $tugas->id) }}"
                                                            class="btn btn-sm btn-primary mx-1">Kerjakan</a>
                                                    @endif
                                                @endif

                                                @if (auth()->user()->role != 'mahasiswa')
                                                    <a href="{{ route('tugas.show', $tugas->id) }}"
                                                        class="btn btn-sm btn-info mx-1">Lihat</a>
                                                    <form action="{{ route('tugas.destroy', $tugas->id) }}" method="POST"
                                                        id="deleteForm{{ $tugas->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-danger mx-1"
                                                            onclick="confirmDelete({{ $tugas->id }})">Hapus</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.css" />

    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#tablemahasiswa').DataTable();
            $('#tabletugas').DataTable();
        });

        function confirmDelete(tugasId) {
            Swal.fire({
                title: 'Yakin ingin menghapus tugas ini?',
                text: 'Tugas yang dihapus tidak bisa dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika konfirmasi hapus berhasil, kirim form
                    document.getElementById('deleteForm' + tugasId).submit();
                }
            });
        }
    </script>
@endsection
