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
                    <form method="post" class="filter owl-carousel owl-theme">
                        <button type="submit" name="responded" class="btn btn-dark">Direspon</button>
                        <button type="submit" name="not-responded" class="btn btn-outline-dark">Belum direspon</button>
                    </form>
                </div>
                <form method="post" class="col-6 col-sm-3">
                    <div class="input-group">
                        <input class="form-control border-dark bg-light" placeholder="Cari..."
                               value="{{ session('cariLaporanSaya') ? session('cariLaporanSaya') : '' }}"
                               name="keyword" aria-label="Cari" aria-describedby="button-cari">
                        <button class="btn btn-dark" type="submit" id="button-cari" name="cariLaporanSaya"><i
                                class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

{{--    <div class="container pt-5">--}}
{{--        <div class="row">--}}
{{--            @foreach ($lapor as $item)--}}
{{--                <div class="col-md-6 mb-3">--}}
{{--                    <div class="position-relative card {{ ($item['id_tanggapan'] !== null) ? 'is-response' : '' }}">--}}
{{--                        @if ($item['dibaca_pengguna'] == 0 && $item['id_tanggapan'] != null)--}}
{{--                            <span--}}
{{--                                class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle"></span>--}}
{{--                        @endif--}}
{{--                        <div class="card-header d-flex justify-content-between">--}}
{{--                            <span>{{ ucfirst(session('klarifikasi')) }}</span>--}}
{{--                            <span>{{ ($item['id_tanggapan'] !== null) ? 'Sudah direspon' : 'Belum direspon' }}</span>--}}
{{--                        </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <h5 class="card-title">{{ $item['judul'] }}</h5>--}}
{{--                            <a href="rincian-laporan-saya.php?id={{ $item['id'] }}" class="btn btn-dark">Lihat--}}
{{--                                Rincian</a>--}}
{{--                        </div>--}}
{{--                        <div class="card-footer text-muted">--}}
{{--                            {{ $item['tanggal_lapor'] }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
