<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubBagian extends Model
{
    use HasFactory;
    protected $fillable = [
    'nama',
	'kode',
	'fk_bagian',
    ];        
        public function bagian_subbagian(){
          return $this->belongsTo('App\Models\Bagian');
	}
}
