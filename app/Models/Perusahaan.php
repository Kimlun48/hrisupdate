<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'kode',
        'logo',
        'status',
    ];    
    public function cabang_pt(){
        return $this->hasMany('App\Models\Cabang','fk_nama_perusahaan','id');
        }
}
