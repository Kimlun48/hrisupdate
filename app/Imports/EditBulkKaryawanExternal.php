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

#class EditBulkKaryawanExternal implements ToModel
class EditBulkKaryawanExternal implements ToModel, WithStartRow
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
        // return new Karyawan([
        //     //
        // ]);
        
        $cek_kar = Karyawan::where('id', $row[0])->first();
        $tgllahir = Carbon::createFromTimestamp(($row[14] - 25569) * 86400)->format('Y-m-d');
        $tglgabung = Carbon::createFromTimestamp(($row[6] - 25569) * 86400)->format('Y-m-d H:i:s');
        $cekcabang = Cabang::where('nama','LIKE','%'.$row[8].'%')->first();
        // $cekcabang = Cabang::where('nama', $row[8])->first();
        $cekbagian = Bagian::where('id', 1)->first();
        $ceklevjab = LevelJabatan::where('nama','LIKE','%'.$row[11].'%')->first();
        
        if (!($ceklevjab)) {
            throw new \Exception('Jabatan Ini Tidak Ada Disistem == '.$row[11].', NIK == '.$row[1].', Nama == '.$row[4]);
        }
        else {
        User::where('email',$row[24])->update([
            #'name' => $row[4],
            'email' => $row[24],
            #'password' => Hash::make('Qwerty123#'),
            #'confirm_password' => Hash::make('Qwerty123#'),
            #'status_user' => 'Karyawan',
            #'email_verified_at' => Carbon::now(),
            'phone_number' => $row[25],
        ]);
        // dd($us);
       Karyawan::where('id', $row[0])->update([
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
              'fk_user'              => $cek_kar->id,
              'brand'                => $row[9],
              'vendor'               => $row[10],
              #'created_at'           => Carbon::now(),
              'updated_at'           => Carbon::now(),
              'keterangan'           =>  $row[26],
          ]);
        
         }
    }
}

