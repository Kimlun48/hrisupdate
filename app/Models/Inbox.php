<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    use HasFactory;

    protected $table = 'inbox';

    protected $fillable = [
        'pengirim_id',
        'penerima_id',
        'title',
        'isi_pengirim',
        'isi_penerima',
        'status_atasan',
        'status_bawahan',   
        'id_presensi_requests',
        'id_time_offs',
        'id_change_shift',
    ];


    public function pengirim()
    {
        return $this->belongsTo('App\Models\User', 'pengirim_id');
    }

    public function penerima()
    {
        return $this->belongsTo('App\Models\User', 'penerima_id');
    }

    public function timeoff()
    {
        return $this->belongsTo('App\Models\TimeOff', 'id_time_offs');
    }
    public function presensireq()
    {
        return $this->belongsTo('App\Models\PrensensiRequest', 'id_presensi_requests');
    }
}
