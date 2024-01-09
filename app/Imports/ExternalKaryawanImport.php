<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Karyawan;
use App\Models\Cabang;
use App\Models\Bagian;
use App\Models\LevelJabatan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\ToCollection;
use DateTime;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Spatie\Permission\Models\Role;


class ExternalKaryawanImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }

    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }

    public function model(array $row)
    {
        $role = Role::where('name','=','Karyawan')->first();
        $cek_email = User::where('email', $row[25])->first();
        $cek_email_kar = Karyawan::where('email', $row[25])->first();
        $cek_nik_kar = Karyawan::where('nomor_induk_karyawan', $row[1])->first();
        $cekcabang = Cabang::where('nama','LIKE','%'.$row[8].'%')->first();
        // $cekcabang = Cabang::where('nama', $row[8])->first();
        $cekbagian = Bagian::where('id', 1)->first();
        $ceklevjab = LevelJabatan::where('nama','LIKE','%'.$row[11].'%')->first();
        
        // dd($ceklevjab);
        $tgllahir = Carbon::createFromTimestamp(($row[14] - 25569) * 86400)->format('Y-m-d');
        $tglgabung = Carbon::createFromTimestamp(($row[6] - 25569) * 86400)->format('Y-m-d H:i:s');
        // dd('ini cabang===', $tglgabung);
        if (!($ceklevjab)) {
            throw new \Exception('Jabatan Ini Tidak Ada Disistem == '.$row[11].', NIK == '.$row[1].', Nama == '.$row[4]);
        }
        if (!($cekcabang)) {
            throw new \Exception('Cabang Ini Tidak Ada Disistem == '.$row[8].', NIK == '.$row[1].', Nama == '.$row[4]);
        }
        if ($cek_nik_kar) {
            throw new \Exception('Nik Ini Telah Terdaftar == '.$row[1].', Nama == '.$row[4]);
        }
        if ($cek_email_kar) {
            throw new \Exception('Email Ini Telah Terdaftar == '.$row[24].', NIK ==, '.$row[1].', Nama == '.$row[4]);
        }
        if ($cek_email) {
            throw new \Exception('Email Ini Telah Terdaftar =='.$row[24].', NIK ==, '.$row[1].', Nama == '.$row[4]);
        } else {
        $us = User::create([
            'name' => $row[4],
            'email' => $row[24],
            'password' => Hash::make('Qwerty123#'),
            'confirm_password' => Hash::make('Qwerty123#'),
            'status_user' => 'Karyawan',
            'email_verified_at' => Carbon::now(),
            'phone_number' => $row[25],
        ]);
	$us->syncRoles([$role->id]);    

        $kar = Karyawan::create([
             'nomor_induk_karyawan' => $row[1],
             'nama_lengkap'         => $row[4],
             'nama_panggilan'       => $row[5],
             'no_identitas'         => $row[15],       
             'tgl_lahir'            => $tgllahir, #$this->transformDate($row[14]),
             'agama'                => $row[20], 
             'gender'               => $row[12],
             'status_pernikahan'    => $row[21], ## DI Data Yang internall Pake bahasa inggris disini pake indonesia
             'alamat'               => $row[16],
             'rt'                   => '-',
             'rw'                   => '-',
             'desa'                 => '-',
             'kecamatan'            => '-',
             'kota'                 => $row[17],
             'provinsi'             => '-',
             'kodepos'              => $row[18],
             'status_rumah'         => '-',
             'no_hp'                => $row[25],
             'no_telp'              => $row[25],
             'photo'                => '-',
             'fk_cabang'            => $cekcabang->id,
             'fk_bagian'            => $cekbagian->id,#$row[21], // supporting operational  // Cek lagi Nanti Di data ga adaan
             'fk_level_jabatan'     => $ceklevjab->id,
             'status_karyawan'      => $row[3], ##Aktif - Non Aktif Untuk External || probation phl controak dll untuk internal
             'fk_nama_perusahaan'   => $cekcabang->fk_nama_perusahaan,
             'tahun_gabung'         => $tglgabung,#$this->transformDate($row[6])
             'jenis_karyawan'       => 'External', // diseragamkeun External
             'upah'                 => '0',
             'tempat_lahir'         => $row[13],
             'expired_kontrak'      => '-',
             'masa_kerja'           => $row[7],
             'alamat_domisili'      => $row[19],
             'ptpk_status'          => '-',
             'pendidikan_terakhir'  => $row[22],
             'grade'                => '0',
             'nama_institusi'       => $row[23],
             'jurusan'              => '-',
             'tahun_masuk_pendidikan' => '-',
             'tahun_lulus'          => '-',
             'gpa'                  => '0',
             'email'                => $row[24],
             'kontak_darurat'       => '0',
             'medsos'               => '-',
             'npwp'                 => '-',
             'golongan_darah'       => '-',
             'no_rek1'              => '-',
             'bank1'                => '-',
             'no_rek2'              => '-',
             'bank2'                => '-',
             'nama_ibu_kandung'     => '-',
             'bpjs_kesehatan'       => '-',
             'keterangan_bpjs'      => '-',
             'no_bpjs_kesehatan'    => '-',
             'bpjs_tenaga_kerja'    => '-',
             'keterangan_bpjs_tenaga_kerja' => '-',
             'no_bpjs_tenaga_kerja' => '-',
             'jamkes_lainnya'       => '-',
             'no_ijazah'            => '-',
             'instansi_ijazah'      => '-',
             'no_finger'            => $row[2],
             'fk_user'              => $us->id,
             'brand'                => $row[9],
             'vendor'               => $row[10],
             'created_at'           => Carbon::now(),
             #'updated_at'           => Carbon::now(),
             'keterangan'           =>  $row[26],
         ]);
        } 
    }
}
