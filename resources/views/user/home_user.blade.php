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

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#82C3EC" fill-opacity="1" d="M0,96L30,128C60,160,120,224,180,245.3C240,267,300,245,360,224C420,203,480,181,540,181.3C600,181,660,203,720,213.3C780,224,840,224,900,202.7C960,181,1020,139,1080,138.7C1140,139,1200,181,1260,181.3C1320,181,1380,139,1410,117.3L1440,96L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z"></path></svg>
    
    <section id="kegiatan" class="pt-md-5 bg-aqua" style="margin-top: -50px">
      
      <h2 class="text-center my-5">Kegiatan</h2>

      <div class="container" id="card-container">
        <div class="row gy-3">
          @if(count($kegiatan)>0)
          @foreach($kegiatan as $k)
          <div class="col md-4">
            <div class="card h-60">
              <img src="https://pdamgianyar.co.id/upload/2c40249223e45301321fca78fc3fb368143354110820201013.jpg" alt="cekpipa" class="card-img-top" height="240px">
              <div class="card-body">
                <h5 class="card-title">PDAM Memperbaiki Pipa</h5>
                <p class="card-text">Kegiatan ini bertujuan untuk memperbaiki kerusakan pipa di daerah tersebut</p>
              </div>
            </div>
          </div>
          @endforeach
          @endif
          {{-- <div class="col md-4">
            <div class="card h-100">
              <img src="https://pudamtsgianyar.co.id/upload/b03bde2170ecd336ab7631c597636b2d142782989120211116.jpg" alt="cekpipa" class="card-img-top h-50">
              <div class="card-body">
                <h5 class="card-title">PDAM Mencatat</h5>
                <p class="card-text">Kegiatan ini dilakukan sebagai upaya untuk menunjang tempat pipa pdam</p>
              </div>
            </div>
          </div>
   
          <div class="col md-4">
            <div class="card h-100">
              <img src="https://www.pdamkutaitimur.com/wp-content/uploads/2020/05/WhatsApp-Image-2020-05-20-at-16.36.40.jpeg" alt="cekpipa" class="card-img-top h-50">
              <div class="card-body">
                <h5 class="card-title">PDAM Memberikan air</h5>
                <p class="card-text">Kegiatan ini dilakukan sebagai upaya untuk menunjang air di kawasan masyarakat yang jauh dari air</p>
              </div>
            </div>
          </div>

          <div class="col md-4">
            <div class="card h-100">
              <img src="https://pudamtsgianyar.co.id/upload/b03bde2170ecd336ab7631c597636b2d142782989120211116.jpg" alt="cekpipa" class="card-img-top h-50">
              <div class="card-body">
                <h5 class="card-title">PDAM Mencatat</h5>
                <p class="card-text">Kegiatan ini dilakukan sebagai upaya untuk menunjang tempat pipa pdam</p>
              </div>
            </div>
          </div>

          <div class="col md-4">
            <div class="card h-100">
              <img src="https://pdamgianyar.co.id/upload/2c40249223e45301321fca78fc3fb368143354110820201013.jpg" alt="cekpipa" class="card-img-top h-50">
              <div class="card-body">
                <h5 class="card-title">PDAM Memperbaiki Pipa</h5>
                <p class="card-text">Kegiatan ini bertujuan untuk memperbaiki kerusakan pipa di daerah tersebut</p>
              </div>
            </div>
          </div> --}}

        </div>
      </div>
    </section>
    
@endsection
