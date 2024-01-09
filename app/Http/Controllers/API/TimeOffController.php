<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TimeOff;
use App\Http\Resources\TimeOffResource;
use Validator;
use App\Models\Karyawan;
use App\Models\LevelJabatan;
use App\Models\Pelamar;
use App\Models\Presensi;
use App\Models\Inbox;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\User;
use App\Models\CutiKaryawan;
use App\Models\ParamTimeOff;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Notifications\EmailApprovalNotification;
use Notification;

class TimeOffController extends Controller
{
    // const FCM_AUTH_KEY = 'AAAAh0sKUrQ:APA91bE_GW1p4poeSo7mVRC-O8ZbWnwj_6lVPqwhYz7Sr7-7GBTkfLzSwMjlz_O3gGq5JiMyWVCuCVHzI_1Nn2z0hwxB-V1MCZVkCTH8a7KHuUCMFdWWuihKVn759uNZ_CUEivoFoGLx';
    public function listchoicetimeoff()
    {
        $tps = ParamTimeOff::where('status', 'Aktif')->orderBy('type')->get()->groupBy('type');


        // Mengonversi hasil query ke dalam bentuk array
        $result = $tps->map(function ($items, $key) {
            return [
                'type' => $key,
                'obj' => $items->toArray()
            ];
        })->values();

        // Mengonversi koleksi hasil query ke dalam bentuk array
        $arrayResult = $result->toArray();


        return response()->json(['message' => 'List Data Status', 'data' =>  $arrayResult]);
    }
    public function index()
    {
	    $time = TimeOff::all();
        return response()->json(['message' => 'List Data Status', 'data' =>  $time]);
        #return new TimeOffResource(true, 'List Data Status', $time);
    }
    public function show()
    {
        //
    }
    public function store(Request $request)
    {
        $partimeoff = ParamTimeOff::where('id', '=', $request->statusoff)->first();
        $user_id = Auth::user();
        $user_id->update(['device_token' => $request->tkn]); ##Untuk Menyimpan Token Firebase
        $cek_atasan = Karyawan::where('fk_level_jabatan', '=', $user_id->getkaryawan->jabatan->parent_id)->latest()->first();
	    $validator = Validator::make($request->all(),[
	        'tanggal'       => 'required',
            'tanggal_akhir' => 'required',
            'statusoff'     => 'required', ##IJIN, SAKIT,CUTI
            'dokumen'       => 'mimes:jpeg,bmp,png,pdf|max:1000',
            'id_karyawan'   => 'required',
            #'ket'   => 'required',
            
        ]);
	    if($validator->fails()){
            // return response()->json(['message' => 'Cek Inputan Anda', 'code' => '400'], 400);
            return response()->json($validator->fails(), 400);
        }
        $rangetgl = CarbonPeriod::create($request->tanggal, $request->tanggal_akhir);
        #$checktimes = TimeOff::whereBetween('tanggal', [$request->tanggal, $request->tanggal_akhir])->where('id_karyawan', $request->id_karyawan)->count();
	    $checktimes = TimeOff::whereBetween('tanggal', [$request->tanggal, $request->tanggal_akhir])
        ->where('id_karyawan','=',$request->id_karyawan)
        ->whereIn('status_approve',['approve','PengajuanOff'])->latest('id')->take(1)->first();
        $cekpres = Presensi::whereBetween('tanggal', [$request->tanggal, $request->tanggal_akhir])->where('id_karyawan','=',$request->id_karyawan)->pluck('id')->toArray();
        if(!$cekpres){
            return response()->json(['message' => 'Your Calendar Shift Is Not Available, Please Call HRD', 'code' => '422'], 422);
        }else{

        // if($checktimes > 0){
        if($checktimes){             
	        return response()->json(['message' => 'Anda sudah mengajukan Time Off untuk hari ini', 'code' => '422'], 422);
	    }else{
        // if($request->statusoff == "Cuti"){
        if($partimeoff->kuota == "Mengurangi"){
          $tgl =  Carbon::create($request->tanggal)->format('Y');
          $cekjatah = CutiKaryawan::where('id_kar', $request->id_karyawan)->where('tahun', $tgl)->take(1)->first();
          if ($cekjatah == null){
            return response()->json(['message' => 'Anda Belum Mempunyai Cuti', 'code' => '403'], 403);
          }else{
            foreach ($rangetgl as $day) {
                $savetime = TimeOff::create([
                    'tanggal'        => $day->format('Y-m-d'),
                    'statusoff'      => $partimeoff->nama ,#"Cuti",  ##IJIN, SAKIT,CUTI
                    'id_karyawan'    => $request->id_karyawan,
                    'status_approve' => 'PengajuanOff',
                    'fk_param'       => $request->statusoff,
                    'notes_aju'      => $request->ket,
                ]);
             }
          }
        // Selain CUTI Tahunan
        }
        else{
            foreach ($rangetgl as $day) {
                $savetime = TimeOff::create([
                    'tanggal'        => $day->format('Y-m-d'),
                    'statusoff'      => $partimeoff->nama,  ##IJIN, SAKIT,CUTI
                    'id_karyawan'    => $request->id_karyawan,
                    'status_approve' => 'PengajuanOff',
                    'fk_param'       => $request->statusoff,
                    'notes_aju'      => $request->ket,
                ]);
                if ($request->file('dokumen')) {
                    $cv = $request->file('dokumen');
                    $nama_dokumen = $savetime->id_karyawan;
                    $extcv = $request->file('dokumen')->getClientOriginalExtension();
                    $CvName = $nama_dokumen . '_' . $day->format('Y-m-d') . '.' . $extcv;
                    $cv->storeAs('berkastimeoff/', $CvName);
                    $savetime->update(['dokumen' => $CvName]);
                    #return redirect()->route('cabang.index')->with(['success' => 'Data Berhasil Disimpan!']);
                    }     
                    $saveinbox = Inbox::create([
                        'pengirim_id'    => $user_id->id,
                        'penerima_id'    => $cek_atasan->user->id,
                        'title'          => 'Request Time Off ('.$savetime->jenis.')',#$title,
                        'isi_pengirim'   => 'Request Time Off ('. $savetime->jenis .') has been submitted, please wait for approval from your superior!',
                        'isi_penerima'   => $user_id->getkaryawan->nama_lengkap .' is Waiting for Time Off ('. $partimeoff->nama .') on ('.$savetime->tanggal.') Request Approval',
                        'status_atasan'  => 'unread',
                        'status_bawahan' => 'unread',
                        'id_time_offs'   => $savetime->id,
                    ]);
             }
             return response()->json(['message' => 'Data Pengajuan Off Berhasil Ditambahkan!', 'code' => '200'], 200);
                    
        }
	    return response()->json(['message' => 'Data Pengajuan '.$partimeoff->nama.' Berhasil Ditambahkan!', 'code' => '200'], 200);
        }
        }
    }

