<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelamar extends Model
{
    use HasFactory;
    protected $fillable = [
	'nama_lengkap',
	'nik',
	'no_hp',
	'no_telp',
	'tgl_lahir',
	'agama',
	'photo',
	'gender',
	'tempat_lahir',
	'status_pernikahan',
	'cv',
	'alamat',
	'rt',
	'rw',
	'desa',
	'kecamatan',
	'kota',
	'provinsi',
	'kodepos',
	'status_rumah',
	'pendidikan_terakhir',
	'nama_sekolah',
	'jurusan',
	'tahun_masuk',
	'tahun_lulus',
	'ipk',
	'hubungan_keluarga',
	'fk_user', 
	'sosial_media',
	'referensi_job'
    ];

	public function userlamar(){ 
		return $this->belongsTo('App\Models\User','fk_user'); 
		}
}
