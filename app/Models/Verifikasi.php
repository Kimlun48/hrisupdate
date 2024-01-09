<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verifikasi extends Model
{
    use HasFactory;
        protected $fillable = [
    'fk_apply',
    'waktu',
    'status',
    'note',
    'maker',
    'progres',
    ];

	public function gt_fkapply(){ 
        return $this->belongsTo('App\Models\Apllyloker', 'fk_apply'); 
      }     
}
