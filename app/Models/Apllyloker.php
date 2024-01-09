<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apllyloker extends Model
{
    use HasFactory;
    protected $fillable = [
    'tanggal',
    'loker_id',
    'pelamar_id',
    'progres',
    'status',
    'user_id',
    ];  

    //////////////////////////////////////
    public function scopeFilter($query, array $filters,)
    {
        

        $query->when($filters['progres'] ?? false, function ($query, $progres) {
            return $query->where (function($query) use ($progres){
                $query->where('progres', 'like', '%' . $progres . '%')
                ->orWhere('status', 'like', '%' . $progres . '%');
            });
        });

        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->whereHas('pelamar', function ($query) use ($search) {
                $query->where('nama_lengkap', 'like' ,'%'.$search.'%')
                ->orwhere('kota', 'like', '%' . request('search') . '%')
                ->orwhere('nama_sekolah', 'like', '%' . request('search') . '%')
                ->orwhere('pendidikan_terakhir', 'like', '%' . request('search') . '%');
            })
            ->orwhereHas('loker', function ($query) {
                $query->where('lowongan_kerja', 'like', '%' . request('search') . '%');
            })
            ->orwhereHas('loker.cabang', function ($query) {
                $query->where('nama', 'like', '%' . request('search') . '%');
            });
            // ->orWhere('nama', 'like', '%' . $search . '%');
        });

       
    }
    ///////////////////////////////////


     

     
    
	public function loker(){ 
      return $this->belongsTo('App\Models\Loker'); 
	}    


	public function pelamar(){ 
      return $this->belongsTo('App\Models\Pelamar'); 
	}
      #public function fk_user(){ 
      #return $this->belongsTo('App\Models\User'); 
      #}
	
}
