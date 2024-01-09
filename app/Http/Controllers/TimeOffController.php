<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimeOff;
use App\Models\LevelJabatan;
use App\Models\ParamTimeOff;
use App\Models\CutiKaryawan;
use App\Models\Karyawan;
use App\Models\Presensi;
use App\Models\PresensiRequest;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\DB;
use DateTime;
use Carbon\Carbon;
use Validator;
class TimeOffController extends Controller
{

    public function cobacekcuti()
    {
        
        $kars = Karyawan::whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation","AKTIF"])->get();
        $tanggalAkhir = Carbon::parse(new DateTime(date('d-m-Y')));
        $tglakhir = $tanggalAkhir->format('m-d');
            
        foreach ($kars as $kar) {
            ##Tanggal Gabung
            $tanggalAwal = Carbon::parse($kar->tahun_gabung);
            $tglawal = $tanggalAwal->format('m-d');

            #hitung berapa tahun Dia Bekerja
            $perbedaanTahun = $tanggalAwal->diffInYears($tanggalAkhir);

            if($tglawal == $tglakhir && $perbedaanTahun == 1){
                $hitawal  = new Carbon($tanggalAkhir->format('Y-'). $tglawal);#Carbon::parse(new DateTime(date('d-m-Y')));
                $hitakhir = new Carbon($tanggalAkhir->format('Y'). '-12-31');
                $perbedaanbulan = $hitawal->diffInMonths($hitakhir);
                $cek = CutiKaryawan::where('id_kar' ,'=',$kar->id)->where('tahun' ,'=', $hitakhir->format('Y'))->get()->first();
                if($cek){
                    
                }else{
                    $cr = CutiKaryawan::create(['mulai_cuti' => $hitawal,'id_kar' => $kar->id,
                    'akhir_cuti' => $hitakhir, 'jumlah_cuti' => $perbedaanbulan + 1,'sisa_cuti' => $perbedaanbulan + 1,'tahun' =>$hitakhir->format('Y')]);
                }
                // if(!($cek)){
                //     $cr = CutiKaryawan::create(['mulai_cuti' => $hitawal,'id_kar' => $kar->id,
                //     'akhir_cuti' => $hitakhir, 'jumlah_cuti' => $perbedaanbulan + 1,'sisa_cuti' => $perbedaanbulan + 1,'tahun' =>$hitakhir->format('Y')]);
                // }
            }
        }
        // foreach ($kar as $kar) {
        //     ##Tanggal Gabung
        //     $tanggalAwal = Carbon::parse($kar->tahun_gabung);
        //     $tglawal = $tanggalAwal->format('m/d');

        //     ##Tanggal HARI INI (Setahun Dia Kerja dari Tanggal Gabung)
        //     $tanggalAkhir = Carbon::parse(new DateTime(date('d-m-Y')));
        //     $tglakhir = $tanggalAkhir->format('m/d');

        //     $perbedaanTahun = $tanggalAwal->diffInYears($tanggalAkhir);

        //     if($tglawal == $tglakhir && $perbedaanTahun == 1){
        //         $hitawal  = Carbon::parse(new DateTime(date('d-m-Y')));
        //         $hitakhir = new Carbon($tanggalAkhir->format('Y'). '-12-31');
        //         $perbedaanbulan = $hitawal->diffInMonths($hitakhir);
        //         $cek = CutiKaryawan::where('id_kar' ,'=',$kar->id)->where('tahun' ,'=', $hitakhir->format('Y'))->get()->first();
        //         if(!($cek)){
        //             $cr = CutiKaryawan::create(['mulai_cuti' => $hitawal,'id_kar' => $kar->id,
        //             'akhir_cuti' => $hitakhir, 'jumlah_cuti' => $perbedaanbulan + 1,'sisa_cuti' => $perbedaanbulan + 1,'tahun' =>$hitakhir->format('Y')]);
        //         }
        //     }           
        // }
            return redirect()->to('https://staging.anyargroup.co.id/timeoffops');
        // return view('cabang.index', compact('kar'));
    }
    public function index_timeoff_ops()
    {
        // dd(Auth::user()->id);
        $ayeuna = new DateTime(date('d-m-Y'));
        $now = $ayeuna->format('d/m/Y');
        return view('timeoffops.index_ops', compact('now'));
    }
    public function read_timeoff_ops()
    {
        $id_user = Auth::user();
        ##PA SEVA
        if($id_user->id == 186) {
            $offs = TimeOff::where('status_approve','=','PengajuanOff')->whereHas('karyawan.cabang.perusahaan', function ($query) {
                $query->whereIn('id', [53]);
            })
            ->whereHas('karyawan.cabang', function ($query){
                $query->whereIn('id',[73,74,75] );
            })
            ->paginate(10);
        }
        // ##PA DIDI
        if($id_user->id == 1642) {
            $offs = TimeOff::where('status_approve','=','PengajuanOff')->whereHas('karyawan.cabang.perusahaan', function ($query) {
                $query->whereIn('id', [53]);
            })
            ->whereHas('karyawan.cabang', function ($query){
                $query->whereIn('id',[73,74,75] );
            })
            ->paginate(10);
        }
        // ##PA HImawan
        if($id_user->id == 1039) {
            $offs = TimeOff::where('status_approve','=','PengajuanOff')->whereHas('karyawan.cabang.perusahaan', function ($query) {
                $query->whereIn('id', [50,51]);
            })->paginate(10);
        }
       
        return view('timeoffops.read_all_ops')->with(['data'=>$offs]);
    }

