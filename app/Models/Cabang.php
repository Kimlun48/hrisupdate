<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'kode',
        'alamat',
        'no_hp',
        'no_telp',
        'fk_nama_perusahaan',
        'dokumen',
	'status',
	'longitude',
	'latitude',
	'radius',
	'satuan_radius'
	
    ];
    public function perusahaan(){ 
        return $this->belongsTo('App\Models\Perusahaan','fk_nama_perusahaan'); 
    } 
    #public function loker(){
    #    return $this->belongsTo('App\Models\Loker','id','fk_penempatan');
    #    }
    public function loker(){
        return $this->hasMany('App\Models\Loker','fk_penempatan');
    }
}
