@extends('user.layout')

@section('content')
    <div class="row mt-lg">
        <div class="mx-auto col-sm-8">
            <div class="container py-5">
                <h3 class="mb-3">{{ $kegiatan->judul_kegiatan }}</h3>
                <div class="mb-3">
                    <span class="text-secondary">
                        <i class="far fa-calendar-alt me-2"></i>{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->format('d M Y') }}
                    </span>
                    <span class="px-3">|</span>
                    <span class="text-secondary"><i class="fas fa-user-tie me-2"></i>{{ $kegiatan->user->email }}</span>
                </div>
                <div class="text-center mb-3">
                    <img class="img-fluid"
                         src="{{ $kegiatan->foto_kegiatan ? asset('storage/foto_kegiatan/' . $kegiatan->foto_kegiatan) : asset('/img/no-img-available.png') }}">
                </div>
                <div class="text-secondary mb-3">
                    {!! $kegiatan->isi_kegiatan !!}
                </div>
            </div>
        </div>
    </div>
@endsection
