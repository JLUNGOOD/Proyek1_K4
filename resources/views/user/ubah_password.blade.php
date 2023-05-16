@extends('user.layout')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
@endpush

@section('content')
    <div class="container my-5 pt-5">
        <div class="row justify-content-center mt-2">
            <div class="col-md-3 border-end">
                <ul class="list-group mb-5 shadow">
                    <li class="list-group-item"><a class="nav-link" href="{{ url('ubah_profil') }}">Ubah
                            Profil</a></li>
                    <li class="list-group-item active"><a class="nav-link" href="{{ url('ubah_password') }}">
                            Ubah Kata Sandi
                        </a></li>
                </ul>
            </div>
            <div class="col-md-9">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-thumbs-up"></i> {{ session('success') }}</strong>.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form method="post" action="{{ url('/ubah_password') }}">
                    @csrf
                    <h4 class="mb-3">Ubah Password</h4>
                    <div class="mt-3 row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control-plaintext" id="email" name="email"
                                   value="{{ auth()->user()->email }}" readonly>
                        </div>
                    </div>
                    <div class="mt-3 row">
                        <label for="old_password" class="col-sm-3 col-form-label">Password Lama</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="old_password" name="old_password"
                                   placeholder="Masukkan Kata Sandi Lama Anda *">
                        </div>
                        @error('old_password')
                        <small class="text-danger">{{ $message }} </small>
                        @enderror
                    </div>
                    <div class="mt-3 row">
                        <label for="password" class="col-sm-3 col-form-label">Password Baru</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password"
                                   placeholder="Masukkan Kata Sandi Baru Anda *">
                        </div>
                        @error('password')
                        <small class="text-danger">{{ $message }} </small>
                        @enderror
                    </div>
                    <div class="mt-3 row">
                        <label for="password_confirmation"
                               class="col-sm-3 col-form-label @error('old_password') is-invalid @enderror">
                            Password Baru Confirmation</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password_confirmation"
                                   name="password_confirmation" placeholder="Masukkan Konfirmasi Kata Sandi Anda *">
                        </div>
                        @error('password_confirmation')
                        <small class="text-danger">{{ $message }} </small>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-dark">Ubah Password</button>
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
