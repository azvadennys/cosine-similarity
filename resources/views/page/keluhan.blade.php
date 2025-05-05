@extends('index2', ['subtitle' => 'Keluhan Pegawai'])

@section('content')
    <!-- Job Details Layout -->
    <section class="my-5">
        <div class="container">
            <!-- Breadcrumb Section -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Keluhan</li>
                </ol>
            </nav>
        </div>
    </section>

    <div class="container">
        <h2>Riwayat Status Keluhan Pegawai</h2>
        <p>Pantau semua keluhan yang diajukan oleh pegawai di CV Wafi Jaya Group.</p>
        <div class="card shadow-sm p-4 mb-4">
            <!-- Tombol Tambah Data -->
            <button class="btn btn-success mb-3 w-30" data-bs-toggle="modal" data-bs-target="#addComplaintModal">
                <i class="fa fa-plus"></i> Tambah Data
            </button>
            <div class="table-responsive">
                <table id="keluhan-table" class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Tanggal</th>
                            <th>Keluhan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employcomplain as $index => $complain)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($complain->created_at)->locale('id')->format('d F Y, H:i') }}
                                </td>
                                <td>{{ \Str::words($complain->complain, 10, '...') }}</td>

                                <td>
                                    <!-- Tombol Lihat dengan passing data ke modal -->
                                    <button class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal"
                                        data-bs-target="#viewComplaintModal" data-complain="{{ $complain->complain }}"
                                        data-created_at="{{ \Carbon\Carbon::parse($complain->created_at)->locale('id')->format('d F Y, H:i') }}">
                                        <i class="fa fa-eye"></i> Lihat
                                    </button>

                                    <!-- Tombol Delete -->
                                    <button class="btn btn-danger btn-sm mb-2"
                                        onclick="deleteComplain({{ $complain->id }})">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal untuk Menampilkan Detail Keluhan -->
    <div class="modal fade" id="viewComplaintModal" tabindex="-1" aria-labelledby="viewComplaintModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewComplaintModalLabel">Detail Keluhan Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Menampilkan Detail Keluhan -->
                    <h6 id="complainTitle"></h6>
                    <p id="complainContent"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Menambah Keluhan -->
    <div class="modal fade" id="addComplaintModal" tabindex="-1" aria-labelledby="addComplaintModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addComplaintModalLabel">Tambah Keluhan Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form Tambah Keluhan -->
                    <form action="{{ route('keluhan.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="complain" class="form-label">Keluhan</label>
                            <textarea class="form-control" id="complain" name="complain" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Keluhan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="{{ asset('/DataTables/datatables.css') }}" />

    <script src="{{ asset('/DataTables/datatables.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteComplain(id) {
            // SweetAlert2 konfirmasi sebelum menghapus
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak bisa mengembalikan data setelah dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = "{{ route('keluhan.destroy', ':id') }}".replace(':id', id);
                    console.log(url);
                    window.location.href = url; // Redirect ke URL penghapusan
                }
            });
        }

        // Ketika tombol "Lihat" diklik
        $('#viewComplaintModal').on('show.bs.modal', function(event) {
            // Ambil tombol yang diklik
            var button = $(event.relatedTarget); // Tombol yang memicu modal
            var complain = button.data('complain'); // Ambil data complain
            var created_at = button.data('created_at'); // Ambil data created_at

            // Update modal dengan data yang diambil
            var modal = $(this);
            modal.find('#complainTitle').text('Keluhan Diajukan pada: ' +
                created_at); // Menampilkan tanggal keluhan
            // Convert newlines (\n) to <br> tags for complain content
            var complainContent = complain.replace(/\n/g, '<br>');

            // Use .html() to allow <br> tags to render
            modal.find('#complainContent').html(complainContent);
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#keluhan-table').DataTable();
        });
    </script>
@endsection
