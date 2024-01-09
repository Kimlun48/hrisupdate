<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use Auth;
use App\Models\LevelJabatan;
use App\Models\Watcher;
use App\Models\Presensi;
use App\Models\PicApprove;
use Carbon\Carbon;

class KaryawanController extends Controller
{
  
    public function apikar(Request $request)
    {
        if ($request->searchEmployee){
          $krs = Karyawan::with('jabatan')->with('cabang')
          ->whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation"])
          ->where('nama_lengkap','like',"%".$request->searchEmployee."%")
          ->orwhere('nomor_induk_karyawan','like',"%".$request->searchEmployee."%")
          ->paginate(20);#->get();
         return response()->json(['message' => 'Success', 'code' => '200', 'data' => $krs]);
        }
        else{
          $krs = Karyawan::with('jabatan')->with('cabang')
          ->whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation"])->paginate(20);#->get();
         return response()->json(['message' => 'Success', 'code' => '200', 'data' => $krs]);
        }
	      
    }

    public function presensisubordinate(Request $request) {
	$start_date = $request->startdate;
	#$end_date = $request->enddate;
        $id_user = Auth::user();
        $skr = Carbon::now()->toDateString();
        $lvl_jab = $id_user->getkaryawan->fk_level_jabatan;
	if(!$start_date) {
		#|| (!$end_date)){
	       $subordinate = Presensi::with('preskaryawan.jabatan')->whereDate('tanggal','=',$skr)
	       ->whereHas('preskaryawan.cabang', function($query) use ($id_user){
               $query->where('fk_cabang','=', $id_user->getkaryawan->fk_cabang);}) ##Filter Berdasar cabang (mengabil dri model karyawan)
               ->whereHas('preskaryawan.jabatan', function($query) use ($lvl_jab){
               $query->where('parent_id','=', $lvl_jab);}) ####Filter Berdasarkan Jabatan USer Yang login sesuai dengan model Level_jabatan)
               ->with(['preskaryawan' => function($query){$query;}]) ##Ambil Semua Data KAryawan
	       ->get(); ##Mengambil Semua 
	}
	else{
	       #$subordinate = Presensi::with('preskaryawan.jabatan')->whereBetween('tanggal',[$start_date, $end_date])
               $subordinate = Presensi::with('preskaryawan.jabatan')->wheredate('tanggal','=',$start_date)
	       ->whereHas('preskaryawan.cabang', function($query) use ($id_user){
	       $query->where('fk_cabang','=', $id_user->getkaryawan->fk_cabang);
	       })->whereHas('preskaryawan.jabatan', function($query) use ($lvl_jab){
	       $query->where('parent_id','=', $lvl_jab);})
	       ->with(['preskaryawan' => function($query){$query;}])
	       ->get();
	 }
            return response()->json(['message' => 'Success', 'code' => '200', 'data' => $subordinate]);
    }


      public function absenanakbuah(Request $request) {
        $start_date = $request->startdate;
        $end_date = $request->enddate;
        $id_user = Auth::user();
        $skr = Carbon::now()->toDateString();
        $lvl_jab = $id_user->getkaryawan->fk_level_jabatan;
	if((!$start_date) || (!$end_date)){
	    $subordinate = Karyawan::with(['karpres' => function ($query) use ($skr) {
              $query->whereDate('tanggal', '=', $skr);
              }])
                ->where('fk_level_jabatan', '=', $lvl_jab)
                ->orWhereHas('jabatan', function ($query) use ($lvl_jab) {
                $query->where('parent_id', '=', $lvl_jab);
              })
             ->get();
        }
	else{
            $subordinate = Karyawan::with(['karpres' => function ($query) use ($start_date, $end_date) {
              $query->whereBetween('tanggal', [$start_date, $end_date]);
            }])
              ->where('fk_level_jabatan', '=', $lvl_jab)
              ->orWhereHas('jabatan', function ($query) use ($lvl_jab) {
              $query->where('parent_id', '=', $lvl_jab);
            })
            ->get();
         }
            return response()->json(['message' => 'Success', 'code' => '200', 'data' => $subordinate]);
    }

    public function level_karyawan(Request $request)
    {
      $user = Auth::user();
      $lm =  Karyawan::where('fk_user', $user->id)->get()->last();
      $pics = PicApprove::where("kar_approve",'=',$user->getkaryawan->id)->where("status",'=','aktif')->count();
      if($pics >= 1){
        $lev_kar_pic = "1";
      }else{
        $lev_kar_pic = "0";
      }
	    if($user->status_user === 'Pelamar' or $user->status_user === 'Admin'){
          return response()->json(['lev_kar_jabatan' => $lm,'lev_kar_pic' => $lev_kar_pic]);
	    }else{
          $level_jab = $lm->jabatan->kode;
          return response()->json(['lev_kar_jabatan' => $level_jab,'lev_kar_pic' => $lev_kar_pic]);
      } 
    }


    public function watcher(Request $request)
    {
      $user = Auth::user();
      $wact =  Watcher::where('id_wacher', $user->id)->get();    
      return response()->json(['data' => $wact]);
    }




}
