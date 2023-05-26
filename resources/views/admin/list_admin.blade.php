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
                        <input type="hidden" class="delete_id" value="{{ $admin->id }}">
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
                        <a class="btn btn-dark" href="{{ url('admin/'.$admin->id.'/edit_user') }}">Ubah</a>
                        <form method="post" action="{{ url('/admin/delete_user/' . $admin->id) }}" class="d-inline-block">
                            @csrf
                            <a data-bs-target="#pilihan" data-bs-toggle="modal" class="btn btn-danger" onclick="setDeleteId({{ $admin->id }})">Hapus</a>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" data-bs-backdrop="static"data-bs-keyboard="false" aria-hidden="true" id="pilihan">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content rounded-3 shadow">
            <div class="modal-body p-4 text-center">
                <h5 class="mb-3">Apakah Anda yakin ingin menghapus User ini?</h5>
                <p class="mb-0">Tindakan ini tidak dapat dibatalkan dan akan menghapus semua data user tersebut. Anda yakin?</p>
            </div>
            <div class="modal-footer flex-nowrap p-0">
                <button type="submit" onclick="deleteUser()" class="btn btn-lg btn-link fs-6 text-danger text-decoration-none col-6 py-3 m-0 rounded-0 border-end"><strong>Ya, hapus</strong></button>
                <button type="button" class="btn btn-lg btn-link fs-6 text-dark text-decoration-none col-6 py-3 m-0 rounded-0" data-bs-dismiss="modal">Batal</button>  
            </div>
        </div>
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
<script>
    let delete_id;
    function setDeleteId(id) {
        delete_id = id;
    }
    function deleteUser() {
        $.ajax({
            url: window.location.origin + '/admin/delete_user_api/',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: delete_id
            },
            success: function (response) {
                window.location.reload();
            }
        })
    }
</script>
@endsection

@if(session()->has('message'))
    @push('script')
        <script>
            Swal.fire({
                icon: 'success',
                title: "{{ session('message') }}",
                timer: 5000
            })
        </script>
    @endpush
@endif