    public function approve_timeoff_ops()
    {
        $id_user = Auth::user();
        ##PA SEVA
        if($id_user->id == 186) {
            $offs = TimeOff::where('status_approve','=','approve')->whereHas('karyawan.cabang.perusahaan', function ($query) {
                $query->whereIn('id', [53]);
            })
            ->whereHas('karyawan.cabang', function ($query){
                $query->whereIn('id',[73,74,75] );
            })
            ->paginate(10);
        }
        // ##PA DIDI
        if($id_user->id == 1642) {
            $offs = TimeOff::where('status_approve','=','approve')->whereHas('karyawan.cabang.perusahaan', function ($query) {
                $query->whereIn('id', [53]);
            })
            ->whereHas('karyawan.cabang', function ($query){
                $query->whereIn('id',[73,74,75] );
            })
            ->paginate(10);
        }
        // ##PA HImawan
        if($id_user->id == 1039) {
            $offs = TimeOff::where('status_approve','=','approve')->whereHas('karyawan.cabang.perusahaan', function ($query) {
                $query->whereIn('id', [50,51]);
            })->paginate(10);
        }
       
        return view('timeoffops.list_approve_reject')->with(['data'=>$offs]);
    }

    public function reject_timeoff_ops()
    {
        $id_user = Auth::user();
        ##PA SEVA
        if($id_user->id == 186) {
            $offs = TimeOff::where('status_approve','=','reject')->whereHas('karyawan.cabang.perusahaan', function ($query) {
                $query->whereIn('id', [53]);
            })
            ->whereHas('karyawan.cabang', function ($query){
                $query->whereIn('id',[73,74,75] );
            })
            ->paginate(10);
        }
        // ##PA DIDI
        if($id_user->id == 1642) {
            $offs = TimeOff::where('status_approve','=','reject')->whereHas('karyawan.cabang.perusahaan', function ($query) {
                $query->whereIn('id', [53]);
            })
            ->whereHas('karyawan.cabang', function ($query){
                $query->whereIn('id',[73,74,75] );
            })
            ->paginate(10);
        }
        // ##PA HImawan
        if($id_user->id == 1039) {
            $offs = TimeOff::where('status_approve','=','reject')->whereHas('karyawan.cabang.perusahaan', function ($query) {
                $query->whereIn('id', [50,51]);
            })->paginate(10);
        }
       
        return view('timeoffops.list_approve_reject')->with(['data'=>$offs]);
    }
    
