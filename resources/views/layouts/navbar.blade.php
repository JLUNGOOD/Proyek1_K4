<div class="container px-4">
    <span class="navbar-brand fw-bold">LAPOR PNG</span>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#tentang">TENTANG</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#lapor">LAPOR</a>
            </li>
        </ul>
        <div class="d-flex gap-3 navbar-nav my-3">
            @auth
                <div class="dropdown">
                    <button class="btn dropdown-toggle d-block w-100" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                        <i class="far fa-user-circle fs-6 pe-1"></i>'
                        . $nama .
                        '
                    </button>
                    <ul class="dropdown-menu shadow">
                        <li><a class="dropdown-item" href="laporan-saya.php">Laporan Saya</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="ubah-profil.php">Ubah Profil</a></li>
                        <li><a class="dropdown-item" href="ubah-password.php">Ubah Kata Sandi</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="keluar.php" data-bs-toggle="modal"
                               data-bs-target="#keluar">
                                <i class="fas fa-sign-out-alt pe-1"></i>Keluar
                            </a>
                        </li>
                    </ul>
                </div>';
            @endauth
            @guest
                <a class="btn btn-outline-dark" role="button" href="masuk.php">Masuk</a>
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#daftar">
                    Daftar
                </button>';
            @endguest
        </div>
    </div>
</div>
</nav>
