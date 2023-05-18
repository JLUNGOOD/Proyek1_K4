@extends('admin.layout')

@section('content')
    <div class="min-vh-100 d-flex gap-4 justify-content-center align-items-center flex-column">
        <h1 class="display-5 fw-bold mb-4">Halo, Admin {{ auth()->user()->name }}</h1>
        <div class="d-flex justify-content-center gap-4">
            <div class="card border border-5 border-warning" style="width: 18rem; background-color: #f5c99f">
                <div class="card-body">
                    <h4 class="card-title fw-bold text-center">Laporan Hari Ini</h4>
                    <div class="card-text d-flex justify-content-around">
                        <div class="d-flex flex-column align-items-center">
                            <h5>Baru</h5>
                            <p>{{ $pengaduans['today_belum_direspon'] }}</p>
                        </div>
                        <div class="d-flex flex-column align-items-center">
                            <h5>Direspon</h5>
                            <p>{{ $pengaduans['today_sudah_direspon'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border border-5 border-primary" style="width: 18rem; background-color: #75a9ff">
                <div class="card-body">
                    <h4 class="card-title fw-bold text-center">Total Laporan</h4>
                    <div class="card-text d-flex justify-content-around">
                        <div class="d-flex flex-column align-items-center">
                            <h5>Baru</h5>
                            <p>{{ $pengaduans['total_belum_direspon'] }}</p>
                        </div>
                        <div class="d-flex flex-column align-items-center">
                            <h5>Direspon</h5>
                            <p>{{ $pengaduans['total_sudah_direspon'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-75">
            <h3 class="text-center fw-bold py-3">Total Laporan Berdasarkan Kategori</h3>
            <canvas id="myChart"></canvas>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');
        const backgroundColor = {!! $pengaduan_count !!}.map(() => {
            return `rgba(${Math.random() * 200}, ${Math.random() * 200}, 255, 1)`;
        })
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! $categories_name !!},
                datasets: [{
                    label: 'Banyak Pengaduan',
                    data: {{ $pengaduan_count }},
                    backgroundColor: backgroundColor,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                aspectRatio: 5/1,
            },
        });
    </script>
@endpush
