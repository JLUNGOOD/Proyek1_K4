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
        <th>Tanggal Kejadian</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($pengaduans as $i => $pengaduan)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $pengaduan->judul }}</td>
            <td>{{ $pengaduan->alamat }}</td>
            <td>{{ $pengaduan->tanggal_kejadian }}</td>
            @switch($pengaduan->status)
                @case('0') <td>Unsolved</td> @break
                @case('1') <td>Solved</td> @break
                @case('2') <td>On Progress</td> @break
                @case('3') <td>Rejected</td> @break
                @default <td>Invalid Status</td> @break
            @endswitch
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
