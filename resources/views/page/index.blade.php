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
                                <h1 class="mb-3 mt-3 display-3 text-white-stable">E-Learning</h1>
                                <p class="lead mb-0">Selamat datang di platform E-Learning kami, tempat terbaik untuk
                                    memperluas pengetahuan dan keterampilan Anda.</p>
                                <p class="lead mb-0">Jelajahi berbagai kursus, pelajari materi terbaru, dan tingkatkan
                                    kemampuan Anda dengan pembelajaran interaktif.</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--hero end-->


    <!---Unit Bisnis end-->
@endsection
