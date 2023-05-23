<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Psy\Util\Str;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kegiatan')->insert([
            [
                'user_id' => '1',
                'judul_kegiatan' => 'Pembersihan air yang keruh',
                'slug' => 'pembersihan-air-yang-keruh',
                'foto_kegiatan' => 'kegiatan1.jpeg',
                'isi_kegiatan' => 'pemeliharaan pipa dilaksanakan rutin sekali dalam satu bulan. Sebelumnya masyarakat akan diberikan imbauan dua atau tiga hari sebelumnya.
                    Namanya washout, atau pembuangan air di ujung pipa, semua pipa dibersihkan satu bulan sekali. Biasanya kami lakukan pukul 21.00 WIB hingga 02.00 WIB mulai dari pipa besar, dilanjutkan pagi hari pada pipa tersier, 
                    semuanya harus dibuang. Dampak dari pembersihan pipa tersebut, masyarakat akan menemukan air PDAM keruh atau terdapat endapan pada waktu tertentu.
                    Pembersihan pipa dilakukan sesuai standard operating procedure [SOP], mulai dari memastikam pipa induk yang berdekatan dengan produksi air bersih, kemudian dilanjutkan ke pipa cabang, hingga pipa tersier yang menuju ke pelanggan',
                'tanggal_kegiatan' => '2023-01-15'
            ],
            [
                'user_id' => '2',
                'judul_kegiatan' => 'Memperbaiki air yang  mati',
                'slug' => 'memperbaiki-air-yang-mati',
                'foto_kegiatan' => 'kegiatan2.jpeg',
                'isi_kegiatan' => 'Tim teknis PDAM Kota Malang bekerja keras untuk mengidentifikasi dan memperbaiki kerusakan pipa air yang menjadi penyebab utama matinya pasokan air. Dalam beberapa hari terakhir, tim telah melakukan patroli intensif untuk menemukan dan memperbaiki kerusakan pipa yang tersebar di beberapa wilayah kota.
                    Selain perbaikan pipa, PDAM Kota Malang juga melakukan pemeliharaan rutin pada instalasi air, seperti pemantauan pompa dan sistem penyaringan. Dalam proses ini, tim teknis memastikan bahwa peralatan bekerja dengan baik dan efisien untuk menjaga kelancaran pasokan air.
                    PDAM Kota Malang juga melibatkan masyarakat dalam proses perbaikan pasokan air. Masyarakat diberikan nomor pengaduan khusus untuk melaporkan kejadian air mati dan memberikan informasi penting kepada tim PDAM. Hal ini membantu tim PDAM dalam merespons cepat dan tepat terhadap keluhan masyarakat.
                    Dalam situasi darurat pasokan air yang mati, PDAM Kota Malang menyediakan pasokan air sementara melalui tangki-tangki air dan truk pengangkut air. Upaya ini dilakukan untuk memenuhi kebutuhan dasar masyarakat hingga perbaikan permanen selesai dilakukan.',
                'tanggal_kegiatan' => '2022-08-22'
            ],
            [
                'user_id' => '1',
                'judul_kegiatan' => 'Pembersihan Saluran yang bocor',
                'slug' => 'pembersihan-saluran-yang-bocor',
                'foto_kegiatan' => 'kegiatan3.jpeg',
                'isi_kegiatan' =>'Tim teknis PDAM Kota Malang telah melakukan patroli rutin pada saluran air dan berhasil mengidentifikasi adanya kebocoran yang signifikan. Keberadaan saluran bocor ini telah mempengaruhi pasokan air di beberapa wilayah selama beberapa waktu, menyebabkan ketidaknyamanan bagi masyarakat.
                    Dalam upaya memperbaiki saluran bocor, PDAM Kota Malang telah mengatur rencana perbaikan yang komprehensif. Tim teknis PDAM akan segera melakukan penggalian dan perbaikan pada titik kebocoran untuk memastikan saluran air kembali berfungsi dengan baik.
                    PDAM Kota Malang juga berkomitmen untuk melakukan pemeliharaan rutin pada saluran air guna mencegah terjadinya kerusakan serupa di masa depan. Langkah ini diambil untuk menjaga kelancaran pasokan air bersih dan meningkatkan kepuasan pelanggan.
                    Masyarakat di imbau untuk bersabar selama proses perbaikan saluran bocor ini berlangsung. PDAM Kota Malang juga menyediakan saluran air alternatif sementara melalui tangki-tangki air guna memenuhi kebutuhan dasar masyarakat selama perbaikan berlangsung.
                    PDAM Kota Malang menghimbau masyarakat untuk tetap menghubungi nomor pengaduan resmi yang telah disediakan jika terdapat masalah terkait pasokan air. Tim PDAM akan siap merespons dan memberikan informasi terkini kepada masyarakat.',
                'tanggal_kegiatan' => '2022-03-02'
            ],
            [
                'user_id' => '2',
                'judul_kegiatan' => 'Memperbaiki air tersumbat',
                'slug' => 'memperbaiki-air-yang-tersumbat',
                'foto_kegiatan' => 'kegiatan4.jpeg',
                'isi_kegiatan' => 'Dalam upaya memperbaiki saluran air yang tersumbat, PDAM Kota Malang mengatur rencana tindakan yang terstruktur. Tim teknis PDAM melakukan pembersihan dan penghilangan penyumbat dengan menggunakan peralatan khusus. Mereka bekerja secara teratur untuk memastikan saluran air kembali mengalir dengan lancar.
                    PDAM Kota Malang juga menghimbau masyarakat untuk tetap memperhatikan penggunaan air dengan bijak untuk menghindari potensi penyumbatan saluran air di masa mendatang. Kampanye kesadaran tentang pentingnya menjaga saluran air tetap bersih dan bebas penyumbatan akan dilakukan oleh PDAM.
                    Masyarakat yang masih mengalami masalah pasokan air di wilayah mereka diminta untuk segera melaporkan kepada PDAM Kota Malang melalui nomor pengaduan resmi yang telah disediakan. Tim PDAM akan terus memantau dan merespons keluhan masyarakat dengan segera.
                    Dengan berhasilnya perbaikan saluran air yang tersumbat ini, diharapkan pasokan air bersih di Kota Malang dapat kembali normal dan memberikan kenyamanan bagi masyarakat.',
                'tanggal_kegiatan' => '2022-03-12'
            ],
            [
                'user_id' => '1',
                'judul_kegiatan' => 'Memperbaiki aliran air',
                'slug' => 'memperbaiki-aliran-air',
                'foto_kegiatan' => 'kegiatan5.jpeg',
                'isi_kegiatan' => 'Tim teknis PDAM Kota Malang telah melakukan upaya pemulihan aliran air yang terganggu dengan segera. Mereka melakukan pemantauan terhadap sistem penyediaan air dan mendeteksi masalah yang menyebabkan terhentinya aliran air di beberapa wilayah kota.
                    Dalam upaya memperbaiki aliran air, PDAM Kota Malang melakukan perbaikan pada instalasi pompa dan pengaturan sistem distribusi air. Tim teknis PDAM bekerja keras untuk memastikan aliran air kembali normal dan masyarakat dapat menikmati pasokan air bersih yang stabil.
                    PDAM Kota Malang juga menghimbau masyarakat untuk menggunakan air dengan bijak dan menghindari pemborosan. Langkah ini diambil untuk menjaga keberlanjutan pasokan air bersih dan meminimalisir risiko terhentinya aliran air di masa mendatang.
                    Masyarakat diimbau untuk tetap menghubungi nomor pengaduan resmi PDAM Kota Malang jika terdapat masalah terkait aliran air di wilayah mereka. Tim PDAM siap merespons dan memberikan bantuan yang diperlukan.
                    Dengan berhasilnya perbaikan aliran air ini, diharapkan masyarakat Kota Malang dapat kembali menikmati pasokan air bersih yang lancar dan terjamin.',
                'tanggal_kegiatan' => '2022-04-22'
            ],
        ]);
    }
}
