<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Peringatan extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
    'tgl_awal',
    'tgl_akhir',
    'id_karyawan',
    'user_aju_id',
    'pasal_id',
    'jenis_peringatan',
    'status_approve',
    'tanggal_approve',
    'user_approve_id',
    'note',
];

    public function karyawan()
    {
        return $this->belongsTo('App\Models\Karyawan','id_karyawan'); 
    }
    public function pasal()
    {
        return $this->belongsTo('App\Models\PasalPelanggaran','pasal_id'); 
    }
}

#namespace App\Models;

#use Illuminate\Database\Eloquent\Factories\HasFactory;
#use Illuminate\Database\Eloquent\Model;

#class Peringatan extends Model
#{
#    use HasFactory;
#    use HasFactory;
#    protected $fillable = [
#    'tgl_awal',
#    'tgl_akhir',
#    'id_karyawan',
#    'user_aju_id',
#    'pasal_id',
#    'jenis_peringatan',
#    'status_approve',
#    'tanggal_approve',
#    'user_approve_id',
#];
#}
?>
