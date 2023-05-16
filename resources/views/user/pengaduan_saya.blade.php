@extends('user.layout')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
@endpush

@section('content')
    <div class="bg-white mt-lg shadow">
        <div class="container py-2">
            <h2 class="my-4">Daftar Pengaduan</h2>
            <div class="row mb-3">
                <div class="col-6 col-sm-9">
                    <div class="filter owl-carousel owl-theme">
                        <button onclick="getSudahDitanggapi()" id="btn-respon" name="responded" class="btn btn-dark">Direspon</button>
                        <button onclick="getBelumDitanggapi()" id="btn-not-respon" name="not-responded" class="btn btn-outline-dark">Belum direspon</button>
                    </div>
                </div>
                <div class="col-6 col-sm-3">
                    <div class="input-group">
                        <input class="form-control border-dark bg-light" placeholder="Cari..."
                               value="{{ session('cariLaporanSaya') ? session('cariLaporanSaya') : '' }}"
                               name="keyword" id="keyword" aria-label="Cari" aria-describedby="button-cari">
                        <button class="btn btn-dark" onclick="searchPengaduan()" id="button-cari" name="cariLaporanSaya"><i
                                class="fas fa-search"></i></button>
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
@endsection

@push('script')
    <script>
        let sortByResponded = 0; // 0 = unsorted, 1 = responded, 2 = not responded
        function getSudahDitanggapi() {
            $('#btn-respon').removeClass('btn-outline-dark');
            $('#btn-respon').addClass('btn-dark');
            $('#btn-not-respon').removeClass('btn-dark');
            $('#btn-not-respon').addClass('btn-outline-dark');
            sortByResponded = 1;
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
                    console.log(response['pengaduans']);
                },
            });
        }

        function getBelumDitanggapi() {
            $('#btn-not-respon').removeClass('btn-outline-dark');
            $('#btn-not-respon').addClass('btn-dark');
            $('#btn-respon').removeClass('btn-dark');
            $('#btn-respon').addClass('btn-outline-dark');
            sortByResponded = 2;
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
                    console.log(response['pengaduans']);
                },
            });
        }

        function searchPengaduan() {
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
                    console.log(response['pengaduans']);
                },
            });
        }

        // $(document).ready(function () {
        //     $('body').addClass('h-100vh d-flex flex-column justify-content-between');
        //     $('.filter.owl-carousel').owlCarousel({
        //         margin: 10,
        //         autoWidth: true,
        //     });
        // })
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
            charset="utf-8"></script>
@endpush
