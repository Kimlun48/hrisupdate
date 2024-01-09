<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatKerja extends Model
{
    use HasFactory;
    protected $fillable = [
        'perusahaan',
        'posisi',
        'alamat',
        'tanggal_masuk',
        'tanggal_keluar',
        'keterangan',
        'fk_pelamar',
        'fk_karyawan'
    ];
}
