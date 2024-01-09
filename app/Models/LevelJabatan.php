<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelJabatan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'kode',
	'status',
	'parent_id',
    'param_level',
    ];    

    public function parent(){
        return $this->belongsTo('App\Models\LevelJabatan','parent_id','id');
    }
    public function paramlevel(){
        return $this->belongsTo('App\Models\ParLevelJabatan','param_level');
    }

}
