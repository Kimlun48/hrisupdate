<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryawanTransfer extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggal',
        'tgl_transfer',
        'id_karyawan',
        'type',
        'status_karyawan',
        'fk_cabang',
        'fk_bagian',
        'fk_level_jabatan',
        'fk_nama_perusahaan',
        'keterangan',
        'status_karyawan_lama',
        'fk_cabang_lama',
        'fk_bagian_lama',
        'fk_level_jabatan_lama',
        'fk_nama_perusahaan_lama',
        'status_approval',
        'signdate',
        'untildate'
    ];    
    public function cabang(){ 
        return $this->belongsTo('App\Models\Cabang','fk_cabang'); 
    } 

    public function jabatan(){ 
        return $this->belongsTo('App\Models\LevelJabatan','fk_level_jabatan'); 
    } 
    
    public function user(){ 
        return $this->belongsTo('App\Models\User','fk_user'); 
    }
    
    public function bagian()
    {
        return $this->belongsTo('App\Models\Bagian', 'fk_bagian');
    }    

    public function getkaryawan(){ 
        return $this->belongsTo('App\Models\Karyawan','id_karyawan'); 
    } 
    
    public function cabang_lama(){ 
        return $this->belongsTo('App\Models\Cabang','fk_cabang_lama'); 
    } 

    public function jabatan_lama(){ 
        return $this->belongsTo('App\Models\LevelJabatan','fk_level_jabatan_lama'); 
    } 
    
    public function bagian_lama()
    {
        return $this->belongsTo('App\Models\Bagian', 'fk_bagian_lama');
    }    

}