    public function index()
    {
        $tmf = TimeOff::paginate(10);
        $ayeuna = new DateTime(date('d-m-Y'));
        $now = $ayeuna->format('d/m/Y');
        return view('timeoff.index', compact('tmf','now'));
    }
    public function levjab()
    {
        $id_user = Auth::user();
        $lm =  Karyawan::where('fk_user', $id_user->id)->get()->last();
        $level_jab = $lm->fk_level_jabatan;
        $tmlead = LevelJabatan::where('parent_id','=',$level_jab)->first();
        $offs = DB::table("time_offs")
            ->leftJoin("karyawans", function($join){
	        $join->on("karyawans.id", "=", "time_offs.id_karyawan");
        })
            ->leftJoin("level_jabatans", function($join){
	        $join->on("level_jabatans.id", "=", "karyawans.fk_level_jabatan");
        })
            ->select("karyawans.nama_lengkap","time_offs.id","time_offs.tanggal","time_offs.statusoff")
            ->where("level_jabatans.parent_id", "=", $level_jab)
        ->get();
  
        return view('timeoff.list_off', compact('offs'));
    }

    // public function approvetimeoff(Request $request, $id)
    // {
        
    //     $this->validate($request, [
    //         'tanggal_approve' => 'required',
    //         'statusapprove'       => 'required', ##Approved, Reject
    //     ]);
    //     $ver_awal = TimeOff::where('id', $id)->get()->last();
    //     $ver_awal->tanggal_approve  = $request->tanggal;
    //     $ver_awal->notes  = $request->notes;
    //     $ver_awal->statusoff    = $request->statusapprove;
    //     $ver_awal->save();
    //     return new TimeOffResource(true, 'Data Presensi Berhasil Ditambahkan!!', $ver_awal);
    //     #return new TimeOffResource(true, 'Data TimeOff Berhasil Ditambahkan!', $savetime);
    // }

    public function approvetimeoff(Request $request, $id)
    {
        $user_id = Auth::user();
        $validator = Validator::make($request->all(), [
            'tanggal_approve' => 'required',
	        'status_approve'   => 'required', ##Approve, Reject
	        #'notes' => 'required',
		]);
        $up_time = TimeOff::where('id', $id)->get()->last();
        
	if ($request->status_approve == 'approve') {
        $up_time->update([
            'tanggal_approve' => $request->tanggal_approve,
            'status_approve'  => $request->status_approve,
            #'notes'           => $request->notes,
	    ]);

            $cekabsen = Presensi::where(['id_karyawan' => $up_time->id_karyawan, 'tanggal' => $up_time->tanggal])->get()->last();
            // $prsn = $cekabsen->update(['presensi_status' => $up_time->statusoff,'fk_timeoff' => $up_time->id,]);
            $prsn = $cekabsen->update(['presensi_status' => $up_time->get_fkparam->nama,'fk_timeoff' => $up_time->id]);
            $year =  Carbon::create($up_time->tanggal)->format('Y');
            if($up_time->get_fkparam->kuota = "Mengurangi"){
            #if($up_time->statusoff=="Cuti"){
                $cekjatah = CutiKaryawan::where('id_kar', $up_time->id_karyawan)->where('tahun', $year)->take(1)->first();
                $hitung = $cekjatah->sisa_cuti - 1;
                $jum = $cekjatah->update(['sisa_cuti' => $hitung]);
                }
        // #Format KIRIM NOTIF FIREBASE Approval Ke sendiri (atasan)
        $dataapp = ['key1' => 'Approve TimeOff '.$up_time->statusoff]; ##Untuk tanda saat Di Klik Di Mobil (android) 
        $to = $user_id->device_token;
        $body = "You have ". $up_time->status_approve .' '. $up_time->karyawan->nama_lengkap. " attendance request!";
        ###Format KIRIM NOTIF FIREBASE Karyawan (bawahan)
	    $to1    = $up_time->karyawan->user->device_token;
        $body1  = $user_id->name.' has approved your Time Off ('. $up_time->statusoff.') request!';
        $result = $this->sendPush($to,  $body, $data=$dataapp); ##Mengirin Notif KE FireBase Karyawan Sendiri) Atasan
        $hasil1 = $this->sendPush($to = $to1, $body=$body1, $data=$dataapp); ##Mengirin Notif KE FireBase Bawahan

            $kar = Karyawan::findOrFail($up_time->id_karyawan);
            //Send Notif E-Mail
            $reqattend = [
                'greeting' => 'Dear '.$kar->nama_lengkap.',',
                'body' => 'Your Request for TimeOff (' . $up_time->statusoff . ') in ' . Carbon::create($up_time->tanggal)->format('d F Y,'),
                'thanks' => 'With Note : ' . $up_time->notes,
                'actionText' => 'Has Been Approved',
                'actionURL' => url('https://hris.anyargroup.co.id/login'),
            ];
            Notification::send($kar, new EmailApprovalNotification($reqattend));
            return response()->json(['message' => 'Approve TimeOff Berhasil', 'code' => '200', 'data' => $up_time]);
        } else {
            $kar = Karyawan::findOrFail($up_time->id_karyawan);
            //Send Notif E-Mail
            $reqattend = [
                'greeting' => 'Dear '.$kar->nama_lengkap.',',
                'body' => 'Your Request for TimeOff (' . $up_time->statusoff . ') in ' . Carbon::create($up_time->tanggal)->format('d F Y,'),
                'thanks' => 'With Note : ' . $up_time->notes,
                'actionText' => 'Has Been Rejected',
                'actionURL' => url('https://hris.anyargroup.co.id/login'),
            ];
	    Notification::send($kar, new EmailApprovalNotification($reqattend));

           return response()->json(['message' => 'Reject TimeOff Berhasil !! ', 'code' => '200', 'data' => $up_time]);
	}
    }

