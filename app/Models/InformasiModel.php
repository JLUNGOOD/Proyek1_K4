<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiModel extends Model
{
    use HasFactory;

    protected $table = 'informasi';
    protected $fillable = ['user_id', 'judul_informasi', 'isi_informasi'];
}
