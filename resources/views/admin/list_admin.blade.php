@extends('admin.layout')

@section('content')
<div class="container mt-lg mt-5">
    <div class="row mt-2">
        <?php //if (isset($_SESSION["hapus"])) {
//            $id = isset($_SESSION["hapus"]);
//            if (hapus($id) > 0) {
//                echo
//                '<div class="alert alert-success alert-dismissible fade show" role="alert">
//                            <strong>Berhasil mengubah data admin!</strong>
//                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
//                            </button>
//                        </div>';
//            } else {
//                echo
//                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
//                            <strong>Gagal mengubah data admin!</strong> Pastikan semuanya terisi dengan benar.
//                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
//                        </div>';
//            }
//        } ?><!---->
        <h4 class="mt-5 mb-3">Daftar Admin & Petugas</h4>
        <a href="{{ url('/admin/tambah_admin') }}" class="btn btn-primary mb-3">Tambah Admin</a>
        @foreach($admins as $admin)
            <div class="col-md-4 mb-3">
                <div class="card text-bg-light">
                    <div class="card-body">
                        <h5 class="card-title">{{ $admin->name }}</h5>
                        <p class="card-text">{{ $admin->email }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <span class="icon-neat me-2">
                                <i class="fas fa-calendar"></i>
                            </span>
                            {{ $admin->tanggal_lahir }}
                        </li>
                        <li class="list-group-item">
                            <span class="icon-neat me-2">
                                <i class="fas fa-venus"></i>
                            </span>
                            {{ ($admin->jenis_kelamin == 'L') ? 'Laki-laki' : 'Perempuan' }}
                        </li>
                        <li class="list-group-item">
                            <span class="icon-neat me-2">
                                <i class="fas fa-reply"></i>
                            </span>
                            {{ ($admin->role == '1') ? 'Admin' : 'Petugas' }}
                        </li>
                    </ul>
                    <div class="card-body">
                        <a href="" class="btn btn-dark">Ubah</a>
                        <a href="" class="btn btn-danger">Hapus</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="modal fade" id="keluar" tabindex="-1" aria-labelledby="keluar" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Yakin untuk keluar?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Anda tidak bisa mengirim laporan jika keluar.
            </div>
            <div class="modal-footer">
                <a href="keluar-admin.php" role="button" class="btn btn-dark">Keluar</a>
            </div>
        </div>
    </div>
</div>
@endsection
