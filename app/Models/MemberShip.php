<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberShip extends Model
{
    use HasFactory;
    protected $fillable = [
        'loyaltycode', 'nama', 'loyaltykategori', 'gender', 'idtype', 'idnum', 'pendididkan', 'alamat', 'provinsi',
        'kota', 'kecamatan', 'kelurahan', 'kodepos', 'email', 'job', 'tempatlahir', 'tgllahir', 'agama', 'statusnikah',
	'statusaktif', 'loyaltypotensi','notelp'

    ];
}

