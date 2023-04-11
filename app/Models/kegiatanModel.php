<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kegiatanModel extends Model
{
    use HasFactory;
    protected $table = 'kegiatan';
    protected $fillable = [
        'user_id',
        'admin',
        'pegawai',
        'judul_kegiatan',
        'isi_kegiatan',
        'tanggal_kegiatan'
    ];
}
