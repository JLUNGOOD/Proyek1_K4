@extendsFirst([
    auth()->user()->role == 3 ? 'user.layout' : 'admin.layout',
    'user.layout',
])

@push('css')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
@endpush

@section('content')
    <div class="bg-white container mt-lg shadow rounded pb-4">
        <div class="container">
            @if(url('admin/tanggapi/' . $pengaduan->id) == url()->current())
                <a href="{{ url('admin/tanggapi') }}" class="btn btn-danger mt-3">Kembali</a>
            @elseif(url('semua_pengaduan/' . $pengaduan->id) == url()->current())
                <a href="{{ url('semua_pengaduan') }}" class="btn btn-danger mt-3">Kembali</a>
            @else
                <a href="{{ url('pengaduan_saya') }}" class="btn btn-danger mt-3">Kembali</a>
            @endif

            <div class="d-flex justify-content-between align-items-center">
                <h2 class="my-4 pt-2">Rincian Pengaduan</h2>
                @if(auth()->user()->role == 3)
                    @if($pengaduan->status == 0)
                        <span class="badge py-2 px-3 rounded-pill bg-dark">Unsolved</span>
                    @elseif($pengaduan->status == 2)
                        <span class="badge py-2 px-3 rounded-pill bg-warning">On progress</span>
                    @elseif($pengaduan->status == 1)
                        <span class="badge py-2 px-3 rounded-pill bg-success">Solved</span>
                    @elseif($pengaduan->status == 3)
                        <span class="badge py-2 px-3 rounded-pill bg-danger">Rejected</span>
                    @endif
                @else
                    <form class="d-flex align-items-center gap-2"
                          action="{{ url('/admin/tanggapan/update_status') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $pengaduan->id }}">
                        <label class="form-check">
                            <input type="radio" name="status" value="0"
                                   class="form-check-input" @checked($pengaduan->status == 0)> Unsolved
                        </label>
                        <label class="form-check">
                            <input type="radio" name="status" value="1"
                                   class="form-check-input" @checked($pengaduan->status == 1)> Solved
                        </label>
                        <label class="form-check">
                            <input type="radio" name="status" value="2"
                                   class="form-check-input" @checked($pengaduan->status == 2)> On Progress
                        </label>
                        <label class="form-check">
                            <input type="radio" name="status" value="3"
                                   class="form-check-input" @checked($pengaduan->status == 3)> Ditolak
                        </label>
                        <button class="btn btn-outline-dark" type="submit">Update Status</button>
                    </form>
                @endif
            </div>
            <div class="mb-3 row border-bottom">
                <label for="klarifikasi" class="col-sm-3 col-form-label fw-bold">Kategori Pengaduan</label>
                <div class="col-sm-9">
                    <input readonly class="form-control-plaintext" id="klarifikasi"
                           value="{{ $pengaduan->kategori->name }}">
                </div>
            </div>
            <div class="mb-3 row border-bottom">
                <label for="judul" class="col-sm-3 col-form-label fw-bold">Judul Pengaduan</label>
                <div class="col-sm-9">
                    <input readonly class="form-control-plaintext" id="judul" value="{{ $pengaduan->judul }}">
                </div>
            </div>
            <div class="mb-3 row border-bottom">
                <label for="alamat" class="col-sm-3 col-form-label fw-bold">Alamat Pengaduan</label>
                <div class="col-sm-9">
                    <input readonly class="form-control-plaintext" id="alamat" value="{{ $pengaduan->alamat }}">
                </div>
            </div>
            <div class="mb-3 row border-bottom">
                <label for="isi" class="col-sm-3 col-form-label fw-bold">Isi Pengaduan</label>
                <div class="col-sm-9">
                    <textarea readonly class="form-control-plaintext" rows="5" id="isi"
                              style="resize: none">{{ $pengaduan->isi }}</textarea>
                </div>
            </div>
            <div class="mb-3 row border-bottom">
                <label for="status" class="col-sm-3 col-form-label fw-bold">Status</label>
                <div class="col-sm-9">
                    <input readonly class="form-control-plaintext" id="status"
                           value="{{ isset($tanggapan) ? "Sudah ditanggapi" : "Belum direspon" }}">
                </div>
            </div>
            <div class="mb-3 row border-bottom">
                <label for="gambar" class="col-sm-3 col-form-label fw-bold">Bukti Gambar</label>
                <div class="col-sm-9">
                    @if($pengaduan->bukti_gambar)
                        <img src="{{ asset('storage/bukti_gambar_pengaduan/' . $pengaduan->bukti_gambar) }}"
                             alt="Bukti Gambar"
                             class="mb-3 border" width="200">
                    @else
                        <label>
                            <input readonly class="form-control-plaintext" value="-">
                        </label>
                    @endif
                </div>
            </div>
            <div class="mb-3 row border-bottom">
                <label for="tanggal" class="col-sm-3 col-form-label fw-bold">Tanggal Kejadian</label>
                <div class="col-sm-9">
                    <input readonly class="form-control-plaintext" id="tanggal"
                           value="{{ $pengaduan->tanggal_kejadian ?? '-' }}">
                </div>
            </div>
            <div class="mb-3 row border-bottom">
                <label for="nama" class="col-sm-3 col-form-label fw-bold">Nama Pelapor</label>
                <div class="col-sm-9">
                    <input readonly class="form-control-plaintext" id="nama"
                           value="{{ $pengaduan->user->name }}"
                    >
                </div>
            </div>
            <div class="mb-3 row border-bottom">
                <label for="email" class="col-sm-3 col-form-label fw-bold">Email Pelapor</label>
                <div class="col-sm-9">
                    <input readonly class="form-control-plaintext" id="email"
                           value="{{ $pengaduan->user->email }}"
                    >
                </div>
            </div>
            <div class="mb-3 row border-bottom ">
                <label for="tanggal_lapor" class="col-sm-3 col-form-label fw-bold">Tanggal Lapor</label>
                <div class="col-sm-9">
                    <input readonly class="form-control-plaintext" id="tanggal_lapor"
                           value="{{ $pengaduan->created_at ?? '-' }}">
                </div>
            </div>
        </div>
        @if(url('pengaduan_saya/' . $pengaduan->id) == url()->current())
            <form class="container">
                <h2 class="my-4 pt-2">Tanggapan</h2>
                @if(isset($tanggapan->user->name))
                    <div class="mb-3 row border-bottom">
                        <label for="ditanggapi-oleh" class="col-sm-3 col-form-label fw-bold">Ditanggapi Oleh</label>
                        <div class="col-sm-9">
                            <input readonly class="form-control-plaintext" id="ditanggapi-oleh"
                                   value="{{ $tanggapan->user->name }}">
                        </div>
                    </div>
                @endif
                <div class="mb-3 row border-bottom">
                    <label for="foto_tanggapan" class="form-label fw-bold">Bukti Foto</label>
                    <div>
                        <a class="image-popup d-inline-block" href="{{ asset('storage/foto_tanggapan/' . $tanggapan->foto_tanggapan) }}">
                            <img src="{{ asset('storage/foto_tanggapan/' . $tanggapan->foto_tanggapan) }}"
                                 class="img-preview d-block rounded border mb-2" alt="Image Preview">
                        </a>
                    </div>
                </div>
                <div class="mb-3 row border-bottom">
                    <label for="isi-tanggapan" class="col-sm-3 col-form-label fw-bold">Tanggapan</label>
                    <div class="col-sm-9">
                        <textarea class="form-control-plaintext" id="isi-tanggapan"
                                  rows="3" readonly>{{ $tanggapan->isi_tanggapan ?? 'Belum Ditanggapi' }}</textarea>
                    </div>
                </div>
            </form>
        @elseif(!isset($tanggapan))
            <p>
                <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#tanggapi"
                        aria-expanded="false" aria-controls="collapseExample">
                    Beri Tanggapan <i class="ps-2 fas fa-angle-down"></i>
                </button>
            </p>
            <div class="collapse" id="tanggapi">
                <div class="card card-body mb-3">
                    <form method="post" action="{{ url('/admin/send_tanggapan') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ auth()->user()->id ?? null }}" name="user_id">
                        <input type="hidden" value="{{ $pengaduan->id }}" name="pengaduan_id">
                        <div class="d-flex gap-2">
                            <b>Status : </b>
                            <label class="form-check">
                                <input type="radio" name="status" value="1"
                                       class="form-check-input"> Solved
                            </label>
                            <label class="form-check">
                                <input type="radio" name="status" value="2"
                                       class="form-check-input"> On Progress
                            </label>
                            <label class="form-check">
                                <input type="radio" name="status" value="3"
                                       class="form-check-input"> Ditolak
                            </label>
                        </div>
                        <div class="mb-3">
                            <label for="foto_kegiatan" class="form-label fw-bold">Foto Kegiatan</label>
                            <div>
                                <a class="image-popup d-inline-block" href="{{ asset('/img/no-img-available.png') }}">
                                    <img src="{{ asset('/img/no-img-available.png') }}"
                                         class="img-preview d-block rounded border mb-2" alt="Image Preview">
                                </a>
                            </div>
                            <input type="file" class="form-control @error('foto_tanggapan') is-invalid @enderror"
                                   name="foto_tanggapan" id="foto_tanggapan" value="{{ old('foto_tanggapan') }}">
                            <div class="form-text">Ukuran file maksimum 5 MB</div>
                            @error('foto_tanggapan')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="isi" class="form-label fw-bold">Isi Tanggapan</label>
                            <textarea class="form-control" name="isi_tanggapan" id="isi_tanggapan" rows="3"
                                      placeholder="Ketik Tanggapan *" required></textarea>
                            <div id="catatan" class="form-text">
                                Catatan: Tanggapan yang sudah dikirim tidak bisa diubah.
                            </div>
                        </div>
                        <button type="submit" name="tanggapan" class="btn btn-dark">Kirim</button>
                    </form>
                </div>
            </div>
        @else
            <form class="container">
                <h2 class="my-4 pt-2">Tanggapan</h2>
                <div class="mb-3 row border-bottom">
                    <label for="ditanggapi-oleh" class="col-sm-3 col-form-label fw-bold">Ditanggapi Oleh</label>
                    <div class="col-sm-9">
                        <input readonly class="form-control-plaintext" id="ditanggapi-oleh"
                               value="{{ $tanggapan->user->name }}">
                    </div>
                </div>
                <div class="mb-3 row border-bottom">
                    <label for="foto_tanggapan" class="form-label fw-bold">Bukti Foto</label>
                    <div>
                        <a class="image-popup d-inline-block" href="{{ asset('storage/foto_tanggapan/' . $tanggapan->foto_tanggapan) }}">
                            <img src="{{ asset('storage/foto_tanggapan/' . $tanggapan->foto_tanggapan) }}"
                                 class="img-preview d-block rounded border mb-2" alt="Image Preview">
                        </a>
                    </div>
                </div>
                <div class="mb-3 row border-bottom">
                    <label for="isi-tanggapan" class="col-sm-3 col-form-label fw-bold">Isi Tanggapan</label>
                    <div class="col-sm-9">
                        <textarea class="form-control-plaintext" id="isi-tanggapan"
                                  rows="3" readonly>{{ $tanggapan->isi_tanggapan }}</textarea>
                    </div>
                </div>
            </form>
        @endif
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" data-bs-keyboard="false" aria-hidden="true"
         id="modalLoginSuccess">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-3 shadow d-flex">
                <div class="modal-header border-bottom-0">
                    <h1 class="modal-title fs-5">Tanggapan berhasil dikirim!</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-0">
                    <p>Anda dapat mulai mulai menganggapi pengaduan yang lain.</p>
                </div>
                <div class="modal-footer flex-column border-top-0">
                    <button type="button" class="btn btn-dark w-100" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.image-popup').magnificPopup({
                type: 'image',
                zoom: {
                    enabled: true,
                    duration: 300,
                    easing: 'ease-in-out'
                }
            });

            $('#foto_tanggapan').change(function () {
                const file = this.files[0];
                const reader = new FileReader();
                const imagePreview = $('.img-preview');
                const imagePopup = $('.image-popup');

                reader.onload = function (e) {
                    if (file.type.includes('image')) {
                        imagePreview.attr('src', e.target.result);
                        imagePopup.attr('href', e.target.result);
                    }
                };

                if (file) {
                    reader.readAsDataURL(file);
                } else {
                    const defaultImage = '{{ asset('/img/no-img-available.png') }}';
                    imagePreview.attr('src', defaultImage);
                    imagePopup.attr('href', defaultImage);
                }
            });

        });
    </script>

    @if(session('message' ))
        <script>
            $(document).ready(function () {
                $('#modalLoginSuccess').modal('show');
            });
        </script>
    @endif
@endpush