    public function read($id)
    {
        $data = TimeOff::where('id_karyawan', $id)->orderBy('id', 'DESC')->get();
        return view('timeoff.read')->with(['data'=>$data]);
    }

    public function readall()
    {
        // $data = TimeOff::orderBy('id', 'DESC')->get();
        $id_user = Auth::user();
        $lm =  Karyawan::where('fk_user', $id_user->id)->get()->last();
        $level_jab = $lm->fk_level_jabatan;
        $tmlead = LevelJabatan::where('parent_id','=',$level_jab)->first();
        $offs = DB::table("time_offs")
            ->leftJoin("karyawans", function($join){
	        $join->on("karyawans.id", "=", "time_offs.id_karyawan");
        })
            ->leftJoin("level_jabatans", function($join){
	        $join->on("level_jabatans.id", "=", "karyawans.fk_level_jabatan");
        })
            ->select("karyawans.nama_lengkap", "karyawans.nomor_induk_karyawan", "time_offs.id","time_offs.tanggal","time_offs.statusoff", "time_offs.status_approve" , "time_offs.dokumen")
            ->where("level_jabatans.parent_id", "=", $level_jab)
	    ->where('time_offs.status_approve','=','PengajuanOff')
            ->where('karyawans.fk_bagian','=', $lm->fk_bagian)
        ->get();
        return view('timeoff.readAll')->with(['data'=>$offs]);
    }


    public function log_timeoff_approve()
    {
        $id_user = Auth::user();
        $offs = DB::table("time_offs")
            ->leftJoin("karyawans", function($join){
	        $join->on("karyawans.id", "=", "time_offs.id_karyawan");
        })
            ->select("karyawans.nama_lengkap", "karyawans.nomor_induk_karyawan", "time_offs.id","time_offs.tanggal","time_offs.statusoff", "time_offs.status_approve" , "time_offs.dokumen")
	        ->where('time_offs.status_approve','=','approve')
        ->get();
        return view('reqattend.log_history.timeoff_approve')->with(['data'=>$offs]);
    }


    public function log_timeoff_reject()
    {
        $id_user = Auth::user();
        $offs = DB::table("time_offs")
            ->leftJoin("karyawans", function($join){
	        $join->on("karyawans.id", "=", "time_offs.id_karyawan");
        })
            ->select("karyawans.nama_lengkap", "karyawans.nomor_induk_karyawan", "time_offs.id","time_offs.tanggal","time_offs.statusoff", "time_offs.status_approve" , "time_offs.dokumen")
	        ->where('time_offs.status_approve','=','reject')
        ->get();
        return view('reqattend.log_history.timeoff_reject')->with(['data'=>$offs]);
    }

