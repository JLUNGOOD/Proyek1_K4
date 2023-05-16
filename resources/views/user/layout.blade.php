<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Utama PDAM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="{{ url('/css/user.css') }}" rel="stylesheet">
    @stack('css')
</head>
<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-smooth-scroll="true" tabindex="0">
@if(session('login_success'))
    <div class="modal fade" tabindex="-1" role="dialog" data-bs-keyboard="false" aria-hidden="true"
         id="modalLoginSuccess">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-3 shadow d-flex">
                <div class="modal-header border-bottom-0">
                    <h1 class="modal-title fs-5">Selamat datang! berhasil login.</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-0">
                    <p>Anda dapat mulai membuat pengaduan baru atau melihat status pengaduan Anda.</p>
                </div>
                <div class="modal-footer flex-column border-top-0">
                    <button type="button" class="btn btn-dark w-100" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endif

<nav id="navbar" class="navbar navbar-expand-lg fixed-top bg-light shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">PDAM Kota</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ url('') == url()->current() ? 'active' : '' }}" href="/">Home</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ url('buat_pengaduan') == url()->current() ? 'active' : '' }}"
                           href="/buat_pengaduan">Buat Pengaduan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ url('pengaduan_saya') == url()->current() ? 'active' : '' }}"
                           href="/pengaduan_saya">Pengaduan Saya</a>
                    </li>
                @endauth
            </ul>
            <div class="d-flex gap-3 navbar-nav my-2">
                @auth
                    <div class="dropdown">
                        <button class="btn dropdown-toggle d-block w-100" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                            <i class="far fa-user-circle fs-6 pe-1"></i>
                            {{ auth()->user()->name }}
                        </button>
                        <ul class="dropdown-menu shadow">
                            <li><a class="dropdown-item" href="profil-user.php">Ubah Profil</a></li>
                            <li><a class="dropdown-item" href="ubah-password-user.php">Ubah Kata Sandi</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#modalLogout">
                                    <i class="fas fa-sign-out-alt pe-1"></i>Keluar
                                </button>
                            </li>
                        </ul>
                    </div>
                @else
                    <a class="btn btn-sm btn-outline-dark" href="{{ url('login') }}">Log in</a>
                    <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#daftar">
                        Sign In
                    </button>
                @endauth
            </div>
        </div>
    </div>
</nav>

@yield('content')

@auth()
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <div class="modal fade" tabindex="-1" role="dialog" data-bs-keyboard="false" aria-hidden="true"
             id="modalLogout">
            <div class="modal-dialog" role="document">
                <div class="modal-content rounded-3 shadow">
                    <div class="modal-body p-4 text-center">
                        <h5 class="mb-3">Apakah Anda yakin ingin keluar?</h5>
                        <p class="mb-0">
                            Jika keluar, Anda tidak dapat mengakses fitur-fitur pengaduan, termasuk melihat status
                            pengaduan atau membuat pengaduan baru.
                        </p>
                    </div>
                    <div class="modal-footer flex-nowrap p-0">
                        <button type="submit"
                                class="btn btn-lg btn-link fs-6 text-dark text-decoration-none col-6 py-3 m-0 rounded-0 border-end"
                                data-bs-dismiss="modal"><strong>Ya, keluar</strong></button>
                        <button type="button"
                                class="btn btn-lg btn-link fs-6 text-dark text-decoration-none col-6 py-3 m-0 rounded-0"
                                data-bs-dismiss="modal">Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endauth

<footer class="bg-dark text-white pt-5 pb-4">
    <div class="container text-center text-md-left">
        <div class="row gy-3">
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning">PDAM Kota Malang</h5>
                <p>Memberikan pelayanan terbaik bagi masyarakat dengan sepenuh hati</p>
            </div>
            
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Useful Links</h5>
                <p><a href="#" class="text-white" style="text-decoration: none;">Pengaduan</a></p>
                <p><a href="#" class="text-white" style="text-decoration: none;">Tanggapan</a></p>
                <p><a href="#" class="text-white" style="text-decoration: none;">Informasi</a></p>
            </div>
            
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Contact Us</h5>
                <p><a class="text-white" href="https://goo.gl/maps/gqAHo2FVEK7ENg8C6"> JL. A Yani, No 53-55, Purwantoro, Kec. Blimbing, Kota Malang, Jawa Timur 65125</a></p>
                <p><a class="text-white" href="http://alwanalawi1@gmail.com"><i class="fas fa-envelope mr-3">pdam@gmail.com</i></a></p>
                <p><a class="text-white" href="https://wa.me/6285257146203"><i class="fas fa-phone mr-3">081244305712</i></a></p>
            </div>
        </div>

        <hr class="mb-4">

        <div class="row align-items-center">

            <div class="col-md-7 col-lg-8" style="margin-left: -100px">
                <p>Copyright 2022. All rights reserved by:
                    <a href="#" style="text-decoration: none;">
                        <strong class="text-warning">Kelompok 4</strong>
                    </a>
                </p>
            </div>

        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/51ab965bab.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
{{--<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>--}}
<script>
    $(document).ready(function () {
        @if(session('login_success'))
        $('#modalLoginSuccess').modal('show');
        @endif
    });
</script>

@stack('script')
</body>
</html>
