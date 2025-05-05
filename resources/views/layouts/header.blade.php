<header>
    <nav class="navbar navbar-expand-lg transparent navbar-transparent navbar-light navbar-clone fixed navbar-stick">
        <div class="container px-3">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="{{ asset('img/logo.png') }}" alt="" style="max-height: 30px;">
                <span class="ms-2">E-Learning</span>
            </a>
            <button class="navbar-toggler offcanvas-nav-btn" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvas">
                <i class="bi bi-list"></i>
            </button>
            <div class="offcanvas offcanvas-start offcanvas-nav" style="width: 20rem" tabindex="-1" id="offcanvas"
                aria-labelledby="offcanvasLabel">
                <div class="offcanvas-header">
                    <a href="./index.html" class="text-inverse"><img style="max-height: 30px"
                            src="{{ asset('img/logo.png') }}" alt=""></a>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body pt-0 align-items-center">
                    <ul class="navbar-nav mx-auto align-items-lg-center">

                        <li class="nav-item"><a class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                                href="{{ url('/') }}">Beranda</a></li>
                        @auth
                            {{-- <li class="nav-item"><a class="nav-link {{ Request::is('riwayat*') ? 'active' : '' }}"
                                    href="{{ route('lowongan.riwayat', auth()->user()->id) }}">Riwayat Lamaran</a></li> --}}
                        @endauth


                        @guest
                            <li class="nav-item"><a class="btn btn-primary mx-2" style="padding: 8px 25px"
                                    href="{{ url('admin') }}">Login</a></li>
                        @endguest
                        @auth
                            <li><a class="btn btn-primary mx-auto" style="padding: 8px 25px" href="#"
                                    id="logout-btn"><i class="fa fa-sign-out"></i> Logout</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
@auth
    <script>
        document.getElementById('logout-btn').addEventListener('click', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Kamu akan Keluar!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Keluar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            })
        });
    </script>
@endauth
