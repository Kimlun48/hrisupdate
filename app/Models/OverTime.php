<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OverTime extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'id_kar',
        'tanggal',
        'tanggal_overtime',
        'mulai',
        'akhir',
        'durasi',
        'status_approve',
        'kompensasi',
        'note',
        'user_approve',
        'tgl_approve',
];
    public function getkar(){ 
        return $this->belongsTo('App\Models\Karyawan','id_kar'); 
      }
      public function getuser_approve(){ 
        return $this->belongsTo('App\Models\User','user_approve'); 
      }      
}
