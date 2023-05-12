<!Doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Utama PDAM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="/resources/css/user.css" rel="stylesheet">
</head>
<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-smooth-scroll="true" tabindex="0">
<nav id="navbar" class="navbar navbar-expand-lg fixed-top bg-light shadow">
    <div class="container px-4">
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
                    <a class="nav-link" href="/pengaduan">Pengaduan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/tanggapan">Tanggapan</a>
                </li>
            </ul>
            <div class="d-flex">
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                        <i class="far fa-user-circle fs-6 pe-1"></i>
                        {{-- {{ auth()->user()->name }} --}}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li><a class="dropdown-item" href="profil-admin.php">Profil</a></li>
                        <li><a class="dropdown-item" href="ubah-password-admin.php">Ubah Kata Sandi</a></li>
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
            </div>
        </div>
    </div>
</nav>

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
                    <a href="#lapor" role="button" class="btn btn-outline-dark btn-lg px-4">Lapor</a>
                </div>
            </div>
        </div>
    </div>
    <img src="{{ asset('img/wave.svg') }}" alt="Wave">
</div>

<div id="#" class="container px-4 py-3">
    <div class="row flex-lg-row align-items-center">
        <div class="col-10 col-sm-8 col-lg-6">
            <img src="{{ asset('img/undraw_Profile_re_4a55.png') }}" class="d-block mx-lg-auto img-fluid" alt="Data Reports"
                 loading="lazy">
        </div>
        <div class="col-lg-6">
            <h1 class="display-5 fw-bold mb-4">Tentang Website Keluhan Pelanggan PDAM</h1>
            <div class="mx-auto">
                <p class="lead mb-4">Pengelolaan pengaduan pelayanan publik mengenai PDAM di Kota ini belum terkelola secara
                    efektif dan terintegrasi. Masyarakat Kota masih sulit dalam menyampaikan pengaduan atau
                    aspirasinya. Dengan adanya website ini Masyarakat Kota dengan mudah dapat menyalurkan aduannya
                    atau aspirasinya dengan menggunakan website ini.</p>
            </div>
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
<script src="js/script.js"></script>
<?php if (isset($_SESSION["alertMasuk"])) { ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil masuk',
            timer: 5000
        })
    </script>';
    <?php unset($_SESSION["alertMasuk"]);
} ?>
</body>
</html>