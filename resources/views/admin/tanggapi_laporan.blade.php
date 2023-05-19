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
                    <div class="d-flex">
                        <div class="input-group">
                            <input id="keyword" class="form-control border-dark bg-light" placeholder="Cari..."
                                   name="keyword"
                                   aria-label="Cari" aria-describedby="button-cari">
                            <button class="btn btn-dark" onclick="searchPengaduan()" id="button-cari" name="cari">Cari</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8 col-sm-10">
                    <div class="filter">
                        <button id="btn-get-all" onclick="getAllPengaduan()" type="submit" name="filter" value="semua" class="btn-switchable btn btn-sm btn-dark">
                            Semua
                        </button>
                        <button id="btn-get-responded" onclick="getSudahDitanggapi()" name="filter" value="direspon" class="btn-switchable btn btn-sm btn-outline-dark">
                            Sudah Direspon
                        </button>
                        <button id="btn-get-unresponded" onclick="getBelumDitanggapi()" name="filter" value="belum-direspon" class="btn-switchable btn btn-sm btn-outline-dark">
                            Belum Direspon
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container pt-5">
        <div class="row" id="list-pengaduan">
            @foreach($daftar_pengaduan as $pengaduan)
                <div class="col-md-6 mb-3">
                    <div class="position-relative card ">
                        <div class="card-header d-flex justify-content-between">
                            <span>Pengaduan</span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $pengaduan->judul }}</h5>
                            <a class="btn btn-dark" href="{{ url('/admin/tanggapi/' . $pengaduan->id) }}">Lihat
                                Rincian</a>
                        </div>
                        <div class="card-footer text-muted">
                            {{ $pengaduan->tanggal_kejadian }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container">
        <footer class="mt-5 py-3 border-top">
            <p class="text-center text-muted">&copy; 2022</p>
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
        let sortByResponded = 0; // 0 = unsorted, 1 = responded, 2 = not responded

        function switchActiveButton(index) {
            const activeButton = document.querySelector('.btn-switchable.btn-dark');
            activeButton.classList.add('btn-outline-dark');
            activeButton.classList.remove('btn-dark');

            const nextActiveButton = document.querySelectorAll('.btn-switchable');
            nextActiveButton[index].classList.add('btn-dark');
            nextActiveButton[index].classList.remove('btn-outline-dark');
        }

        function getAllPengaduan() {
            $('#keyword').val('');
            sortByResponded = 0;
            searchPengaduan();
            switchActiveButton(0);
        }

        function getSudahDitanggapi() {
            sortByResponded = 1;
            switchActiveButton(sortByResponded);
            $.ajax({
                method: 'POST',
                url: '{{ url('/pengaduan/sudah_ditanggapi') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    sortByResponded: sortByResponded
                },
                success: (response) => {
                    $('#list-pengaduan').empty();
                    response['pengaduans'].forEach((pengaduan) => {
                        let temp_html = `
                        <div class="col-md-6 mb-3">
                            <div class="position-relative card ">
                                <div class="card-header d-flex justify-content-between">
                                    <span>Pengaduan</span>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">${pengaduan['judul']}</h5>
                                    <a class="btn btn-dark" href="/admin/tanggapi/${pengaduan['id']}">Lihat
                                        Rincian</a>
                                </div>
                                <div class="card-footer text-muted">
                                    ${pengaduan['tanggal_kejadian']}
                                </div>
                            </div>
                        </div>
                        `;
                        $('#list-pengaduan').append(temp_html);
                    });
                },
            });
        }

        function getBelumDitanggapi() {
            sortByResponded = 2;
            switchActiveButton(sortByResponded);
            $.ajax({
                method: 'POST',
                url: '{{ url('/pengaduan/belum_ditanggapi') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    sortByResponded: sortByResponded
                },
                success: (response) => {
                    $('#list-pengaduan').empty();
                    response['pengaduans'].forEach((pengaduan) => {
                        let temp_html = `
                        <div class="col-md-6 mb-3">
                            <div class="position-relative card ">
                                <div class="card-header d-flex justify-content-between">
                                    <span>Pengaduan</span>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">${pengaduan['judul']}</h5>
                                    <a class="btn btn-dark" href="/admin/tanggapi/${pengaduan['id']}">Lihat
                                        Rincian</a>
                                </div>
                                <div class="card-footer text-muted">
                                    ${pengaduan['tanggal_kejadian']}
                                </div>
                            </div>
                        </div>
                        `;
                        $('#list-pengaduan').append(temp_html);
                    });
                },
            });
        }

        function searchPengaduan() {
            switchActiveButton(sortByResponded);
            $.ajax({
                method: 'POST',
                url: '{{ url('/pengaduan/search') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    keyword: $('#keyword').val(),
                    sortByResponded: sortByResponded
                },
                success: (response) => {
                    $('#list-pengaduan').empty();
                    response['pengaduans'].forEach((pengaduan) => {
                        let temp_html = `
                        <div class="col-md-6 mb-3">
                            <div class="position-relative card ">
                                <div class="card-header d-flex justify-content-between">
                                    <span>Pengaduan</span>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">${pengaduan['judul']}</h5>
                                    <a class="btn btn-dark" href="/admin/tanggapi/${pengaduan['id']}">Lihat
                                        Rincian</a>
                                </div>
                                <div class="card-footer text-muted">
                                    ${pengaduan['tanggal_kejadian']}
                                </div>
                            </div>
                        </div>
                        `;
                        $('#list-pengaduan').append(temp_html);
                    });
                },
            });
        }

        $(document).ready(function () {
            $('body').addClass('h-100vh d-flex flex-column justify-content-between');
            $('.filter.owl-carousel').owlCarousel({
                margin: 10,
                autoWidth: true,
            });
            document.getElementById('keyword').addEventListener('keyup', searchPengaduan);
        })
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
            charset="utf-8"></script>
@endpush
