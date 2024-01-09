<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rehire extends Model
{
    use HasFactory;
    protected $fillable = [
            'nomor_induk_karyawan',
            'jenis_karyawan', 
            'tahun_gabung_lama',
            'tahun_keluar_lama',
            'upah',
            'masa_kerja',
            'ptpk_status',
            'email',
            'tanggal_pengangkatan',
            'status', //Rehire
            'tanggal_rehire',
            'tanggal_effektif',
            //History Id Karyawans Lamanya
            'id_kar',
            //choice ke tabel cabang (ayani, rancaekek dll)
            'fk_cabang',
            // choice ke tabel (supporting, dll)
            'fk_bagian',
            //choice ke tabel (staff, spv, manager, direktur dll)
            'fk_level_jabatan',
            'status_karyawan', //tetap, kontrak, probation hardcore
            'fk_nama_perusahaan',
            'fk_user',
            'id_resign',          
            'keterangan',
        ];
}
