@extends('admin.layout')

@section('content')
    <div class="min-vh-100 d-flex gap-4 justify-content-center align-items-center flex-column" style="margin-top: 90px">
        <h1 class="display-5 fw-bold mb-4">Halo, {{ $user->role==1? 'Admin':'Pegawai' }} {{ $user->name }}</h1>             
        <div class="d-flex justify-content-center gap-4">
            <div class="card border border-5 border-warning" style="width: 18rem; background-color: #f5c99f">
                <div class="card-body">
                    <h4 class="card-title fw-bold text-center">Pengaduan Hari Ini</h4>
                    <div class="card-text d-flex justify-content-around">
                        <div class="d-flex flex-column align-items-center">
                            <h5>Belum Direspon</h5>
                            <p>{{ $pengaduans['today_belum_direspon'] }}</p>
                        </div>
                        <div class="d-flex flex-column align-items-center">
                            <h5>Direspon</h5>
                            <p>{{ $pengaduans['today_sudah_direspon'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border border-5 border-success" style="width: 18rem; background-color: #08f100">
                <div class="card-body">
                    <h4 class="card-title fw-bold text-center">Pengaduan Bulan Ini</h4>
                    <div class="card-text d-flex justify-content-around">
                        <div class="d-flex flex-column align-items-center">
                            <h5>Belum Direspon</h5>
                            <p>{{ $pengaduans['bulan_ini_belum_direspon'] }}</p>
                        </div>
                        <div class="d-flex flex-column align-items-center">
                            <h5>Direspon</h5>
                            <p>{{ $pengaduans['bulan_ini_sudah_direspon'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center gap-4">
            <div class="card border border-5 border-danger" style="width: 18rem; background-color: #f04a4a">
                <div class="card-body">
                    <h4 class="card-title fw-bold text-center">Jumlah Pengguna</h4>
                    <div class="card-text d-flex justify-content-around">
                        <div class="d-flex flex-column align-items-center">
                            <h5>Baru Hari Ini</h5>
                            <p>{{ $user_today }}</p>
                        </div>
                        <div class="d-flex flex-column align-items-center">
                            <h5>Total</h5>
                            <p>{{ $total_user }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border border-5 border-primary" style="width: 18rem; background-color: #75a9ff">
                <div class="card-body">
                    <h4 class="card-title fw-bold text-center">Total Pengaduan</h4>
                    <div class="card-text d-flex justify-content-around">
                        <div class="d-flex flex-column align-items-center">
                            <h5>Belum Direspon</h5>
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
            <h3 class="text-center fw-bold py-3">Total Laporan Berdasarkan Kategori Pada {{ ($selected_month == 13) ? 'Semua Bulan' : 'Bulan ' . $selected_month }}</h3>
            <div class="d-flex justify-content-between w-100 container">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Pilih Bulan
                    </button>
                    <ul class="dropdown-menu" style="z-index: 99999">
                        @foreach($months as $i => $month)
                            <li><a class="dropdown-item" href="{{ url('admin?month=' . ++$i)  }}">{{ $month }}</a></li>
                        @endforeach
                            <li><a class="dropdown-item" href="{{ url('admin?month=13')  }}">Semua Bulan</a></li>
                    </ul>
                </div>
            </div>
            <canvas id="myChart"></canvas>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! $categories_name !!},
            datasets: [{
            label: 'Banyak Pengaduan',
            data: {{ $pengaduan_count }},
            backgroundColor: [
                'rgba(10, 125, 255, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
            }]
        },
        options: {
            scales: {
            y: {
                beginAtZero: true
            }
            },
            aspectRatio: 5 / 1,
            plugins: {
            legend: {
                display: true,
                position: 'top',
                labels: {
                generateLabels: function (chart) {
                    const data = chart.data;
                    if (data.labels.length && data.datasets.length) {
                    return data.labels.map(function (label, i) {
                        const meta = chart.getDatasetMeta(0);
                        const style = meta.controller.getStyle(i);

                        return {
                        text: label + ': ' + data.datasets[0].data[i],
                        fillStyle: style.backgroundColor,
                        strokeStyle: style.borderColor,
                        lineWidth: style.borderWidth,
                        hidden: isNaN(data.datasets[0].data[i]) || meta.data[i].hidden,
                        index: i
                        };
                    });
                    }
                    return [];
                }
                }
            }
            }
        }
        });
    </script>
@endpush
