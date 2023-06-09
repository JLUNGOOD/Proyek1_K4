@extends('user.layout')

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
@endpush

@section('content')
    <div class="bg-aqua">
        <div class="container px-4 py-5 h-100vh d-flex">
            <div class="row flex-lg-row-reverse align-items-center">
                <div class="col-10 col-sm-8 col-lg-6 mx-auto">
                    <img src="{{ asset('img/undraw_Online_test_re_kyfx.png') }}" class="img-fluid" alt="Data Reports"
                         loading="lazy">
                </div>
                <div class="col-lg-6 mt-3">
                    <h1 class="display-5 fw-bold mb-4">Layanan Aspirasi dan Pengaduan Online PDAM Masyarakat Kota</h1>
                    <div class="d-md-flex">
                        <a href="#tentang" role="button" class="btn btn-dark btn-lg px-4 me-md-2">Jelajahi<i
                                class="fas fa-chevron-down ms-2 fs-6"></i></a>
                        <a href="{{ url('buat_pengaduan') }}" role="button" class="btn btn-outline-dark btn-lg px-4">Lapor</a>
                    </div>
                </div>
            </div>
        </div>
        <img src="{{ asset('img/wave.svg') }}" alt="Wave">
    </div>

    <div id="tentang" class="container px-4 pb-3">
        <div class="row flex-lg-row align-items-center pt-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="{{ asset('img/undraw_Profile_re_4a55.png') }}" class="d-block mx-lg-auto img-fluid"
                     alt="Data Reports"
                     loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold mb-4">Tentang Website Keluhan Pelanggan PDAM</h1>
                <div class="mx-auto">
                    <p class="lead mb-4">Pengelolaan pengaduan pelayanan publik mengenai PDAM di Kota ini belum
                        terkelola secara efektif dan terintegrasi. Masyarakat Kota masih sulit dalam menyampaikan
                        pengaduan atau aspirasinya. Dengan adanya website ini Masyarakat Kota dengan mudah dapat
                        menyalurkan aduannya atau aspirasinya dengan menggunakan website ini.</p>
                </div>
            </div>
        </div>
    </div>

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#82C3EC" fill-opacity="1"
              d="M0,96L30,128C60,160,120,224,180,245.3C240,267,300,245,360,224C420,203,480,181,540,181.3C600,181,660,203,720,213.3C780,224,840,224,900,202.7C960,181,1020,139,1080,138.7C1140,139,1200,181,1260,181.3C1320,181,1380,139,1410,117.3L1440,96L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z"></path>
    </svg>

    <section id="kegiatan" class="pt-md-5 bg-aqua">

        <h1 class="display-5 text-center fw-bold py-4">Kegiatan</h1>
        <div class="py-4 container overflow-hidden">
            <div class="swiper">
                <div class="swiper-wrapper mb-3">
                    @foreach($kegiatans as $kegiatan)
                        <div class="swiper-slide">
                            <a href="{{ url('/kegiatan/' . $kegiatan->slug) }}" class="card activity shadow card-has-bg"
                               style="background-image:url('{{ $kegiatan->foto_kegiatan ? asset('storage/foto_kegiatan/' . $kegiatan->foto_kegiatan) : asset('/img/no-img-available.png') }}');">
                                <div class="card-img-overlay d-flex flex-column">
                                    <div class="card-body text-white">
                                        <small class="text-aqua mb-2">Kegiatan</small>
                                        <h5 class="card-title mt-0 ">{{ $kegiatan->judul_kegiatan }}</h5>
                                        <small><i
                                                class="far fa-clock me-2"></i>{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->format('d M Y') }}
                                        </small>
                                    </div>
                                    <div class="card-footer text-white">
                                        <h6 class="my-0 text-white d-block">{{ $kegiatan->user->name }}</h6>
                                        <small>{{ $kegiatan->user->email }}</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    <div class="swiper-slide">
                        <a href="{{ url('kegiatan') }}" class="card activity shadow card-has-bg">
                            <div class="card-img-overlay d-flex flex-column">
                                <div
                                    class="card-body text-white d-flex justify-content-center align-items-center flex-column">
                                    <h3 class="card-title mt-0 mb-4">Semua Kegiatan</h3>
                                    <i class="fs-1 rounded-circle p-4 border border-4 border-white fas fa-arrow-right">
                                    </i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.desc').matchHeight();
        });

        const swiper = new Swiper('.swiper', {
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                100: {
                    slidesPerView: 1,
                    spaceBetween: 10
                },
                280: {
                    slidesPerView: 1.2,
                    spaceBetween: 20
                },
                484: {
                    slidesPerView: 1.5,
                    spaceBetween: 20
                },
                768: {
                    slidesPerView: 2.2,
                    spaceBetween: 20
                },
                1000: {
                    slidesPerView: 4,
                    spaceBetween: 20
                },
            },
        });
    </script>
@endpush
