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
use App\Models\CutiKaryawan;
use App\Models\ParamPresensi;
use App\Models\TimeOff;
use App\Models\ParLevelJabatan;
use App\Models\ParamTimeOff;
use App\Models\User;
use App\Models\ParamPeriode;
use App\Models\OverTime;
use App\Models\PresensiEditLog;
use App\Imports\KaryawansImport;
use Maatwebsite\Excel\Facades\Excel;
use DateTime;
use Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Exports\PelamarExport;
use App\Exports\PresensisExport;
use App\Exports\KehadiranEmployeeExport;
use Intervention\Image\Facades\Image;
use Storage;



class PresensiController extends Controller
{

  public function tesupdatepresensi(Request $request)
  {
  $tmo = TimeOff::where('status_approve','=','approve')->get();
  foreach ($tmo as $item) {
      $presensi = Presensi::where('id_karyawan',$item->id_karyawan)->where('tanggal','=',$item->tanggal)->first();
      if($presensi){
          $presensi->fk_timeoff  = $item->id;
          $presensi->save();
       }
  }
  }
  public function kehadiran(Request $request)
  {
    // dd('aaaaaaaaaaaaduuuuuuuuuhhhhhhhh',$request->startdate);
  // Coba Report Kehadiran
  $startDate = date('Y-m-d',strtotime($request->startdate));
  $endDate = date('Y-m-d',strtotime($request->enddate));      
  $shift = Karyawan::wherein('id',[1213,993,30,983,1000])->get();
  $dateRange = CarbonPeriod::create($startDate, $endDate);
  
  // dd($dateRange);
  // $absen = Presensi::join('karyawans', 'karyawans.id', '=', 'presensis.id_karyawan')
  // ->whereBetween('presensis.tanggal', [$startDate,$endDate])
  // ->leftJoin('param_presensis', 'param_presensis.id', '=', 'presensis.id_parampresensi')
  // ->select(
  //     'karyawans.nama_lengkap',
  //     'karyawans.nomor_induk_karyawan',
  //     'presensis.id',
  //     'presensis.id_parampresensi',
  //     'presensis.jam_masuk',
  //     'presensis.jam_pulang',
  //     DB::raw('COALESCE(param_presensis.jenis_shift, "Kosong") as shift')
  // )
  // ->get();



  $dates = [
    '2023-01-17', '2023-01-18', '2023-01-19', '2023-01-20',
    '2023-01-21', '2023-01-22', '2023-01-23', '2023-01-24', '2023-01-25'
];

$caseStatements = [];
foreach ($dates as $date) {
    $caseStatements[] = "MAX(CASE WHEN tanggal = '$date' THEN presensi_status ELSE 'ns' END) AS '$date'";
}

$caseStatements = implode(', ', $caseStatements);

$newData = DB::select("
    SELECT id_karyawan, $caseStatements
    FROM presensis
    WHERE id_karyawan IN (30,983,1000,1213)
    AND tanggal BETWEEN '2023-01-17' AND '2023-01-25'
    GROUP BY id_karyawan
");
//  dd($newData);
// $absen = json_encode($newData, true);
 
  return view('presensi.tesreport',compact('newData'));  
  
  // dd($absen);
  // return Excel::download(new KehadiranEmployeeExport($absen,$dateRange,$shift), 'Kehadiran_karyawan_'.$startDate.'_'.$endDate.'.'.'xlsx');

        

  }
  // AKhir Coba Report Kehadiran
    public function index(Request $request)
    {
       $skr = Carbon::now()->toDateString();
       $cabang = Cabang::all();
       $bgn = Bagian::All();
       $jabs = LevelJabatan::all();
       $timeoff = ParamTimeOff::All();
       $lvl = ParLevelJabatan::All();
      //  $employes =  Karyawan::distinct()->pluck('status_karyawan');
      //  dd($employes);
        // Karyawan::where('jenis_karyawan','=','Internal')            
        // ->whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation",'Resign', 'PHK'])
        // ->get();

        $krs = Karyawan::whereHas('getjeniskar', function ($query) {
          $query->where('jenis_kar', '=', 'Internal');
        })->whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation",'Resign', 'PHK'])->get();
      
       return view('presensi.index',compact('skr','krs','lvl', 'cabang', 'bgn','jabs','timeoff'));
    }

    public function index_external(Request $request)
    {
       $skr = Carbon::now()->toDateString();
      //  $karyawan = Karyawan::where("jenis_karyawan","=","Internal")->count();
       $cabang = Cabang::all();
       $bgn = Bagian::All();
       $jabs = LevelJabatan::all();
       $timeoff = ParamTimeOff::All();
       $employes = Karyawan::where('jenis_karyawan','=','External')            
        ->whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation",'Resign', 'PHK'])
        ->with('bagian')
        ->get();
       $krs = Karyawan::All();
      return view('presensi.index_external',
            compact('skr','krs', 'cabang', 'bgn','jabs','timeoff','employes'
      ));
    }

    public function countdetail(Request $request, $id)
    {
      if (Carbon::now()->format('d') < 21) {
        $awal = Carbon::now()->subMonth()->format('Y-m-21');
        $akhir = Carbon::now()->format('Y-m-20');
        $skr = Carbon::now()->subMonth()->format('Y-m-d');
      } else {
        $awal = Carbon::now()->format('Y-m-21');
        $akhir = Carbon::now()->addMonth()->format('Y-m-20');
        $skr = Carbon::now()->format('Y-m-d');
      }

      $earlyin = Presensi::where('id_karyawan', $id)
      ->where('presensi_status', '=', 'EarlyIn')
      ->whereBetween('tanggal', [$awal, $akhir])
      ->count();

      $ontime = Presensi::where('id_karyawan', $id)
      ->where('presensi_status', '=', 'OnTime')
      ->whereBetween('tanggal', [$awal, $akhir])
      ->count();

      $late = Presensi::where('id_karyawan', $id)
      ->where('presensi_status', '=', 'Late')
      ->whereBetween('tanggal', [$awal, $akhir])
      ->count();

      $attend = Presensi::where('id_karyawan', $id)
      ->whereNotNull('jam_masuk')
      ->whereBetween('tanggal', [$awal, $akhir])
      ->count();

      $absen = Presensi::where('id_karyawan', $id)
      ->whereNull('presensi_status')
      ->whereBetween('tanggal', [$awal, $akhir])
      ->count();

      $timeoff = Presensi::where('id_karyawan', $id)
      ->where('presensi_status', '=', 'TimeOff')
      ->whereBetween('tanggal', [$awal, $akhir])
      ->count();

      $dayoff = Presensi::where('id_karyawan', $id)
      ->where('presensi_status', '=', 'DayOff')
      ->whereBetween('tanggal', [$awal, $akhir])
      ->count();

      $noclockin = Presensi::where('id_karyawan', $id)
      ->whereNull('jam_masuk')
      ->whereBetween('tanggal', [$awal, $akhir])
      ->count();

      $noclockout = Presensi::where('id_karyawan', $id)
      ->whereNull('jam_pulang')
      ->whereBetween('tanggal', [$awal, $akhir])
      ->count();

      $presensiKaryawan = [];#Presensi::where('id_karyawan', $id)
      // ->whereBetween('tanggal', [$awal, $akhir])
      // ->with('preskaryawan')
      // ->with('parampresensi')
      // ->with('preskaryawan.jabatan')
      // ->with('preskaryawan.bagian')
      // ->with('preskaryawan.cabang')
      // ->get();
      
    
      return view('presensi.countdetail', compact(
          'skr', 'ontime', 'late', 'earlyin', 'attend', 'absen', 'noclockin', 'noclockout', 'dayoff', 'timeoff',
          'awal', 'akhir', 'presensiKaryawan'
      ));
    }


    public function countdetail_external(Request $request, $id)
    {
      if (Carbon::now()->format('d') < 21) {
          $awal = Carbon::now()->subMonth()->format('Y-m-21');
          $akhir = Carbon::now()->format('Y-m-20');
          $skr = Carbon::now()->subMonth()->format('Y-m-d');
      } else {
          $awal = Carbon::now()->format('Y-m-21');
          $akhir = Carbon::now()->addMonth()->format('Y-m-20');
          $skr = Carbon::now()->format('Y-m-d');
      }
  
      $earlyin = Presensi::where('id_karyawan', $id)
          ->where('presensi_status', '=', 'EarlyIn')
          ->whereBetween('tanggal', [$awal, $akhir])
          ->count();
  
      $ontime = Presensi::where('id_karyawan', $id)
          ->where('presensi_status', '=', 'OnTime')
          ->whereBetween('tanggal', [$awal, $akhir])
          ->count();
  
      $late = Presensi::where('id_karyawan', $id)
          ->where('presensi_status', '=', 'Late')
          ->whereBetween('tanggal', [$awal, $akhir])
          ->count();
  
      $attend = Presensi::where('id_karyawan', $id)
          ->whereNotNull('jam_masuk')
          ->whereBetween('tanggal', [$awal, $akhir])
          ->count();
  
      $absen = Presensi::where('id_karyawan', $id)
          ->whereNull('presensi_status')
          ->whereBetween('tanggal', [$awal, $akhir])
          ->count();
  
      $timeoff = Presensi::where('id_karyawan', $id)
          ->where('presensi_status', '=', 'TimeOff')
          ->whereBetween('tanggal', [$awal, $akhir])
          ->count();
  
      $dayoff = Presensi::where('id_karyawan', $id)
          ->where('presensi_status', '=', 'DayOff')
          ->whereBetween('tanggal', [$awal, $akhir])
          ->count();
  
      $noclockin = Presensi::where('id_karyawan', $id)
          ->whereNull('jam_masuk')
          ->whereBetween('tanggal', [$awal, $akhir])
          ->count();
  
      $noclockout = Presensi::where('id_karyawan', $id)
          ->whereNull('jam_pulang')
          ->whereBetween('tanggal', [$awal, $akhir])
          ->count();
  
      $presensiKaryawan = Presensi::where('id_karyawan', $id)
          ->whereBetween('tanggal', [$awal, $akhir])
          ->with('preskaryawan')
          ->with('parampresensi')
          ->with('preskaryawan.jabatan')
          ->with('preskaryawan.bagian')
          ->with('preskaryawan.cabang')
          ->get();
  
      return view('presensi.countdetail_external', compact(
          'skr', 'ontime', 'late', 'earlyin', 'attend', 'absen', 'noclockin', 'noclockout', 'dayoff', 'timeoff',
          'awal', 'akhir', 'presensiKaryawan'
      ));
    }


    public function countindex(Request $request)
    {
      $skr = Carbon::now()->toDateString();
      // $karyawan = Karyawan::count();

//       $global =  Presensi::whereDate('tanggal', '=', $skr)
//       ->whereHas('preskaryawan.getjeniskar', function ($query) {
//              $query->where('jenis_kar', '=', 'Internal');
//          })->get();
//  $earlyin = $global->where('presensi_status', '=', 'EarlyIn')->count();
//  $ontime = $global->where('presensi_status', '=', 'OnTime')->count();
//  $late = $global->where('presensi_status', '=', 'Late')->count();
//  $attend = $global->whereNotNull('jam_masuk')->count();
 


      $karyawan = Karyawan::whereHas('getjeniskar', function ($query) {
        $query->where('jenis_kar', 'Internal');
    })
      ->whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation"])
      ->count();


  //     $attendanceCounts = Presensi::whereDate('tanggal', '=', $skr)
  //     ->whereIn('presensi_status', ['EarlyIn', 'OnTime', 'Late'])
  //     ->whereHas('preskaryawan.getjeniskar', function ($query) {
  //         $query->where('jenis_kar', '=', 'Internal');
  //     })
  //     ->select('presensi_status', \DB::raw('COUNT(*) as count'))
  //     ->groupBy('presensi_status')
  //     ->pluck('count', 'presensi_status')
  //     ->toArray();
  
  // $earlyin = $attendanceCounts['EarlyIn'] ?? 0;
  // $ontime = $attendanceCounts['OnTime'] ?? 0;
  // $late = $attendanceCounts['Late'] ?? 0;

$status = ['EarlyIn', 'OnTime', 'Late'];
$statusCounts = [];

foreach ($status as $s) {
    $count = Presensi::whereDate('tanggal', $skr)
        ->where('presensi_status', $s)
        ->whereHas('preskaryawan.getjeniskar', function ($query) {
            $query->where('jenis_kar', 'Internal');
        })
        ->count();

    $statusCounts[$s] = $count;
}

$earlyin = $statusCounts['EarlyIn'];
  $ontime = $statusCounts['OnTime'];
  $late = $statusCounts['Late'];


      // $earlyin = Presensi::whereDate('tanggal', '=', $skr)
      //   ->where('presensi_status', '=', 'EarlyIn')
      //   ->whereHas('preskaryawan.getjeniskar', function ($query) {
      //     $query->where('jenis_kar', '=', 'Internal');
      //   })
      // ->count();
  
      // $ontime = Presensi::whereDate('tanggal', '=', $skr)
      //   ->where('presensi_status', '=', 'OnTime')
      //   ->whereHas('preskaryawan.getjeniskar', function ($query) {
      //     $query->where('jenis_kar', '=', 'Internal');
      //   })
      // ->count();
  
      // $late = Presensi::whereDate('tanggal', '=', $skr)
      //   ->where('presensi_status', '=', 'Late')
      //   ->whereHas('preskaryawan.getjeniskar', function ($query) {
      //     $query->where('jenis_kar', '=', 'Internal');
      //   })
      // ->count();

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

    public function countindex_external(Request $request)
    {
      $skr = Carbon::now()->toDateString();
      // $karyawan = Karyawan::count();
      $karyawan = Karyawan::where("jenis_karyawan","=","External")->count();
      $earlyin = Presensi::whereDate('tanggal', '=', $skr)
        ->where('presensi_status', '=', 'EarlyIn')
        ->whereHas('preskaryawan', function ($query) {
            $query->where('jenis_karyawan', '=', 'External');
        })
      ->count();
  
      $ontime = Presensi::whereDate('tanggal', '=', $skr)
        ->where('presensi_status', '=', 'OnTime')
        ->whereHas('preskaryawan', function ($query) {
            $query->where('jenis_karyawan', '=', 'External');
        })
      ->count();
  
      $late = Presensi::whereDate('tanggal', '=', $skr)
        ->where('presensi_status', '=', 'Late')
        ->whereHas('preskaryawan', function ($query) {
            $query->where('jenis_karyawan', '=', 'External');
        })
      ->count();

      $attend = Presensi::whereDate('tanggal','=',$skr)
      ->whereNotNull('jam_masuk')
      ->whereHas('preskaryawan', function ($query) {
        $query->where('jenis_karyawan', '=', 'External');
      })
      ->count();
      $absen = Presensi::whereDate('tanggal','=',$skr)
      ->whereNull('presensi_status')
      ->whereHas('preskaryawan', function ($query) {
        $query->where('jenis_karyawan', '=', 'External');
      })
      ->count();
      $timeoff = Presensi::whereDate('tanggal','=',$skr)
      ->where('presensi_status','=','TimeOff')
      ->whereHas('preskaryawan', function ($query) {
        $query->where('jenis_karyawan', '=', 'External');
      })
      ->count();
      $dayoff = Presensi::whereDate('tanggal','=',$skr)
      ->where('presensi_status','=','DayOff')
      ->whereHas('preskaryawan', function ($query) {
        $query->where('jenis_karyawan', '=', 'External');
      })
      ->count();
      $noclockin = Presensi::whereDate('tanggal','=',$skr)
      ->whereNull('jam_masuk')
      ->whereHas('preskaryawan', function ($query) {
        $query->where('jenis_karyawan', '=', 'External');
      })
      ->count();
      $noclockout = Presensi::whereDate('tanggal','=',$skr)
      ->whereNull('jam_pulang')
      ->whereHas('preskaryawan', function ($query) {
        $query->where('jenis_karyawan', '=', 'External');
      })
      ->count();
    
        return view('presensi.countindex', compact(
            'skr', 'ontime', 'late', 'earlyin', 'attend', 'absen', 'noclockin', 'noclockout', 'dayoff', 'timeoff','karyawan'
        ));
    }


  public function readpresensi(Request $request)
  {
      $skr = Carbon::now()->toDateString();
      $filterDate = $request->input('tanggal'); // Ambil tanggal dari permintaan jika ada
      if ($filterDate) {
          $prs = Presensi::whereDate('tanggal', '=', $filterDate)
              ->with('preskaryawan')
              ->with('parampresensi')
              ->with('preskaryawan.jabatan')
              ->with('preskaryawan.bagian')
              ->with('preskaryawan.cabang')
              ->whereHas('preskaryawan', function ($query) {
                  $query->where('jenis_karyawan', '=', 'Internal');
              })
              ->get();
      } else {
          $prs = Presensi::whereDate('tanggal', '=', $skr)
              ->with('preskaryawan')
              ->with('parampresensi')
              ->with('preskaryawan.jabatan')
              ->with('preskaryawan.bagian')
              ->with('preskaryawan.cabang')
              ->whereHas('preskaryawan', function ($query) {
                  $query->where('jenis_karyawan', '=', 'Internal');
              })
              ->get();
      }
      
      return view('presensi.readpresensi', compact('prs', 'skr'));
  }
    
  public function readpresensifilterview(Request $request)
  {
    $startdate = date('Y-m-d', strtotime($request->startdate));
    $enddate = date('Y-m-d', strtotime($request->enddate));
    $cabang = $request->cabang;
    if ($request->format == 'view'){
      $prs = Presensi::whereBetween('tanggal',[$startdate, $enddate])
        ->with('preskaryawan')->with('parampresensi')->with('preskaryawan.jabatan')
        ->with('preskaryawan.bagian')->with('preskaryawan.cabang')
        ->whereHas('preskaryawan', function ($query) use ($request){
            $query->where('jenis_karyawan', '=', 'Internal');
          if ($request->cabang != null && $request->karyawan != null) {
            $query->whereIn('id', $request->karyawan);
          } elseif ($request->cabang != null && $request->karyawan == null) {
            $query->whereIn('fk_cabang', $request->cabang);
          } elseif ($request->cabang == null && $request->karyawan != null) {
            $query->whereIn('id', $request->karyawan);
          }
        })->get();
      }
      if ($request->format == 'excel'){
        $prs = Presensi::whereBetween('tanggal',[$startdate, $enddate])
          ->with('preskaryawan')->with('parampresensi')->with('preskaryawan.jabatan')
          ->with('preskaryawan.bagian')->with('preskaryawan.cabang')
          ->whereHas('preskaryawan', function ($query) use ($request){
              $query->where('jenis_karyawan', '=', 'Internal');

            if ($request->cabang != null && $request->karyawan != null) {
                $query->whereIn('id', $request->karyawan);
            } elseif ($request->cabang != null && $request->karyawan == null) {
                $query->whereIn('fk_cabang', $request->cabang);
            } elseif ($request->cabang == null && $request->karyawan != null) {
                $query->whereIn('id', $request->karyawan);
            }
         })->get();
        return (new PresensisExport($cabang,$prs,$startdate,$enddate))->download('Presensi_Karyawan_Internal.xlsx');#membuat excel
      }
    return view('presensi.readpresensi', compact('prs'));
  }

  public function readpresensifilterview_external(Request $request)
  {
    $startdate = date('Y-m-d', strtotime($request->startdate));
    $enddate = date('Y-m-d', strtotime($request->enddate));
    $cabang = $request->cabang;
    if ($request->format == 'view'){
      $prs = Presensi::whereBetween('tanggal',[$startdate, $enddate])
        ->with('preskaryawan')->with('parampresensi')->with('preskaryawan.jabatan')
        ->with('preskaryawan.bagian')->with('preskaryawan.cabang')
        ->whereHas('preskaryawan', function ($query) use ($request){
            $query->where('jenis_karyawan', '=', 'External');
          if ($request->cabang != null && $request->karyawan != null) {
            $query->whereIn('id', $request->karyawan);
          } elseif ($request->cabang != null && $request->karyawan == null) {
            $query->whereIn('fk_cabang', $request->cabang);
          } elseif ($request->cabang == null && $request->karyawan != null) {
            $query->whereIn('id', $request->karyawan);
          }
        })->get();
      }
      if ($request->format == 'excel'){
        $prs = Presensi::whereBetween('tanggal',[$startdate, $enddate])
          ->with('preskaryawan')->with('parampresensi')->with('preskaryawan.jabatan')
          ->with('preskaryawan.bagian')->with('preskaryawan.cabang')
          ->whereHas('preskaryawan', function ($query) use ($request){
              $query->where('jenis_karyawan', '=', 'External');

            if ($request->cabang != null && $request->karyawan != null) {
                $query->whereIn('id', $request->karyawan);
            } elseif ($request->cabang != null && $request->karyawan == null) {
                $query->whereIn('fk_cabang', $request->cabang);
            } elseif ($request->cabang == null && $request->karyawan != null) {
                $query->whereIn('id', $request->karyawan);
            }
         })->get();
        return (new PresensisExport($cabang,$prs,$startdate,$enddate))->download('Presensi_Karyawan_External.xlsx');#membuat excel
      }
    return view('presensi.readpresensi', compact('prs'));
  }



  public function readpresensi_external(Request $request)
  {
    $skr = Carbon::now()->toDateString();
    
    $filterDate = $request->input('tanggal'); // Ambil tanggal dari permintaan jika ada
    if ($filterDate) {
        $prs = Presensi::whereDate('tanggal', '=', $filterDate)
            ->with('preskaryawan')->with('parampresensi')->with('preskaryawan.jabatan')
            ->with('preskaryawan.bagian')->with('preskaryawan.cabang')->get();
    } else {
        $prs = Presensi::whereDate('tanggal', '=', $skr)
            ->with('preskaryawan')->with('parampresensi')->with('preskaryawan.jabatan')
            ->with('preskaryawan.bagian')->with('preskaryawan.cabang')->get();
    }
    
    return view('presensi.read_external', compact('prs', 'skr'));
  }

   	public function jarakabsen() {
    $nik = '105221372';
    $id_karyawan = Karyawan::where('nomor_induk_karyawan', $nik)->get()->last();
    $cek_radius = doubleval($id_karyawan->cabang->radius);
		$unit = $id_karyawan->cabang->satuan_radius;
		$cek_lat_cabang = $id_karyawan->cabang->latitude;
		$cek_lon_cabang = $id_karyawan->cabang->longitude;
		#$unit = 'miles';
    ###HITUNG JARAK AWAL
    // $latitude1  = -6.925254943306605; ###Posisi Absen
    // $longitude1 = 107.64630506836477; ###Posisi Absen

    $latitude1  = -6.907494466463305;#-6.912213466463305; ###Posisi Absen
    $longitude1 = 107.61666568555326;#107.63702538555326; ###Posisi Absen
    
    $latitude2  = doubleval($cek_lat_cabang); ###Posisi Cabang
    $longitude2 = doubleval($cek_lon_cabang); ###Posisi Cabang


		$theta = $longitude1 - $longitude2; 
		$distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta))); 
		$distance = acos($distance); 
		$distance = rad2deg($distance); 
		$distance = $distance * 60 * 1.1515; 
		switch($unit) { 
		  case 'miles': 
			break; 
		  case 'Kilometer' : 
			$distance = $distance * 1.609344; 
        break; 
      case 'Meter' : 
        $distance = $distance *  1609.344; 
		} 
    // dd(round($distance,2));
		return (round($distance,2)); 
	}

  
  public function readdatadetail(Request $request,$id)
  {
    $parperiod = ParamPeriode::where('status','=','Aktif')->first();
    if($request->tanggal){
          $cek = Carbon::parse($request->tanggal);
          $blnskr   = $cek->format('Y-m-'.$parperiod->enddate);
          $blnkmren = $cek->subMonth()->format('Y-m-'.$parperiod->startdate);
          $presensiKaryawan = Presensi::where('id_karyawan', $id)
            ->whereBetween('tanggal', [$blnkmren, $blnskr])
            ->with('preskaryawan')->with('parampresensi')
            ->with('preskaryawan.jabatan')->with('preskaryawan.bagian')
            ->with('preskaryawan.cabang')
            ->get();
          return view('presensi.readdetail', compact('presensiKaryawan'));
    }else{
          if (Carbon::now()->format('d') < $parperiod->startdate) { 
            $awal = Carbon::now()->subMonth()->format('Y-m-'.$parperiod->startdate); 
            $akhir =  Carbon::now()->format('Y-m-'.$parperiod->enddate); } 
          else { 
            $awal =  Carbon::now()->format('Y-m-'.$parperiod->startdate); 
            $akhir = Carbon::now()->addMonth()->format('Y-m-'.$parperiod->enddate); }

          $presensiKaryawan = Presensi::where('id_karyawan', $id)->whereBetween('tanggal', [$awal, $akhir])
            ->with('preskaryawan')->with('parampresensi')
            ->with('preskaryawan.jabatan')->with('preskaryawan.bagian')
            ->with('preskaryawan.cabang')
            ->get();
            return view('presensi.readdetail', compact('presensiKaryawan'));
          }
  }

  public function readdatadetail_external(Request $request,$id)
  {

    if($request->tanggal){
          if (Carbon::now()->format('d') < 21) { 
            $awal = Carbon::now()->subMonth()->format('Y-m-21'); 
            $akhir =  Carbon::now()->format('Y-m-20'); } 
        else { 
          $awal =  Carbon::now()->format('Y-m-21'); 
          $akhir = Carbon::now()->addMonth()->format('Y-m-20'); }
      
        $presensiKaryawan = Presensi::where('id_karyawan', $id)->whereBetween('tanggal', [Carbon::now()->format('Y-m-d'), Carbon::now()->format('Y-m-d')])
          ->with('preskaryawan')->with('parampresensi')
          ->with('preskaryawan.jabatan')->with('preskaryawan.bagian')
          ->with('preskaryawan.cabang')
          ->get();
      return view('presensi.readdetail_external', compact('presensiKaryawan'));
    }else{
    if (Carbon::now()->format('d') < 21) { 
      $awal = Carbon::now()->subMonth()->format('Y-m-21'); 
      $akhir =  Carbon::now()->format('Y-m-20'); } 
    else { 
      $awal =  Carbon::now()->format('Y-m-21'); 
      $akhir = Carbon::now()->addMonth()->format('Y-m-20'); }

    $presensiKaryawan = Presensi::where('id_karyawan', $id)->whereBetween('tanggal', [$awal, $akhir])
      ->with('preskaryawan')->with('parampresensi')
      ->with('preskaryawan.jabatan')->with('preskaryawan.bagian')
      ->with('preskaryawan.cabang')
      ->get();

      return view('presensi.readdetail_external', compact('presensiKaryawan'));
    }
  }

  
  public function indexdetailpresensi(Request $request, $id)
  {
    // Mendapatkan tanggal hari ini dan konversi ke format tanggal (Y-m-d)
      $skrString = Carbon::now()->toDateString(); // Menghasilkan string seperti "2023-08-04"
    $skr = Carbon::createFromFormat('Y-m-d', $skrString); // Mengonversi string menjadi objek Carbon
    // $bulanTahun = $skr->format('F Y'); // Format bulan dalam teks dan tahun (contoh: "August 2023")
    $parperiod = ParamPeriode::where('status','=','Aktif')->first();
    if (Carbon::now()->format('d') < $parperiod->startdate) { 
      $awal = Carbon::now()->subMonth()->format('Y-m-'.$parperiod->startdate); 
      $cek = Carbon::parse($awal);
      $bulanTahun = $cek->format('F Y');  
      } 
    else { 
      $awal = Carbon::now()->addMonth()->format('Y-m-'.$parperiod->enddate); 
      $cek = Carbon::parse($awal);
      $bulanTahun = $cek->format('F Y');  
    }
    
    $karyawan = Karyawan::count();
    $karyawan_masuk = Presensi::whereDate('tanggal', '=', $skr)->whereIn('presensi_status', ['EarlyIn', 'Late', 'OnTime'])->count();
    $earlyin = Presensi::whereDate('tanggal', '=', $skr)->where('presensi_status', '=', 'EarlyIn')->count();
    // $ontime = Presensi::whereDate('tanggal','=',$skr)->where('presensi_status', '=', 'OnTime')->count();
    $ontime = Presensi::whereDate('tanggal', '=', $skr)
                    ->where('presensi_status', '=', 'OnTime')
                    ->whereTime('jam_masuk', '>=', '08:00:00')
                    ->whereTime('jam_masuk', '<=', '08:00:59')
                    ->count();
    $late = Presensi::whereDate('tanggal', '=', $skr)->where('presensi_status', '=', 'Late')->count();
    $attend = Presensi::whereDate('tanggal', '=', $skr)->whereNotNull('jam_masuk')->count();
    $timeoff = Presensi::whereDate('tanggal', '=', $skr)->where('presensi_status', '=', 'TimeOff')->count();
    $dayoff = Presensi::whereDate('tanggal', '=', $skr)->where('presensi_status', '=', 'DayOff')->count();
    $absen = Presensi::whereDate('tanggal', '=', $skr)->whereNull('presensi_status')->count();
    $noclockin = Presensi::whereDate('tanggal', '=', $skr)->whereNull('jam_masuk')->count();
    $noclockout = Presensi::whereDate('tanggal', '=', $skr)->whereNull('jam_pulang')->count();
    //$timeoff = Presensi::whereDate('tanggal','=',$skr)->whereIn('keterangan', ['CUTI', 'IJIN', 'SAKIT'])->count();
    $cabang = Cabang::get();
    $jabs = LevelJabatan::all();
    $bgn = Bagian::all();
    $employ = Karyawan::where('jenis_karyawan', 'internal')->get();
    $timeoff = ParamTimeOff::All();


    //Test

    // $presensiKaryawan = Presensi::where('id_karyawan',$id)->whereBetween('tanggal',[$awal, $akhir])->get();
  
    return view('presensi.detailindex', compact('bulanTahun','skrString','employ','noclockin', 'noclockout', 'absen', 'jabs', 'bgn', 'skr', 'karyawan', 'karyawan_masuk', 'ontime', 'earlyin', 'late', 'attend', 'timeoff', 'dayoff', 'cabang'));
  }

  public function indexdetailpresensi_external(Request $request, $id)
  {
    // Mendapatkan tanggal hari ini dan konversi ke format tanggal (Y-m-d)
    $skrString = Carbon::now()->toDateString(); // Menghasilkan string seperti "2023-08-04"
    $skr = Carbon::createFromFormat('Y-m-d', $skrString); // Mengonversi string menjadi objek Carbon
    // $bulanTahun = $skr->format('F Y'); // Format bulan dalam teks dan tahun (contoh: "August 2023")
    $parperiod = ParamPeriode::where('status','=','Aktif')->first();
    if (Carbon::now()->format('d') < $parperiod->startdate) { 
      $awal = Carbon::now()->subMonth()->format('Y-m-'.$parperiod->startdate); 
      $cek = Carbon::parse($awal);
      $bulanTahun = $cek->format('F Y');  
    } 
    else { 
      $awal = Carbon::now()->addMonth()->format('Y-m-'.$parperiod->enddate); 
      $cek = Carbon::parse($awal);
      $bulanTahun = $cek->format('F Y');  
    }
    
    $karyawan = Karyawan::count();
    $karyawan_masuk = Presensi::whereDate('tanggal', '=', $skr)->whereIn('presensi_status', ['EarlyIn', 'Late', 'OnTime'])->count();
    $earlyin = Presensi::whereDate('tanggal', '=', $skr)->where('presensi_status', '=', 'EarlyIn')->count();
    // $ontime = Presensi::whereDate('tanggal','=',$skr)->where('presensi_status', '=', 'OnTime')->count();
    $ontime = Presensi::whereDate('tanggal', '=', $skr)
                    ->where('presensi_status', '=', 'OnTime')
                    ->whereTime('jam_masuk', '>=', '08:00:00')
                    ->whereTime('jam_masuk', '<=', '08:00:59')
                    ->count();
    $late = Presensi::whereDate('tanggal', '=', $skr)->where('presensi_status', '=', 'Late')->count();
    $attend = Presensi::whereDate('tanggal', '=', $skr)->whereNotNull('jam_masuk')->count();
    $timeoff = Presensi::whereDate('tanggal', '=', $skr)->where('presensi_status', '=', 'TimeOff')->count();
    $dayoff = Presensi::whereDate('tanggal', '=', $skr)->where('presensi_status', '=', 'DayOff')->count();
    $absen = Presensi::whereDate('tanggal', '=', $skr)->whereNull('presensi_status')->count();
    $noclockin = Presensi::whereDate('tanggal', '=', $skr)->whereNull('jam_masuk')->count();
    $noclockout = Presensi::whereDate('tanggal', '=', $skr)->whereNull('jam_pulang')->count();

    //$timeoff = Presensi::whereDate('tanggal','=',$skr)->whereIn('keterangan', ['CUTI', 'IJIN', 'SAKIT'])->count();
    $cabang = Cabang::get();
    $jabs = LevelJabatan::all();
    $bgn = Bagian::all();
    $employ = Karyawan::where('jenis_karyawan', 'external')->get();
    $timeoff = ParamTimeOff::All();

      //Test

      // $presensiKaryawan = Presensi::where('id_karyawan',$id)->whereBetween('tanggal',[$awal, $akhir])->get();
  
    return view('presensi.detailindex_external', compact('bulanTahun','skrString','employ','noclockin', 'noclockout', 'absen', 'jabs', 'bgn', 'skr', 'karyawan', 'karyawan_masuk', 'ontime', 'earlyin', 'late', 'attend', 'timeoff', 'dayoff', 'cabang'));
  }

  // public function editpresensi(Request $request, $id)
  // {
  //     try {
  //         // Ambil data presensi berdasarkan ID
  //         $presensi = Presensi::findOrFail($id);
  
  //         // Lakukan validasi data dari form edit
  //         $request->validate([
  //             'clockIn' => 'required|date_format:H:i', // Format jam (HH:mm)
  //             'clockOut' => 'required|date_format:H:i', // Format jam (HH:mm)
  //         ]);
  
  //         // Simpan perubahan pada data presensi
  //         $presensi->jam_masuk = date('Y-m-d') . ' ' . $request->input('clockIn') . ':00';
  //         $presensi->jam_pulang = date('Y-m-d') . ' ' . $request->input('clockOut') . ':00';
  //         $presensi->save();
  
  //         // Kirim respons JSON sebagai konfirmasi berhasil
  //         return response()->json(['message' => 'Data presensi berhasil diperbarui.']);
  //     } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
  //         // Data tidak ditemukan
  //         return response()->json(['message' => 'Data presensi tidak ditemukan.'], 404);
  //     } catch (\Exception $e) {
  //         // Penanganan kesalahan lainnya
  //         return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data.'], 500);
  //     }
  // }

  public function showedit($id)
  {
    $presensi = Presensi::findOrFail($id);
    $shift = ParamPresensi::All();
    $timeoff = ParamTimeOff::All();
    $ovtime = OverTime::where('id','=',$presensi->fk_overtime)->first();
              // ->where('id_kar','=',$presensi->id_karyawan)->where('status_approve','=','approve')->first();
    // dd($ovtime->mulai);
    return view('presensi.showedit', compact('presensi','shift','timeoff','ovtime'));

  }

  public function exportmodal()
  {
    $employ = Karyawan::all();
    $cabang = Cabang::all();
    return view('presensi.daily.export', compact('employ','cabang'));
  }

  public function exportmodal_external()
  {
    $employ = Karyawan::all();
    $cabang = Cabang::all();
    return view('presensi.daily.export_external', compact('employ','cabang'));
  }

  // public function showedit($id)
  // {
  //   $presensi = Presensi::findOrFail($id);
  //   $shift = ParamPresensi::all();
  //   $timeoff = TimeOff::all();

  //   // Mengelompokkan data berdasarkan nilai statusoff (case-insensitive)
  //   $groupedTimeOff = $timeoff->groupBy(function ($item) {
  //       return strtolower($item->statusoff);
  //   });

  //   // Mengambil nilai unik dari kelompok data
  //   $uniqueTimeOff = $groupedTimeOff->map(function ($items) {
  //       return $items->first();
  //   });

  //   return view('presensi.showedit', compact('presensi', 'shift', 'uniqueTimeOff'));
  // }