    public function listoff()
    {
	    $time = TimeOff::where('status_approve', '=', 'PengajuanOff')->get();
	    #return new TimeOffResource(true, 'Data Pengajuan Off', $time);
        return response()->json(['message' => 'Success', 'code' => '200', 'data' => $time]);
    }

    public function getlistoff($id)
    {
            $time =  TimeOff::where('id_karyawan', $id)->orderBy('id', 'DESC')->get();
            // $time = TimeOff::where('status_approve', '=', 'PengajuanOff')->where('id_karyawan', $id)->get();
            #return new TimeOffResource(true, 'Data Pengajuan Off', $time);
            return response()->json(['message' => 'Success', 'code' => '200', 'data' => $time]);
    }
     ###Coba Baru
    public function levjab()
    {
        // Untuk Yang Menggunakan Jabatan
        $id_user = Auth::user()->id;
        $lm =  Karyawan::where('fk_user', $id_user)->get()->last();
        $level_jab = $lm->fk_level_jabatan;
        $tmlead = LevelJabatan::where('parent_id','=',$level_jab)->first(); 
        ##VIA JABATAN
        $offs = DB::table("time_offs")
            ->leftJoin("karyawans", function($join){
	        $join->on("karyawans.id", "=", "time_offs.id_karyawan");
        })
            ->leftJoin("level_jabatans", function($join){
	        $join->on("level_jabatans.id", "=", "karyawans.fk_level_jabatan");
        })
            ->select("karyawans.nama_lengkap","time_offs.id","time_offs.tanggal","time_offs.statusoff","time_offs.status_approve","time_offs.dokumen")
	        ->where("level_jabatans.parent_id", "=", $level_jab)
            ->where('time_offs.status_approve','=','PengajuanOff')
            ->where('karyawans.fk_bagian','=', $lm->fk_bagian);
            // ->orderBy('id', 'DESC')->get();

        // Untuk Yang Menggunakan PIC APPOVE
        ##VIA PIC
        $dataall = DB::table("time_offs")
        ->leftJoin("karyawans", function($join){
        $join->on("karyawans.id", "=", "time_offs.id_karyawan");
        })
        ->leftJoin("pic_approves", function($join) use ($lm){
        $join->on("time_offs.id_karyawan", "=", "pic_approves.id_kar");
        })
        ->select("karyawans.nama_lengkap","time_offs.id","time_offs.tanggal","time_offs.statusoff","time_offs.status_approve","time_offs.dokumen")
        ->where('pic_approves.kar_approve','=', $lm->id )
        ->where("karyawans.approval_via","=","PIC")
        ->where('time_offs.status_approve','=', "PengajuanOff")
        ->union($offs)
        ->orderBy('tanggal', 'DESC')->get();


        // $picoffs = DB::table("time_offs")
        //     ->leftJoin("pic_approves", function($join) use ($lm){
        //     $join->on("time_offs.id_karyawan", "=", "pic_approves.id_kar");
        //     })->where('pic_approves.kar_approve','=', $lm->id )
        //     ->where('time_offs.status_approve','=', "PengajuanOff")->get();
        
        return response()->json(['message' => 'Your Profile', 'data' =>  $dataall]);
    }
 
