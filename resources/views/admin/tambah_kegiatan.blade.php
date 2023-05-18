@extends('admin.layout')

@push('css')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
@endpush

@section('content')
    <div class="container my-5 pt-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-thumbs-up"></i> {{ session('success') }}</strong> Informasi kegiatan Anda sudah
                tersimpan.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h1 class="display-6 mb-4 fw-bold text-center">Tambah Kegiatan</h1>
        <form enctype="multipart/form-data" action="{{ route('admin.store-kegiatan') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="judul_kegiatan" class="form-label fw-bold">Judul Kegiatan</label>
                <input class="form-control @error('judul_kegiatan') is-invalid @enderror" name="judul_kegiatan"
                       id="judul_kegiatan" placeholder="Masukkan Judul Kegiatan *"
                       value="{{ old('judul_kegiatan') ?? '' }}">
                @error('judul_kegiatan')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="foto_kegiatan" class="form-label fw-bold">Foto Kegiatan</label>
                <div>
                    <a class="image-popup d-inline-block" href="{{ asset('/img/no-img-available.png') }}">
                        <img src="{{ asset('/img/no-img-available.png') }}"
                             class="img-preview d-block rounded border mb-2" alt="Image Preview">
                    </a>
                </div>
                <input type="file" class="form-control @error('foto_kegiatan') is-invalid @enderror"
                       name="foto_kegiatan" id="foto_kegiatan" value="{{ old('foto_kegiatan') }}">
                <div class="form-text">Ukuran file maksimum 5 MB</div>
                @error('foto_kegiatan')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="isi_kegiatan" class="form-label fw-bold">Isi Kegiatan</label>
                <input id="isi_kegiatan" type="hidden" name="isi_kegiatan" value="{{ old('isiF_kegiatan') }}">
                <trix-editor input="isi_kegiatan"></trix-editor>
                @error('isi_kegiatan')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tanggal_kegiatan" class="form-label fw-bold">Tanggal Kegiatan</label>
                <input type="date" class="form-control @error('tanggal_kegiatan') is-invalid @enderror"
                       name="tanggal_kegiatan" id="tanggal_kegiatan" value="{{ old('tanggal_kegiatan') }}">
                @error('tanggal_kegiatan')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="button" class="btn btn-dark d-block mb-4" data-bs-toggle="modal"
                    data-bs-target="#modalChoice">KIRIM
            </button>

            <div class="modal fade" tabindex="-1" role="dialog" data-bs-backdrop="static"
                 data-bs-keyboard="false" aria-hidden="true" id="modalChoice">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content rounded-3 shadow">
                        <div class="modal-body p-4 text-center">
                            <h5 class="mb-3">Apakah Anda yakin ingin mengirim kegiatan ini?</h5>
                            <p class="mb-0">Dengan mengirim kegiatan, informasi tersebut akan ditampilkan secara publik.
                                Anda yakin?</p>
                        </div>
                        <div class="modal-footer flex-nowrap p-0">
                            <button type="submit"
                                    class="btn btn-lg btn-link fs-6 text-dark text-decoration-none col-6 py-3 m-0 rounded-0 border-end"
                                    data-bs-dismiss="modal"><strong>Ya, kirim</strong></button>
                            <button type="button"
                                    class="btn btn-lg btn-link fs-6 text-dark text-decoration-none col-6 py-3 m-0 rounded-0"
                                    data-bs-dismiss="modal">Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection

@push('script')
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.image-popup').magnificPopup({
                type: 'image',
                zoom: {
                    enabled: true,
                    duration: 300,
                    easing: 'ease-in-out'
                }
            });

            $('#foto_kegiatan').change(function () {
                const file = this.files[0];
                const reader = new FileReader();
                const imagePreview = $('.img-preview');
                const imagePopup = $('.image-popup');

                reader.onload = function (e) {
                    if (file.type.includes('image')) {
                        imagePreview.attr('src', e.target.result);
                        imagePopup.attr('href', e.target.result);
                    }
                };

                if (file) {
                    reader.readAsDataURL(file);
                } else {
                    const defaultImage = '{{ asset('/img/no-img-available.png') }}';
                    imagePreview.attr('src', defaultImage);
                    imagePopup.attr('href', defaultImage);
                }
            });

        });
    </script>
@endpush
