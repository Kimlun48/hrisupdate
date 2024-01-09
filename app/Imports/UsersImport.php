<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Karyawan;
use App\Models\Cabang;
use App\Models\Bagian;
use App\Models\LevelJabatan;
use App\Models\Perusahaan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\ToCollection;
use DateTime;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;

class UsersImport implements ToModel,WithStartRow
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
        $cek_email = User::where('email', $row[40])->first();
        $cek_email_kar = Karyawan::where('email', $row[40])->first();
        $cek_nik_kar = Karyawan::where('nomor_induk_karyawan', $row[0])->first();
        $cekcabang = Cabang::where('nama','LIKE','%'.$row[20].'%')->first();
        // $cekcabang = Cabang::where('nama', $row[8])->first();
	    $cekbagian = Bagian::where('nama', $row[21])->first();
        $ceklevjab = LevelJabatan::where('nama','LIKE','%'.$row[22].'%')->first();
        #$cekperusahaan = Perusahaan::where('nama','LIKE','%'.$row[24].'%')->first();
        
        // dd($ceklevjab);
        $tgllahir = Carbon::createFromTimestamp(($row[4] - 25569) * 86400)->format('Y-m-d');
        $tglgabung = Carbon::createFromTimestamp(($row[25] - 25569) * 86400)->format('Y-m-d H:i:s');
        if (!($ceklevjab)) {
            throw new \Exception('Jabatan Ini Tidak Ada Disistem == '.$row[22].', NIK == '.$row[0].', Nama == '.$row[1]);
        }
        if (!($cekcabang)) {
            throw new \Exception('Cabang Ini Tidak Ada Disistem == '.$row[20].', NIK == '.$row[0].', Nama == '.$row[4]);
        }
        if ($cek_nik_kar) {
            throw new \Exception('Nik Ini Telah Terdaftar == '.$row[0].', Nama == '.$row[1]);
        }
        if ($cek_email_kar) {
            throw new \Exception('Email Ini Telah Terdaftar == '.$row[24].', NIK ==, '.$row[1].', Nama == '.$row[4]);
        }
        // if ($cekperusahaan) {
        //     throw new \Exception('Perusahaan Ini Telah Terdaftar == '.$row[24].', NIK ==, '.$row[1].', Nama == '.$row[4]);
        // }
        if ($cek_email) {
            throw new \Exception('Email Ini Telah Terdaftar =='.$row[24].', NIK ==, '.$row[1].', Nama == '.$row[4]);
        } else {
        $us = User::create([
            'name' => $row[1],
            'email' => $row[40],
            'password' => Hash::make('Qwerty123#'),
            'confirm_password' => Hash::make('Qwerty123#'),
            'status_user' => 'Karyawan',
            'email_verified_at' => new DateTime(date('Y-m-d H:i:s')),
            'phone_number' => $row[18],
	]);
	$us->syncRoles([$role->id]);
        return new Karyawan([
            'nomor_induk_karyawan' => $row[0],
            'nama_lengkap' => $row[1],
            'nama_panggilan' => $row[2],
            'no_identitas' => $row[3],
            'tgl_lahir' => $tgllahir,#$this->transformDate($row[4]),
            'agama' => $row[5],
            'gender' => $row[6],
            'status_pernikahan' => $row[7],
            'alamat' => $row[8],
            'rt' => $row[9],
            'rw' => $row[10],
            'desa' => $row[11],
            'kecamatan' => $row[12],
            'kota' => $row[13],
            'provinsi' => $row[14],
            'kodepos' => $row[15],
            'status_rumah' => $row[16],
            'no_hp' => $row[17],
            'no_telp' => $row[18],
            'photo' => $row[19],
            'fk_cabang' => $cekcabang->id,
            'fk_bagian' => $cekbagian->id,#$row[21], // supporting operational  // Cek lagi Nanti Di data ga adaan
            'fk_level_jabatan' => $ceklevjab->id,
            'status_karyawan' => $row[23],
            'fk_nama_perusahaan' => $cekcabang->fk_nama_perusahaan,
            'tahun_gabung' => $tglgabung,#$this->transformDate($row[25]), //$row[25], not null keun
            'jenis_karyawan' => 'Internal', //$row[26], diseragamkeun Internal
            'upah' => $row[27],
            'tempat_lahir' => $row[28],
            'expired_kontrak' => $row[29],
            'masa_kerja' => $row[30],
            'alamat_domisili' => $row[31],
            'ptpk_status' => $row[32],
            'pendidikan_terakhir' => $row[33],
            'grade' => $row[34],
            'nama_institusi' => $row[35],
            'jurusan' => $row[36],
            'tahun_masuk_pendidikan' => $row[37],
            'tahun_lulus' => $row[38],
            'gpa' => $row[39],
            'email' => $row[40],
            'kontak_darurat' => $row[41],
            'medsos' => $row[42],
            'npwp' => $row[43],
            'golongan_darah' => $row[44],
            'no_rek1' => $row[45],
            'bank1' => $row[46],
            'no_rek2' => $row[47],
            'bank2' => $row[48],
            'nama_ibu_kandung' => $row[49],
            'bpjs_kesehatan' => $row[50],
            'keterangan_bpjs' => $row[51],
            'no_bpjs_kesehatan' => $row[52],
            'bpjs_tenaga_kerja' => $row[53],
            'keterangan_bpjs_tenaga_kerja' => $row[54],
            'no_bpjs_tenaga_kerja' => $row[55],
            'jamkes_lainnya' => $row[56],
            'no_ijazah' => $row[57],
            'instansi_ijazah' => $row[58],
            'no_finger' => $row[59],
            'fk_user' => $us->id,
        ]);
        }
    }
}

/*
0 nomor_induk_karyawan	
1 nama_lengkap	
2 nama_panggilan	
3 no_identitas	
4 tgl_lahir	
5 agama	
6 gender	
7 status_pernikahan	
8 alamat	
9 rt	
10 rw	
11 desa	
12 kecamatan	
13 kota	
14 provinsi	
15 kodepos	
16 status_rumah	
17 no_hp	
18 no_telp	
19 photo	
20 fk_cabang	
21 fk_bagian	
22 fk_level_jabatan	
23 status_karyawan	
24 fk_nama_perusahaan	
25 tahun_gabung	
26 jenis_karyawan	
27 upah	
28 tempat_lahir	
29 expired_kontrak	
30 masa_kerja	
31 alamat_domisili	
32 ptpk_status	
33 pendidikan_terakhir	
34 grade	
35 nama_institusi	
36 jurusan	
37 tahun_masuk_pendidikan	
38 tahun_lulus	
39 gpa	
40 email	
41 kontak_darurat	
42 medsos	
43 NPWP	
44 golongan_darah	
45 no_rek1	
46 bank1	
47 no_rek2	
48 bank2	
49 nama_ibu_kandung	
50 bpjs_kesehatan	
51 keterangan_bpjs	
52 no_bpjs_kesehatan	
53 bpjs_tenaga_kerja	
54 keterangan_bpjs_tenaga_kerja	
55 no_bpjs_tenaga_kerja	
56 jamkes_lainnya	
57 no_ijazah	
58 instansi_ijazah	
59 no_finger
*/
