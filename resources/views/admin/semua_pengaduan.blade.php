@extends('admin.layout')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endpush

@section('content')
    <div class="bg-white mt-lg pb-4 shadow">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center py-2">
                <h2 class="my-4">Daftar Pengaduan</h2>
                <p>
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#formCetakLaporan" aria-expanded="false" aria-controls="formCetakLaporan">
                        Cetak Laporan
                    </button>
                </p>
            </div>

        </div>
    </div>
    <div class="container py-5">
        <table class="table table-striped" id="data-pengaduan">
            <thead>
            <tr>
                <th>No</th>
                <th>Topik</th>
                <th>Alamat</th>
                <th>Tanggal Kejadian</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection

@push('script')
    <!-- DataTables  & Plugins -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
            charset="utf-8"></script>

    <script>
        $(document).ready(function (){
            var dataPengaduan = $('#data-pengaduan').DataTable({
                processing:true,
                serverSide:true,
                ajax:{
                    'url': '{{  url('/semua_pengaduan/get_data') }}',
                    'dataType': 'json',
                    'type': 'GET',
                },
                columns:[
                    {data:'DT_RowIndex',name:'DT_RowIndex'},
                    {data:'judul',name:'judul'},
                    {data:'alamat',name:'alamat'},
                    {data:'tanggal_kejadian',name:'tanggal_kejadian'},
                    {data:'status',name:'status'},
                    {data:'id', orderable: false, searchable: false,
                        render: (id, type, row) => `<a href="{{ url('/admin/tanggapi') }}/${id}" class="btn btn-sm btn-info mr-2"><i class="fa fa-eye mr-1"></i>Show</a>`
                    },
                ]
            });
        });
    </script>
@endpush
