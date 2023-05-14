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
<nav id="navbar" class="navbar navbar-expand-lg fixed-top bg-light shadow">
    <div class="container">
        <span class="navbar-brand fw-bold">PDAM Kota</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/pengaduan')}}">Pengaduan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/tanggapan')}}">Tanggapan</a>
                </li>
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
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#keluar">
                                        <i class="fas fa-sign-out-alt pe-1"></i>Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a class="btn btn-sm btn-outline-dark" role="button" href="{{ url('login') }}">Log in</a>
                    <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#daftar">
                        Sign In
                    </button>
                @endauth
            </div>
        </div>
    </div>
</nav>

@yield('content')

<footer class="bg-dark text-white pt-5 pb-4">
    <div class="container text-center text-md-left">
        <div class="row gy-3">
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning">PDAM Kota Malang</h5>
                <p>Sedikit informasi tentang kami. Terimakasih</p>
            </div>
            
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Useful Links</h5>
                <p><a href="#" class="text-white" style="text-decoration: none;">Pengaduan</a></p>
                <p><a href="#" class="text-white" style="text-decoration: none;">Tanggapan</a></p>
            </div>
            
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Contact Us</h5>
                <p><i class="fas fa-home mr-3">Jl. Terusan Danau Sentani No.100, Madyopuro, Kec. Kedungkandang, Kota Malang</i></p>
                <p><i class="fas fa-envelope mr-3">pdam@gmail.com</i></p>
                <p><i class="fas fa-phone mr-3">0816550800</i></p>
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
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{--<script>--}}
{{--    Swal.fire({--}}
{{--        icon: 'success',--}}
{{--        title: 'Berhasil masuk',--}}
{{--        timer: 5000--}}
{{--    })--}}
{{--</script>--}}
@stack('script')
</body>
</html>
