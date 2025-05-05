@extends('index2', ['subtitle' => 'Kehadiran Pegawai'])

@section('content')
    <!-- Job Details Layout -->
    <section class="my-5">
        <div class="container">
            <!-- Breadcrumb Section -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kehadiran</li>
                </ol>
            </nav>
        </div>
    </section>

    <div class="container">
        <h2>Riwayat Status Kehadiran Pegawai</h2>
        <p>Pantau semua kehadiran yang dilakukan oleh pegawai di CV Wafi Jaya Group.</p>
        <div class="card shadow-sm p-4 mb-4">
            <!-- Tombol Tambah Kehadiran -->
            <button class="btn btn-success mb-3 w-30" data-bs-toggle="modal" data-bs-target="#addAttendanceModal">
                <i class="fa fa-plus"></i> Tambah Kehadiran
            </button>

            <div class="table-responsive">
                <table id="attendance-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employeeAttendances as $index => $attendance)
                            @php
                                $image_path = str_replace('public/', '', $attendance->image_path);
                                $date_attendance = \Carbon\Carbon::parse($attendance->created_at)
                                    ->locale('id')
                                    ->format('d F Y, H:i');
                            @endphp
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $date_attendance }} </td>
                                <td>{{ $attendance->status }}</td>
                                <td>{{ \Str::words($attendance->information, 10, '...') }}</td>
                                <td>

                                    <!-- Tombol Lihat dengan passing data ke modal -->
                                    <button class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal"
                                        data-bs-target="#viewAttendanceModal" data-status="{{ $attendance->status }}"
                                        data-created_at="{{ \Carbon\Carbon::parse($attendance->created_at)->locale('id')->format('d F Y, H:i') }}"
                                        data-information="{{ $attendance->information }}"
                                        data-image="{{ asset('storage/' . $image_path) }}" data-id="{{ $attendance->id }}">
                                        <i class="fa fa-eye"></i> Lihat
                                    </button>


                                    <!-- Tombol Delete -->
                                    <button class="btn btn-danger btn-sm mb-2"
                                        onclick="deleteAttendance({{ $attendance->id }})">
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

    <!-- Modal untuk Menampilkan Detail Kehadiran -->
    <div class="modal fade" id="viewAttendanceModal" tabindex="-1" aria-labelledby="viewAttendanceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewAttendanceModalLabel">Detail Kehadiran Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Title, Status, and Information -->
                    <h6 id="attendanceTitle"></h6>
                    <p id="attendanceStatus"></p>
                    <p id="attendanceInformation"></p>

                    <!-- Tampilkan Foto Kehadiran -->
                    <div id="attendanceImageContainer" style="text-align: center; margin-top: 20px;" class="">
                        <img id="attendanceImage" src="" alt="Foto Kehadiran" class="img-fluid border border-3"
                            style="max-width: 100%; max-height: 400px;">
                    </div>
                    <!-- Tombol Aksi -->
                    <div class="mt-3">
                        <button type="button" class="btn btn-danger" id="deleteAttendanceBtn">
                            <i class="fa fa-trash"></i> Hapus Kehadiran
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk meminta perizinan kamera -->
    <div class="modal fade" id="cameraPermissionModal" tabindex="-1" aria-labelledby="cameraPermissionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cameraPermissionModalLabel">Perizinan Kamera Dibutuhkan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Aplikasi ini memerlukan akses ke kamera untuk mengambil gambar. Silakan aktifkan perizinan kamera di
                        pengaturan perangkat Anda.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="openSettingsButton">Buka Pengaturan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <style>
        #imagePreviewContainer {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 200px;
            /* Atur tinggi sesuai dengan modal */
            overflow: hidden;
        }

        #imagePreview {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
    </style>
    <!-- Modal untuk Menambah Kehadiran -->
    <div class="modal fade" id="addAttendanceModal" tabindex="-1" aria-labelledby="addAttendanceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAttendanceModalLabel">
                        @if ($attendanceToday)
                            Kehadiran Anda Sudah Tersimpan untuk Hari Ini
                        @else
                            Tambah Kehadiran Pegawai
                        @endif
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (!$attendanceToday)
                        <form action="{{ route('kehadiran.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Status Kehadiran -->
                            <div class="mb-3">
                                <label for="status" class="form-label">Status Kehadiran</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="Hadir">Hadir</option>
                                    <option value="Izin">Izin</option>
                                    <option value="Sakit">Sakit</option>
                                    <option value="Alpa">Alpa</option>
                                </select>
                            </div>

                            <!-- Keterangan -->
                            <div class="mb-3">
                                <label for="information" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="information" name="information" rows="4" required></textarea>
                            </div>



                            <!-- Kamera Container -->
                            <div id="cameraContainer" style="display:none; text-align: center; position: relative;">
                                <!-- Video dengan ukuran asli dan menjaga rasio aspek -->
                                <div
                                    style="width: 200px; height: 200px; margin: 0 auto; overflow: hidden; position: relative;">
                                    <video id="video" width="100wh" height="auto" autoplay
                                        style="object-fit: cover; border: 1px solid #ccc;"></video>
                                </div>

                                <!-- Canvas untuk menangkap gambar, disembunyikan -->
                                <canvas id="canvas" style="display:none; width: 100%; height: 100%;"></canvas>


                            </div>

                            <!-- Preview Gambar Setelah Pengambilan Gambar -->
                            <div id="imagePreviewContainer" class="mt-3"
                                style="display:none; text-align: center; max-height: 400px; width:auto; overflow: hidden;">
                                <img id="imagePreview" src="#" alt="Image Preview"
                                    class="img-fluid border border-3" style="max-width: 100%; height: auto;">
                            </div>
                            <!-- Button untuk membuka kamera -->
                            <div class="my-3">
                                <div class="row justify-content-center">
                                    <div class="col-6" id="divopenCameraButton">
                                        <button type="button" id="openCameraButton" class="btn btn-warning w-100 ">Buka
                                            Kamera</button>
                                    </div>

                                    <!-- Tombol Ambil Gambar -->
                                    <div class="col-6" id="divtakePictureButton"  style="display: none;">
                                        <button type="button" id="takePictureButton" class="btn btn-success w-100"
                                            style="display: none;">Ambil
                                            Gambar</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Hidden input untuk menyimpan gambar sebagai file -->
                            <input type="file" id="image_path" name="image_path" style="display:none;"
                                accept="image/*" required>

                            <!-- Submit Button -->
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary w-100">Simpan Kehadiran</button>
                            </div>
                        </form>
                    @else
                        <h4>Anda sudah mengisi kehadiran hari ini dengan status
                            <span class="text-primary">"{{ $attendanceToday->status }}"</span> pada
                            {{ $attendanceToday->created_at->format('d F Y, H:i') }}.
                        </h4>
                    @endif
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
        $(document).ready(function() {
            $('[data-bs-toggle="modal"]').on('click', function() {
                showAttendanceDetails(this); // Pass the button that was clicked
            });
            $('#attendance-table').DataTable();
        });
    </script>
    <script>
        // Mendapatkan elemen-elemen
        const openCameraButton = document.getElementById('openCameraButton');
        const divopenCameraButton = document.getElementById('divopenCameraButton');
        const cameraContainer = document.getElementById('cameraContainer');
        const video = document.getElementById('video');
        const takePictureButton = document.getElementById('takePictureButton');
        const divtakePictureButton = document.getElementById('divtakePictureButton');
        const canvas = document.getElementById('canvas');
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');
        const imagePreview = document.getElementById('imagePreview');
        const imagePathInput = document.getElementById('image_path'); // Input file untuk gambar

        let stream;
        // Cek perizinan kamera
        navigator.permissions.query({
                name: 'camera'
            })
            .then(function(permissionStatus) {
                if (permissionStatus.state === 'denied') {
                    // Tampilkan modal jika perizinan ditolak
                    showCameraPermissionModal();
                }

                permissionStatus.onchange = function() {
                    if (permissionStatus.state === 'denied') {
                        // Tampilkan modal jika perizinan ditolak
                        showCameraPermissionModal();
                    }
                };
            })
            .catch(function(error) {
                console.error('Error checking camera permission:', error);
            });

        // Fungsi untuk menampilkan modal perizinan kamera
        function showCameraPermissionModal() {
            // Menampilkan modal dengan menggunakan Bootstrap modal
            var cameraPermissionModal = new bootstrap.Modal(document.getElementById('cameraPermissionModal'));
            cameraPermissionModal.show();
        }

        // Menangani tombol untuk membuka pengaturan perangkat
        document.getElementById('openSettingsButton').addEventListener('click', function() {
            // Untuk desktop, bisa membuka pengaturan browser atau sistem
            alert('Silakan buka pengaturan browser atau perangkat Anda untuk mengaktifkan izin kamera.');
        });
        // Membuka kamera saat button ditekan
        openCameraButton.addEventListener('click', function() {
            // Minta izin untuk mengakses kamera
            navigator.mediaDevices.getUserMedia({
                    video: { facingMode: 'user' },'audio': false,
                })
                .then(function(mediaStream) {
                    // Menampilkan stream video ke elemen video
                    video.srcObject = mediaStream;
                    imagePreviewContainer.style.display = 'none';
                    cameraContainer.style.display = 'block'; // Menampilkan kamera
                    takePictureButton.style.display = 'block'; // Menampilkan kamera
                    divtakePictureButton.style.display = 'block'; // Menampilkan div kamera
                    stream = mediaStream;
                })
                .catch(function(error) {
                    alert('Gagal mengakses kamera: ' + error);
                });

        });

        // Ambil gambar dari kamera dan tampilkan preview
        takePictureButton.addEventListener('click', function() {
            const videoWidth = video.videoWidth; // Lebar asli video
            const videoHeight = video.videoHeight; // Tinggi asli video

            // Mengatur dimensi canvas untuk menjaga rasio aspek
            canvas.width = videoWidth;
            canvas.height = videoHeight;

            // Menangkap gambar dari video ke canvas dengan menjaga rasio aspek
            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, videoWidth, videoHeight); // Menjaga rasio aspek video

            // Mengambil data URL gambar dari canvas
            const imageData = canvas.toDataURL('image/png'); // Mengambil gambar sebagai data URL

            // Menampilkan gambar pada preview
            imagePreview.src = imageData;
            imagePreview.style.width = 'auto';
            imagePreview.style.height = 'auto'; // Pastikan gambar terdisplay dengan rasio aspek yang benar
            imagePreviewContainer.style.display = 'block'; // Tampilkan gambar preview

            // Setelah gambar diambil, sembunyikan kamera dan canvas
            cameraContainer.style.display = 'none'; // Menyembunyikan kamera
            canvas.style.display = 'none'; // Menyembunyikan canvas

            // Hentikan stream kamera
            if (stream) {
                const tracks = stream.getTracks();
                tracks.forEach(track => track.stop()); // Hentikan semua track video
            }

            // Mengonversi data URL ke Blob
            const byteString = atob(imageData.split(',')[1]);
            const mimeString = imageData.split(',')[0].split(':')[1].split(';')[0]; // MIME type
            const ab = new ArrayBuffer(byteString.length);
            const ia = new Uint8Array(ab);
            for (let i = 0; i < byteString.length; i++) {
                ia[i] = byteString.charCodeAt(i);
            }
            const blob = new Blob([ab], {
                type: mimeString
            });

            // Mengonversi Blob menjadi objek File
            const file = new File([blob], 'image.png', {
                type: mimeString
            });

            // Menyisipkan File ke dalam input file
            const dataTransfer = new DataTransfer(); // Membuat objek DataTransfer
            dataTransfer.items.add(file); // Menambahkan file ke DataTransfer
            imagePathInput.files = dataTransfer.files; // Menyimpan file dalam input file
            takePictureButton.style.display = 'none';
            divtakePictureButton.style.display = 'none';
        });



        function deleteAttendance(id) {
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
                    var url = "{{ route('kehadiran.destroy', ':id') }}".replace(':id', id);
                    console.log(url);
                    window.location.href = url; // Redirect ke URL penghapusan
                }
            });
        }

        function showAttendanceDetails(button) {
            // Wrap the button element with jQuery to access .data()
            var $button = $(button); // Make sure we're working with a jQuery object

            var status = $button.data('status'); // Get status data
            var created_at = $button.data('created_at'); // Get created_at data
            var information = $button.data('information'); // Get information data
            var imagePath = $button.data('image'); // Get image path data
            var attendanceId = $button.data('id'); // Get the attendance ID

            // Update modal dengan data yang diambil
            var modal = $('#viewAttendanceModal');
            modal.find('#attendanceTitle').text('Kehadiran Diajukan pada : ' + created_at);
            modal.find('#attendanceStatus').text('Status : ' + status);
            // Convert newlines (\n) to <br> tags for information content
            var informationContent = information.replace(/\n/g, '<br>');

            // Use .html() to allow <br> tags to render
            modal.find('#attendanceInformation').html(informationContent);


            // Menampilkan gambar kehadiran jika ada
            if (imagePath) {
                modal.find('#attendanceImage').attr('src', imagePath);
                modal.find('#attendanceImageContainer').show(); // Menampilkan gambar
            } else {
                modal.find('#attendanceImageContainer').hide(); // Menyembunyikan gambar jika tidak ada
            }

            // Menambahkan aksi tombol Hapus Kehadiran
            modal.find('#deleteAttendanceBtn').off('click').on('click', function() {
                deleteAttendance(attendanceId); // Panggil fungsi untuk menghapus data
            });
        }

        $('#viewAttendanceModal').on('show.bs.modal', function() {
            // Set aria-hidden to false when modal is shown
            $(this).attr('aria-hidden', 'false');
        });

        $('#viewAttendanceModal').on('hidden.bs.modal', function() {
            // Set aria-hidden to true when modal is hidden
            $(this).attr('aria-hidden', 'true');
        });
    </script>
@endsection
