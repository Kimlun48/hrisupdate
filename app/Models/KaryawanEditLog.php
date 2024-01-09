<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryawanEditLog extends Model
{
    use HasFactory;
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
        'user_update',
        'menu_akses',
    ];    
}
