<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon icon-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/logo.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/logo.png') }}">
    <meta name="msapplication-TileColor" content="#FB4700">
    <meta name="msapplication-config" content="./assets/images/favicon/tile.xml">

    <!-- Color modes -->
    <script src="{{ asset('assets_new/js/color-modes.js') }}"></script>

    <!-- Libs CSS -->
    <link href="{{ asset('assets_new/css/simplebar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_new/css/bootstrap-icons.min.css') }}" rel="stylesheet">

    <!-- Scroll Cue -->
    <link rel="stylesheet" href="{{ asset('assets_new/css/scrollCue.css') }}">

    <!-- Box icons -->
    <link rel="stylesheet" href="{{ asset('assets_new/css/boxicons.min.css') }}">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('assets_new/css/theme.min.css') }}">
    <!-- Add Font Awesome CDN link for the icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">

    <!-- Add SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Add SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <title>E-Learning</title>
</head>

<body>
    <!-- Navbar -->
    @include('layouts.header')

    <main>
        @if (!Request::is('/'))
            {{-- <div class="pattern-square py-8"></div> --}}
        @endif
        <!--hero start-->
        <style>
            .line {
                width: 30%;
                height: 4px;
                background-color: #D9D9D9;
                margin: auto;
            }
        </style>
        @php
            if (isset($subtitle) || isset($subtitle_primary) || Request::is('/')) {
                $notitle = false;
            } else {
                $notitle = true;
            }
        @endphp
        @if (isset($subtitle))
            <section class="jarallax py-4 mb-4 hero-agency" data-jarallax="" data-speed="0.4" style="min-height: 40vh;">
                <img class="jarallax-img" src="{{ asset('img/effective-meeting-blog 2.png') }}" alt="agency"
                    style="filter: brightness(50%);">
                <div class="position-absolute start-0 end-0">
                    <div class="container">
                        <div class="row">
                            <div class="col-12" data-cue="zoomIn">
                                <div class="text-center text-lg-start">
                                    <div class="mb-4 text-white-stable">
                                        <h1 class="mb-3 mt-3 display-3 text-white-stable text-center">
                                            {{ $subtitle }}
                                        </h1>

                                        @if (isset($subtitle_deskripsi))
                                            <div class="line mb-3  "></div>
                                            <p class="text-center ">{{ $subtitle_deskripsi }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        @if ($notitle)
            <section class="jarallax py-4 mb-4 hero-agency" data-jarallax="" data-speed="0.4" style="min-height:10vh;">

                <div class="position-absolute start-0 end-0">

                </div>
            </section>
        @endif
        @if (isset($subtitle_primary))
            <section class="jarallax py-4 hero-agency" data-jarallax="" data-speed="0.4"
                style="min-height: 30vh; background-color: #FB4700; ">
                <div class="position-absolute start-0 end-0">
                    <div class="container">
                        <div class="row">
                            <div class="col-12" data-cue="zoomIn">
                                <div class="text-center text-lg-start">
                                    <div class="text-white-stable">
                                        <h3 class="mb-3 mt-3 display-3 text-white-stable">{{ $subtitle_primary }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible " role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible " role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <!-- Display validation errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        @yield('content')
    </main>
    <footer class="pt-7">
        <div class="container">
            <!-- Footer 4 column -->
            <div class="row">
                <div class="col-lg-9 col-12 mb-4">
                    <div class="row" id="ft-links">
                        <div class="row">
                            <!-- Gambar pertama di baris pertama -->
                            <div class="col-12 d-flex justify-content-start mb-3">
                                <a class="navbar-brand" href="/">
                                    <img style="max-height: 60px" src="{{ asset('img/logo.png') }}" alt="">
                                </a>

                            </div>
                        </div>

                        <div class="row">
                            <h3>E-Learning</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-12 mb-4">
                    <div class="me-7">
                        <h4 class="mb-4 text-center">Temukan kami di:</h4>
                        <div class="text-center">
                            <a href="#" class="btn btn-light m-2">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="btn btn-light m-2">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="#" class="btn btn-light m-2">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-2 pt-lg-4 pb-4">
            <div class="row align-items-center">
                <div class="col-md-3">

                </div>
                <div class="col-md-9 col-lg-6">
                    <div class="small mb-3 mb-lg-0 text-lg-center">
                        Copyright © 2025 E-Learning
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="text-lg-end d-flex align-items-center justify-content-lg-end">
                        <div class="dropdown">
                            <button class="btn btn-light btn-icon rounded-circle d-flex align-items-center"
                                type="button" aria-expanded="false" data-bs-toggle="dropdown"
                                aria-label="Toggle theme (auto)">
                                <i class="bi theme-icon-active lh-1"><i class="bi theme-icon bi-sun-fill"></i></i>
                                <span class="visually-hidden bs-theme-text">Toggle theme</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bs-theme-text">
                                <li>
                                    <button type="button" class="dropdown-item d-flex align-items-center active"
                                        data-bs-theme-value="light" aria-pressed="true">
                                        <i class="bi theme-icon bi-sun-fill"></i>
                                        <span class="ms-2">Light</span>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item d-flex align-items-center"
                                        data-bs-theme-value="dark" aria-pressed="false">
                                        <i class="bi theme-icon bi-moon-stars-fill"></i>
                                        <span class="ms-2">Dark</span>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item d-flex align-items-center"
                                        data-bs-theme-value="auto" aria-pressed="false">
                                        <i class="bi theme-icon bi-circle-half"></i>
                                        <span class="ms-2">Auto</span>
                                    </button>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Scroll top -->
    <div class="btn-scroll-top">
        <svg class="progress-square svg-content" width="100%" height="100%" viewBox="0 0 40 40">
            <path
                d="M8 1H32C35.866 1 39 4.13401 39 8V32C39 35.866 35.866 39 32 39H8C4.13401 39 1 35.866 1 32V8C1 4.13401 4.13401 1 8 1Z">
            </path>
        </svg>
    </div>

    <!-- Libs JS -->
    <script src="{{ asset('assets_new/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets_new/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets_new/js/headhesive.min.js') }}"></script>

    <!-- Theme JS -->
    <script src="{{ asset('assets_new/js/theme.min.js') }}"></script>

    <script src="{{ asset('assets_new/js/jarallax.min.js') }}"></script>
    <script src="{{ asset('assets_new/js/jarallax.js') }}"></script>
    <script src="{{ asset('assets_new/js/scrollCue.min.js') }}"></script>
    <script src="{{ asset('assets_new/js/scrollcue.js') }}"></script>

    @yield(section: 'scripts')

</body>

</html>
