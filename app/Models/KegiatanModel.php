<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanModel extends Model
{
    use HasFactory;
    protected $table = 'kegiatan';
    protected $fillable = [
        'user_id',
        'judul_kegiatan',
        'slug',
        'foto_kegiatan',
        'isi_kegiatan',
        'tanggal_kegiatan'
    ];

    public function user()
    {
        return $this->belongsTo(UserModel::class);
    }
}

