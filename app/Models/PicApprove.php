<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PicApprove extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_kar',
        'kar_approve',
        'status',
    ];    
    public function get_kar(){ 
        return $this->belongsTo('App\Models\Karyawan','id_kar'); 
    } 
    public function get_kar_approve(){ 
        return $this->belongsTo('App\Models\Karyawan','kar_approve'); 
    } 
}
