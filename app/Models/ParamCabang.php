<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParamCabang extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_kar',
        'id_cabang',
        'status',
    ];
 
    public function getkaryawan(){ 
        return $this->belongsTo('App\Models\Karyawan','id_kar'); 
      }    
      public function getcabang(){ 
        return $this->belongsTo('App\Models\Cabang','id_cabang'); 
      }
}

