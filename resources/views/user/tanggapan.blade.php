<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="/resources/css/user.css" rel="stylesheet">
    <title>Tanggapan</title>
</head>
<body>
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

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                </div>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="card">
                <div class="card-header">
                    <h2>Daftar Tanggapan</h2>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Judul Aduan</th>
                                <th>Isi Aduan</th>
                                <th>Pelapor</th>
                                <th>Tanggapan</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if ($tanggapan->count() > 0)
                                @foreach ($tanggapan as $i => $t)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{$t->pengaduan->judul}}</td>
                                        <td>{{$t->pengaduan->isi}}</td>
                                        <td>{{$t->users->name}}</td>
                                        <td>{{$b->isi_tanggapan}}</td>
                                    </tr>
                                @endforeach
                
                            @else
                                <tr><td colspan="6" class="text-center">Data tidak ada</td></tr>
                            @endif
                            </tbody>
                    </table>
                <div class="card-body">
                  
                </div>
                <!-- /.card-body -->
                <!-- /.card-footer-->
              </div>

        </section>
        <!-- /.content -->
    </div>
</body>
</html>