<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeShift extends Model
{
	use HasFactory;
	protected $fillable = [
        'shift_awal',
        'tanggal_awal',
        'shift_akhir',
        'tanggal_akhir',
        'id_karyawan',
        'keterangan',
        'status_approve',
        'tanggal_approve',
	'notes',
        'shift_off',
        'tanggal_off',
    ];

}
