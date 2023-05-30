@extends('user.layout')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
@endpush

@section('content')
    <div class="bg-white mt-lg shadow">
        <div class="container py-2">
            <h2 class="my-4">Kegiatan</h2>
        </div>
    </div>
    <div class="container pt-5">
        <div class="row" id="list-kegiatan">
            <div class="container">
                <div class="row">
                    @foreach($kegiatans as $kegiatan)
                        <div class="col-sm-12 col-md-4 col-lg-3 mb-3">
                            <a href="{{ url('/kegiatan/' . $kegiatan->slug) }}" class="card activity card-has-bg"
                               style="background-image:url('{{ $kegiatan->foto_kegiatan ? asset('storage/foto_kegiatan/' . $kegiatan->foto_kegiatan) : asset('/img/no-img-available.png') }}');">
                                <div class="card-img-overlay d-flex flex-column">
                                    <div class="card-body text-white">
                                        <small class="text-aqua mb-2">Kegiatan</small>
                                        <h5 class="card-title mt-0 ">{{ $kegiatan->judul_kegiatan }}</h5>
                                        <small><i
                                                class="far fa-clock me-2"></i>{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->format('d M Y') }}
                                        </small>
                                    </div>
                                    <div class="card-footer text-white">
                                        <h6 class="my-0 text-white d-block">{{ $kegiatan->user->name }}</h6>
                                        <small>{{ $kegiatan->user->email }}</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
