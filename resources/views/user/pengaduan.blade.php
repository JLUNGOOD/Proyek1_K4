@extends('user.layout')

@section('content')
    <div id="lapor" class="container px-4 py-5">
        <div class="shadow-lg p-3 my-5 bg-body rounded">
            <h1 class="display-5 my-4 fw-bold text-center">Sampaikan Pengaduan Anda</h1>
            <form enctype="multipart/form-data" action="#lapor" method="post" name="formLaporan">
                <div class="mb-3">
                    <label for="kategori" class="form-label fw-bold">Kategori Pengaduan</label>
                    <select class="form-select" id="kategori" name="kategori_id">
                        <option selected>Pilih Kategori Pengaduan Anda</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="judul" class="form-label fw-bold">Judul Pengaduan</label>
                    <input class="form-control" name="judul" id="judul" aria-describedby="judul"
                           placeholder="Ketik Judul Laporan Anda *" required>
                </div>
                <div class="mb-3">
                    <label for="isi" class="form-label fw-bold">Isi Pengadauan</label>
                    <textarea class="form-control" name="isi" id="isi" rows="3"
                              placeholder="Ketik Isi Pengaduan Anda *" required></textarea>
                </div>
                <div class="isComplaint">
                    <div class="mb-3">
                        <label for="gambar" class="form-label fw-bold">Unggah Bukti Gambar</label>
                        <input type="file" class="form-control" name="bukti_gambar" id="gambar"
                               aria-describedby="gambar">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label fw-bold">Tanggal Kejadian</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal" value=""
                               aria-describedby="tanggalKejadian">
                    </div>
                </div>
                <button type="submit" name="lapor" class="btn btn-dark d-block mb-4">LAPOR</button>
            </form>
        </div>
    </div>
@endsection

