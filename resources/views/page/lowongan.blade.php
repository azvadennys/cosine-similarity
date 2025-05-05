@extends('index2', ['subtitle' => 'Karir', 'subtitle_deskripsi' => 'Kami membuka kesempatan yang sama, baik untuk para talenta muda dan juga untuk para profesional. Pilih kategori yang sesuai dengan pengalaman kerjamu!'])

@section('content')
    <section class="my-xl-9 my-5">
        <div class="container my-4">
            <form method="GET" action="{{ route('lowongan') }}" class="row g-3 align-items-center">
                <!-- Jurusan Filter -->
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="text" name="position" class="form-control" placeholder="Semua Posisi"
                            value="{{ request('position') }}">
                    </div>
                </div>

                <!-- Unit Lowongan Filter -->
                <div class="col-md-3">
                    <div class="input-group">
                        <select name="unit_name" class="form-select">
                            <option value="">Semua Unit Bisnis</option>
                            @foreach ($unit_bisnis as $unit)
                                <option value="{{ $unit->unit_name }}"
                                    {{ request('unit_name') == $unit->unit_name ? 'selected' : '' }}>
                                    {{ $unit->unit_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Jenjang Pendidikan Filter -->
                <div class="col-md-3">
                    <div class="input-group">
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="Buka" {{ request('status') == 'Buka' ? 'selected' : '' }}>Buka</option>
                            <option value="Tutup" {{ request('status') == 'Tutup' ? 'selected' : '' }}>Tutup</option>
                        </select>
                    </div>
                </div>



                <!-- Search Button -->
                <div class="col-md-3 text-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </section>


    <!--Unit Bisnis Start-->
    <section class="my-xl-9 my-5">
        <div class="container">

            <style>
                .line {
                    width: 80%;
                    height: 2px;
                    background-color: #D9D9D9;
                    margin: 4px auto;
                }

                .logo-size {
                    width: auto;
                    height: 100px;
                }
            </style>

            <!-- Card -->
            <div class="table-responsive-lg">
                <div class="row g-5 justify-content-center">
                    @if ($lowongan->isEmpty())
                        <div class="col-12 text-center">
                            <div class="card shadow-sm p-3">
                                <!-- Icon for No Career History -->
                                <div class="d-flex justify-content-center mb-3">
                                    <i class="bi bi-person-x" style="font-size: 3rem; color: #6c757d;"></i>
                                    <!-- Bootstrap icon -->
                                </div>
                                <h4>Belum ada lowongan yang tersedia di CV Wafi Jaya Group.</h4>
                                <p class="text-muted">Silahkan cek secara berkala.</p>
                            </div>
                        </div>
                    @endif
                    <!-- Card Loop -->
                    @foreach ($lowongan as $index)
                        <div class="col-lg-4 col-md-6 col-11 mb-4">
                            <div class="card shadow-lg rounded-3 border-0 d-flex flex-column" style="height: 100%">
                                <!-- Card Body with Logo -->
                                <div class="card-body text-center">
                                    <img src="{{ asset($index->placement->unit->logo) }}" alt="portfolio-2"
                                        class="img-fluid logo-size rounded-3 mb-3 text-center"
                                        style="max-height: 150px; object-fit: contain;">
                                    <h4 class="card-title text-center">{{ $index->placement->unit->unit_name }}</h4>
                                </div>

                                <!-- Stats Section -->
                                <div class="card-body p-4 ">
                                    <div class="row">
                                        <h4>{{ $index->position }}</h4>
                                        <p>Penempatan : <span class="text-primary">{{ $index->placement->location }}</span>
                                        </p>
                                        <!-- Check if application_deadline is passed or not -->
                                        @php
                                            $status = \Carbon\Carbon::now()->greaterThan($index->application_deadline)
                                                ? 'Tutup'
                                                : 'Buka';
                                        @endphp

                                        <p>Penutupan Pendaftaran:
                                            <span
                                                class="text-primary">{{ \Carbon\Carbon::parse($index->application_deadline)->locale('id')->format('d F Y') }}</span>
                                        </p>

                                        <p>Status: <span
                                                class="{{ $status == 'Tutup' ? 'text-danger' : 'text-success' }}">{{ $status }}</span>
                                        </p>
                                    </div>
                                    <div class="row justify-content-center">
                                        @if ($status == 'Buka')
                                            <!-- First Item -->
                                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 mb-2">
                                                <a href="{{ route('lowongan.detail', $index->id) }}"
                                                    class="btn btn-success w-100">Lihat Detail</a>
                                            </div>
                                            @auth
                                                @php
                                                    $cekDaftar = \App\Models\JobApplication::where(
                                                        'job_opening_id',
                                                        $index->id,
                                                    )
                                                        ->where('user_id', auth()->id()) // Assuming the user is authenticated
                                                        ->first();
                                                @endphp
                                            @endauth

                                            <!-- Second Item -->
                                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 mb-2">
                                                @auth
                                                    @if ($cekDaftar === null)
                                                        <a href="{{ route('lowongan.lamar', $index->id) }}"
                                                            class="btn btn-primary w-100">Daftar</a>
                                                    @else
                                                        <button class="btn btn-primary w-100" disabled>Sudah Terdaftar</button>
                                                    @endif
                                                @endauth
                                                @guest
                                                    <a href="{{ route('lowongan.lamar', $index->id) }}"
                                                        class="btn btn-primary w-100">Daftar</a>
                                                @endguest
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Pagination Links -->
            <div class="d-flex justify-content-center mt-4">
                <!-- Display Bootstrap pagination -->
                {{ $lowongan->links('pagination::bootstrap-4') }}
            </div>

        </div>
    </section>


    <!---Unit Bisnis end-->
@endsection
