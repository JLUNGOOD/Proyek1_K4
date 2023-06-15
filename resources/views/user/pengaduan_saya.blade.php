@extends('user.layout')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
@endpush

@section('content')
    <div class="bg-white mt-lg shadow">
        <div class="container py-2">
            <h2 class="my-4">Daftar Pengaduan</h2>
            <div class="row mb-3">
                <div class="col-md-9 col-lg-10">
                    <div
                        class="filter d-flex flex-wrap align-items-center justify-content-between justify-content-md-start gap-2">
                        <div class="d-flex flex-wrap gap-2">
                            <button onclick="getAllPengaduan()" id="btn-respon" name="responded"
                                    class="btn-switchable btn btn-dark">Semua
                            </button>
                            <button onclick="getSudahDitanggapi()" id="btn-respon" name="responded"
                                    class="btn-switchable btn btn-outline-dark">Direspon
                            </button>
                            <button onclick="getBelumDitanggapi()" id="btn-not-respon" name="not-responded"
                                    class="btn-switchable btn btn-outline-dark">Belum direspon
                            </button>
                        </div>
                        <div class="d-flex">
                            <label for="filterDropdown"></label>
                            <select id="filterDropdown" class="form-select border-dark">
                                <option selected disabled value="">Filter</option>
                                <option value="solved" onclick="getSolved()">Solved</option>
                                <option value="unsolved" onclick="getUnsolved()">Unsolved</option>
                                <option value="onprogress" onclick="getOnProgress()">On Progress</option>
                                <option value="rejected" onclick="getRejected()">Rejected</option>
                            </select>
                            <button class="btn btn-outline-dark mx-2" data-bs-toggle="modal"
                                    data-bs-target="#modalInfo">
                                <i class="fas fa-question"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-lg-2 mt-2 mt-md-0">
                    <div class="input-group">
                        <input class="form-control border-dark bg-light" placeholder="Cari..."
                               value="{{ session('cariLaporanSaya') ? session('cariLaporanSaya') : '' }}"
                               name="keyword" id="keyword" aria-label="Cari" aria-describedby="button-cari">
                        <button class="btn btn-dark" onclick="searchPengaduan()" id="button-cari"
                                name="cariLaporanSaya"><i
                                class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-5">
        @if (count($daftar_pengaduan) == 0)
            <div class="row" id="list-pengaduan">
                @foreach($daftar_pengaduan as $pengaduan)
                    <div class="col-md-6 mb-3">
                        <div class="position-relative card ">
                            <div class="card-header d-flex justify-content-between">
                                @if(auth()->user()->id == $pengaduan->user_id)
                                    <b>Pengaduan Anda</b>
                                @else
                                    <span>Pengaduan</span>
                                @endif
                                <div>
                                    @if($pengaduan->is_read == '1')
                                        <i class='fas fa-check-double text-info'></i>
                                    @else
                                        <i class='fas fa-check-double'></i>
                                    @endif
                                    @if ($pengaduan->tanggapan_is_read === 0)
                                        <i class="text-danger fa fa-circle"></i>
                                    @endif

                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $pengaduan->judul }}</h5>
                                <a class="btn btn-dark" href="{{ url('/pengaduan_saya/' . $pengaduan->id) }}">Lihat
                                    Rincian</a>
                            </div>
                            <div class="card-footer text-muted d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="far fa-calendar-alt pe-1"></i>
                                    {{ $pengaduan->tanggal_kejadian ?  \Carbon\Carbon::parse($pengaduan->tanggal_kejadian)->format('d M Y') : 'Tidak Diketahui' }}
                                </div>
                                @if($pengaduan->status == '1')
                                    <span class="badge bg-success">Solved</span>
                                @elseif($pengaduan->status == '0')
                                    <span class="badge bg-danger">Unsolved</span>
                                @elseif($pengaduan->status == '2')
                                    <span class="badge bg-warning">On Progress</span>
                                @elseif($pengaduan->status == '3')
                                    <span class="badge bg-secondary">Rejected</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center">
                <img src="{{ asset('img/undraw_No_data_re_kwbl.png') }}" width="300px" class="img-fluid" alt="No Data"
                     loading="lazy">
                <h4 class="mt-3">Tidak ada data yang tersedia.</h4>
            </div>
        @endif
    </div>

    <div class="modal fade" id="modalInfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Informasi Status Pengaduan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        <i class='fas fa-check-double pe-2'></i>
                        Belum Dibaca oleh Petugas/Admin.
                    </p>
                    <hr>
                    <p>
                        <i class='fas fa-check-double text-info pe-2'></i>
                        Sudah Dibaca oleh Petugas/Admin.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        let sortByResponded = 0; // 0 = unsorted, 1 = responded, 2 = not responded

        // get html template that can be append to list-pengaduan
        function getTempHtml(pengaduan) {
            return ` <div class="col-md-6 mb-3">
                            <div class="position-relative card ">
                                <div class="card-header d-flex justify-content-between">
                                    ${
                pengaduan["user_id"] == {{ auth()->user()->id }}
                    ? "<b>Pengaduan Anda</b>"
                    : "<span>Pengaduan</span>"
            }
                                    <div>
                                    ${
                pengaduan["is_read"] == "1"
                    ? "<i class='fas fa-check-double text-info'></i>"
                    : "<i class='fas fa-check-double'></i>"
            }
            ${
                pengaduan["tanggapan_is_read"] === 0
                    ? "<i class='text-danger fa fa-circle'></i>"
                    : ""
            }
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">${pengaduan['judul']}</h5>
                                    <a class="btn btn-dark" href="/admin/tanggapi/${pengaduan['id']}">Lihat
                                        Rincian</a>
                                </div>
                                <div class="card-footer text-muted d-flex justify-content-between">
                                    ${pengaduan['tanggal_kejadian']}
                                    ${pengaduan['status'] == "1" ? "<span class='badge bg-success'>Solved</span>" :
                pengaduan['status'] == "0" ? "<span class='badge bg-danger'>Unsolved</span>" :
                    pengaduan['status'] == "2" ? "<span class='badge bg-warning'>On Progress</span>" :
                        pengaduan['status'] == "3" ? "<span class='badge bg-secondary'>Rejected</span>" : ""
            }
                                </div>
                            </div>
                        </div>
                        `;
        }

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
            switchActiveButton(sortByResponded);
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
                        let temp_html = getTempHtml(pengaduan);
                        $('#list-pengaduan').append(temp_html);
                    });
                    console.log(response['pengaduans']);
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
                        let temp_html = getTempHtml(pengaduan);
                        $('#list-pengaduan').append(temp_html);
                    });
                    console.log(response['pengaduans']);
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
                        let temp_html = getTempHtml(pengaduan);
                        $('#list-pengaduan').append(temp_html);
                    });
                    console.log(response['pengaduans']);
                },
            });
        }

        const selectElement = document.getElementById('filterDropdown');

        selectElement.addEventListener('change', function () {
            const selectedOption = this.value;

            if (selectedOption === 'unsolved') {
                getUnsolved();
            } else if (selectedOption === 'solved') {
                getSolved();
            } else if (selectedOption === 'onProgress') {
                getOnProgress();
            } else {
                getRejected();
            }
        });

        let status;

        function getUnsolved() {
            status = 0;
            switchActiveButton(sortByResponded);
            $.ajax({
                method: 'POST',
                url: '{{ url('/pengaduan/unsolved') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    sortByResponded: sortByResponded
                },
                success: (response) => {
                    $('#list-pengaduan').empty();
                    response['pengaduans'].forEach((pengaduan) => {
                        let temp_html = getTempHtml(pengaduan);
                        $('#list-pengaduan').append(temp_html);
                    });
                    console.log(response['pengaduans']);
                },
            });
        }

        function getSolved() {
            status = 1;
            switchActiveButton(sortByResponded);
            $.ajax({
                method: 'POST',
                url: '{{ url('/pengaduan/solved') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    sortByResponded: sortByResponded
                },
                success: (response) => {
                    $('#list-pengaduan').empty();
                    response['pengaduans'].forEach((pengaduan) => {
                        let temp_html = getTempHtml(pengaduan);
                        $('#list-pengaduan').append(temp_html);
                    });
                    console.log(response['pengaduans']);
                },
            });
        }

        function getOnProgress() {
            status = 2;
            switchActiveButton(sortByResponded);
            $.ajax({
                method: 'POST',
                url: '{{ url('/pengaduan/on_progress') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    sortByResponded: sortByResponded
                },
                success: (response) => {
                    $('#list-pengaduan').empty();
                    response['pengaduans'].forEach((pengaduan) => {
                        let temp_html = getTempHtml(pengaduan);
                        $('#list-pengaduan').append(temp_html);
                    });
                    console.log(response['pengaduans']);
                },
            });
        }

        function getRejected() {
            status = 3;
            switchActiveButton(sortByResponded);
            console.log(status);
            $.ajax({
                method: 'POST',
                url: '{{ url('/pengaduan/rejected') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    sortByResponded: sortByResponded
                },
                success: (response) => {
                    $('#list-pengaduan').empty();
                    response['pengaduans'].forEach((pengaduan) => {
                        let temp_html = getTempHtml(pengaduan);
                        $('#list-pengaduan').append(temp_html);
                    });
                    console.log(response['pengaduans']);
                },
            });
        }
    </script>
@endpush
