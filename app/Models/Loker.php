<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loker extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'posisi_id',
        'fk_penempatan',
        'lowongan_kerja',
        'deskripsi',
        'kualifikasi',
        'status', ##jika 1 Maka Aktif Klo 0 Maka Non Aktif
        'tanggal',
        'dok_header',
        'dok_poster',
        'pendidikan',
        'pengalaman',
        'level_job',
        'kategory_job',  
    ];
    public function cabang(){ 
      return $this->belongsTo('App\Models\Cabang','fk_penempatan'); 
	  } 
    public function posisi(){ 
      return $this->belongsTo('App\Models\Posisijob'); 
	  }    
      public function apply()
    {
       return $this->hasMany('App\Models\Apllyloker');
    }
}	
