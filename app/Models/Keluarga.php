<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    use HasFactory;
    protected $fillable = [
        'anggota', 'nama', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'pendidikan', 'pekerjaan', 'usia', 'urutan_anak', 'keterangan', 'fk_pelamar','fk_karyawan'
    ];
    public function fk_pelamar()
    {
        return $this->belongsTo('App\Models\Pelamar', 'fk_pelamar');
    }
}
