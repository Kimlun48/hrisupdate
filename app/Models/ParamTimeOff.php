<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParamTimeOff extends Model
{
    use HasFactory;
    protected $fillable = [
    'type',
    'nama',
    'kode',
    'durasi',
    'efektif_date',
    'expire_date',
    'status',
    'dokumen',
    'kuota',
	];

    protected static $choices = [
        'IZIN'  => 'Izin',
        'SAKIT' => 'Sakit',
        'CUTI'  => 'Cuti',
        'OTHER' => 'Lainnya',
    ];
    
    public static function ParTimeOfffChoice()
    {
        return self::$choices;
    }
    
}
