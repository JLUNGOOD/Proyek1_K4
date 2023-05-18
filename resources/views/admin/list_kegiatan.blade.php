@extends('admin.layout')

@section('content')
    <div class="bg-white mt-lg shadow">
        <div class="container py-2">
            <h2 class="my-4">Daftar Kegiatan</h2>
            <a href="{{ url('/admin/tambah_kegiatan') }}" class="btn btn-dark mb-3">Tambah Kegiatan</a>
        </div>
    </div>
    <div class="container my-5">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach($kegiatans as $kegiatan)
                <div class="col">
                    <div class="kegiatan card shadow-sm">
                        <div class="h-225 rounded-top overflow-hidden">
                            <img class="object-fit-cover"
                                 src="{{ $kegiatan->foto_kegiatan ? asset('storage/foto_kegiatan/' . $kegiatan->foto_kegiatan) : asset('/img/no-img-available.png') }}">
                        </div>
                        <div class="card-body d-flex justify-content-between flex-column">
                            <p class="card-title fw-bold">{{ $kegiatan->judul_kegiatan }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-dark">Edtt
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger">Hapus
                                    </button>
                                </div>
                                <small class="text-body-secondary">{{ $kegiatan->daysRemaining }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js"></script>
    <script>
        $(document).ready(function() {
            $('.kegiatan').matchHeight();
        });
    </script>
@endpush
