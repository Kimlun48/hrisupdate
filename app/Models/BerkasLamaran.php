<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasLamaran extends Model
{
	use HasFactory;
	protected $fillable = [
        'id_user',
        'pelamar_id',
        'tanggal',
        'cv',
        'lamaran',
        'photo',
        'ktp',
        'kk',
        'ijazah',
        'transkrip_nilai',
        'npwp',
        'vaksin',
        'sertipikat',
        'sim',
        'sio',
        'paklaring',
        'skck',
    ];
}
