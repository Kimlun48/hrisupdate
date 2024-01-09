<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasalPelanggaran extends Model
{
    protected $fillable = [
        'pasal', 'ayat', 'isiayat','status',
    ];
}


