<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Notifications\Notifiable;

class Karyawan extends Model
{
    use HasFactory,Notifiable;
    protected $fillable = [

	    'nama_lengkap',
        'nama_panggilan',
        'no_identitas',
        'golongan_darah',
        'status_pernikahan',
        'nama_ibu_kandung',
        'email',
        'gender',
        'tempat_lahir',
        'tgl_lahir',
        'agama',
        'photo',
        'medsos',
        'kontak_darurat',
        'no_telp',
        'no_hp',
        'alamat',
        'alamat_domisili',
        'rt',
        'rw',
        'desa',
        'kecamatan',
        'kota',
        'provinsi',
        'kodepos',
        'status_rumah',
        'pendidikan_terakhir',
        'no_ijazah',
        'nama_institusi',
        'instansi_ijazah',
        'jurusan',
        'gpa',
        'tahun_masuk_pendidikan',
        'tahun_lulus',
        'grade',
        'nomor_induk_karyawan',
        'fk_nama_perusahaan', //choice ke tabel (pt Ari, spbu, rkm, abm, ld)
        'fk_cabang', //choice ke tabel cabang (ayani, rancaekek dll)
        'fk_bagian', // choice ke tabel (supporting, dll)
        'fk_level_jabatan', //choice ke tabel (staff, spv, manager, direktur dll)
        'status_karyawan', //tetap, kontrak, probation hardcore
        'jenis_karyawan',
        'tahun_gabung',
        'tahun_keluar',
        'npwp',
        'no_rek1',
        'no_rek2',
        'bank1',
        'bank2',
        'jamkes_lainnya',
        'no_bpjs_tenaga_kerja',
        'keterangan_bpjs_tenaga_kerja',
        'bpjs_tenaga_kerja',
        'no_bpjs_kesehatan',
        'keterangan_bpjs',
        'bpjs_kesehatan',
        'upah',
        'masa_kerja',
        'expired_kontrak',
        'expired_kontrak_baru',
        'tanggal_pengangkatan',
        'ptpk_status',
        'fk_user',
        #'fk_tempat_lahir', //choice ke tabel kota/kab
        'jenis_identitas',
        'masa_berlaku_identitas',
        'no_finger',
        'brand', ##UNTuk KAryawan External
        'vendor', ##UNTuk KAryawan External
        'fk_jenis_kar', ##UNTuk Pembeda Internal Atau External
        'fk_user_update',
        'menu_akses_update',
        'approval_via', ##Approve nYa lewat apa PIC APPROVAL ATAU LEWAT JABATAN
    ];    
    public function cabang(){ 
        return $this->belongsTo('App\Models\Cabang','fk_cabang'); 
        } 
    public function jabatan(){ 
        return $this->belongsTo('App\Models\LevelJabatan','fk_level_jabatan'); 
        } 
    public function user(){ 
        return $this->belongsTo('App\Models\User','fk_user'); 
    }
    public function bagian()
    {
        return $this->belongsTo('App\Models\Bagian', 'fk_bagian');
    }    
    public function get_masakerja(){
	return Carbon::parse($this->tahun_gabung)->diff(Carbon::now())
		->format('%y Years %m Month');
    }
    
    public function karpres(){
        return $this->hasMany('App\Models\Presensi','id_karyawan','id');
    }

    public function karyawanWithPresensi(){
        return $this->hasMany('App\Models\Presensi','id_karyawan');
    }

    public function cuti(){
        return $this->hasMany('App\Models\CutiKaryawan','id_kar','id');
    }
    public function getparamcabang(){
        return $this->hasMany('App\Models\ParamCabang','id_kar','id');
    }
    public function getjeniskar(){
        return $this->belongsTo('App\Models\ParamJenisKaryawan','fk_jenis_kar');
    }
        

    // public function getAbsensiCount()
    // {
    //     $skr = Carbon::now()->toDateString();
    //     $minggulalu = Carbon::now()->subDays(7)->toDateString();
    //     $cekabsen = $this->with(['karpres' => function ($query) use ($minggulalu, $skr) {
    //             $query->whereBetween('tanggal', [$minggulalu, $skr])
    //                 ->where(function ($subquery) {
    //                     $subquery->whereNull('presensi_status')
    //                         ->orWhere('presensi_status', 'off');
    //                 });
    //         }])
    //         ->first();
    //     return optional($cekabsen->karpres)->count() ?? 0;
    // }
    
    public function getAbsensiCount()
    {
        // $skr = Carbon::now()->toDateString();
        // $minggulalu = Carbon::now()->subDays(7)->toDateString();

        $skr = date('Y-m-d');
        $minggulalu = date('Y-m-d', strtotime(date('Y-m-d'). ' - 7 days'));

         $hasil = $this->karpres()
            ->whereBetween('tanggal', [$minggulalu, $skr])
            ->where(function ($query) {
                $query->whereNull('presensi_status')
                    ->orWhere('presensi_status', 'off');
            })
            ->count();
            return $hasil > 0 ? $hasil : 10; ##Jika Tidak ada Shif nya dianggap tidak hadir dengan value
    }
}
