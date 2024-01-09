<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiEditLog extends Model
{
    use HasFactory;
    protected $fillable = [ 
            'tanggal',
            'jam_masuk',
            'jam_pulang',
            'image_masuk',
            'image_pulang',
            'latitude',
            'longitude',
            'latitude_pulang',
            'longitude_pulang',
	        'keterangan', //cuti,absen keluar,pulang cepat,masuk siang dll
            'presensi_status', //Ontime,Late,cuti,off,
            'presensi_status_pulang',
            'id_karyawan',           
            'id_user',
            'istirahat_keluar',
            'istirahat_masuk',
            'fk_overtime',          
            'fk_timeoff',
            'user_update',
            'menu_update'
    ];
}
