<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>
<div class="container col-xl-10 col-xxl-8 px-4">
    <div class="row align-items-center g-lg-5 h-100vh">
        <div class="col-lg-7">
            <img src="{{ asset('img/undraw_Login_re_4vu2.png') }}" class="d-block mx-lg-auto img-fluid" alt="Login"
                 loading="lazy">
        </div>
        <div class="col-md-10 mx-auto col-lg-5">
            <form class="p-4 p-md-5 border rounded-3 bg-light shadow" action={{ url('/login') }} method="post">
                @csrf
                <h1 class="display-5 fw-bold mb-4 text-center">Login</h1>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput"
                           placeholder="name@example.com" name="email">
                    <label for="floatingInput">Email Address</label>
                    @error('email')
                    <small class="text-danger">{{ $message }} </small>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                           id="floatingPassword" placeholder="Password" name="password">
                    <label for="floatingPassword">Password</label>
                    @error('password')
                    <small class="text-danger">{{ $message }} </small>
                    @enderror
                </div>
                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" class="form-check-input" value="remember-me" name="remember"> Ingat saya
                    </label>
                </div>
                <button class="w-100 btn btn-lg btn-dark" type="submit">Sign In</button>
                <hr class="my-4">
                <small class="d-block text-muted text-center">Belum punya akun? <a href="" data-bs-toggle="modal"
                                                                                   data-bs-target="#daftar">Daftar</a>.
                </small>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="daftar" data-bs-backdrop="static" tabindex="-1" aria-labelledby="daftar"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fw-bold mb-0 fs-2" id="exampleModalLabel">Register</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('register') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mt-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input class="form-control" name="name" id="name" placeholder="Masukkan Nama Anda *"
                               required>
                    </div>
                    <div class="mt-3">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control" name="email" id="email" placeholder="Masukkan Alamat Email Anda *"
                               required>
                    </div>
                    <div class="mt-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password"
                               placeholder="Masukkan Kata Sandi Anda *" required>
                        <div id="passwordHelpBlock" class="form-text">
                            Kata sandi minimal 4 karakter.
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="password_confirmation" class="form-label">Password Confirmation</label>
                        <input type="password" class="form-control" name="password_confirmation"
                               id="password_confirmation" placeholder="Masukkan Konfirmasi Kata Sandi Anda *" required>
                    </div>
                    <div class="mt-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir"
                               placeholder="Masukkan Tanggal Lahir Anda *" required>
                    </div>
                    <div class="mt-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" value="L"
                                   id="male" checked>
                            <label class="form-check-label" for="male">
                                Laki-laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" value="P"
                                   id="female" required>
                            <label class="form-check-label" for="female">
                                Perempuan
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark">Sign Up</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>
</html>
