@extends('admin.layout')

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
          rel="stylesheet"/>
@endpush

@section('content')
    <div class="bg-white mt-lg shadow mt-5">
        <div class="container pb-4">
            <h2 class="my-4 pt-2">Daftar Laporan</h2>
            <div class="row justify-content-center my-4">
                <div class="col-lg-8">
                    <form method="post" class="d-flex">
                        <div class="input-group">
                            <input class="form-control border-dark bg-light" placeholder="Cari..."
                                   name="keyword"
                                   aria-label="Cari" aria-describedby="button-cari">
                            <button class="btn btn-dark" type="submit" id="button-cari" name="cari">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-8 col-sm-10">
                    <form method="post" class="filter owl-carousel owl-theme">
                        <button type="submit" name="filter" value="semua"
                                class="btn btn-sm">
                        </button>
                        <button type="submit" name="filter" value="direspon"
                                class="btn btn-sm">
                            Sudah Direspon
                        </button>
                        <button type="submit" name="filter" value="belum-direspon"
                                class="btn btn-sm">
                            Belum Direspon
                        </button>
                    </form>
                </div>
                <form method="post" class="col-4 col-sm-2">
                    <select class="form-select form-select-sm border-dark" aria-label="urutkan">
                        <option value="1" class="text-small" selected>Terlama</option>
                        <option value="2" class="text-small">Terbaru</option>
                    </select>
                </form>
            </div>
        </div>
    </div>

    <div class="container pt-5">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="position-relative card ">
                <div class="card-header d-flex justify-content-between">
                    <span>Pengaduan</span>
{{--                    <span>' . (($item["id_tanggapan"] !== null) ? "Sudah direspon" : "Belum direspon") . '</span>--}}
                </div>
                <div class="card-body">
                    <h5 class="card-title">Judul</h5>
{{--                    <a href="rincian-laporan.php?lapor=' . $_GET["lapor"] . '&id=' . $item["id"] . '"--}}
{{--                    class="btn btn-dark">Lihat Rincian</a>--}}
                    <a class="btn btn-dark">Lihat Rincian</a>
                </div>
                <div class="card-footer text-muted">
{{--                    ' . $item["tanggal_lapor"] . '--}}
                    tanggal_lapor
                </div>
            </div>
        </div>
        </div>
    </div>

    <div class="container">
        <footer class="mt-5 py-3 border-top">
            <p class="text-center text-muted">&copy; 2022, Design and Develop By Bahtiar Rifa'i</p>
        </footer>
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

@push('script')
    <script>
        $(document).ready(function () {
            $('body').addClass('h-100vh d-flex flex-column justify-content-between');
            $('.filter.owl-carousel').owlCarousel({
                margin: 10,
                autoWidth: true,
            });
        })
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
            charset="utf-8"></script>
@endpush