    public function approvetimeoff(Request $request, $id)
    {
        $user_id = Auth::user();
        $validator = Validator::make($request->all(), [
            'tanggal_approve' => 'required',
	        'status_approve'   => 'required', ##Approve, Reject
	        'notes' => 'required',
		]);
        $up_time = TimeOff::where('id', $id)->get()->last();
        // $up_time->update([
        //     'tanggal_approve' => $request->tanggal_approve,
        //     'status_approve'  => $request->status_approve,
        //     'notes'           => $request->notes,
	    // ]);
        
	// if ($up_time->status_approve == 'approve') {
    if ($request->status_approve == 'approve') {
        $cek_baru = TimeOff::where('id', $id)->get()->last();
        if ($cek_baru->status_approve != 'approve') {
            $cekabsen = Presensi::where(['id_karyawan' => $up_time->id_karyawan, 'tanggal' => $up_time->tanggal])->get()->last();
            // $prsn = $cekabsen->update(['presensi_status' => $up_time->statusoff,'fk_timeoff' => $up_time->id,]);
            $prsn = $cekabsen->update(['presensi_status' => $up_time->get_fkparam->nama,'fk_timeoff' => $up_time->id]);
            $year =  Carbon::create($up_time->tanggal)->format('Y');
            #if($up_time->statusoff=="Cuti"){
            if ($up_time->get_fkparam->kuota == "Mengurangi"){
                $cekjatah = CutiKaryawan::where('id_kar', $up_time->id_karyawan)->where('tahun', $year)->take(1)->first();
                $hitung = $cekjatah->sisa_cuti - 1;
                $jum = $cekjatah->update(['sisa_cuti' => $hitung]);
                }
            $up_time->update([
                'tanggal_approve' => $request->tanggal_approve,
                'status_approve'  => $request->status_approve,
                'notes'           => $request->notes,
            ]);
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

        }
        if ($cek_baru->status_approve == 'approve') {
            return response()->json(['message' => 'Anda Sudah Melakukan Approval', 'code' => '200', 'data' => $up_time]);
        }
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
	#return response()->json(['message' => 'Berhasil Disimpan', 'code' => '200', 'data' => $up_time]);
	#return new TimeOffResource(true, 'Data Pengajuan Off', $up_time);
    


    public function listoff_approve()
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
        return response()->json(['message' => 'Data Pengajuan Approve Time Off', 'data' =>  $offs]);
        #dd($off);
        #return view('timeoff.list_approve_reject')->with(['data'=>$offs]);
    }

    public function listoff_reject()
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
        return response()->json(['message' => 'Data Pengajuan Reject Time Off', 'data' =>  $offs]);
    }