// ICAL
  // public function editpresensi(Request $request, $id)
  // {
  //   $presensi = Presensi::where('id', $id)->latest()->first();
  //   $paramPresensi = $presensi->parampresensi;
    
  //   $batasOnTime = Carbon::createFromFormat('H:i:s', $paramPresensi->jam_masuk)->subSecond(59);
  //   $cekJamMasuk = Carbon::parse($request->clockIn);
    
  //   if ($request->clockIn === null) {
  //     $presensi->jam_masuk = null;
  //     $presensi->presensi_status = null;
  //   } else {
  //     $jamMasuk = Carbon::parse($request->date . ' ' . $request->clockIn);
  //     $presensi->jam_masuk = $jamMasuk;
      
  //     if ($cekJamMasuk < $batasOnTime) {
  //       $presensi->presensi_status = "Earlyin";
  //     } elseif ($cekJamMasuk >= $batasOnTime && $cekJamMasuk <= $paramPresensi->jam_pulang) {
  //       $presensi->presensi_status = "OnTime";
  //     } elseif ($cekJamMasuk > $paramPresensi->jam_pulang && $cekJamMasuk <= $paramPresensi->maks_telat_kerja) {
  //       $presensi->presensi_status = "OnTime";
  //     }
  //   }
    
  //   if ($request->clockOut !== null) {
  //     $jamPulang = Carbon::parse($request->date . ' ' . $request->clockOut);
  //     $presensi->jam_pulang = $jamPulang;
  //   } else {
  //     $presensi->jam_pulang = null;
  //   }

  //   $presensi->id_parampresensi = $request->shift_id;
  //   $presensi->save();

  //   if ($request->time_off === "clear" && $request->time_off !== null) {
  //     $trans = TimeOff::where('tanggal', $presensi->tanggal)
  //       ->where('id_karyawan', $presensi->id_karyawan)
  //       ->latest()
  //       ->first();
          
  //     if ($trans) {
  //       $trans->status_approve = "Reject";
  //       $trans->save();

  //       $paramTimeOff = ParamTimeOff::findOrFail($trans->statusoff);
        
  //       if ($paramTimeOff->type === 'CUTI') {
  //         $cutiKaryawan = CutiKaryawan::where('id_kar', $presensi->id_karyawan)->first();
          
  //         if ($cutiKaryawan) {
  //           $cutiKaryawan->sisa_cuti += 1;
  //           $cutiKaryawan->save();
  //         }
  //       }
        
  //       $presensi->id_parampresensi = $request->shift_id;
  //       $presensi->presensi_status = null;
  //       $presensi->save();
  //     } else {
  //       $presensi->id_parampresensi = $request->shift_id;
  //       $presensi->presensi_status = null;
  //       $presensi->save();
  //     }
  //   }

  //   if ($request->time_off !== "clear" && $request->time_off !== null) {
  //     $trans = TimeOff::where('tanggal', $presensi->tanggal)
  //     ->where('id_karyawan', $presensi->id_karyawan)
  //     ->latest()
  //     ->first();
          
  //     $paramTimeOff = ParamTimeOff::findOrFail($request->time_off);

  //     if ($trans) {
  //       if ($paramTimeOff->type === 'CUTI') {
  //         $cutiKaryawan = CutiKaryawan::where('id_kar', $presensi->id_karyawan)->first();
          
  //         if ($cutiKaryawan) {
  //           $cutiKaryawan->sisa_cuti -= 1;
  //           $cutiKaryawan->save();
  //         }
  //       } else {
  //         $cutiKaryawan = CutiKaryawan::where('id_kar', $presensi->id_karyawan)->first();
          
  //         if ($cutiKaryawan) {
  //           $cutiKaryawan->sisa_cuti += 1;
  //           $cutiKaryawan->save();
  //         }
  //       }
        
  //       $trans->statusoff = $paramTimeOff->nama;
  //       $trans->save();
        
  //       $presensi->id_parampresensi = $request->shift_id;
  //       $presensi->presensi_status = $trans->statusoff;
  //       $presensi->save();
  //     } else {
  //       if ($paramTimeOff->type === 'CUTI') {
  //         $cutiKaryawan = CutiKaryawan::where('id_kar', $presensi->id_karyawan)->first();
          
  //         if ($cutiKaryawan) {
  //           $cutiKaryawan->sisa_cuti -= 1;
  //           $cutiKaryawan->save();
  //         }
  //       } else {
  //         $cutiKaryawan = CutiKaryawan::where('id_kar', $presensi->id_karyawan)->first();
          
  //         if ($cutiKaryawan) {
  //           $cutiKaryawan->sisa_cuti += 1;
  //           $cutiKaryawan->save();
  //         }
  //       }
          
  //       TimeOff::create([
  //         'tanggal' => $presensi->tanggal,
  //         'statusoff' => $paramTimeOff->nama,
  //         'id_karyawan' => $presensi->id_karyawan,
  //         'status_approve' => 'approve',
  //         'tanggal_approve' => $presensi->tanggal,
  //       ]);
          
  //       $presensi->id_parampresensi = $request->shift_id;
  //       $presensi->presensi_status = $paramTimeOff->nama;
  //       $presensi->save();
  //     }
  //   }
  // }

  
  


  //UPDATE EDIT PRESENSI KARYAWAN
  public function editpresensi(Request $request, $id)
  {
    $presensi = Presensi::where('id','=',$id)->get()->last();
    $cek_jam_masuk = $presensi->parampresensi->jam_masuk;
    $cek_jam_pulang = $presensi->parampresensi->jam_pulang;
    $cek_awal_absen_masuk = $presensi->parampresensi->awal_absen_masuk;
    $cek_maks_telat_kerja = $presensi->parampresensi->maks_telat;
    $batas_ontime = Carbon::createFromFormat('H:i:s', $cek_jam_masuk)->subSecond(59)->format('H:i:s');
    $cek_jam_masuk = Carbon::parse($request->clockIn)->format('H:i:s');
    $year = Carbon::parse($request->date)->format('Y');

    $presensi->user_update = Auth::user()->id;
    $presensi->menu_update  = "MENU EDIT PRESENSI";
    $presensi->save();

    $copy_table = PresensiEditLog::create([
      'tanggal' =>$presensi->tanggal ?? null,
      'jam_masuk' =>$presensi->jam_masuk ?? null,
      'jam_pulang' =>$presensi->jam_pulang ?? null,
      'image_masuk' =>$presensi->image_masuk ?? null,
      'image_pulang' =>$presensi->image_pulang ?? null,
      'latitude' =>$presensi->latitude ?? null,
      'longitude' =>$presensi->longitude ?? null,
      'latitude_pulang' =>$presensi->latitude_pulang ?? null,
      'longitude_pulang' =>$presensi->longitude_pulang ?? null,
      'keterangan' =>$presensi->keterangan ?? null, 
      'presensi_status' =>$presensi->presensi_status ?? null,
      'presensi_status_pulang' =>$presensi->presensi_status_pulang ?? null,
      'id_karyawan' =>$presensi->id_karyawan ?? null,           
      'id_user' =>$presensi->id_user ?? null,
      'istirahat_keluar' =>$presensi->istirahat_keluar ?? null,
      'istirahat_masuk' =>$presensi->istirahat_masuk ?? null,
      'fk_overtime' => $presensi->fk_overtime ?? null,          
      'fk_timeoff' => $presensi->fk_timeoff ?? null,
      'user_update' =>$presensi->fk_user_update ?? null,
      'menu_akses'   => $presensi->menu_akses ?? null,#$data->menu_akses_update
    ]);

    ##CEK DATA clockIn Jika Kosong maka jam_masuk isi null dan presensi_status Juga isi null jam_pulang Juga isi null
    if(($request->clockIn == null)){
      $presensi->jam_masuk = null;
      $presensi->presensi_status = null;
      $presensi->jam_pulang = null;
    };
    ##Akhir CEK DATA clockIn Jika Kosong maka jam_masuk isi null dan presensi_status Juga isi null jam_pulang Juga isi null
    ##CEK DATA clockIn Jika ISI maka jam_masuk isi $jam_masuk dan presensi_status isi Sesuai Kondisi earlyin,ontime,late
    if(!($request->clockIn == null)){
        $jam_masuk = Carbon::parse($request->date.' '.$request->clockIn)->format('Y-m-d H:i:s');
        $presensi->jam_masuk = $jam_masuk;
        if($cek_jam_masuk < $batas_ontime){
          $presensi->presensi_status = "Earlyin";
        }
        if ($cek_jam_masuk >= $batas_ontime && $cek_jam_masuk <= $cek_jam_masuk) {
            $presensi->presensi_status = "OnTime";
        }
        if($cek_jam_masuk > $cek_jam_masuk and $cek_jam_masuk <= $cek_maks_telat_kerja){
          $presensi->presensi_status = "OnTime";
        }
    };
    ##CEK DATA clockOut Jika ISI maka jam_pulang isi null
    if(($request->clockOut == null)){
      $presensi->jam_pulang = null;
    };
    ##Akhir DATA clockOut Jika ISI maka jam_pulang isi null
    ##CEK DATA clockOut Jika ISI maka jam_pulang isi $jam_pulang
    if(!($request->clockOut == null)){
      $jam_pulang = Carbon::parse($request->date.' '.$request->clockOut)->format('Y-m-d H:i:s');
      $presensi->jam_pulang = date('Y-m-d') . ' ' . $request->input('clockOut') . ':00';
    };
    ##Akhir DATA clockOut Jika ISI maka jam_pulang isi $jam_pulang
    
    ##DATA shift_id Jika ISI maka id_parampresensi isi $request->shift_id;
    $presensi->id_parampresensi = $request->shift_id;
    $presensi->save();
    ##Akhir DATA shift_id Jika ISI maka id_parampresensi isi $request->shift_id;

    ##CEK DATA APAKAH SEBELUMNYA ADA TIME OFFNYA ATAU TIDAK, Jika Ada Beri Nilai Id Time Offnya, Jika tidak ada beri angka 0
    if($presensi->get_fk_timeoff){
      $timeoff_awal = $presensi->get_fk_timeoff->id;
    };
    if(!($presensi->get_fk_timeoff)){
      $timeoff_awal = 0;
    };
    ###TIME OFF
    ##AKHIR CEK DATA APAKAH SEBELUMNYA ADA TIME OFFNYA ATAU TIDAK, Jika Ada Beri Nilai Id Time Offnya, Jika tidak ada beri angka 0
    ##DATA Time Off Jika Pilihan Isi maka id_parampresensi isi $request->shift_id;
    // $trans = TimeOff::where('id','=',$timeoff_awal->id)->first();
    if ($request->time_off == "clear" || $request->time_off == null ){
        $trans = TimeOff::where('id','=',$timeoff_awal)->first();
        #$trans_baru = ParamTimeOff::where('id','=',$request->time_off)->first();
        if ($trans){
          // if($trans->get_fkparam->type == "CUTI"){
          if($trans->get_fkparam->kuota == "Mengurangi"){
            $cekjatah = CutiKaryawan::where('id_kar', $presensi->id_karyawan)->where('tahun', $year)->take(1)->first();
            $hitung = $cekjatah->sisa_cuti + 1;
            $jum = $cekjatah->update(['sisa_cuti' => $hitung]);
          }
          // if($trans->get_fkparam->type != "CUTI" ){
          if($trans->get_fkparam->kuota != "Mengurangi"){
            $cekjatah = CutiKaryawan::where('id_kar', $presensi->id_karyawan)->where('tahun', $year)->take(1)->first();
          }

          #$trans->statusoff = "Reject";
          #$trans->statusoff = $trans_baru->nama;
          $trans->status_approve = "Reject";
          $trans->save();
          $presensi->id_parampresensi = $request->shift_id;
          $presensi->presensi_status = null ;  
          $presensi->fk_timeoff = null ;  
          $presensi->save();
        }else{
          $presensi->id_parampresensi = $request->shift_id;
          $presensi->presensi_status = null;
          $presensi->fk_timeoff = null;
          $presensi->save();
        }
    }
    if ($request->time_off != "clear" && $request->time_off != null ){
      $trans = TimeOff::where('id','=',$timeoff_awal)->first();
      $trans_baru = ParamTimeOff::where('id','=',$request->time_off)->first();
      if ($trans){
            // if($trans->get_fkparam->type == "CUTI" && $trans_baru->type != "CUTI" ){
            if($trans->get_fkparam->kuota == "Mengurangi" && $trans_baru->kuota != "Mengurangi" ){
              $cekjatah = CutiKaryawan::where('id_kar', $presensi->id_karyawan)->where('tahun', $year)->take(1)->first();
              $hitung = $cekjatah->sisa_cuti + 1;
              $jum = $cekjatah->update(['sisa_cuti' => $hitung]);

              $paramtimeoff = ParamTimeOff::findOrFail($request->time_off);
              $trans->statusoff = $paramtimeoff->nama;
              $trans->fk_param = $paramtimeoff->id;
              $trans->save();
              $presensi->id_parampresensi = $request->input('shift_id');
              $presensi->presensi_status = $trans_baru->nama ;  
              $presensi->fk_timeoff = $trans->id; 
              $presensi->save();
            }
            // if($trans->get_fkparam->type != "CUTI" && $trans_baru->type == "CUTI" ){
            if($trans->get_fkparam->kuota != "Mengurangi" && $trans_baru->kuota == "Mengurangi" ){
              $cekjatah = CutiKaryawan::where('id_kar', $presensi->id_karyawan)->where('tahun', $year)->take(1)->first();
              $hitung = $cekjatah->sisa_cuti - 1;
              $jum = $cekjatah->update(['sisa_cuti' => $hitung]);

              $paramtimeoff = ParamTimeOff::findOrFail($request->time_off);
              $trans->statusoff = $paramtimeoff->nama;
              $trans->fk_param = $paramtimeoff->id; 
              $trans->save();
              $presensi->presensi_status = $trans_baru->nama ;  
              $presensi->id_parampresensi = $request->input('shift_id');
              $presensi->fk_timeoff = $trans->id;
              $presensi->save();
            }
            // if($trans->get_fkparam->type == "CUTI" && $trans_baru->type == "CUTI" ){
            if($trans->get_fkparam->kuota == "Mengurangi" && $trans_baru->kuota == "Mengurangi" ){
                $paramtimeoff = ParamTimeOff::findOrFail($request->time_off);
                $trans->statusoff = $paramtimeoff->nama;
                $trans->fk_param = $paramtimeoff->id;
                $trans->save();
                $presensi->presensi_status = $trans_baru->nama ;  
                $presensi->id_parampresensi = $request->input('shift_id');
                $presensi->fk_timeoff = $trans->id;
                $presensi->save();
            }
            // if($trans->get_fkparam->type != "CUTI" && $trans_baru->type != "CUTI" ){
              if($trans->get_fkparam->kuota != "Mengurangi" && $trans_baru->kuota != "Mengurangi" ){
              $paramtimeoff = ParamTimeOff::findOrFail($request->time_off);
              $trans->statusoff = $paramtimeoff->nama;
              $trans->fk_param = $paramtimeoff->id;
              $trans->save();
              $presensi->presensi_status = $trans_baru->nama ;  
              $presensi->id_parampresensi = $request->input('shift_id');
              $presensi->fk_timeoff = $trans->id;
              $presensi->save();
          }
      }else{
          $paramtimeoff = ParamTimeOff::findOrFail($request->time_off);
          $trans = TimeOff::create([
            'tanggal'     => $presensi->tanggal,
            'statusoff'   => $paramtimeoff->nama,
            'id_karyawan' => $presensi->id_karyawan,
            'status_approve' => 'approve',
            'tanggal_approve' => $presensi->tanggal,
            'fk_param' => $request->time_off,
        ]);
          // if($presensi->get_fkparam == Null && $trans_baru->type == "CUTI" ){
          if($presensi->get_fkparam == Null && $trans_baru->kuota == "Mengurangi" ){
          $cekjatah = CutiKaryawan::where('id_kar', $presensi->id_karyawan)->where('tahun', $year)->take(1)->first();
          $hitung = $cekjatah->sisa_cuti - 1;
          $jum = $cekjatah->update(['sisa_cuti' => $hitung]);
        }
          $presensi->id_parampresensi = $request->input('shift_id');
          $presensi->presensi_status = $trans->statusoff ;  
          $presensi->fk_timeoff = $trans->id;  
          $presensi->save();         
      }
    }

    ###OVER TIME / LEMBUR
    // dd($request->ovtstart,$request->ovtend);
    if ($request->ovtstart && $request->ovtend ){
      $mulai = $waktu1 = Carbon::parse($request->ovtstart);
      $jammulai = $mulai->format('H:i:00');
      $waktu1 = Carbon::parse($request->ovtstart);
      $waktu2 = Carbon::parse($request->ovtend);
      $hitung_durasi = $waktu1->diff($waktu2);
      $jamDurasi = $hitung_durasi->format('%H');
      $menitDurasi = $hitung_durasi->format('%I');
      $durasi = $jamDurasi.":".$menitDurasi;
      // dd($jammulai,$presensi->parampresensi->jam_pulang, intval($jamDurasi));
      if (!($presensi->fk_overtime)){
        if ($jammulai >= $presensi->parampresensi->jam_pulang && intval($jamDurasi) >= 3){
          $overtm = OverTime::create([
            'id_kar' => $presensi->id_karyawan,
            'tanggal' => $presensi->tanggal,
            'tanggal_overtime' => $presensi->id_karyawan,
            'mulai' => $request->ovtstart,
            'akhir' => $request->ovtend,
            'durasi' => $durasi,
            'kompensasi' => "Paid",
            'status_approve' => "approve",
            'note' => "Over Time Refisi"
        ]);
        $presensi->fk_overtime = $overtm->id;  
        $presensi->save();     
        // dd($presensi->parampresensi->id,$presensi->parampresensi->jam_pulang);
        }else{
          return response()->json(['message' => 'Pengajuan Lembur Harus lebih Dari jam '.$presensi->parampresensi->jam_pulang .' dan berudurasi minimal 3 Jam', 'code' => '403'], 403);
        }        
      }
      if ($presensi->fk_overtime){
        if ($jammulai >= $presensi->parampresensi->jam_pulang && intval($jamDurasi) >= 3){
          $ovt = OverTime::where('id','=',$presensi->fk_overtime)->first();         
            $ovt->mulai = $request->ovtstart;
            $ovt->akhir = $request->ovtend;
            $ovt->durasi = $durasi;
            $ovt->kompensasi = "Paid";
            $ovt->status_approve = "approve";
            $ovt->note = "Over Time Refisi";
            $presensi->fk_overtime = $ovt->id;  
            $presensi->save();     
        }else{
          return response()->json(['message' => 'Pengajuan Lembur Harus lebih Dari jam '.$presensi->parampresensi->jam_pulang .' dan berudurasi minimal 3 Jam', 'code' => '403'], 403);
        }        
      }
    }
    if ($request->ovtstart == Null && $request->ovtend == Null){
      if ($presensi->fk_overtime){
            $ovt = OverTime::where('id','=',$presensi->fk_overtime)->first();         
            $ovt->status_approve = "Reject";
            $ovt->note = "Over Time Refisi";       
            $ovt->save();
            $presensi->fk_overtime = Null;  
            $presensi->save();     
      }
    }
  }
      
  

  public function earlyin()
  {
      $skr = Carbon::now()->toDateString();
      $earlyintoday = Presensi::whereDate('tanggal','=',$skr)->where('presensi_status','=','EarlyIn')
      ->with(['preskaryawan' => function($query){ $query;}])
      ->with(['preskaryawan.cabang' => function($query){ $query;}])->get();
      return view('presensi.daily.earlyin', compact('earlyintoday'));
  }

  public function ontime()
  {
      $skr = Carbon::now()->toDateString();
      $ontimetoday = Presensi::whereDate('tanggal','=',$skr)->where('presensi_status','=','OnTime')
      ->with(['preskaryawan' => function($query){ $query;}])
      ->with(['preskaryawan.cabang' => function($query){ $query;}])->get();
      return view('presensi.daily.ontime', compact('ontimetoday'));
  }

  public function latein()
  {
      $skr = Carbon::now()->toDateString();
      $latetoday = Presensi::whereDate('tanggal','=',$skr)->where('presensi_status','=','Late')
      ->with(['preskaryawan' => function($query){ $query;}])
      ->with(['preskaryawan.cabang' => function($query){ $query;}])->get();
      return view('presensi.daily.latein', compact('latetoday'));
  }

  public function attendin()
  {
      $skr = Carbon::now()->toDateString();
      $attendtoday = Presensi::whereDate('tanggal','=',$skr)->whereNotNull('jam_masuk')
      ->with(['preskaryawan' => function($query){ $query;}])
      ->with(['preskaryawan.cabang' => function($query){ $query;}])->get();
      return view('presensi.daily.attend', compact('attendtoday'));
  }

  public function timeoff()
  {
      $skr = Carbon::now()->toDateString();
      $timeofftoday = Presensi::whereDate('tanggal','=',$skr)->where('presensi_status','=','Timeoff')
      ->with(['preskaryawan' => function($query){ $query;}])
      ->with(['preskaryawan.cabang' => function($query){ $query;}])->get();
      return view('presensi.daily.timeoff', compact('timeofftoday'));
  }

  public function absen()
  {
      $skr = Carbon::now()->toDateString();
      $absenofftoday = Presensi::whereDate('tanggal','=',$skr)->whereNull('presensi_status')
      ->with(['preskaryawan' => function($query){ $query;}])
      ->with(['preskaryawan.cabang' => function($query){ $query;}])->get();
      return view('presensi.daily.absen', compact('absenofftoday'));
  }

  public function noclockin()
  {
      $skr = Carbon::now()->toDateString();
      $noclockinofftoday = Presensi::whereDate('tanggal','=',$skr)->whereNull('jam_masuk')
      ->with(['preskaryawan' => function($query){ $query;}])
      ->with(['preskaryawan.cabang' => function($query){ $query;}])->get();
      return view('presensi.daily.noclockin', compact('noclockinofftoday'));
  }

  public function noclockout()
  {
      $skr = Carbon::now()->toDateString();
      $noclockoutofftoday = Presensi::whereDate('tanggal','=',$skr)->whereNull('jam_pulang')
      ->with(['preskaryawan' => function($query){ $query;}])
      ->with(['preskaryawan.cabang' => function($query){ $query;}])->get();
      return view('presensi.daily.noclockout', compact('noclockoutofftoday'));
  }

  public function dayoff()
  {
      $skr = Carbon::now()->toDateString();
      $dayofftoday = Presensi::whereDate('tanggal','=',$skr)->where('presensi_status','=','DayOff')
      ->with(['preskaryawan' => function($query){ $query;}])
      ->with(['preskaryawan.cabang' => function($query){ $query;}])->get();
      return view('presensi.daily.dayoff', compact('dayofftoday'));
  }

