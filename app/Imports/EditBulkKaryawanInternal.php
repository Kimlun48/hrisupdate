<?php

namespace App\Imports;

use App\Models\Karyawan;
use Maatwebsite\Excel\Concerns\ToModel;


use App\Models\User;
use Illuminate\Support\Facades\Hash;

use App\Models\Cabang;
use App\Models\Bagian;
use App\Models\LevelJabatan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\ToCollection;
use DateTime;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

#class EditBulkKaryawanInternal implements ToModel
class EditBulkKaryawanInternal implements ToModel, WithStartRow
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
	    $cek_email = User::where('email', $row[40])->first();
        $cek_email_kar = Karyawan::where('email', $row[40])->first();
        $cek_nik_kar = Karyawan::where('nomor_induk_karyawan', $row[0])->first();
        $cekcabang = Cabang::where('nama','LIKE','%'.$row[20].'%')->first();
    	$cekbagian = Bagian::where('nama', $row[21])->first();
        $ceklevjab = LevelJabatan::where('nama','LIKE','%'.$row[22].'%')->first();
        $tgllahir = Carbon::createFromTimestamp(($row[4] - 25569) * 86400)->format('Y-m-d');
        $tglgabung = Carbon::createFromTimestamp(($row[25] - 25569) * 86400)->format('Y-m-d H:i:s');
        $expired_kontrak = Carbon::createFromTimestamp(($row[29] - 25569) * 86400)->format('Y-m-d');
        if (!($ceklevjab)) {
            throw new \Exception('Jabatan Ini Tidak Ada Disistem == '.$row[11].', NIK == '.$row[1].', Nama == '.$row[4]);
        }
        else {
        User::where('email',$row[40])->update([
            #'name' => $row[4],
            'email' => $row[40],
            #'password' => Hash::make('Qwerty123#'),
            #'confirm_password' => Hash::make('Qwerty123#'),
            #'status_user' => 'Karyawan',
            #'email_verified_at' => Carbon::now(),
            'phone_number' => $row[25],
        ]);
        Karyawan::where('id', $row[60])->update([
            #'nomor_induk_karyawan' => $row[0],
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
            'expired_kontrak_baru' => $expired_kontrak,
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
            'fk_user' => $cek_email->id,
        ]);
        
         }
    }
}

