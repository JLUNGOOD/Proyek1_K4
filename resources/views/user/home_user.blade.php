@extends('user.layout')

@section('content')
    <div class="bg-aqua">
        <div class="container px-4 py-5 h-100vh d-flex">
            <div class="row flex-lg-row-reverse align-items-center">
                <div class="col-10 col-sm-8 col-lg-6 mx-auto">
                    <img src="{{ asset('img/undraw_Online_test_re_kyfx.png') }}" class="img-fluid" alt="Data Reports"
                         loading="lazy">
                </div>
                <div class="col-lg-6 mt-3">
                    <h1 class="display-5 fw-bold mb-4">Layanan Aspirasi dan Pengaduan Online PDAM Masyarakat Kota</h1>
                    <div class="d-md-flex">
                        <a href="#tentang" role="button" class="btn btn-dark btn-lg px-4 me-md-2">Jelajahi<i
                                class="fas fa-chevron-down ms-2 fs-6"></i></a>
                        <a href="#lapor" role="button" class="btn btn-outline-dark btn-lg px-4">Lapor</a>
                    </div>
                </div>
            </div>
        </div>
        <img src="{{ asset('img/wave.svg') }}" alt="Wave">
    </div>

    <div id="#" class="container px-4 py-3">
        <div class="row flex-lg-row align-items-center">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="{{ asset('img/undraw_Profile_re_4a55.png') }}" class="d-block mx-lg-auto img-fluid"
                     alt="Data Reports"
                     loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold mb-4">Tentang Website Keluhan Pelanggan PDAM</h1>
                <div class="mx-auto">
                    <p class="lead mb-4">Pengelolaan pengaduan pelayanan publik mengenai PDAM di Kota ini belum
                        terkelola secara
                        efektif dan terintegrasi. Masyarakat Kota masih sulit dalam menyampaikan pengaduan atau
                        aspirasinya. Dengan adanya website ini Masyarakat Kota dengan mudah dapat menyalurkan aduannya
                        atau aspirasinya dengan menggunakan website ini.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container d-flex justify-content-start px-4 py-3">
        <div class="card me-2" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
              <p class="card-text">Ini berisi kegiatan PDAM Kota</p>
            </div>
          </div>
          <div class="card me-2" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
              <p class="card-text">Kegiatan ini bertujuan untuk membuat tanggul air</p>
            </div>
          </div>
          <div class="card me-2" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
              <p class="card-text">Kegiatan bersama warga</p>
            </div>
          </div>
          <div class="card me-2" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
              <p class="card-text">Kegiatan bersama warga</p>
            </div>
          </div>
    </div>
@endsection