// public function earlyin()
// {
//     $skr = Carbon::now()->toDateString();
//     $earlyintoday = Presensi::whereDate('tanggal','=',$skr)->where('presensi_status','=','EarlyIn')->get();
//     return view('presensi.daily.earlyin', compact('earlyintoday'));
// }

// public function ontime()
// {
//     $skr = Carbon::now()->toDateString();
//     $ontimetoday = Presensi::whereDate('tanggal','=',$skr)->where('presensi_status','=','OnTime')->get();
//     return view('presensi.daily.ontime', compact('ontimetoday'));
// }

// public function latein()
// {
//     $skr = Carbon::now()->toDateString();
//     $latetoday = Presensi::whereDate('tanggal','=',$skr)->where('presensi_status','=','Late')->get();
//     return view('presensi.daily.latein', compact('latetoday'));
// }

// public function attendin()
// {
//     $skr = Carbon::now()->toDateString();
//     $attendtoday = Presensi::whereDate('tanggal','=',$skr)->whereNotNull('jam_masuk')->get();
//     $timeoff = Presensi::whereDate('tanggal','=',$skr)->where('presensi_status','=','Timeoff')->get();
//     return view('presensi.daily.attend', compact('attendtoday'));
// }

// public function timeoff()
// {
//     $skr = Carbon::now()->toDateString();
//     $timeofftoday = Presensi::whereDate('tanggal','=',$skr)->where('presensi_status','=','Timeoff')->get();
//     return view('presensi.daily.timeoff', compact('timeofftoday'));
// }

