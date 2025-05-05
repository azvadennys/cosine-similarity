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
                    <li class="breadcrumb-item active" aria-current="page">Riwayat</li>
                </ol>
            </nav>
        </div>
    </section>



    <div class="container">
        <h2>Riwayat Status Lamaran</h2>
        <p>Pantau semua aktivitas lamaran Anda di setiap unit bisnis pada CV Wafi Jaya Group </p>
        <div class="card shadow-sm p-4 mb-4">

            <!-- Job Listings -->
            <div class="row">
                <!-- Loop through job applications (replace with dynamic data) -->
                @if ($jobApplications->isEmpty())
                    <div class="col-12 text-center">
                        <div class="card shadow-sm p-3">
                            <!-- Icon for No Career History -->
                            <div class="d-flex justify-content-center mb-3">
                                <i class="bi bi-person-x" style="font-size: 3rem; color: #6c757d;"></i>
                                <!-- Bootstrap icon -->
                            </div>
                            <h4>Tidak ada riwayat karir</h4>
                            <p class="text-muted">Anda belum melamar pada lowongan pekerjaan di CV Wafi Jaya Group.</p>
                        </div>
                    </div>
                @else
                    <!-- Loop through job applications if available -->
                    @foreach ($jobApplications as $application)
                        <div class="col-12 col-md-6 mb-4">
                            <a href="{{ route('lowongan.status', $application->id) }}"
                                class="card shadow-sm p-3 text-decoration-none">
                                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                                    <!-- Job Icon (replace with your own icon or logo) -->
                                    <h3
                                        class="d-flex flex-column flex-md-row align-items-center justify-content-center mb-3 mb-md-0">
                                        <img src="{{ asset($application->jobOpening->placement->unit->logo) }}"
                                            alt="Logo"
                                            style="height: 60px; object-fit: contain; margin-bottom: 5px; margin-right: 10px; max-width: 100%;">
                                        <span>{{ $application->position }}</span>
                                    </h3>

                                    <!-- Status Message Based on Progress and Status -->
                                    @if ($application->status == 'Proses')
                                        <button class="btn btn-primary w-100 w-md-auto mb-2">
                                            @if ($application->progress == 'Administrasi')
                                                Proses - Administrasi
                                            @elseif($application->progress == 'Wawancara')
                                                Proses - Wawancara
                                            @endif
                                        </button>
                                    @elseif($application->status == 'Ditolak')
                                        <button class="btn btn-danger w-100 w-md-auto mb-2">Tidak Lolos</button>
                                    @elseif($application->status == 'Pengunduran Diri')
                                        <button class="btn btn-danger w-100 w-md-auto mb-2">Pengunduran Diri</button>
                                    @elseif($application->status == 'Diterima')
                                        <button class="btn btn-success w-100 w-md-auto mb-2">Diterima</button>
                                    @endif
                                </div>

                                <h4>{{ $application->jobOpening->position }} -
                                    {{ $application->jobOpening->placement->unit->unit_name }}</h4>
                                <div class="mt-2">
                                    <p>{{ $application->jobOpening->placement->location }} |
                                        {{ $application->jobOpening->placement->address }}</p>
                                    <p><small>Tanggal Mendaftar: {{ $application->created_at->format('d F Y') }}</small></p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
            <!-- Pagination Links -->
            <div class="d-flex justify-content-center mt-4">
                <!-- Display Bootstrap pagination -->
                {{ $jobApplications->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
