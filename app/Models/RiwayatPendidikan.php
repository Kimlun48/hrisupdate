<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPendidikan extends Model
{
    use HasFactory;
    protected $fillable = [
        'pendidikan', 'institusi', 'jurusan', 'tempat', 'tahun_masuk',
        'tahun_keluar', 'keterangan', 'nilai', 'fk_pelamar',
    ];
}

