@extends('admin.layout')
@section('content')
<div class="container my-5">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <form>
          <div class="mb-3">
            <label for="judu_kegiatan" class="form-label">Judul Kegiatan</label>
            <input type="text" class="form-control" name="judul_kegiatan" placeholder="Masukkan judul kegiatan">
          </div>

          <div class="mb-3">
            <label for="foto_kegiatan" class="form-label">Foto Kegiatan</label>
            <input type="file" class="form-control" name="foto_kegiatan">
            <div class="form-text">Ukuran file maksimum 5 MB</div>
          </div>

          <div class="mb-3">
            <label for="isi_kegiatan" class="form-label">Isi Kegiatan</label>
            <textarea class="form-control" name="isi_kegiatan" rows="8" placeholder="Tuliskan isi kegiatan"></textarea>
          </div>

          <div class="mb-3">
            <label for="tanggal_kegiatan" class="form-label">JTanggal Kegiatan</label>
            <input type="date" class="form-control" name="tanggal_kegiatan" placeholder="Masukkan tanggal kegiatan">
          </div>

          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
@endsection