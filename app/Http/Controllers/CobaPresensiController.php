<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Hash;
use App\Http\Resources\PresensiResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Presensi;
use App\Models\Karyawan;
use App\Models\Cabang;
use App\Models\Bagian;
use App\Models\LevelJabatan;
use App\Models\ParamPresensi;
use App\Models\TimeOff;
use App\Models\ParLevelJabatan;
use App\Models\ParamTimeOff;
use App\Models\User;
use App\Models\ParamPeriode;
use App\Imports\KaryawansImport;
use Maatwebsite\Excel\Facades\Excel;
use DateTime;
use Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Exports\PelamarExport;
use App\Exports\PresensisExport;
use Intervention\Image\Facades\Image;
use Storage;

class CobaPresensiController extends Controller
{
    public function index(Request $request)
    {
       $skr = Carbon::now()->toDateString();
       $cabang = Cabang::all();
       $bgn = Bagian::All();
       $jabs = LevelJabatan::all();
       $timeoff = ParamTimeOff::All();
       $lvl = ParLevelJabatan::All();

        $krs = Karyawan::whereHas('getjeniskar', function ($query) {
          $query->where('jenis_kar', '=', 'Internal');
        })->whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation",'Resign', 'PHK'])->get();
      
       return view('cobapresensi.index',compact('skr','krs','lvl', 'cabang', 'bgn','jabs','timeoff'));
    }

    public function cobacountindex(Request $request)
    {
      $skr = Carbon::now()->toDateString();
      $karyawan = Karyawan::whereHas('getjeniskar', function ($query) {
        $query->where('jenis_kar', 'Internal');
    })
      ->whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation"])
      ->count();

      $earlyin = Presensi::whereDate('tanggal', '=', $skr)
        ->where('presensi_status', '=', 'EarlyIn')
        ->whereHas('preskaryawan.getjeniskar', function ($query) {
          $query->where('jenis_kar', '=', 'Internal');
        })
      ->count();
  
      $ontime = Presensi::whereDate('tanggal', '=', $skr)
        ->where('presensi_status', '=', 'OnTime')
        ->whereHas('preskaryawan.getjeniskar', function ($query) {
          $query->where('jenis_kar', '=', 'Internal');
        })
      ->count();
  
      $late = Presensi::whereDate('tanggal', '=', $skr)
        ->where('presensi_status', '=', 'Late')
        ->whereHas('preskaryawan.getjeniskar', function ($query) {
          $query->where('jenis_kar', '=', 'Internal');
        })
      ->count();

      $attend = Presensi::whereDate('tanggal','=',$skr)
      ->whereNotNull('jam_masuk')
      ->whereHas('preskaryawan.getjeniskar', function ($query) {
        $query->where('jenis_kar', '=', 'Internal');
      })
      ->count();
      $absen = Presensi::whereDate('tanggal','=',$skr)
      ->whereNull('presensi_status')
      ->whereHas('preskaryawan.getjeniskar', function ($query) {
        $query->where('jenis_kar', '=', 'Internal');
      })
      ->count();
      $timeoff = Presensi::whereDate('tanggal','=',$skr)
      ->where('presensi_status','=','TimeOff')
      ->whereHas('preskaryawan.getjeniskar', function ($query) {
          $query->where('jenis_kar', '=', 'Internal');
        })
      ->count();
      $dayoff = Presensi::whereDate('tanggal','=',$skr)
      ->where('presensi_status','=','DayOff')
      ->whereHas('preskaryawan.getjeniskar', function ($query) {
        $query->where('jenis_kar', '=', 'Internal');
      })
      ->count();
      $noclockin = Presensi::whereDate('tanggal','=',$skr)
      ->whereNull('jam_masuk')
      ->whereHas('preskaryawan.getjeniskar', function ($query) {
        $query->where('jenis_kar', '=', 'Internal');
      })
      ->count();
      $noclockout = Presensi::whereDate('tanggal','=',$skr)
      ->whereNull('jam_pulang')
      ->whereHas('preskaryawan.getjeniskar', function ($query) {
        $query->where('jenis_kar', '=', 'Internal');
      })
      ->count();
    
        return view('presensi.countindex', compact(
            'skr', 'ontime', 'late', 'earlyin', 'attend', 'absen', 'noclockin', 'noclockout', 'dayoff', 'timeoff','karyawan'
        ));
    }
}