        public function kar_listoff($id)
    {
        $offs = TimeOff::where('id_karyawan', $id)->where("status_approve", "Approve",)->orderBy('id', 'DESC')->get();
        return response()->json(['message' => 'Data Pengajuan Approve Time Off', 'data' =>  $offs]);
    }

    #    public function kar_listoff_reject($id)
    #{
    #    $offs = TimeOff::where('id_karyawan', $id)->where("status_approve","reject")->orderBy('id', 'DESC')->get();
    #    return response()->json(['message' => 'Data Pengajuan Approve Time Off', 'data' =>  $offs]);
    #}
       ###Function Kirim Notif Ke Firebase
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
     
    // Contoh
    //    use Illuminate\Support\Facades\Http;
    //    public function sendFcmNotification()
    //    {
    //        $url = 'https://fcm.googleapis.com/v1/projects/your-firebase-project-id/messages:send';
    //        $serverKey = 'your-fcm-server-key';      
    //        $fcmToken = 'target-fcm-token';
    //        $notificationData = [
    //            'message' => [
    //                'token' => $fcmToken,
    //                'notification' => [
    //                    'title' => 'Judul Notifikasi',
    //                    'body' => 'Isi Notifikasi',
    //                ],
    //                'data' => [
    //                    'key' => 'value',
    //                ],
    //            ],
    //        ];
       
    //        $response = Http::withHeaders([
    //            'Authorization' => 'Bearer ' . $serverKey,
    //            'Content-Type' => 'application/json',
    //        ])->post($url, $notificationData);
       
    //        return $response->json();
    //    }

    ##Cancel Request Time Off
    public function cektimeoffpersonal($id)
    {
        $user_id = Auth::user();
        $dt =  TimeOff::where('id',$id)->where('id_karyawan',$user_id->getkaryawan->id)->first();
        return $dt;
    }

    public function canceltimeoff(Request $request)
    {
        $user_id = Auth::user();
        $validator = Validator::make($request->all(), [
        'id_offtime' => 'required',
            ]);
        if($validator->fails()){
           return response()->json(['message' => 'Cek Inputan Anda', 'code' => '404'], 404);
        }
        $dt = $this->cektimeoffpersonal($request->id_offtime);
        if(!($dt)){
            return response()->json(['message' => 'Time Off Tidak Ditemukan!!', 'code' => '404'], 404);
        }
        if($dt){
            if ($dt->status_approve == "PengajuanOff"){
                $dt->status_approve = "Cancel";
                $dt->save();
                return response()->json(['message' => 'Time Off Berhasil Di Batalkan', 'code' => '200'], 200);
            }
            if ($dt->status_approve != "PengajuanOff"){
                return response()->json(['message' => 'Cek Time Off Tidak Bisa Dicancel Karna Telah Di Approve / Cancel!', 'code' => '403'], 403);
            }
        }
    }
    ##Akhir Cancel Request Time Off

}

