<?php


namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\ToCollection;
use DateTime;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\Null_;
use App\Models\ShiftPresensi;
use App\Models\Karyawan;
use App\Models\ParamPresensi;
use App\Models\Presensi;
use App\Models\ShiftHeader;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Month;

use Carbon\CarbonPeriod;
class ShiftImport implements ToModel, WithHeadingRow, WithValidation
{
    private $karyawans;
    private $params;
    public function __construct()
    {
        $this->karyawans = Karyawan::select('id', 'nomor_induk_karyawan', 'nama_lengkap')->get();
        $this->params = ParamPresensi::select('id', 'jenis_shift')->get();
    }

    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }

    public function transformDateTime($value, $format = 'Y-m-d H:i:s')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }
    public function model(array $row)
    {
        $headerawal = collect($row)->keys()->get(2);
        $headerakhir = collect($row)->keys()->last();

        #$tanggalawal = Carbon::createFromTimestamp(($headerawal - 25569) * 86400)->format('Y-m-d');
        #$tanggalakhir = Carbon::createFromTimestamp(($headerakhir - 25569) * 86400)->format('Y-m-d');

        $blnskr = Carbon::createFromTimestamp(($headerawal - 25569) * 86400)->format('Y-m-d');
        $blndepan = Carbon::createFromTimestamp(($headerakhir - 25569) * 86400)->format('Y-m-d');

        $dateRange = CarbonPeriod::create($blnskr, $blndepan);
        $dates = array_map(fn ($date) => $date->format('Y-m-d'), iterator_to_array($dateRange));

        $kar = $this->karyawans->where('nomor_induk_karyawan', $row['nik'])->where('nama_lengkap', $row['nama'])->first();
        // dd($kar);
        $par = $this->params->where('jenis_shift', $row[$headerawal])->first();
        $pars = $this->params->where('jenis_shift', $row[$headerakhir])->first();
        $skr = new DateTime(date('Y-m-d'));
        $request = request()->all();

        $par = ParamPresensi::where('jenis_shift', $row[$headerawal])->first(); //looping column
        $kar = Karyawan::where('nomor_induk_karyawan', $row['nik'])->where('nama_lengkap', $row['nama'])->first();
        if($kar == Null){
            //    dd($row['nik'],$row['nama']);
            }

        $array_calendar = $dates; #ShiftHeader::all();
        foreach ($array_calendar as $value) {
            $cek = date('Y-m-d', strtotime($value));
            $date = Carbon::parse($value);
            $excelFormat = ($date->getTimestamp() / 86400) + 25570;
            #dd(intval($excelFormat));
            $pars = ParamPresensi::where('jenis_shift',  $row[+(intval($excelFormat))])->first(); //looping column
            $cek_data = Presensi::where('id_karyawan', '=', $kar->id)->where('tanggal', '=', $value)->first();
            #if ($pars == Null){
            #   dd($row['nik'],$row['nama']);
            #}

            if (!($cek_data)) {
                Presensi::create([
                    'id_user'           => $kar->user->id,
                    'tanggal'           => $value,
                    'id_karyawan'       => $kar->id ?? Null,
                    'id_parampresensi'  => $pars->id ?? null, #$par->id ?? Null,
                    'keterangan'        => Null, ' ', //$value->keterangan,
                    'presensi_status'   => $pars->id == 9 ? 'Off' : null, //$value->keterangan,
                ]);
            }
            if ($cek_data) {
                $cek_data->update([
                    'id_user'           => $kar->user->id,
                    'tanggal'           => $value,
                    'id_karyawan'       => $kar->id ?? Null,
                    'id_parampresensi'  => $pars->id ?? null, #$par->id ?? Null,
                    'keterangan'        => Null, ' ', //$value->keterangan,
                    'presensi_status'   => $pars->id == 9 ? 'Off' : null,
                 ]);
            }
        }
   }
    public function rules(): array
    {
        return [
            'nik'   => 'required',
            'nama'  => 'required',
            #'21'    => 'required',
        ];
    }
}


