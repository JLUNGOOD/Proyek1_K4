<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TanggapanModel extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';
    protected $fillable = [
        'pengaduan_id',
        'user_id',
        'isi_tanggapan'
    ];
}