    public function readallapprove()
    {
        // $data = TimeOff::orderBy('id', 'DESC')->get();
        $id_user = Auth::user();
        $lm =  Karyawan::where('fk_user', $id_user->id)->get()->last();
        $level_jab = $lm->fk_level_jabatan;
        $tmlead = LevelJabatan::where('parent_id','=',$level_jab)->first();
        $offs = DB::table("time_offs")
            ->leftJoin("karyawans", function($join){
	        $join->on("karyawans.id", "=", "time_offs.id_karyawan");
        })
            ->leftJoin("level_jabatans", function($join){
	        $join->on("level_jabatans.id", "=", "karyawans.fk_level_jabatan");
        })
            ->select("karyawans.nama_lengkap", "karyawans.nomor_induk_karyawan", "time_offs.id","time_offs.tanggal","time_offs.statusoff", "time_offs.status_approve", "time_offs.dokumen")
            ->where("level_jabatans.parent_id", "=", $level_jab)
            ->where('time_offs.status_approve','=','Approve')
            ->where('karyawans.fk_bagian','=', $lm->fk_bagian)
        ->get();
        return view('timeoff.list_approve_reject')->with(['data'=>$offs]);
    }

    public function readallreject()
    {
        // $data = TimeOff::orderBy('id', 'DESC')->get();
        $id_user = Auth::user();
        $lm =  Karyawan::where('fk_user', $id_user->id)->get()->last();
        $level_jab = $lm->fk_level_jabatan;
        $tmlead = LevelJabatan::where('parent_id','=',$level_jab)->first();
        $offs = DB::table("time_offs")
            ->leftJoin("karyawans", function($join){
	        $join->on("karyawans.id", "=", "time_offs.id_karyawan");
        })
            ->leftJoin("level_jabatans", function($join){
	        $join->on("level_jabatans.id", "=", "karyawans.fk_level_jabatan");
        })
            ->select("karyawans.nama_lengkap", "karyawans.nomor_induk_karyawan", "time_offs.id","time_offs.tanggal","time_offs.statusoff", "time_offs.status_approve", "time_offs.dokumen")
            ->where("level_jabatans.parent_id", "=", $level_jab)
            ->where('time_offs.status_approve','=','Reject')
            ->where('karyawans.fk_bagian','=', $lm->fk_bagian)
        ->get();
        return view('timeoff.list_approve_reject')->with(['data'=>$offs]);
    }

    // public function create() 
    // {
    //     $pars = ParamTimeOff::where('status','=','Aktif')->get();
    //     return view('timeoff.create', compact('pars'));
    // }
    public function create() 
    {
        $types = ParamTimeOff::where('status', 'Aktif')->distinct()->pluck('type');
        $pars = ParamTimeOff::where('status', 'Aktif')->get();
    
        return view('timeoff.create', compact('pars', 'types'));
    }
    
    
    public function showupdate($id)
    {
        $data = TimeOff::findorfail($id);
        return view('timeoff.showedit')->with(['data'=>$data]);
    }
    // Simpan data Approve TIME OFFFFFFFFFFFF
    public function approve(Request $request, $id)
    {
        $user_id = Auth::user();
        $validator = Validator::make($request->all(), [
            'tanggal'     => 'required',
            'nama'        => 'required',
            'stsapp'      => 'required',
            'id_karyawan' => 'required',
            'notes'       => 'required',              
                ]);
        $up_time = TimeOff::where('id', $id)->get()->last();
        if ($request->stsapp == 'approve') {
            $up_time->update([
                'tanggal_approve' => $request->tanggal,
                'status_approve'  => $request->stsapp,
                'notes'           => $request->notes,
                ]);

            $cekabsen = Presensi::where(['id_karyawan' => $up_time->id_karyawan, 'tanggal' => $up_time->tanggal])->get()->last();
            $prsn = $cekabsen->update(['presensi_status' => $up_time->statusoff]);
            $year =  Carbon::create($up_time->tanggal)->format('Y');
            if($up_time->get_fkparam->kuota == "Mengurangi"){
                $cekjatah = CutiKaryawan::where('id_kar', $up_time->id_karyawan)->where('tahun', $year)->take(1)->first();
                $hitung = $cekjatah->sisa_cuti - 1;
                $jum = $cekjatah->update(['sisa_cuti' => $hitung]);
                }
            // #Format KIRIM NOTIF FIREBASE Approval Ke sendiri (atasan)
            $dataapp = ['key1' => 'Approve TimeOff '.$up_time->statusoff]; ##Untuk tanda saat Di Klik Di Mobil (android) 
            #$body = "You have ". $up_time->status_approve .' '. $up_time->karyawan->nama_lengkap. " attendance request!";
            ###Format KIRIM NOTIF FIREBASE Karyawan (bawahan)
            $to1    = $up_time->karyawan->user->device_token;
            $body1  = $user_id->name.' has approved your Time Off ('. $up_time->statusoff.') request!';
            #$result = $this->sendPush($to,  $body, $data=$dataapp); ##Mengirin Notif KE FireBase Karyawan Sendiri) Atasan
            $hasil1 = $this->sendPush($to = $to1, $body=$body1, $data=$dataapp); ##Mengirin Notif KE FireBase Bawahan

            $kar = Karyawan::findOrFail($up_time->id_karyawan);
            //Send Notif E-Mail
            $reqattend = [
                'greeting' => 'Dear '.$kar->nama_lengkap.',',
                'body' => 'Your Request for TimeOff (' . $up_time->statusoff . ') in ' . Carbon::create($up_time->tanggal)->format('d F Y,'),
                'thanks' => 'With Note : ' . $up_time->notes,
                'actionText' => 'Has Been Approved',
                'actionURL' => url('https://hris.anyargroup.co.id/login'),
            ];
            #Notification::send($kar, new EmailApprovalNotification($reqattend));
            return response()->json(['message' => 'Approve TimeOff Berhasil', 'code' => '200', 'data' => $up_time]);
        }
    }
    // Tampilkan data Approve
    public function showreject($id)
    {
        $data = TimeOff::findorfail($id);
        return view('timeoff.showreject')->with(['data'=>$data]);
    }

