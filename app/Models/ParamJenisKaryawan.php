<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParamJenisKaryawan extends Model
{
    use HasFactory;
    protected $fillable = [
    'nama',
    'jenis_kar',
    'no_urut',
    'status',
    'format_depan_nik'
    ];
}
