<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CutiKaryawan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_kar',
        'mulai_cuti',
        'akhir_cuti',
        'jumlah_cuti',
        'sisa_cuti',
        'tahun',
    ];	
    public function karyawan()
    {
        return $this->belongsTo('App\Models\Karyawan','id_kar'); 
    }
}