    // Simpan data Reject
    public function reject(Request $request, $id)
    {   
        $up_time = TimeOff::where('id', $id)->get()->last();   
        $user_id = Auth::user();
        $validator = Validator::make($request->all(), [
            'tanggal'     => 'required',
            'nama'        => 'required',
            'stsapp'      => 'required',
            'id_karyawan' => 'required',
            'notes'       => 'required',              
                ]);
        
        $up_time->update([
            'tanggal_approve' => $request->tanggal,
            'status_approve'  => $request->stsapp,
            'notes'           => $request->notes,
            ]);
        if ($up_time->status_approve == 'reject') {
            $year =  Carbon::create($up_time->tanggal)->format('Y');
            // #Format KIRIM NOTIF FIREBASE Approval Ke sendiri (atasan)
            $dataapp = ['key1' => 'Approve TimeOff '.$up_time->statusoff]; ##Untuk tanda saat Di Klik Di Mobil (android) 
            #$body = "You have ". $up_time->status_approve .' '. $up_time->karyawan->nama_lengkap. " attendance request!";
            ###Format KIRIM NOTIF FIREBASE Karyawan (bawahan)
            $to1    = $up_time->karyawan->user->device_token;
            $body1  = $user_id->name.' has Rejected your Time Off ('. $up_time->statusoff.') request!';
            #$result = $this->sendPush($to,  $body, $data=$dataapp); ##Mengirin Notif KE FireBase Karyawan Sendiri) Atasan
            $hasil1 = $this->sendPush($to = $to1, $body=$body1, $data=$dataapp); ##Mengirin Notif KE FireBase Bawahan

            $kar = Karyawan::findOrFail($up_time->id_karyawan);
            //Send Notif E-Mail
            $reqattend = [
                'greeting' => 'Dear '.$kar->nama_lengkap.',',
                'body' => 'Your Request for TimeOff (' . $up_time->statusoff . ') in ' . Carbon::create($up_time->tanggal)->format('d F Y,'),
                'thanks' => 'With Note : ' . $up_time->notes,
                'actionText' => 'Has Been Rejected',
                'actionURL' => url('https://hris.anyargroup.co.id/login'),
            ];
            #Notification::send($kar, new EmailApprovalNotification($reqattend));
            return response()->json(['message' => 'Approve TimeOff Berhasil', 'code' => '200', 'data' => $up_time]);
        } 
    }


    public function reqtimeoff($id) {
        $data = TimeOff::where('id_karyawan', $id)->orderBy('id', 'DESC')->get();
        return view('timeoff.timeoffkar')->with(['data'=>$data]);
    }
    
