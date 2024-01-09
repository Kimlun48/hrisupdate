<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul',
        'isi',
        'tanggal',
        'dokumen',
        'status',
        'id_user',
    ];    

    public function getuser()
    {
        return $this->belongsTo('App\Models\User', 'id_user');
    }
    

}

