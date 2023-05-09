@extends('admin.layout')

@section('content')
    <div class="h-100vh d-flex justify-content-center align-items-center flex-column">
        <h1 class="display-5 fw-bold mb-4">Halo, Admin<br> {{ auth()->user()->name }}</h1>
        <div class="d-flex justify-content-center gap-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title text-center">Laporan Hari Ini</h5>
                    <div class="card-text d-flex justify-content-around">
                        <div class="d-flex flex-column align-items-center">
                            <h5>Baru</h5>
                            <p>50</p>
                        </div>
                        <div class="d-flex flex-column align-items-center">
                            <h5>Terbaca</h5>
                            <p>50</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title text-center">Laporan Hari Ini</h5>
                    <div class="card-text d-flex justify-content-around">
                        <div class="d-flex flex-column align-items-center">
                            <h5>Baru</h5>
                            <p>50</p>
                        </div>
                        <div class="d-flex flex-column align-items-center">
                            <h5>Terbaca</h5>
                            <p>50</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
