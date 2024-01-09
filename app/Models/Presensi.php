<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Presensi extends Model
{
	use HasFactory;
	protected $fillable = [ 
		'id_user',
		'image_masuk',
		'jam_masuk',
		'latitude',
		'longitude',
		'tanggal',
		'id_karyawan',
		'image_pulang',
		'jam_pulang',
		'latitude_pulang',
		'longitude_pulang',
		'id_parampresensi',
		'keterangan',
		'presensi_status',
		'istirahat_keluar',
		'istirahat_masuk',
		'fk_overtime',
		'presensi_status_pulang',
		'fk_timeoff',
		'user_update',
        'menu_update'
	];
	protected $with = ['preskaryawan', 'parampresensi'];


	public function get_fk_timeoff(){ 
        return $this->belongsTo('App\Models\TimeOff','fk_timeoff'); 
        } 

	public function preskaryawan(){ 
        #return $this->hasMany('App\Models\Karyawan');
        return $this->belongsTo('App\Models\Karyawan','id_karyawan'); 
	}

	public function presensiWithKaryawan(){ 
        return $this->belongsTo('App\Models\Karyawan','id'); 
	}
	
        #public function fk_param(){
        #return $this->belongsTo('App\Models\ParamPresensi','id_parampresensi');
        #}
        public function parampresensi(){
        return $this->belongsTo('App\Models\ParamPresensi','id_parampresensi');
        }
		public function EarlyIn($query)
		{
			$skr = Carbon::now()->toDateString();
			 return $query->whereDate('tanggal', '=', $skr)
				->where('presensi_status', '=', 'EarlyIn')
				->whereHas('preskaryawan.getjeniskar', function ($query) {
					$query->where('jenis_kar', '=', 'Internal');
				})
				->count();
				}

	public function getkodeabsen()
    {     
		// if ($this->jam_masuk !== null && $this->jam_pulang !== null) {
        //     return 'H'.$this->attributes['jam_masuk'];
        // } 
		// if ($this->jam_masuk !== null && $this->jam_pulang == null) {
        //     return 'H/NCO'.$this->attributes['jam_masuk'];
        // } 
		// if ($this->jam_masuk == "off") {
        //     return 'OFF'.$this->attributes['jam_masuk'];
        // } 

        // Periksa apakah kolom 'jammasuk' diisi atau null
		if ($this->attributes['jam_masuk'] == null && $this->attributes['jam_pulang'] == null) {
            return 'A';
        } 
        if ($this->attributes['jam_masuk'] !== null && $this->attributes['jam_pulang'] !== null) {
            return 'H';
        } 
		if ($this->attributes['jam_masuk'] !== null && $this->attributes['jam_pulang'] == null) {
            return 'H/NCO';
        }
    }
}
