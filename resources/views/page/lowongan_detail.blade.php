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
                    <li class="breadcrumb-item active" aria-current="page">{{ $index->position }}</li>
                </ol>
            </nav>
            <div class="row">
                <!-- Left Column (Job Description) -->
                <div class="col-lg-8">
                    <div class="card shadow-sm p-4 mb-4">
                        <h3 class="d-flex flex-column flex-md-row align-items-center">
                            <!-- Replace the "MINUMIN" text with an image -->
                            <img src="{{ asset($index->placement->unit->logo) }}" alt="Minumin Logo"
                                style="height: 60px; object-fit: contain; margin-bottom: 5px; margin-right: 10px;">
                            <span>{{ $index->position }}</span>
                        </h3>


                        <p class="text-muted">{{ $index->placement->unit->unit_name }} - {{ $index->placement->location }}
                        </p>
                        @if ($status_daftar)
                            <a href="{{ route('lowongan.status', $CekUserApplication->id) }}"
                                class="btn btn-success mb-3 col-lg-4 col-md-6 col-12">Lihat Status Lamaran</a>
                        @else
                            <a href="{{ route('lowongan.lamar', $index->id) }}"
                                class="btn btn-primary mb-3 col-lg-4 col-md-6 col-12">Lamar</a>
                        @endif
                        <p><strong>Batas Lamar:</strong>
                            {{ \Carbon\Carbon::parse($index->application_deadline)->locale('id')->format('d F Y') }}</p>

                        <hr>

                        <h4>Deskripsi Pekerjaan</h4>
                        <p>{!! nl2br(e($index->job_description)) !!}</p>


                        <h4 class="mt-4">Persyaratan</h4>
                        <p>{!! nl2br(e($index->requirements)) !!}</p>
                    </div>
                </div>

                <!-- Right Column (Company Info) -->
                <div class="col-lg-4">
                    <div class="card shadow-sm p-4 mb-4">
                        <h5><strong>Tentang {{ $index->placement->unit->unit_name }}</strong></h5>
                        <p>{{ $index->placement->unit->description }}</p>

                        <hr>

                        <h5><strong>Alamat Penempatan</strong></h5>
                        <p>{{ $index->placement->address }}</p>

                        <h5><strong>Telepon</strong></h5>
                        <p>Unknown</p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!---Unit Bisnis end-->
@endsection
