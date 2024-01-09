<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftPresensi extends Model
{
	use HasFactory;
	protected $fillable = [
        'hari',
        'id_karyawan',
        'id_parampresensi',
        'keterangan',
    ];
    public function fk_param(){
        return $this->belongsTo('App\Models\ParamPresensi','id_parampresensi');
    }
}
