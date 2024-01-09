<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPraPayrol extends Model
{
    use HasFactory;
    protected $fillable = [
    'id_kar',
    'id_param',
    'nilai',
    'periode',
    ];

    public function karyawan(){ 
        return $this->belongsTo('App\Models\Karyawan','id_kar'); 
    }
}

