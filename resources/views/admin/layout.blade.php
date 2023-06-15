<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="{{ url('/css/main.css') }}" rel="stylesheet">
    @stack('css')
</head>
<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-smooth-scroll="true" tabindex="0">

<nav class="navbar fixed-top bg-light shadow">
    <div class="container px-4">
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar"
                aria-controls="sidebar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-flex">
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                    <i class="far fa-user-circle fs-6 pe-1"></i>
                    {{ auth()->user()->name }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li><a class="dropdown-item" {{ url('ubah_profil') == url()->current() ? 'active' : '' }}" href="{{ url('ubah_profil') }}">Ubah Profil</a></li>
                    <li><a class="dropdown-item" {{ url('ubah_password') == url()->current() ? 'active' : '' }}"
                        href="{{ url('ubah_password') }}">Ubah Kata Sandi</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <a type="submit" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#keluar">
                                <i class="fas fa-sign-out-alt pe-1"></i>Keluar
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <div class="offcanvas offcanvas-start d-flex flex-column flex-shrink-0 p-3 text-bg-dark" data-bs-scroll="true"
             tabindex="-1" id="sidebar" aria-labelledby="sidebarAdmin">
            <div class="d-flex align-items-center justify-content-between">
                <a href="{{ url('/') }}" class="fs-4 text-simple fw-bold">Lapor HomePage</a>
                <button class="btn btn-close btn-close-white" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#sidebar"
                        aria-controls="offcanvasWithBothOptions">
                </button>
            </div>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item mb-1">
                    <a href="{{ url('/admin') }}" class="nav-link active" aria-current="page">
                        <div class="icon-neat">
                            <i class="fas fa-tachometer-alt"></i>
                        </div>
                        Dashboard
                    </a>
                </li>
                @if(auth()->user()->role == '1')
                    <li class="nav-item mb-1">
                        <a href="{{ url('/admin/list_admin') }}" class="nav-link text-white" aria-current="page">
                            <div class="icon-neat">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            List Admin
                        </a>
                    </li>
                @endif
                <li class="nav-item mb-1">
                    <a class="nav-link text-white" href="{{ url('/admin/tanggapi') }}"
                       aria-expanded="false">
                        <div class="icon-neat">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        Tanggapi Laporan
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link text-white" href="{{ url('/admin/kegiatan') }}"
                       aria-expanded="false">
                        <div class="icon-neat">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        Kelola Kegiatan
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<footer class="bg-dark text-white pt-5 pb-4">
    <div class="container text-md-left">
        <div class="row gy-3">
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3 text-center">
                <h5 class="text-uppercase mb-4 font-weight-bold text-aqua">PDAM Kota Malang</h5>
                <p>Memberikan pelayanan terbaik bagi masyarakat dengan sepenuh hati,
                    Guna terciptanya kesejahteraan masyarakat dan kemajuan bangsa
                </p>
            </div>

            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3 text-center">
                <h5 class="text-uppercase mb-4 font-weight-bold text-aqua">Useful Links</h5>
                <p>
                    <a href="{{ url('/buat_pengaduan') }}" class="text-white text-decoration-none">Buat Pengaduan</a>
                </p>
                <p>
                    <a href="{{ url('/pengaduan_saya') }}" class="text-white text-decoration-none">Daftar Pengaduan</a>
                </p>
            </div>

            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3 text-center">
                <h5 class="text-uppercase mb-4 font-weight-bold text-aqua text-center">Contact Us</h5>
                <p>
                    <a href="https://goo.gl/maps/gqAHo2FVEK7ENg8C6"
                       class="text-white text-decoration-none d-flex align-items-center justify-content-center">
                        <i class="fas fa-location-arrow"></i>
                        <span class="ms-2">JL. A Yani, No 53-55, Purwantoro, Kec. Blimbing, Kota Malang 65125</span>
                    </a>
                </p>
                <p>
                    <a href="http://alwanalawi1@gmail.com"
                       class="text-white text-decoration-none d-flex align-items-center justify-content-center">
                        <i class="fas fa-envelope"></i>
                        <span class="ms-2">pdam@gmail.com</span>
                    </a>
                </p>
                <p>
                    <a href="https://wa.me/6285257146203"
                       class="text-white text-decoration-none d-flex align-items-center justify-content-center">
                        <i class="fas fa-phone"></i>
                        <span class="ms-2">081244305712</span>
                    </a>
                </p>
            </div>
        </div>

        <hr class="mb-4">

        <div class="row text-center">
            <p>Copyright 2022. All rights reserved by:
                <a href="" class="text-decoration-none fw-bold text-aqua">Kelompok 4</a>
            </p>
        </div>
    </div>
</footer>

<div class="modal fade" id="keluar" tabindex="-1" aria-labelledby="keluar" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Yakin untuk keluar?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Anda tidak bisa mengakses fitur admin jika anda logout.
            </div>
            <div class="modal-footer">
                <form action="{{ url('logout') }}" method="POST">
                    @csrf
                    <button type="submit" role="button" class="btn btn-dark">Keluar</button>
                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>

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
