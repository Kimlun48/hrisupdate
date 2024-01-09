<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeOff extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggal',
        'statusoff',
        'dokumen',
        'status_approve',
        'id_karyawan',
        'tanggal_approve',
        'notes',
        'fk_param',
        'notes_aju',

    ];

    public function karyawan()
    {
        return $this->belongsTo('App\Models\Karyawan', 'id_karyawan');
    }

    public function get_fkparam()
    {
        return $this->belongsTo('App\Models\ParamTimeOff', 'fk_param');
    }
}

