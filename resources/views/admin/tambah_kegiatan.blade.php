@extends('admin.layout')

@push('css')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
@endpush

@section('content')
    <div class="container my-5 pt-5">
        <h1 class="display-6 mb-4 fw-bold text-center">Tambah Kegiatan</h1>
        <form>
            <div class="mb-3">
                <label for="judul_kegiatan" class="form-label fw-bold">Judul Kegiatan</label>
                <input class="form-control @error('judul_kegiatan') is-invalid @enderror" name="judul_kegiatan"
                       id="judul_kegiatan" placeholder="Masukkan Judul Kegiatan *"
                       value="{{ old('judul_kegiatan') ?? '' }}">
                @error('judul')
                <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="foto_kegiatan" class="form-label fw-bold">Foto Kegiatan</label>
                <div>
                    <a class="image-popup d-inline-block" href="{{ asset('/img/no-img-available.png') }}"><img
                            src="{{ asset('/img/no-img-available.png') }}"
                            class="img-preview d-block rounded border mb-2" alt="Image Preview">
                    </a>
                </div>
                <input type="file" class="form-control @error('bukti_gambar') is-invalid @enderror"
                       name="foto_kegiatan" id="foto_kegiatan" value="{{ old('foto_kegiatan') }}">
                <div class="form-text">Ukuran file maksimum 5 MB</div>
                @error('foto_kegiatan')
                <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="isi_kegiatan" class="form-label fw-bold">Isi Kegiatan</label>
                <input id="isi_kegiatan" value="Masukkan Isi Kegiatan" type="hidden" name="content">
                <trix-editor input="isi_kegiatan"></trix-editor>
            </div>
            <div class="mb-3">
                <label for="tanggal_kegiatan" class="form-label fw-bold">Tanggal Kegiatan</label>
                <input type="date" class="form-control @error('tanggal_kegiatan') is-invalid @enderror"
                       name="tanggal_kegiatan" id="tanggal_kegiatan" value="{{ old('tanggal_kegiatan') }}">
                @error('tanggal_kegiatan')
                <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>

            <button type="button" class="btn btn-dark d-block mb-4" data-bs-toggle="modal"
                    data-bs-target="#modalChoice">KIRIM
            </button>
        </form>
    </div>
@endsection

@push('script')
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
@endpush
