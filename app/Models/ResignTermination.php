<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResignTermination extends Model
{
    use HasFactory;
    protected $fillable = [
    'tanggal',
    'tanggal_pengajuan',
    'tanggal_akhirkerja',
    'status', ##RESIGN/PHK
    'dokumen',
    'karyawan_id',
    'status_approve',
    'tanggal_approve',
    'notes',
    ];
    public function karyawan(){ 
        return $this->belongsTo('App\Models\Karyawan','karyawan_id'); 
    } 
}

