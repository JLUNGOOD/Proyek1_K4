<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TanggapanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tanggapan')->insert([
            [
                'pengaduan_id' => '7',
                'user_id' => '1',
                'isi_tanggapan' => 'Kami akan segera memperbaiki satu',
                'is_read' => '0'
            ],
            [
                'pengaduan_id' => '8',
                'user_id' => '2',
                'isi_tanggapan' => 'Kami akan segera memperbaiki dua',
                'is_read' => '0'
            ],
            [
                'pengaduan_id' => '9',
                'user_id' => '1',
                'isi_tanggapan' => 'Kami akan segera memperbaiki tiga',
                'is_read' => '0'
            ],
            [
                'pengaduan_id' => '10',
                'user_id' => '2',
                'isi_tanggapan' => 'Kami akan segera memperbaiki empat',
                'is_read' => '0'
            ],
            [
                'pengaduan_id' => '11',
                'user_id' => '1',
                'isi_tanggapan' => 'Kami akan segera memperbaiki lima',
                'is_read' => '0'
            ],
        ]);
    }
}
