@extends('admin.layout')

@section('content')
<div class="container mt-lg mt-5">
    <div class="row mt-2">
        <h4 class="mt-5 mb-3">Daftar Kegiatan</h4>
        <a href="{{ url('/admin/tambah_kegiatan') }}" class="btn btn-primary mb-3">Tambah Kegiatan</a>
{{--        @foreach($admins as $admin)--}}
{{--            <div class="col-md-4 mb-3">--}}
{{--                <div class="card text-bg-light">--}}
{{--                    <div class="card-body">--}}
{{--                        <h5 class="card-title">{{ $admin->name }}</h5>--}}
{{--                        <p class="card-text">{{ $admin->email }}</p>--}}
{{--                    </div>--}}
{{--                    <ul class="list-group list-group-flush">--}}
{{--                        <li class="list-group-item">--}}
{{--                            <span class="icon-neat me-2">--}}
{{--                                <i class="fas fa-calendar"></i>--}}
{{--                            </span>--}}
{{--                            {{ $admin->tanggal_lahir }}--}}
{{--                        </li>--}}
{{--                        <li class="list-group-item">--}}
{{--                            <span class="icon-neat me-2">--}}
{{--                                <i class="fas fa-venus"></i>--}}
{{--                            </span>--}}
{{--                            {{ ($admin->jenis_kelamin == 'L') ? 'Laki-laki' : 'Perempuan' }}--}}
{{--                        </li>--}}
{{--                        <li class="list-group-item">--}}
{{--                            <span class="icon-neat me-2">--}}
{{--                                <i class="fas fa-reply"></i>--}}
{{--                            </span>--}}
{{--                            {{ ($admin->role == '1') ? 'Admin' : 'Petugas' }}--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                    <div class="card-body">--}}
{{--                        <a class="btn btn-dark" href="{{ url('admin/'.$admin->id.'/edit_user') }}">Ubah</a>--}}
{{--                        <form method="post" action="{{ url('/admin/delete_user/' . $admin->id) }}" class="d-inline-block">--}}
{{--                            @csrf--}}
{{--                            <button type="submit" class="btn btn-danger">Hapus</button>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endforeach--}}
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
