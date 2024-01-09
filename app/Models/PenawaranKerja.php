<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenawaranKerja extends Model
{
    use HasFactory;
    protected $fillable = [
    'nama',
    'upah',
    'keterangan',
    'status_kerja',
    'tanggal_masuk',
    'lain_lain',
    'fk_apllyloker',
    'fk_bagian',
    'fk_cabang',
    'fk_level_jabatan',
    ];
    public function cabang(){ 
        return $this->belongsTo('App\Models\Cabang','fk_cabang'); 
        } 
    public function bagian(){ 
        return $this->belongsTo('App\Models\Bagian','fk_bagian'); 
        } 
}
