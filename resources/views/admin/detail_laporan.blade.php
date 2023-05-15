@extends('admin.layout')

@section('content')
    <div class="bg-white container mt-lg shadow rounded pb-4">
        {{--        <?php--}}
        {{--        if (isset($_POST["tanggapan"])) {--}}
        {{--            $_POST["lapor"] = $_GET["lapor"];--}}
        {{--            $_POST["id"] = $_GET["id"];--}}
        {{--            $email = $_SESSION['adminMasuk'];--}}
        {{--            $_POST["id_admin"] = getData("SELECT id FROM admin WHERE email = '$email'")[0]['id'];--}}

        {{--            if (beriTanggapan($_POST) > 0) {--}}
        {{--                echo '--}}
        {{--            <div class="my-3 alert alert-success alert-dismissible fade show" role="alert">--}}
        {{--                <strong>Berhasil memberi tanggapan!</strong>.--}}
        {{--                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
        {{--            </div>';--}}
        {{--            } else {--}}
        {{--                echo '--}}
        {{--            <div class="my-3 alert alert-danger alert-dismissible fade show" role="alert">--}}
        {{--                <strong>Gagal memberi tanggapan!</strong>.--}}
        {{--                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
        {{--            </div>';--}}
        {{--            }--}}
        {{--        }--}}
        {{--        ?>--}}
        <form class="container" method="post">
            <h2 class="my-4 pt-2">Rincian Laporan</h2>
            <div class="mb-3 row border-bottom">
                <label for="klarifikasi" class="col-sm-3 col-form-label fw-bold">Klarifikiasi Laporan</label>
                <div class="col-sm-9">
                    <input readonly class="form-control-plaintext" id="klarifikasi"
                           value="{{ $pengaduan->kategori->name }}">
                </div>
            </div>
            <div class="mb-3 row border-bottom">
                <label for="judul" class="col-sm-3 col-form-label fw-bold">Judul Laporan</label>
                <div class="col-sm-9">
                    <input readonly class="form-control-plaintext" id="judul" value="{{ $pengaduan->judul }}">
                </div>
            </div>
            <div class="mb-3 row border-bottom">
                <label for="isi" class="col-sm-3 col-form-label fw-bold">Isi Laporan</label>
                <div class="col-sm-9">
                    <input readonly class="form-control-plaintext" id="isi" value="{{ $pengaduan->isi }}">
                </div>
            </div>
            <div class="mb-3 row border-bottom">
                <label for="status" class="col-sm-3 col-form-label fw-bold">Status</label>
                <div class="col-sm-9">
                    <input readonly class="form-control-plaintext" id="status"
                           value="{{ isset($tanggapan) ? "Sudah ditanggapi" : "Belum direspon" }}"
                    >
                </div>
            </div>
            <div class="mb-3 row border-bottom">
                <label for="gambar" class="col-sm-3 col-form-label fw-bold">Bukti Gambar</label>
                <div class="col-sm-9">
                    @if($pengaduan->bukti_gambar)
                        <img src="{{ asset('/img/pengaduan/' . $pengaduan->bukti_gambar) }}" alt="Bukti Gambar"
                             class="mb-3 border" width="200">
                    @endif
                </div>
            </div>
            <div class="mb-3 row border-bottom">
                <label for="tanggal" class="col-sm-3 col-form-label fw-bold">Tanggal Kejadian</label>
                <div class="col-sm-9">
                    <input readonly class="form-control-plaintext" id="tanggal"
                           value="{{ $pengaduan->tanggal_kejadian }}">
                </div>
            </div>
            <div class="mb-3 row border-bottom">
                <label for="nama" class="col-sm-3 col-form-label fw-bold">Nama Pelapor</label>
                <div class="col-sm-9">
                    <input readonly class="form-control-plaintext" id="nama"
                           value="{{ $pengaduan->user->name }}"
                    >
                </div>
            </div>
            <div class="mb-3 row border-bottom">
                <label for="email" class="col-sm-3 col-form-label fw-bold">Email Pelapor</label>
                <div class="col-sm-9">
                    <input readonly class="form-control-plaintext" id="email"
                           value="{{ $pengaduan->user->email }}"
                    >
                </div>
            </div>
            <div class="mb-3 row border-bottom ">
                <label for="tanggal_lapor" class="col-sm-3 col-form-label fw-bold">Tanggal Lapor</label>
                <div class="col-sm-9">
                    <input readonly class="form-control-plaintext" id="tanggal_lapor"
                           value="{{ $pengaduan->created_at }}"
                    >
                </div>
            </div>
        </form>
        @if(!isset($tanggapan))
            <p>
                <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#tanggapi"
                        aria-expanded="false" aria-controls="collapseExample">
                    Beri Tanggapan <i class="ps-2 fas fa-angle-down"></i>
                </button>
            </p>
            <div class="collapse" id="tanggapi">
                <div class="card card-body mb-3">
                    <form method="post">
                        <div class="mb-3">
                            <label for="isi" class="form-label fw-bold">Isi Tanggapan</label>
                            <textarea class="form-control" name="isi" id="isi" rows="3"
                                      placeholder="Ketik Tanggapan *" required></textarea>
                            <div id="catatan" class="form-text">
                                Catatan: Tanggapan yang sudah dikirim tidak bisa diubah.
                            </div>
                        </div>
                        <button type="submit" name="tanggapan" class="btn btn-dark">Kirim</button>
                    </form>
                </div>
            </div>
        @else
            <form class="container">
                <h2 class="my-4 pt-2">Tanggapan</h2>
                <div class="mb-3 row border-bottom">
                    <label for="ditanggapi-oleh" class="col-sm-3 col-form-label fw-bold">Ditanggapi Oleh</label>
                    <div class="col-sm-9">
                        <input readonly class="form-control-plaintext" id="ditanggapi-oleh"
                               value="{{ $tanggapan->user->name }}">
                    </div>
                </div>
                <div class="mb-3 row border-bottom">
                    <label for="isi-tanggapan" class="col-sm-3 col-form-label fw-bold">Isi Tanggapan</label>
                    <div class="col-sm-9">
                        <textarea class="form-control-plaintext" id="isi-tanggapan"
                                  rows="3" readonly>{{ $tanggapan->isi_tanggapan }}</textarea>
                    </div>
                </div>
            </form>
    @endif
</div>
@endsection
