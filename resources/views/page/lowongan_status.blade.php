@extends('index2', ['subtitle' => $subtitle])

@section('content')
    <!-- Job Details Layout -->
    <section class="my-5">
        <div class="container">
            <!-- Breadcrumb Section -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('lowongan') }}">Karir</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('lowongan.riwayat', auth()->user()->id) }}">Riwayat</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $index->jobopening->position }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <style>
        .status-container {
            margin-top: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 20px;
        }

        .status-header {
            font-size: 24px;
            font-weight: bold;
        }

        .status-description {
            color: #6c757d;
        }

        .job-title {
            font-size: 20px;
            font-weight: bold;
            margin-top: 15px;
        }

        .job-location {
            color: #6c757d;
            font-size: 14px;
        }

        .status-step {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            padding: 10px;
            background-color: #e9ecef;
            border-radius: 10px;
        }

        .step-box {
            display: flex;
            align-items: center;
        }

        .step-circle {
            width: 30px;
            height: 30px;
            background-color: var(--bs-primary);
            color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 10px;
            opacity: 20%;
        }

        .step-text {
            font-weight: bold;
        }

        .status-message {
            background-color: #f8d7da;
            color: #721c24;
            border-radius: 5px;
            padding: 10px;
            margin-top: 10px;
        }

        .step-box.completed .step-circle {
            background-color: var(--bs-primary);
            opacity: 100%;
        }

        .step-box.completed .step-text {
            color: var(--bs-primary);
        }

        /* Additional CSS for mobile responsiveness */
        @media (max-width: 768px) {
            .status-step {
                flex-direction: column;
                text-align: center;
            }

            .step-box {
                margin-bottom: 15px;
            }

            .job-title {
                font-size: 18px;
                text-align: center;
            }

            .job-location {
                font-size: 12px;
                text-align: center;
            }

            .status-message {
                font-size: 14px;
            }

            .action-button {
                width: 100%;
                text-align: center;
                padding: 12px 20px;
            }
        }
    </style>

    <div class="container">
        <h2>Status Lamaran - {{ $index->jobopening->position }}</h2>
        <p>Pantau semua aktivitas lamaran Anda di setiap unit bisnis pada CV Wafi Jaya Group</p>
        <div class="card shadow-sm p-4 mb-4">

            <h3 class="d-flex flex-column flex-md-row align-items-center justify-content-center">
                <!-- Job title with the logo -->
                <img src="{{ asset($index->jobOpening->placement->unit->logo) }}" alt="Logo"
                    style="height: 60px; object-fit: contain; margin-bottom: 5px; margin-right: 10px; max-width: 100%;">
                <span class="text-center">{{ $index->position }}</span>
            </h3>

            <!-- Job Title and Location -->
            <h4 class="text-center">{{ $index->jobOpening->placement->unit->unit_name }} -
                {{ $index->jobOpening->placement->location }}</h4>
            <p class="text-center">{{ $index->jobOpening->placement->address }}</p>

            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <!-- Status Step Section -->
                    <div class="status-step mb-2">
                        <div class="step-box @if ($progress == 'Administrasi' || $progress == 'Wawancara' || $progress == 'Lolos Seleksi' || $status == 'Diterima') completed @endif">
                            <div class="step-circle">1</div>
                            <div class="step-text">Administrasi</div>
                        </div>
                        <div class="step-box @if ($progress == 'Wawancara' || $progress == 'Lolos Seleksi' || $status == 'Diterima') completed @endif">
                            <div class="step-circle">2</div>
                            <div class="step-text">Wawancara</div>
                        </div>
                        <div class="step-box @if ($progress == 'Lolos Seleksi' || $status == 'Diterima') completed @endif">
                            <div class="step-circle">3</div>
                            <div class="step-text">Lolos Seleksi</div>
                        </div>
                    </div>

                    <!-- Status Message Based on Progress and Status -->
                    @if ($status == 'Proses')
                        <div class="alert alert-info">
                            @if ($progress == 'Administrasi')
                                Proses Seleksi Administrasi sedang berlangsung, cek secara berkala untuk mendapatkan
                                informasi terbaru.
                            @elseif($progress == 'Wawancara')
                                Proses Wawancara sedang berlangsung, pastikan Anda siap untuk tahap wawancara.
                            @elseif($progress == 'Lolos Seleksi')
                                Anda telah lolos seleksi, tunggu informasi lebih lanjut.
                            @endif
                        </div>
                    @elseif($status == 'Ditolak')
                        <div class="alert alert-danger">
                            Maaf, Anda tidak lolos dalam seleksi ini. Terima kasih telah melamar.
                        </div>
                    @elseif($status == 'Pengunduran Diri')
                        <div class="alert alert-danger">
                            Anda telah melakukan pengunduran diri dalam seleksi ini. Terima kasih telah melamar.
                        </div>
                    @elseif($status == 'Diterima')
                        <div class="alert alert-success">
                            Selamat! Anda diterima untuk posisi ini. Silakan tunggu informasi lebih lanjut.
                        </div>
                    @endif

                    @if ($status == 'Proses')
                        <!-- Action Button (Pengunduran diri) -->
                        <div class="btn btn-danger w-100" id="resignBtn">
                            Pengunduran diri
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // SweetAlert Confirmation for Pengunduran Diri
        document.getElementById('resignBtn').addEventListener('click', function() {
            Swal.fire({
                title: 'Apakah Anda yakin ingin mengundurkan diri?',
                text: "Anda tidak dapat membatalkan proses ini setelah mengkonfirmasi.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, saya yakin!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Here you can add the action to perform when the user confirms the resignation
                    // You can submit a form or make an AJAX request to process the resignation
                    window.location.href =
                        "{{ route('lowongan.status.pengunduran_diri', $index->id) }}"; // Example route for resignation
                }
            });
        });
    </script>
@endsection
