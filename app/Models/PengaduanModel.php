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
        'kategori_id',
        'user_id',
        'judul',
        'alamat',
        'isi',
        'tanggal_kejadian',
        'bukti_gambar',
        'is_read'
    ];

    public function kategori() {
        return $this->belongsTo(KategoriModel::class);
    }

    public function user() {
        return $this->belongsTo(UserModel::class);
    }

    public function tanggapan() {
        return $this->hasOne(TanggapanModel::class, 'pengaduan_id', 'id');
    }
}
