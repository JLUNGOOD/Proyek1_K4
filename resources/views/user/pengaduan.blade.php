<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="/resources/css/user.css" rel="stylesheet">
    <title>Pengaduan Layanan</title>
</head>
<body>
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
                    <ul class="navbar-nav">
                        <li class="nav-item">
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
        </nav>  

<div id="lapor" class="container px-4 py-5">
    <div class="shadow-lg p-3 mb-5 bg-body rounded">
        <h1 class="display-5 my-4 fw-bold text-center">Sampaikan Laporan Anda</h1>
        <form enctype="multipart/form-data" action="#lapor" method="post" name="formLaporan">
            <div class="mb-3">
                <label for="klarifikasiLaporan" class="form-label fw-bold">Klarifikasi Laporan</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="klarifikasi" id="pengaduan"
                           value="pengaduan"
                           checked>
                    <label class="form-check-label" for="pengaduan">
                        Pengaduan
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="klarifikasi" id="aspirasi"
                           value="aspirasi">
                    <label class="form-check-label" for="aspirasi">
                        Aspirasi
                    </label>
                </div>
            </div>
            <div class="mb-3">
                <label for="judul" class="form-label fw-bold">Judul Laporan</label>
                <input class="form-control" name="judul" id="judul" aria-describedby="judul"
                       placeholder="Ketik Judul Laporan Anda *" required>
            </div>
            <div class="mb-3">
                <label for="isi" class="form-label fw-bold">Isi Laporan</label>
                <textarea class="form-control" name="isi" id="isi" rows="3"
                          placeholder="Ketik Isi Laporan Anda *" required></textarea>
            </div>
            <div class="isComplaint">
                <div class="mb-3">
                    <label for="gambar" class="form-label fw-bold">Unggah Bukti Gambar</label>
                    <input type="file" class="form-control" name="bukti_gambar" id="gambar"
                           aria-describedby="gambar">
                </div>
                <div class="mb-3">
                    <label for="lokasi" class="form-label fw-bold">Lokasi Kejadian</label>
                    <input class="form-control" name="lokasi" id="lokasi" aria-describedby="lokasiKejadian"
                           placeholder="Ketik Lokasi Kejadian">
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label fw-bold">Tanggal Kejadian</label>
                    <input type="date" class="form-control" name="tanggal" id="tanggal" value=""
                           aria-describedby="tanggalKejadian">
                </div>
            </div>
            <button type="submit" name="lapor" class="btn btn-dark d-block mb-4">LAPOR</button>
        </form>
    </div>
</div>

</div>
</body>
</html>