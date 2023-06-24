<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-content: center;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: lightgray;
        }
    </style>
</head>
<body>
<h1>Laporan Pengaduan PDAM Kota Malang</h1>
<h3>Periode {{ $dateStart }} - {{ $dateEnd }}</h3>
<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Topik</th>
        <th>Alamat</th>
        <th>Tanggal Pengaduan</th>
        <th>Status</th>
        <th>Tanggal Tanggapan</th>
        <th>Tanggapan</th>
    </tr>
    </thead>
    <tbody>
        @foreach($pengaduans as $i => $pengaduan)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $pengaduan->judul }}</td>
                <td>{{ $pengaduan->alamat }}</td>
                <td>{{ $pengaduan->created_at }}</td>
                @switch($pengaduan->status)
                    @case('0') <td>Unsolved</td> @break
                    @case('1') <td>Solved</td> @break
                    @case('2') <td>On Progress</td> @break
                    @case('3') <td>Rejected</td> @break
                    @default <td>Invalid Status</td> @break
                @endswitch
                @if($pengaduan->status != 0 && $pengaduan->tanggapan->pengaduan())
                    <td>{{ $pengaduan->tanggapan->created_at }}</td>
                    <td>{{ $pengaduan->tanggapan->isi_tanggapan }}</td>
                @else
                    <td>-</td>
                    <td>-</td>
                @endif
            </tr>
        @endforeach
        
    </tbody>
</table>
</body>
</html>
