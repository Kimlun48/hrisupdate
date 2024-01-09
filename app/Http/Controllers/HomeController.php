<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Apllyloker;
use App\Models\Cabang;
use App\Models\Karyawan;
use App\Models\Pelamar;
use App\Models\Loker;
use App\Models\Presensi;
use Carbon\Carbon;
use App\Models\Perusahaan;
use App\Models\CutiKaryawan;
use App\Models\Announcement;
use App\Models\TimeOff;
use App\Models\PicApprove;
use Auth;
use DateTime;


class HomeController extends Controller {
public $perusahaan;
    public function index(Request $request) {
        $id_user = Auth::user();
        #dd($id_user);
        if ($id_user == null) {
            return view('home.index');
        }else{
            $timenow = new DateTime(date('Y-m-d'));
            $id_user = Auth::user();
            // dd($id_user->status_user);
            $cabs = Cabang::get();
            $uss = Pelamar::all()->first();
            $loks = Loker::all();
            $employes = Karyawan::take(50)->latest()->get();
            // dd($employes);
            $list = Apllyloker::take(50)->latest()->get();

            // chart vacancy
            $hasil = DB::table('perusahaans')
                ->select('perusahaans.*', DB::raw('(SELECT COUNT(*) 
                    FROM apllylokers INNER JOIN lokers ON lokers.id = apllylokers.loker_id 
                    INNER JOIN cabangs ON cabangs.id = lokers.fk_penempatan 
                    WHERE perusahaans.id = cabangs.fk_nama_perusahaan)
                    AS get_applyloker_count'))->get();

            $data['label'] = $hasil->pluck('nama')->toArray();
            $data['data'] = $hasil->pluck('get_applyloker_count')->toArray();
            $hasil = $this->$hasil = json_encode($data);

            // chart reference
            $lamar = DB::table('pelamars AS itungpelamar')
                ->select('referensi_job', DB::raw('COUNT(*) as get_pelamar'))
                ->groupBy('referensi_job')
                ->get();

            $result['label'] = $lamar->pluck('referensi_job')->toArray();
            $result['data'] = $lamar->pluck('get_pelamar')->toArray();
            $ref = $this->$lamar = json_encode($result);

            $cek = $id_user->roles->pluck('name')[0];
            // dd($cek);
                
            if($cek == "admin" OR $cek == "SUPERADMIN"){
                $id_user = Auth::user();
                $timenow = new DateTime(date('Y'));
                $kary = Karyawan::where("fk_user", "=", $id_user->id)->first();
                $employes = Karyawan::get();


                return view('home.index', compact('list', 'loks', 'uss', 'cabs', 'employes', 'hasil', 'ref', 'kary', 'id_user'));
            } else {
                $pics = PicApprove::where("kar_approve",'=',$id_user->getkaryawan->id)->where("status",'=','aktif')->count();

                $timenow = new DateTime(date('Y'));
                $id_user = Auth::user();
                $kary = Karyawan::where("fk_user", "=", $id_user->id)->first();
                $anns = Announcement::Where("status", "=", "Aktif")->orderBy('id', 'DESC')->get();
                $tmfs = TimeOff::where('tanggal', $timenow)->get();
                $sisacuti = CutiKaryawan::where('id_kar','=', $id_user->getkaryawan->id)
                ->where('tahun','=', $timenow)->first();
                return view('dashboard.index', compact('pics','kary', 'anns','tmfs','hasil','ref', 'id_user','sisacuti'));
            }

        }
    }
    
    // public function dashboard() {
    //     $id_user = Auth::user();
    //     $pics = PicApprove::where("kar_approve",'=',$id_user->getkaryawan->id)->where("status",'=','aktif')->count();
    //     $timenow = new DateTime(date('Y-m-d'));
    //     $kary = Karyawan::where("fk_user", "=", $id_user->id)->first();
    //     $tmfs = TimeOff::where('tanggal', $timenow)->get();
    //     $anns = Announcement::Where("status", "=", "Aktif")->orderBy('id', 'DESC')->get();

    //     $list = Apllyloker::take(50)->latest()->get();


    //     // chart vacancy
    //     $hasil = DB::table('perusahaans')
    //         ->select('perusahaans.*', DB::raw('(SELECT COUNT(*) 
    //         FROM apllylokers INNER JOIN lokers ON lokers.id = apllylokers.loker_id 
    //         INNER JOIN cabangs ON cabangs.id = lokers.fk_penempatan 
    //         WHERE perusahaans.id = cabangs.fk_nama_perusahaan)
    //     AS get_applyloker_count'))->get();

    //     $data['label'] = $hasil->pluck('nama')->toArray();
    //     $data['data'] = $hasil->pluck('get_applyloker_count')->toArray();
    //     $hasil = $this->$hasil = json_encode($data);

    //     // chart reference
    //     $lamar = DB::table('pelamars AS itungpelamar')
    //         ->select('referensi_job', DB::raw('COUNT(*) as get_pelamar'))
    //         ->groupBy('referensi_job')
    //         ->get();

    //     $result['label'] = $lamar->pluck('referensi_job')->toArray();
    //     $result['data'] = $lamar->pluck('get_pelamar')->toArray();
    //     $ref = $this->$lamar = json_encode($result);

    //     $timenow = new DateTime(date('Y'));
    //     $sisacuti = CutiKaryawan::where('id_kar','=', $id_user->getkaryawan->id)
    //     ->where('tahun','=', $timenow)->first();
    //     return view('dashboard.index', compact('pics','kary','list','sisacuti', 'anns', 'id_user', 'tmfs', 'hasil', 'ref'));
    // }

    public function dashboard() {
        $id_user = Auth::user();
        $pics = PicApprove::where("kar_approve",'=',$id_user->getkaryawan->id)->where("status",'=','aktif')->count();
        $timenow = new DateTime(date('Y-m-d'));
        $currentDate = Carbon::now()->format('l, j F Y');
        $kary = Karyawan::where("fk_user", "=", $id_user->id)->first();
        $currentMonth = Carbon::now()->format('m');
        $ultah = Karyawan::whereRaw("MONTH(tgl_lahir) = $currentMonth")->get();
        $employes = Karyawan::take(50)->latest()->get();
        $tmfs = TimeOff::where('tanggal', $timenow)->get();
        $anns = Announcement::Where("status", "=", "Aktif")->orderBy('id', 'DESC')->get();
        // Get the current month

        $offStatus = ["cuti opname", "cuti", "cuti tahunan", "off"];

        $off = Presensi::whereIn("presensi_status", $offStatus)
            ->whereMonth('tanggal', $currentMonth)
        ->get();

        // dd($off);
    
        $list = Apllyloker::take(50)->latest()->get();
    
        // Chart Vacancy
        $hasil = DB::table('perusahaans')
            ->select('perusahaans.*', DB::raw('(SELECT COUNT(*) 
            FROM apllylokers INNER JOIN lokers ON lokers.id = apllylokers.loker_id 
            INNER JOIN cabangs ON cabangs.id = lokers.fk_penempatan 
            WHERE perusahaans.id = cabangs.fk_nama_perusahaan)
        AS get_applyloker_count'))->get();
    
        $data['labels'] = $hasil->pluck('nama')->toArray();
        $data['data'] = $hasil->pluck('get_applyloker_count')->toArray();
    
        // Chart Reference
        $lamar = DB::table('pelamars AS itungpelamar')
            ->select('referensi_job', DB::raw('COUNT(*) as get_pelamar'))
            ->groupBy('referensi_job')
            ->get();
    
        $result['labels'] = $lamar->pluck('referensi_job')->toArray();
        $result['data'] = $lamar->pluck('get_pelamar')->toArray();
    
        $timenow = new DateTime(date('Y'));
        $sisacuti = CutiKaryawan::where('id_kar','=', $id_user->getkaryawan->id)
            ->where('tahun','=', $timenow)->first();
    
        return view('dashboard.index', compact('pics','off','employes','ultah','currentDate','kary','list','sisacuti', 'anns', 'id_user', 'tmfs', 'data', 'result'));
    }
    
}
                                         
