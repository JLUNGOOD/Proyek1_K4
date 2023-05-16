@extends('user.layout')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
@endpush

@section('content')
    <div class="container py-5">
        <div class="my-5">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
                    <strong><i class="fas fa-thumbs-up"></i> {{ session('success') }}</strong> Pengaduan Anda akan
                    segera ditinjau oleh tim kami.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="shadow-lg p-3 bg-body rounded">
                <h1 class="display-6 my-4 fw-bold text-center">Sampaikan Pengaduan Anda</h1>
                <form enctype="multipart/form-data" action="{{ route('pengaduan.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="kategori" class="form-label fw-bold">Kategori Pengaduan</label>
                        <select class="form-select @error('kategori') is-invalid @enderror" id="kategori"
                                name="kategori">
                            <option selected>Pilih Kategori Pengaduan Anda *</option>
                            @foreach($categories as $category)
                                <option {{ (old('kategori') == $category->id) ? 'selected' : ''}}
                                        value="{{ $category->id }}">{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori')
                        <small class="text-danger">{{ $message }} </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="judul" class="form-label fw-bold">Judul Pengaduan</label>
                        <input class="form-control @error('judul') is-invalid @enderror" name="judul" id="judul"
                               aria-describedby="judul" placeholder="Ketik Judul Laporan Anda *"
                               value="{{ old('judul') ?? '' }}">
                        @error('judul')
                        <small class="text-danger">{{ $message }} </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="isi" class="form-label fw-bold">Isi Pengadauan</label>
                        <textarea class="form-control @error('isi') is-invalid @enderror" name="isi" id="isi" rows="3"
                                  placeholder="Ketik Isi Pengaduan Anda *">{{ old('isi') ?? '' }}</textarea>
                        @error('isi')
                        <small class="text-danger">{{ $message }} </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label fw-bold">Tanggal Mulai Kejadian</label>
                        <input type="date" class="form-control @error('tanggal_kejadian') is-invalid @enderror"
                               name="tanggal_kejadian" id="tanggal" aria-describedby="tanggalKejadian"
                               value="{{ old('tanggal_kejadian') }}">
                        @error('tanggal_kejadian')
                        <small class="text-danger">{{ $message }} </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label fw-bold">Unggah Bukti Gambar</label>
                        <div>
                            <a class="image-popup d-inline-block" href="{{ asset('/img/no-img-available.png') }}"><img
                                    src="{{ asset('/img/no-img-available.png') }}"
                                    class="img-preview d-block rounded border mb-2" alt="Image Preview">
                            </a>
                        </div>
                        <input type="file" class="form-control @error('bukti_gambar') is-invalid @enderror"
                               name="bukti_gambar" id="gambar" aria-describedby="gambar"
                               value="{{ old('bukti_gambar') }}">
                        @error('bukti_gambar')
                        <small class="text-danger">{{ $message }} </small>
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
                                    <h5 class="mb-3">Anda akan mengirim pengaduan ini?</h5>
                                    <p class="mb-0">Pastikan informasi yang Anda berikan sudah benar dan relevan.
                                        Pengaduan
                                        yang telah
                                        dikirim tidak dapat diubah. Apakah Anda yakin ingin melanjutkan?</p>
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
        </div>
    </div>
@endsection

@push('script')
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

            $('#gambar').change(function () {
                const file = this.files[0];
                const reader = new FileReader();
                const imagePreview = $('.img-preview');
                const imagePopup = $('.image-popup');

                reader.onload = function (e) {
                    imagePreview.attr('src', e.target.result);
                    imagePopup.attr('href', e.target.result);
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