// public function dayoff()
// {
//     $skr = Carbon::now()->toDateString();
//     $dayofftoday = Presensi::whereDate('tanggal','=',$skr)->where('presensi_status','=','DayOff')->get();
//     return view('presensi.daily.dayoff', compact('dayofftoday'));
// }

public function showImageFromFTP()
{
    // $filePath = 'tesfirman/1230215003_2023-09-05_09:54:52.png'; // Sesuaikan dengan path file di FTP
    // $image_url = Storage::disk('ftp_server')->url($filePath);
    #$filePath = 'tesimage/123021223_2023-09-05_09:54:52.png'; // Sesuaikan dengan path file di FTP
    // $adapter = Storage::disk('ftp_server')->getDriver()->getAdapter();
    // $image_url = $adapter->applyPathPrefix($filePath);

    $filePath = '/tesfirman/1230215003_2023-09-05_09:54:52.png'; // Sesuaikan dengan path file di FTP
    $filesystem = Storage::disk('ftp_server')->getDriver()->getAdapter()->getFilesystem();
    $image_url = $filesystem->getAdapter()->getClient()->getMetadata($filePath)['uri'];

    dd($image_url);
    return view('presensi.show_image', compact('image_url'));
}


  public function logpresensikar($id) {
    $prs = Presensi::where('id_karyawan','=', $id)->orderBy('tanggal', 'DESC')->paginate(31);
    return view('presensi.attendancelogkar', compact('prs'));
  }
  public function breaktime(Request $request) {
    $karyawan = Karyawan::whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation"])->count();
    $skr = Carbon::now()->toDateString();
    $date_now = new DateTime(date('Y-m-d'));
    $out = Presensi::whereDate('tanggal','=',$skr)->whereNotNull('istirahat_keluar')->count();
    $in = Presensi::whereDate('tanggal','=',$skr)->whereNotNull('istirahat_masuk')->count();
    $cabang = Cabang::get();

    if ($request->has('search')) {
      $krs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
              ->whereHas('preskaryawan', function ($query) use ($request){
            $query->where('nama_lengkap', 'like', '%'.$request->cabang.'%')
            ->orwhere('nomor_induk_karyawan', 'like', '%'.$request->cabang.'%');});

      $prs = Presensi::whereDate('tanggal','=',$skr)->whereHas('preskaryawan', function ($query) use ($request){
        $query->where('nama_lengkap', 'like', '%'.$request->search.'%')
              ->orwhere('nomor_induk_karyawan', 'like', '%'.$request->search.'%');})
              ->with(['parampresensi' => function($query){
              $query;}])
              ->orwhereHas('preskaryawan.jabatan', function ($query) use ($request){
                $query->where('nama', 'like', '%'.$request->search.'%');
                })
              ->with(['preskaryawan.bagian' => function($query){
              $query;}])
              ->orwhereHas('preskaryawan.cabang', function ($query) use ($request){
              $query->where('nama', 'like', '%'.$request->search.'%');
              })->paginate(20)->withQueryString();
            return view('presensi.istirahat', compact('karyawan', 'out', 'in', 'cabang', 'krs', 'prs'));

      }


    if ($request->has('report')) {
      $this->validate($request, [
      'cabang' => 'required',
      'format'=> 'required',
      'startdate'=> 'required',
      'enddate'=> 'required',
      #'cari'=> 'required',


      ]);

      if(empty($request->cari) && $request->format=='view' ){

      $cabs = Cabang::All();

      $start_date = $request->startdate;
      $end_date = $request->enddate;
      $krs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
            ->whereHas('preskaryawan', function ($query) use ($request){
            $query->where('nama_lengkap', 'like', '%'.$request->cabang.'%')
            ->orWhere('nomor_induk_karyawan', 'like', '%'.$request->cabang.'%');});

      $prs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
        ->whereHas('preskaryawan', function ($query) use ($request){
        $query->where('fk_cabang','=', $request->cabang)
        ;})
        ->with(['parampresensi' => function($query){
        $query;}])
        ->with(['preskaryawan.jabatan' => function($query){
        $query;}])
        ->with(['preskaryawan.bagian' => function($query){
        $query;}])
        ->with(['preskaryawan.cabang' => function($query){
        $query;}])

        ->paginate(20)->withQueryString();

      }

      if(!empty($request->cari) && $request->format=='view' ){
      // if($request->format=='view'){
          $cabs = Cabang::All();
          $start_date = $request->startdate;
          $end_date = $request->enddate;
          $krs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
                ->whereHas('preskaryawan', function ($query) use ($request){
                $query->where('nama_lengkap', 'like', '%'.$request->cabang.'%')
                ->orWhere('nomor_induk_karyawan', 'like', '%'.$request->cabang.'%');});
            $prs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
            ->whereHas('preskaryawan', function ($query) use ($request){
            $query->where('fk_cabang','=', $request->cabang)
            ->where('nama_lengkap','=', $request->cari)
            ;})
            ->with(['parampresensi' => function($query){
            $query;}])
            ->with(['preskaryawan.jabatan' => function($query){
            $query;}])
            ->with(['preskaryawan.bagian' => function($query){
            $query;}])
            ->with(['preskaryawan.cabang' => function($query){
            $query;}])
            ->paginate(20)->withQueryString();
        }
      #tanpa nama
      if(empty($request->cari) && $request->format=='excel' ){
      // if($request->format=='view'){
      $cabs = Cabang::All();
      $start_date = $request->startdate;
      $end_date = $request->enddate;
      $krs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
          ->whereHas('preskaryawan', function ($query) use ($request){
          $query->where('nama_lengkap', 'like', '%'.$request->cabang.'%')
          ->orWhere('nomor_induk_karyawan', 'like', '%'.$request->cabang.'%');});
      $prs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
      ->whereHas('preskaryawan', function ($query) use ($request){
      $query->where('fk_cabang','=', $request->cabang)
      ;})
      ->with(['parampresensi' => function($query){
      $query;}])
      ->with(['preskaryawan.jabatan' => function($query){
      $query;}])
      ->with(['preskaryawan.bagian' => function($query){
      $query;}])
      ->with(['preskaryawan.cabang' => function($query){
      $query;}])
      ->get();

      return (new PresensisExport($cabang,$prs,$start_date,$end_date))->download('presensi_karyawan.xlsx');#membuat excel
     }
     #dengan nama cari
      if(!empty($request->cari) && $request->format=='excel' ){
      // if($request->format=='view'){
        $cabs = Cabang::All();
        $start_date = $request->startdate;
        $end_date = $request->enddate;
        $krs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
              ->whereHas('preskaryawan', function ($query) use ($request){
              $query->where('nama_lengkap', 'like', '%'.$request->cabang.'%')
              ->orWhere('nomor_induk_karyawan', 'like', '%'.$request->cabang.'%');});
          $prs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
          ->whereHas('preskaryawan', function ($query) use ($request){
          $query->where('fk_cabang','=', $request->cabang)
          ->where('nama_lengkap','=', $request->cari)
          ;})
          ->with(['parampresensi' => function($query){
          $query;}])
          ->with(['preskaryawan.jabatan' => function($query){
          $query;}])
          ->with(['preskaryawan.bagian' => function($query){
          $query;}])
          ->with(['preskaryawan.cabang' => function($query){
          $query;}])
          ->get();
      return (new PresensisExport($cabang,$prs,$start_date,$end_date))->download('presensi_karyawan.xlsx');#membuat excel
      }
      #tanpa cari nama
      if(empty($request->cari) && $request->format=='pdf' ){
      // if($request->format=='view'){
          $cabs = Cabang::All();
          $start_date = $request->startdate;
          $end_date = $request->enddate;
          $krs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
                ->whereHas('preskaryawan', function ($query) use ($request){
                $query->where('nama_lengkap', 'like', '%'.$request->cabang.'%')
                ->orWhere('nomor_induk_karyawan', 'like', '%'.$request->cabang.'%');});
            $prs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
            ->whereHas('preskaryawan', function ($query) use ($request){
            $query->where('fk_cabang','=', $request->cabang)
            ;})
            ->with(['parampresensi' => function($query){
            $query;}])
            ->with(['preskaryawan.jabatan' => function($query){
            $query;}])
            ->with(['preskaryawan.bagian' => function($query){
            $query;}])
            ->with(['preskaryawan.cabang' => function($query){
            $query;}])
            ->get();

        $pdf = \PDF::loadView('presensi.report_presensi', compact('krs','prs','cabang','start_date','end_date'))->setPaper('a4', 'landscape');
        return $pdf->stream('data_presensi_karyawan.pdf');
      }

      if(!empty($request->cari) && $request->format=='pdf' ){
        // if($request->format=='view'){
            $cabs = Cabang::All();
            $start_date = $request->startdate;
            $end_date = $request->enddate;
            $krs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
                  ->whereHas('preskaryawan', function ($query) use ($request){
                  $query->where('nama_lengkap', 'like', '%'.$request->cabang.'%')
                  ->orWhere('nomor_induk_karyawan', 'like', '%'.$request->cabang.'%');});
              $prs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
              ->whereHas('preskaryawan', function ($query) use ($request){
              $query->where('fk_cabang','=', $request->cabang)
              ->where('nama_lengkap','=', $request->cari)
              ;})
              ->with(['parampresensi' => function($query){
              $query;}])
              ->with(['preskaryawan.jabatan' => function($query){
              $query;}])
              ->with(['preskaryawan.bagian' => function($query){
              $query;}])
              ->with(['preskaryawan.cabang' => function($query){
              $query;}])
              ->get();

          $pdf = \PDF::loadView('presensi.report_presensi', compact('krs','prs','cabang','start_date','end_date'))->setPaper('a4', 'landscape');
          return $pdf->stream('data_presensi_karyawan.pdf');
        }


    }

  else{
          $skr = Carbon::now()->toDateString();
          $prs = Presensi::whereDate('tanggal','=',$skr)->with(['preskaryawan' => function($query){
          $query;}])
          ->with(['parampresensi' => function($query){
          $query;}])
          ->with(['preskaryawan.jabatan' => function($query){
          $query;}])
          ->with(['preskaryawan.bagian' => function($query){
          $query;}])
          ->with(['preskaryawan.cabang' => function($query){
          $query;}])->paginate(20);

          $krs = Presensi::whereDate('tanggal','=',$skr)->with(['preskaryawan' => function($query){
            $query;}])->get();

            session(['nama-datalist' => $krs]);

            return view('presensi.istirahat', compact('karyawan', 'out', 'in', 'cabang', 'krs', 'prs'));

  }
    return view('presensi.istirahat', compact('karyawan', 'out', 'in', 'cabang'));
  }
