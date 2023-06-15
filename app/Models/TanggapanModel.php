<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TanggapanModel extends Model
{
    use HasFactory;

    protected $table = 'tanggapan';
    protected $fillable = [
        'pengaduan_id',
        'user_id',
        'foto_tanggapan',
        'isi_tanggapan',
        'is_read',
    ];

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'id');
    }
}
