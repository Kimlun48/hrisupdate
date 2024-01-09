<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Karyawan;
use App\Models\CutiKaryawan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\ToCollection;
use DateTime;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class BulkCutiKaryawan implements ToCollection,WithStartRow
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

    

    public function collection(Collection $row)
    {
        $columnAData = $row->pluck(0)->toArray();
        // Coba
        $skr = Carbon::now()->format("Y-m-d");
        $get_thn_skr= Carbon::now()->format("Y");
        $akhirtahun = Carbon::now()->format($get_thn_skr."-12-31");

        $foundData = [];
        $missingData = [];

        $result = Karyawan::whereIn('id', $columnAData)->get();      
        foreach ($columnAData as $id) {
            $data = $result->firstWhere('id', $id);
            if ($data) {
                $foundData[] = $data;
            } else {
                $missingData[] = ['id' => $id, 'nama' => null];
            }
        }
            #medapatkan Error Jika Di Excel ada Id Tapi Di Data bAse Tidak Ada Id Yang DI tuju
            $idArray = array_map(function ($item) {
                return $item['id'];
            }, $missingData);
             if($idArray){
                 throw new \Exception('Data Karyawan dengan Id ('. implode(", " , $idArray). ') Ini Tidak Terdaftar');
             }

             $foundData2 = [];
             $missingData2 = [];
             $result2 = CutiKaryawan::whereIn('id_kar', $columnAData)->get();
             
             foreach ($columnAData as $id) {
                $data2 = $result2->firstWhere('id_kar', $id);
                if ($data2) {
                    $foundData2[] = $data2;
                } else {
                    $missingData2[] = ['id' => $id, 'nama' => null];
                }
            }
                #medapatkan Error Jika Di Excel ada Id Tapi Di Data bAse Tidak Ada Id Yang DI tuju
                $idArray2 = array_map(function ($item) {
                    return $item['id_kar'];
                }, $foundData2);
                
                 if($idArray2){
                    throw new \Exception('Data Cuti dengan Id ('. implode(", " , $idArray2). ') Sudah Terdaftar');
                 }
    
        // Mulai transaksi database
        DB::beginTransaction();
        try {
            foreach ($row as $row) {
                // Validasi data sesuai kebutuhan Anda
                    // Membuat data jika data valid
                    CutiKaryawan::create([
                        'id_kar'      => $row[0],
                        'mulai_cuti'  => $skr,
                        'akhir_cuti'  => $akhirtahun,
                        'jumlah_cuti' => $row[1],
                        'sisa_cuti'   => $row[2],
                        'tahun'       => $row[3],
                        'created_at'  => Carbon::now(),
                    ]);
            }
            // Komit transaksi jika semuanya berhasil
            DB::commit();
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            DB::rollBack();
            throw new \Exception('Ada Data Yang Kosong SIlahKan Cek Data Anda'.$e->getMessage());
        }

    }



}