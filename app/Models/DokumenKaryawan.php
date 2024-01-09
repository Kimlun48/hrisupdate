<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenKaryawan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_kar',
        'nama',
        'tipe_dok',
        'nomor_dok',
        'tanggal',
        'lokasi_penyimpanan',
        'dok_file'
    ];
    public function getkar(){ 
        return $this->belongsTo('App\Models\Karyawan','id_kar'); 
      }
}