public function showcapture(Request $request)
  {
    $nik = Auth::user()->getkaryawan->nomor_induk_karyawan;
    $id_karyawan = Karyawan::where('nomor_induk_karyawan', $nik)->get()->last();
    $cek_lat_cabang = $id_karyawan->cabang->latitude;
		$cek_lon_cabang = $id_karyawan->cabang->longitude;
    return view('presensi.capture', compact('cek_lat_cabang', 'cek_lon_cabang'));
  }
  public function capturestore(Request $request)
    {
    //   $validator = Validator::make($request->all(), [
    //     'nik'    => 'nullable',
    //     'image'  => 'nullable',
    //     'lat'    => 'nullable',
    //     'long'   => 'nullable',
    //     'foto'   => 'nullable',
    // ]);
    // dd($request->all());
    // if ($validator->fails()){
    //     #return response()->json($validator->errors(),422);
    //     return response()->json(['message' => 'Perikasa Kembali Inputan Anda', 'code' => 'error'], 422);
    // }
    $id_karyawan = Karyawan::where('nomor_induk_karyawan', $request->nik)->get()->last();
	  if ($id_karyawan == Null) {
      return response()->json(['message' => 'Anda Belum Terdaftar Sebagai Karyawan', 'code' => 'warning7'], 200);
	  }
    else{
      $cek_radius     = $id_karyawan->cabang->radius;
      $unit           = $id_karyawan->cabang->satuan_radius;
      $cek_lat_cabang = $id_karyawan->cabang->latitude;
      $cek_lon_cabang = $id_karyawan->cabang->longitude;
    ###HITUNG JARAK AWAL
    $latitude1  = doubleval($request->lat);  ###Posisi Absen
    $longitude1 = doubleval($request->long); ###Posisi Absen
    $latitude2  = doubleval($cek_lat_cabang); ###Posisi Cabang
    $longitude2 = doubleval($cek_lon_cabang); ###Posisi Cabang
    $theta = $longitude1 - $longitude2; 
    $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta))); 
    $distance = acos($distance); 
    $distance = rad2deg($distance); 
    $distance = $distance * 60 * 1.1515; 
     
    switch($unit) { 
        case 'miles': 
      break; 
        case 'Kilometer' : 
          $distance = $distance * 1.609344; 
            break; 
              case 'Meter' : 
                $distance = $distance *  1609.344; 
    } 
    if ($distance > $cek_radius) {
              return response()->json(['message' => 'Jarak Anda Diluar jangkauan!!'.'ieu jarakna'.$distance, 'code' => 'warning1','distance' => $distance ,'unit' => $unit], 200);#400);
    }if ($distance <= $cek_radius) {
        // $cv = $request->file('image_masuk');
        // $extcv = $request->file('image_masuk')->getClientOriginalExtension();
        // $CvName = $request->nik.'_'.date('Y-m-d_H:i:s').'.'.'png';
        // $cv->storeAs('presensi', $CvName);	
        
        $image = $request->image;
        #$latitude = $request->lat;
        #$longitude = $request->long;
        $image_parts = explode(";base64,", $image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[01]);
        $FotoName = $request->nik.'_'.date('Y-m-d_H:i:s').'.'.'png';
        $folderPath = "presensi/";
        $file = $folderPath . $FotoName;
        Storage::put($file, $image_base64);

        $ayeuna = new DateTime( date('Y-m-d H:i:s') );
        $date_now = new DateTime( date('Y-m-d'));
        $cek_absen = Presensi::select('*')->where('id_karyawan', '=', $id_karyawan->id)->where('tanggal','=', $date_now)->get()->last();
        $skr = $ayeuna->format('H:i:s');
        if ($cek_absen) {
            $cek_jam_masuk = $cek_absen->parampresensi->jam_masuk;
            $cek_jam_pulang = $cek_absen->parampresensi->jam_pulang;
            $cek_awal_absen_masuk = $cek_absen->parampresensi->awal_absen_masuk;
            $cek_maks_telat_kerja = $cek_absen->parampresensi->maks_telat;
        if ($cek_absen->jam_masuk != Null and $cek_absen->jam_pulang != Null) {
              return response()->json(['message' => 'Anda Sudah Absen Pulang Kerja!!', 'code' => 'warning2'], 200); #403);
        }if ($cek_absen->jam_masuk == Null) {
            if($skr < $cek_jam_masuk){
                $cek_absen->update([
                    'image_masuk'     => $FotoName,
                    'jam_masuk'       => $ayeuna,
                    'id_user'         => $id_karyawan->fk_user,
                    'latitude'        => $request->lat,
                    'longitude'       => $request->long,
                    'tanggal'         => $date_now,
                    'id_karyawan'     => $id_karyawan->id,
                    'keterangan'      => 'EarlyIn',##
                    'presensi_status' => 'EarlyIn',##Untuk Penarikan Report (EarlyIn,Late,Off,Cuti dll)
                ]);
                  return response()->json(['message' => 'Absen Masuk Berhasil Early In!!', 'code' => 'Success1'], 200);
        }
            if($skr == $cek_jam_masuk){
                $cek_absen->update([
                    'image_masuk'     => $FotoName,
                    'jam_masuk'       => $ayeuna,
                    'id_user'         => $id_karyawan->fk_user,
                    'latitude'        => $request->lat,
                    'longitude'       => $request->long,
                    'tanggal'         => $date_now,
                    'id_karyawan'     => $id_karyawan->id,
                    'keterangan'      => 'OnTime',
                    'presensi_status' => 'OnTime',
                 ]);
                 return response()->json(['message' => 'Absen Masuk Berhasil Ontime!!', 'code' => 'Success2'], 200);
      }

      if($skr > $cek_jam_masuk and $skr <= $cek_maks_telat_kerja){ 
          //Cek periode dari tanggal sekarang (tentukan awal dan akhir periode)
          // if (Carbon::now()->format('d') < 21) {
          //    $awal = Carbon::now()->subMonth()->format('Y-m-d');
          //    $akhir =  Carbon::now()->format('Y-m-d');
          // } else {
          //    $awal =  Carbon::now()->format('Y-m-d');
          //    $akhir = Carbon::now()->addMonth()->format('Y-m-d');
          // }
          //Query Get Consecutive Late in this periode by id_karyawan
          //    $consect = DB::select(DB::raw("SELECT max(Consecutive_Days) as jumlah_consecutive 
          //        from (SELECT t.tanggal, t.id_karyawan, t.presensi_status, 
          //        DATEDIFF(t.tanggal, MIN(t.tanggal) 
          //            OVER( PARTITION BY t.DateGroup_Num ORDER BY t.tanggal)) +1 AS Consecutive_Days
          //        FROM( SELECT tanggal, id_karyawan, presensi_status, SUM( IF( DATEDIFF(tanggal, Prev_Date) = 1, 0, 1) ) 
          //            OVER( PARTITION BY id_karyawan ORDER BY tanggal)  AS DateGroup_Num
          //                FROM ( SELECT tanggal, id_karyawan, presensi_status, 
          //                    LAG(tanggal,1) OVER (PARTITION BY id_karyawan ORDER BY tanggal) AS Prev_Date
          //                        FROM presensis
          //                        where presensi_status = 'Late' and id_karyawan = '$id_karyawan'
          //                        and tanggal between '$awal' and '$akhir'
          //                    ) grp
          //                ) t 
          //                ) ta"));
          //            //Query Get Late amount
          //    $late_amount = DB::select(DB::raw("SELECT count(id_karyawan)
          //        FROM presensis
          //        where presensi_status = 'Late' and id_karyawan = '$id_karyawan' 
          //        and tanggal between '$awal' and '$akhir'"));
          //        if ($con == 3) {
          //            return response()->json(['message' => 'Tidak bisa absen, sudah telat 3 kali berturut-turut di periode ini'], 200);
          //        }
          //        elseif ($late == 5) {
          //           return response()->json(['message' => 'Tidak bisa absen, sudah telat 5 kali di periode ini'], 200);
          //        }
          //        else {
                      $cek_absen->update([
                          'image_masuk'     => $FotoName,
                          'jam_masuk'       => $ayeuna,
                          'id_user'         => $id_karyawan->fk_user,
                          'latitude'        => $request->lat,
                          'longitude'       => $request->long,
                          'tanggal'         => $date_now,
                          'id_karyawan'     => $id_karyawan->id,
                          'keterangan'      => 'Late',
                          'presensi_status' => 'Late',
		      ]); 
           // }
                      return response()->json(['message' => 'Absen Masuk Berhasil Late!!', 'code' => 'Success3'], 200);
                  }elseif($cek_absen->jam_masuk == Null and $skr >= $cek_maks_telat_kerja){
                      return response()->json(['message' => 'Bukan Jam Masuk Kerja!!', 'code' => 'warning3'], 200);#403);
              }
        }
              if ($cek_absen->jam_masuk != Null and $skr < $cek_jam_pulang) {
          return response()->json(['message' => 'Anda Sudah Melakukan Absen Masuk Kerja!!', 'code' => 'warning4'], 200);#403);
              }
        if ($cek_absen->jam_masuk != Null and $skr >= $cek_jam_pulang) {
                  if($skr >= $cek_jam_pulang){
                      $cek_absen->update([
                          'image_pulang'     => $FotoName,
                          'jam_pulang'       => $ayeuna,
                          'id_user'          => $id_karyawan->fk_user,
                          'latitude_pulang'  => $request->lat,
                          'longitude_pulang' => $request->long,
                      ]);
                      return response()->json(['message' => 'Absen Pulang Berhasil!!', 'code' => 'Success4'], 200);
                  }if($skr <= $cek_jam_pulang){
                      return response()->json(['message' => 'Bukan Jam Pulang Kerja!!', 'code' => 'warning5'], 200); #403);
                  }
              }
    }
    #JIka Belum Ada Di Table Presensi (blom ke Create Absennya)
    if (!($cek_absen)) {	
            return response()->json(['message' => 'Presensi Anda Belum Terdaftar!!', 'code' => 'warning6'], 200);#400
    }

        }
      }
    
   
        // $image = $request->image;
        // $latitude = $request->lat;
        // $longitude = $request->long;
        // $image_parts = explode(";base64,", $image);
        // $image_type_aux = explode("image/", $image_parts[0]);
        // $image_type = $image_type_aux[1];
        // $image_base64 = base64_decode($image_parts[01]);
        // $FotoName = $request->nik.'_'.$latitude.'_'.$longitude.'_'.date('Y-m-d_H:i:s').'.'.'png';
        // $folderPath = "presensi/";
        // $file = $folderPath . $FotoName;
	      // Storage::put($file, $image_base64);
        
        // $data = [
        //     'filename' => $FotoName,
        //     'latitude' => $latitude,
        //     'longitude' => $longitude,
        // ];
        #Foto::create($data);
        #return redirect()->back();
        #return response()->json(['message' => 'Anda Berhasil Absen cooyyy', 'code' => 'berhasil'], 200);#400);
    }


    public function createshift(Request $request)
    {
      $years = $this->getYearList();   
      return view('presensi.createshift', compact('years'));
    }


    // Fungsi untuk mengambil daftar tahun
    private function getYearList()
    {
        $tes = Carbon::now()->addYear(2);
        $currentYear = $tes->format('Y');
        $years = [];
        
        for ($year = $currentYear; $year >= 2000; $year--) {
            $years[] = $year;
        }

        return $years;
    }

    public function eksekusicreateshift(Request $request)
    {

      $tes = Carbon::now()->addYear(1);
      $tahundepan = $tes->format('Y');
      $mulai = new Carbon($tahundepan . '-01-01');
      $akhir = new Carbon($tahundepan . '-12-31');
      dd($mulai,$akhir);

      $auth = Auth::user();
      $startPeriod = new Carbon($request->tahun . '-01-01');
      $endPeriod = new Carbon($request->tahun . '-01-13');
      $period = CarbonPeriod::create($startPeriod, $endPeriod);
      // dd('ini tahun ya=',$request->tahun,'ini jenis Karyawan ya=',$request->jenis_karyawan, 'ini Periode ya=',$period);
      $kar = Karyawan::where('jenis_karyawan','=',$request->jenis_karyawan)
      ->whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation","AKTIF"])->get();
      $paroff = ParamPresensi::where('jenis_shift','=','Off')->where('status','=','Aktif')->first();
      $parho = ParamPresensi::where('jenis_shift','=','HO')->where('status','=','Aktif')->first();
      $parop1 = ParamPresensi::where('jenis_shift','=','OP1')->where('status','=','Aktif')->first();
      
      foreach ($kar as $kar) {
        foreach ($period as $dr) {
          $namaHari = $dr->format('l');
          if ($kar->fk_bagian == 2 ){
            if ($namaHari == "Sunday"){
              $cr = Presensi::create(['tanggal' => $dr->format('Y-m-d'),'id_karyawan' => $kar->id,
              'id_user' => $auth->id, 'id_parampresensi' => $paroff->id,'created_at' => date('Y-m-d H:i:s')]);
            }else{
              $cr = Presensi::create(['tanggal' => $dr->format('Y-m-d'),'id_karyawan' => $kar->id,
              'id_user' => $auth->id, 'id_parampresensi' => $parho->id,'created_at' => date('Y-m-d H:i:s')]);
            }
          }else{ ##Untuk Opertional
            $cr = Presensi::create(['tanggal' => $dr->format('Y-m-d'),'id_karyawan' => $kar->id,
              'id_user' => $auth->id, 'id_parampresensi' => $parop1->id,'created_at' => date('Y-m-d H:i:s')]);
          }
        }
        
      }
    }

    
    

}


