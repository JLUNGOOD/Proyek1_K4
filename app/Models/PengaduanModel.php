<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaduanModel extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';
    protected $fillable = [
        'user_id',
        'judul',
        'isi',
        'tanggal_kejadian',
        'bukti_gambar'
    ];
}
