@extends('admin.layout')

@section('content')
    <div class="bg-white mt-lg shadow">
        <div class="container py-2">
            <h2 class="my-4">Daftar Kegiatan</h2>
            <a href="{{ url('/admin/tambah_kegiatan') }}" class="btn btn-dark mb-3">Tambah Kegiatan</a>
        </div>
    </div>
    <div class="container my-5">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach($kegiatans as $kegiatan)
                <div class="col">
                    <div class="kegiatan card shadow-sm">
                        <div class="h-225 rounded-top overflow-hidden">
                            <img class="object-fit-cover"
                                 src="{{ $kegiatan->foto_kegiatan ? asset('storage/foto_kegiatan/' . $kegiatan->foto_kegiatan) : asset('/img/no-img-available.png') }}">
                        </div>
                        <div class="card-body d-flex justify-content-between flex-column">
                            <p class="card-title fw-bold">{{ $kegiatan->judul_kegiatan }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="{{ route('admin.edit-kegiatan', $kegiatan->slug) }}"
                                       class="btn btn-sm btn-outline-dark">Edit</a>
                                    <form action="{{ route('admin.delete-kegiatan', $kegiatan->slug) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal"
                                                data-bs-target="#modalChoice">Hapus
                                        </button>

                                        <div class="modal fade" tabindex="-1" role="dialog" data-bs-backdrop="static"
                                             data-bs-keyboard="false" aria-hidden="true" id="modalChoice">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content rounded-3 shadow">
                                                    <div class="modal-body p-4 text-center">
                                                        <h5 class="mb-3">Apakah Anda yakin ingin menghapus kegiatan
                                                            ini?</h5>
                                                        <p class="mb-0">Tindakan ini tidak dapat dibatalkan dan akan
                                                            menghapus semua informasi terkait dengan kegiatan tersebut.
                                                            Anda yakin?</p>
                                                    </div>
                                                    <div class="modal-footer flex-nowrap p-0">
                                                        <button type="submit"
                                                                class="btn btn-lg btn-link fs-6 text-danger text-decoration-none col-6 py-3 m-0 rounded-0 border-end"
                                                                data-bs-dismiss="modal"><strong>Ya, hapus</strong>
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-lg btn-link fs-6 text-dark text-decoration-none col-6 py-3 m-0 rounded-0"
                                                                data-bs-dismiss="modal">Batal
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <small class="text-body-secondary">{{ $kegiatan->tanggal_kegiatan }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js"></script>
    <script>
        $(document).ready(function () {
            $('.kegiatan').matchHeight();
        });
    </script>
@endpush
