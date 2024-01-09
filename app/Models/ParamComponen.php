<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParamComponen extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'jenis',
        'status_tunjangan',
	'status_aktif',
	'komponen',
    ];
}
