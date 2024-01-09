<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParamPresensi extends Model
{
    use HasFactory;
    protected $fillable = [
        'awal_absen_masuk',
        'jam_masuk',
		'maks_telat',
		'jam_pulang',
		'status',
		'jenis_shift',
		'jenis_karyawan',
	];
}
