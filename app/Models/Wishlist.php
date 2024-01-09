<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $fillable = [
        'loker_id',
        'id_user',
        'pelamar_id',
    ];

    public function loker()
    {
        return $this->belongsTo('App\Models\Loker');
    }
}

