@extends('index')
@section('content')
    <!--hero start-->
    <section class="jarallax py-4 hero-agency" data-jarallax="" data-speed="0.4">
        <img class="jarallax-img" src="{{ asset('assets_new/images/picture1.png') }}" alt="agency"
            style="filter: brightness(50%);">
        <div class="position-absolute start-0 end-0">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-cue="zoomIn">
                        <div class="text-center text-lg-start">
                            <div class="mb-4 text-white-stable">
                                <h1 class="mb-3 mt-3 display-3 text-white-stable">CV Wafi Jaya Group
                                </h1>
                                <p class="lead mb-0">Mulai perjalanan kariermu di perusahaan terpercaya melalui CV Wafi Jaya
                                    Group.</p>
                                <p class="lead mb-0">Jelajahi berbagai posisi yang tersedia dan daftarkan dirimu untuk
                                    menjadi bagian dari kami.</p>
                            </div>

                            <a href="#" class="btn btn-primary">Telusuri Karir</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--hero end-->

    <!--Project we done start-->
    <section class="my-xl-9 my-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="text-center mb-xl-7 mb-5" data-cue="fadeIn">
                        <h2 class="my-3">Temukan Karir yang Tepat, dengan Cepat</h2>
                        <p class="mb-0">Wafi Jaya Group menawarkan berbagai peluang yang sesuai dengan keterampilan dan
                            ambisi Kamu. Daftar hari ini dan ambil langkah berikutnya menuju karir Impian. Masa depan Anda
                            dimulai di sini.</p>
                    </div>
                </div>
            </div>
            <div class="table-responsive-lg">
                <div class="row  pb-4 pb-lg-0  me-lg-0 justify-content-center">
                    <div class="col-lg-4 col-md-6 col-12 d-flex mb-4 mb-md-0">
                        <img src="{{ asset('img/image1.png') }}" alt="portfolio-2"
                            class="img-fluid rounded-3 align-self-stretch">
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 d-flex flex-column">
                        <h2 class="text-center mb-4">Apa yang Wafi Jaya Group Tawarkan?</h2>
                        <div class="card w-100 d-flex align-items-stretch">
                            <div class="card-body">
                                <div id="carouselText" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="slider-text row">
                                                <h3 class="my-2">1. Membangun Skill secara Profesional dengan Metode
                                                    Terbaik</h3>
                                                <p>Kami percaya bahwa pengembangan keterampilan adalah investasi jangka
                                                    panjang. CV Wafi Jaya Group menyediakan pelatihan dan pendampingan yang
                                                    tepat guna membantu setiap individu tumbuh secara profesional di
                                                    lingkungan kerja yang mendukung.</p>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="slider-text row">
                                                <h3 class="my-2">2. Upah yang Proporsional</h3>
                                                <p>Kami memberikan kompensasi yang adil dan sesuai dengan kontribusi serta
                                                    tanggung jawab setiap posisi. Kesejahteraan karyawan menjadi prioritas
                                                    utama dalam membangun semangat kerja yang optimal.</p>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="slider-text row">
                                                <h3 class="my-2">3. Kualitas dan Pelayanan yang Unggul dan Tersistem</h3>
                                                <p>Dengan sistem kerja yang terorganisir dan berbasis teknologi, kami
                                                    memastikan seluruh proses kerja berjalan efisien, tepat waktu, dan
                                                    selalu mengutamakan kualitas serta kepuasan klien.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Unit Bisnis Start-->
    <section class="my-xl-9 my-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3" data-cue="fadeIn">
                    <div class="text-center mb-xl-7 mb-5">
                        <h2 class="h1 mb-3">Gabung Bersama CV Wafi Jaya Group</h2>
                        <p class="mb-0">Wafi Jaya Group telah membantu lebih dari  unit bisnis
                            dengan total 10cabang,
                            dan 10 Karyawan yang telah bergabung pada kami.</p>
                    </div>
                </div>
            </div>

            <style>
                .line {
                    width: 80%;
                    height: 2px;
                    background-color: #D9D9D9;
                    margin: 4px auto;
                }

                .logo-size {
                    width: auto;
                    height: 150px;
                }
            </style>

            <!-- Card -->
            <div class="table-responsive-lg">
                <div class="row g-5 justify-content-center">
                    <!-- Card Loop -->

                        <div class="col-lg-4 col-md-6 col-11 mb-4">
                            <div class="card shadow-lg rounded-3 border-0 d-flex flex-column" style="height: 100%">
                                <!-- Card Body with Logo -->
                                <div class="card-body text-center">
                                    <img src="#" alt="portfolio-2"
                                        class="img-fluid logo-size rounded-3 mb-3"
                                        style="max-height: 150px; object-fit: contain;">
                                    <h4 class="card-title">Test</h4>
                                    <div class="line"></div>
                                </div>

                                <!-- Stats Section -->
                                <div class="card-body p-0 mb-4 flex-grow-1">
                                    <div class="row text-center g-3">
                                        <!-- First Item -->
                                        <div class="col-6">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="bi bi-list-ul fs-2 text-muted"></i>
                                                <h5 class="mb-0">10 Cabang</h5>
                                            </div>
                                        </div>

                                        <!-- Second Item -->
                                        <div class="col-6">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="bi bi-person fs-2 text-muted"></i>
                                                <h5 class="mb-0">10 Karyawan</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>

        </div>
    </section>


    <!---Unit Bisnis end-->
@endsection