    ###POSTTT REQUESTTTNYAAAAAAAAAAAAAAAAAAAAAAAAAAaaaaaa
    public function store(Request $request) {
        $cekstatusoff = ParamTimeOff::where(['id' => $request->statusoff])->get()->last();	
        $user_id = Auth::user();
        $cek_atasan = Karyawan::where('fk_level_jabatan', '=', $user_id->getkaryawan->jabatan->parent_id)->latest()->first();
        $status_off = $cekstatusoff->dokumen;
        if($status_off == 'wajib') {
            $validator = \Validator::make($request->all(), [
                'tanggal'     => 'required',
                'statusoff'   => 'required',
                'dokumen'     => 'image|nullable|max:19999999',/*If commented, validation passes.*/
                'id_karyawan' => 'required',
            ]);
        }else {
            $validator = \Validator::make($request->all(), [
                'tanggal'     => 'required',
                'statusoff'   => 'required',
                'id_karyawan' => 'required',
            ]);
        }

        $cekabsen = Presensi::where(['id_karyawan' => $request->id_karyawan, 'tanggal' => $request->tanggal])->get()->last();	
        $cekstatusoff = ParamTimeOff::where(['id' => $request->statusoff])->get()->last();	
        if($cekabsen == Null){
        return response()->json(['message' => 'Presensi Belum Terdaftar', 'code' => 'warning'], 200);
        }elseif($status_off == 'wajib'){
            $file 	         = $request->file('dokumen');
            $image_name          = $request->id_karyawan.'_'.$request->statusoff.'_'.$request->tanggal.'_'.$file->getClientOriginalName();
            $filePath            = $file->storeAs('berkastimeoff', $image_name);
            $data['tanggal']     = $request->tanggal;
            $data['statusoff']   = $cekstatusoff->nama;
            $data['dokumen']     = $image_name;
            $data['id_karyawan'] = $request->id_karyawan;
            $data['status_approve'] = 'PengajuanOff';
            $data['fk_param']       = $request->statusoff;
            $data['notes_aju']      = $request->ket;
        }else {
            $data['tanggal']     = $request->tanggal;
            $data['statusoff']   = $cekstatusoff->nama;
            $data['id_karyawan'] = $request->id_karyawan;
            $data['status_approve'] = 'PengajuanOff';
            $data['notes_aju'] = $request->other;
            $data['fk_param']       = $request->statusoff;
        }
	    $tm = TimeOff::insert($data);
        return response()->json(['message' => 'Pengajuan Off Berhasil!! ', 'code' => 'success'], 200);
    }

    private function sendPush($to, $body,$data)
       {
           $title = "Daily A Team Notification";
           $icon = 'https://hris.anyargroup.co.id/assets/bootstrap/img/icon-office.png';
           $url = 'https://hris.anyargroup.co.id/';
           $FCM_AUTH_KEY = 'AAAAh0sKUrQ:APA91bE_GW1p4poeSo7mVRC-O8ZbWnwj_6lVPqwhYz7Sr7-7GBTkfLzSwMjlz_O3gGq5JiMyWVCuCVHzI_1Nn2z0hwxB-V1MCZVkCTH8a7KHuUCMFdWWuihKVn759uNZ_CUEivoFoGLx';
           $postdata = json_encode([
               'notification' => [
                   'title' => $title,
                   'body' => $body,
                   'icon' => $icon,
                   'click_action' => $url
               ],
               'data' => $data,
               'to' => $to
           ]);
           $opts = [
               'http' => [
                   'method'  => 'POST',
                   'header'  => 'Content-type: application/json' . "\r\n" . 'Authorization: key=' . $FCM_AUTH_KEY . "\r\n",
                   'content' => $postdata,
               ]
           ];
           $context  = stream_context_create($opts);
           $result = file_get_contents('https://fcm.googleapis.com/fcm/send', false, $context);
           if ($result) {
               return json_decode($result);
           } else {
               return false;
           }
       }
}

// class VerifikasiController extends Controller
// {
//     public function index()
//     {
//         $tmf = TimeOff::all();
//         return view('timeoff.index', compact('tmf'));
//     }
// }


