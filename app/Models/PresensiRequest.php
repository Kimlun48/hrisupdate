<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiRequest extends Model
{
    use HasFactory;
    protected $fillable = [
    'tanggal',
    'jam',
    'id_karyawan',
    'status_approve',
    'tanggal_approve',
    'notes',
    'user_approve_id',
    'jenis',
 
    #'tanggal',
    #'jam_masuk',
    #'jam_pulang',
    #'id_karyawan',
    #'status_approve',
    #'tanggal_approve',
    #'notes',
    #'user_approve_id',
    ];

    public function karyawan()
    {
        return $this->belongsTo('App\Models\Karyawan', 'id_karyawan');
    }

    public function getuserapprove()
    {
        return $this->belongsTo('App\Models\User', 'user_approve_id');
    }
}

