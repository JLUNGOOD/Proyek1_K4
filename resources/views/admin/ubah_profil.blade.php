@extends('admin.layout')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
@endpush

@section('content')
    <div class="container my-5 pt-5">
        <div class="row justify-content-center mt-2">
            <div class="col-md-9">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-thumbs-up"></i> {{ session('success') }}</strong>.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form method="post" action="{{ url('/ubah_profil') }}">
                    @csrf
                    <h4>Ubah Profil</h4>
                    <div class="mt-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input class="form-control @error('email') is-invalid @enderror" name="name" id="name"
                               placeholder="Masukkan Nama Anda *" value="{{ auth()->user()->name }}">
                        @error('name')
                        <small class="text-danger">{{ $message }} </small>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control " name="email" id="email" value="{{ auth()->user()->email }}"
                               disabled>
                    </div>
                    <div class="mt-3">
                        <label for="tanggal_lahir" class="form-label @error('tanggal_lahir') is-invalid @enderror">
                            Tanggal Lahir
                        </label>
                        <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir"
                               placeholder="Masukkan Tanggal Lahir Anda *" value="{{ auth()->user()->tanggal_lahir }}">
                        @error('tanggal_lahir')
                        <small class="text-danger">{{ $message }} </small>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" value="L"
                                   id="male" {{ auth()->user()->jenis_kelamin == 'L' ? 'checked' : '' }}>
                            <label class="form-check-label" for="male">
                                Laki-laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" value="P"
                                   id="female" {{ auth()->user()->jenis_kelamin == 'P' ? 'checked' : '' }}>
                            <label class="form-check-label" for="female">
                                Perempuan
                            </label>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-dark">Ubah Profil</button>
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
