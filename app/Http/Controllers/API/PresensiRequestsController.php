<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PresensiRequest;
use App\Models\LevelJabatan;
use App\Models\Karyawan;
use App\Models\Inbox;
use App\Models\Presensi;
use App\Models\ParamPresensi;
use App\Models\ParamCabang;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\DB;
use DateTime;
use Carbon\Carbon;
use Validator;
use App\Notifications\WelcomeEmailNotification;

class PresensiRequestsController extends Controller
{
    // Firebase Cloud Messaging Authorization Key
    const FCM_AUTH_KEY = 'AAAAh0sKUrQ:APA91bE_GW1p4poeSo7mVRC-O8ZbWnwj_6lVPqwhYz7Sr7-7GBTkfLzSwMjlz_O3gGq5JiMyWVCuCVHzI_1Nn2z0hwxB-V1MCZVkCTH8a7KHuUCMFdWWuihKVn759uNZ_CUEivoFoGLx';
     
    public function getparamcabang()
    {
        $id_user = Auth::user();
        $lm =  Karyawan::where('fk_user', $id_user->id)->get()->last();
        $par = ParamCabang::where('id_kar',$lm->id)->where('status',"aktif")->with('getcabang')->get();
        return response()->json(['message' => 'List Data Req Attendance', 'data' =>  $par]);
    }
 
    public function indexreqattend()
    {
        $id_user = Auth::user();
        $lm =  Karyawan::where('fk_user', $id_user->id)->get()->last();
        $par = ParamCabang::where('id_kar',$lm->id)->pluck('id_cabang')->toarray();

        ##VIA JABATAN
        $level_jab = $lm->fk_level_jabatan;
        $tmlead = LevelJabatan::where('parent_id','=',$level_jab)->first();
        $dt = DB::table("presensi_requests")
            ->leftJoin("karyawans", function($join){
            $join->on("karyawans.id", "=", "presensi_requests.id_karyawan");
        })
            ->leftJoin("level_jabatans", function($join){
            $join->on("level_jabatans.id", "=", "karyawans.fk_level_jabatan");
        })
            ->select("karyawans.nama_lengkap", "karyawans.nomor_induk_karyawan", "presensi_requests.id","presensi_requests.tanggal", "presensi_requests.status_approve","presensi_requests.notes","presensi_requests.jam","presensi_requests.jenis")
            ->where("level_jabatans.parent_id", "=", $level_jab)
            ->where('presensi_requests.status_approve','=','ReqAttendance')
	        ->where('karyawans.fk_bagian','=', $lm->fk_bagian)
            ->whereIn('karyawans.fk_cabang', $par)
            ->where("karyawans.approval_via","=","JABATAN");
            // ->orderBy('tanggal', 'DESC');
            // ->get(); 

            ##VIA PIC
            $dataall = DB::table("presensi_requests")
                ->leftJoin("karyawans", function($join){
                $join->on("karyawans.id", "=", "presensi_requests.id_karyawan");
            })
                ->leftJoin("pic_approves", function($join) use ($lm){
                $join->on("presensi_requests.id_karyawan", "=", "pic_approves.id_kar");
            })
                ->select("karyawans.nama_lengkap", "karyawans.nomor_induk_karyawan", "presensi_requests.id","presensi_requests.tanggal", "presensi_requests.status_approve","presensi_requests.notes","presensi_requests.jam","presensi_requests.jenis")
                ->where('pic_approves.kar_approve','=', $lm->id )
                ->where("karyawans.approval_via","=","PIC")
                ->where('presensi_requests.status_approve','=', "ReqAttendance")
                ->union($dt)
                ->orderBy('tanggal', 'DESC')->get();
        return response()->json(['message' => 'List Data Req Attendance', 'data'=>$dataall]);
        #$id_user = Auth::user();
        #$lm =  Karyawan::where('fk_user', $id_user->id)->get()->last();
        #$level_jab = $lm->fk_level_jabatan;
        #$tmlead = LevelJabatan::where('parent_id','=',$level_jab)->first();
        #$dt = DB::table("presensi_requests")
        #    ->leftJoin("karyawans", function($join){
	#    $join->on("karyawans.id", "=", "presensi_requests.id_karyawan");
        #})
        #    ->leftJoin("level_jabatans", function($join){
	#    $join->on("level_jabatans.id", "=", "karyawans.fk_level_jabatan");
        #})
        #    ->select("karyawans.nama_lengkap", "karyawans.nomor_induk_karyawan", "presensi_requests.id","presensi_requests.tanggal", "presensi_requests.status_approve","presensi_requests.notes")
        #    ->where("level_jabatans.parent_id", "=", $level_jab)
        #    ->where('presensi_requests.status_approve','=','ReqAttendance')
        #    ->where('karyawans.fk_bagian','=', $lm->fk_bagian)
        #->get();
        #return response()->json(['message' => 'List Data Req Attendance', 'data' =>  $dt]);
    }

    public function karreqattend($id)
    {
        // $dt =  PresensiRequest::where('id_karyawan', $id)->where('status_approve','=', 'ReqAttendance')->get();
        $dt =  PresensiRequest::where('id_karyawan', $id)->orderBy('id', 'DESC')->get();
        return response()->json(['message' => 'List Data Req Attendance', 'data' =>  json_decode($dt, true)]);
    }
    public function savereqattend(Request $request)
    {
        $cek = Carbon::now()->subDay(3)->format('Y-m-d');
        // dd(Carbon::now()->format('Y-m-d'),$cek);
        $user_id = Auth::user();
        $user_id->update(['device_token' => $request->tkn]); ##Untuk Menyimpan Token Firebase
        $validator = Validator::make($request->all(), [
        'tanggal'     => 'required',
        'jam'         => 'required',
        'reason'      => 'required',
        'id_karyawan' => 'required',
        'jenis'        => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['message' => 'Cek Inputan Anda', 'code' => '401'], 401);
	    }
        $user_id = Auth::user();
        $cek_atasan = Karyawan::where('fk_level_jabatan', '=', $user_id->getkaryawan->jabatan->parent_id)->latest()->first();

        #Format KIRIM NOTIF FIREBASE Karyawan Bersangkutan
        $data = ['key1' => 'RequestAttendace']; ##Untuk tanda saat Di Klik Di Mobil (android) 
        $to = $user_id->device_token;
        $body = "Request Attendance has been submitted, please wait for approval from your superior!";
        ###Format KIRIM NOTIF FIREBASE Karyawan Atasan
        $to1    = $cek_atasan->user->device_token;
        $body1  = $user_id->getkaryawan->nama_lengkap .' is Waiting for Attendance Request Approval';
        
        #$checktimes = PresensiRequest::where('tanggal', $request->tanggal)->where('jenis', '=', 'Masuk')->where('id_karyawan', $request->id_karyawan)->take(1)->first();
        $checktimes = PresensiRequest::where('tanggal', $request->tanggal)
         ->where('jenis', '=', 'Masuk')->where('id_karyawan', $request->id_karyawan)
         ->whereIn('status_approve',['approve','ReqAttendance'])->take(1)->first();

        #$checktimesout = PresensiRequest::where('tanggal', $request->tanggal)->where('jenis', '=', 'Pulang')->where('id_karyawan', $request->id_karyawan)->take(1)->first();

        $checktimesout = PresensiRequest::where('tanggal', $request->tanggal)
         ->where('jenis', '=', 'Pulang')->where('id_karyawan', $request->id_karyawan)
         ->whereIn('status_approve',['approve','ReqAttendance'])->take(1)->first();
        $jam = Carbon::create($request->jam)->format('H:i:s');	
        ##CEK TANGGAL PENGAJUAN 2 Hari Seblum Tgl SKR
        $cekpres = Presensi::where('tanggal', $request->tanggal)
                ->where('id_karyawan', $request->id_karyawan)->take(1)->first();
        if($cekpres){
            if ($cekpres->parampresensi->jenis_shift == "Off") {
                return response()->json(['message' => 'Saat Ini Anda Sedang Off/Libur, Jika Ingin Melakukan Request Absensi Silahkan Ajukan Change Shift Terlebih Dahulu!!', 'code' => 'warning2'], 403); #403);
            }
        }if(!($cekpres)){
                return response()->json(['message' => 'Shift Anda Belum Ada!!', 'code' => 'warning2'], 403); #403);
            }
        if($request->tanggal >= $cek && $request->tanggal <= Carbon::now()){
            if($request->jenis == 'Masuk'){
                if ($checktimes){
                    return response()->json(['message' => 'Anda Sudah Melakukan Request Attendance', 'code' => '403'], 403);
                }
                if (!$checktimes){
                    $cekabsen = Presensi::where(['id_karyawan' =>$request->id_karyawan, 'tanggal' =>  $request->tanggal])->whereNotNull('jam_masuk')->take(1)->first();
                    if ($cekabsen){
                        return response()->json(['message' => 'Anda Sudah Melakukan Absensi', 'code' => '403'], 403);
                    }
                    if (!$cekabsen){
                    $savetime = PresensiRequest::create([
                        'tanggal'        => $request->tanggal,
                        'jam'            => $jam,
                        'id_karyawan'    => $request->id_karyawan,
                        'notes'          => $request->reason,
                        'status_approve' => 'ReqAttendance',
                        'jenis'          => $request->jenis,
            ]);
    
            $saveinbox = Inbox::create([
                'pengirim_id'    => $user_id->id,
                'penerima_id'    => $cek_atasan->user->id,
                'title'          => 'ReqAttendance ('.$savetime->jenis.')',
                'isi_pengirim'   => 'Request Attendance ('. $savetime->jenis .') has been submitted, please wait for approval from your superior!',
                'isi_penerima'   => $user_id->getkaryawan->nama_lengkap .' is Waiting for Request Attendance ('. $savetime->jenis .') on ('.$savetime->tanggal.')('.$savetime->jam.')   Request Approval',
                'status_atasan'         => 'unread',
                'status_bawahan'         => 'unread',
                'id_presensi_requests'   => $savetime->id,
            ]);
                    if($to){
                            $result = $this->sendPush($to,$body,$data); ##Mengirin Notif KE FireBase Karyawan
                        }
                    if($to1){
                        $hasil1 = $this->sendPush($to=$to1, $body=$body1, $data); ##Mengirin Notif KE FireBase Atasan
                    }
                return response()->json(['message' => 'Data Request Attendance '. $request->jenis .' Berhasil Ditambahkan!', 'code' => '200'], 200);
                }
            }
            }if($request->jenis == 'Pulang'){
            if ($checktimes){
                if (!$checktimesout){
                $savetime = PresensiRequest::create([
                    'tanggal'        => $request->tanggal,
                    'jam'            => $jam,
                    'id_karyawan'    => $request->id_karyawan,
                    'notes'          => $request->reason,
                    'status_approve' => 'ReqAttendance',
                    'jenis'          => $request->jenis,
            ]);
    
            $saveinbox = Inbox::create([
                'pengirim_id'    => $user_id->id,
                'penerima_id'    => $cek_atasan->user->id,
                'title'          => 'ReqAttendance ('.$savetime->jenis.')',
                'isi_pengirim'   => 'Request Attendance ('. $savetime->jenis .') has been submitted, please wait for approval from your superior!',
                'isi_penerima'   => $user_id->getkaryawan->nama_lengkap .' is Waiting for Request Attendance ('. $savetime->jenis .') on ('.$savetime->tanggal.')('.$savetime->jam.')   Request Approval',
                'status_atasan'         => 'unread',
                'status_bawahan'         => 'unread',
                'id_presensi_requests'   => $savetime->id,
            ]);
                   #$result = $this->sendPush($to, $title, $body, $icon, $url); ##Mengirin Notif KE FireBase Karyawan
               #$hasil1 = $this->sendPush($to = $to1, $title = $title1, $body=$body1, $icon=$icon1, $url=$url1); ##Mengirin Notif KE FireBase Atasan
                if($to){
                        $result = $this->sendPush($to,$body,$data); ##Mengirin Notif KE FireBase Karyawan
                    }
                    if($to1){
                        $hasil1 = $this->sendPush($to=$to1, $body=$body1, $data); ##Mengirin Notif KE FireBase Atasan
                    }             
                    return response()->json(['message' => 'Data Request Attendance '. $request->jenis .' Berhasil Ditambahkan!', 'code' => '200'], 200);
                }if ($checktimesout){
                    return response()->json(['message' => 'Anda Sudah Melakukan Request', 'code' => '403'], 403);
                }
            }if (!$checktimes){
                $cekabsen = Presensi::where(['id_karyawan' =>$request->id_karyawan, 'tanggal' =>  $request->tanggal])->whereNotNull('jam_masuk')->take(1)->first();
                if ($cekabsen){
                    $savetime = PresensiRequest::create([
                        'tanggal'        => $request->tanggal,
                        'jam'            => $jam,
                        'id_karyawan'    => $request->id_karyawan,
                        'notes'          => $request->reason,
                        'status_approve' => 'ReqAttendance',
                        'jenis'          => $request->jenis,
            ]);
    
            $saveinbox = Inbox::create([
                'pengirim_id'    => $user_id->id,
                'penerima_id'    => $cek_atasan->user->id,
                'title'          => 'ReqAttendance ('.$savetime->jenis.')',
                'isi_pengirim'   => 'Request Attendance ('. $savetime->jenis .') has been submitted, please wait for approval from your superior!',
                'isi_penerima'   => $user_id->getkaryawan->nama_lengkap .' is Waiting for Request Attendance ('. $savetime->jenis .') on ('.$savetime->tanggal.')('.$savetime->jam.')   Request Approval',
                'status_atasan'         => 'unread',
                'status_bawahan'         => 'unread',
                'id_presensi_requests'   => $savetime->id,
            ]);
            #$result = $this->sendPush($to, $title, $body, $icon, $url); ##Mengirin Notif KE FireBase Karyawan
                #$hasil1 = $this->sendPush($to = $to1, $title = $title1, $body=$body1, $icon=$icon1, $url=$url1); ##Mengirin Notif KE FireBase Atasan
            if($to){
                        $result = $this->sendPush($to,$body,$data); ##Mengirin Notif KE FireBase Karyawan
                    }
                    if($to1){
                        $hasil1 = $this->sendPush($to=$to1, $body=$body1, $data); ##Mengirin Notif KE FireBase Atasan
                    }
    
                    return response()->json(['message' => 'Data Request Attendance Out Berhasil Ditambahkan34!', 'code' => '200'], 200);
                }if(!$cekabsen){
                    return response()->json(['message' => 'Anda Belum Absen/request Masuk', 'code' => '403'], 403);
                }
            }else{
                return response()->json(['message' => 'Anda Belum Absen/request Masuk', 'code' => '403'], 403);
            }
        }
            return response()->json(['message' => 'Cek Inputan Anda!', 'code' => '401'], 401);
        }
        ##CEK TANGGAL PENGAJUAN 2 Hari Seblum Tgl SKR
        else{
            return response()->json(['message' => 'Maaf Tanggal Request melebihi Ketentuan 2 Hari Sebelum Hari H atau Lebih Dari hari H' ,'code' => '403'], 403);
        }
   
    }


    // Simpan data Approve
    public function approvereqattend(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'tanggal'     => 'required',
            'stsapp'   => 'required', #approve,reject
            #'nama'        => 'required',
            #'id_karyawan' => 'required',
	]);
        $user_id = Auth::user();
	    $data = PresensiRequest::findorfail($id);
	    $data->status_approve = $request->stsapp;

        ##tamabahan Ke presensi
        $cekabsen = Presensi::where(['id_karyawan' => $data->id_karyawan, 'tanggal' => $data->tanggal])->get()->last();
        $req_jam_msk = $data->jam;#jam_masuk;
        $req_tgl_msk = $data->tanggal;
        $cek_param_jam_masuk = Carbon::parse($cekabsen->parampresensi->jam_masuk)->format('H:i:s');
        $cek_tgl_jam_masuk = $req_tgl_msk . ' '.$data->jam;#jam_masuk;
        $post_jam_masuk = Carbon::parse($cek_tgl_jam_masuk)->format('Y-m-d H:i:s');
        $cek_tgl_jam_pulang = $req_tgl_msk . ' '.$data->jam;#jam_pulang;
        $post_jam_pulang = Carbon::parse($cek_tgl_jam_pulang)->format('Y-m-d H:i:s');
        if ($req_jam_msk <= $cek_param_jam_masuk) {
            $presensi_status = "EarlyIn";
        }
        if ($req_jam_msk == $cek_param_jam_masuk) {
            $presensi_status = "OnTime";
        }
        if ($req_jam_msk > $cek_param_jam_masuk) {
            $presensi_status = "Late";
        }
        if ($data->jenis == 'Masuk' && $request->stsapp == 'approve') {
            $prsn = $cekabsen->update(['keterangan' => $data->notes, 'jam_masuk'=>$post_jam_masuk, 'presensi_status' => $presensi_status]);
        }

        if ($data->jenis == 'Pulang' && $request->stsapp == 'approve') {
            $prsn = $cekabsen->update(['keterangan' => $data->notes, 'jam_pulang'=>$post_jam_pulang]);
        }
	    $data->save();

        #Format KIRIM NOTIF FIREBASE Approval Ke sendiri (atasan)
	    $dataapp = ['key1' => 'RequestAttendace']; ##Untuk tanda saat Di Klik Di Mobil (android) 
	    $to = $user_id->device_token;
        $body = "You have ". $data->status_approve .' '. $data->karyawan->nama_lengkap. " attendance request!";
        ###Format KIRIM NOTIF FIREBASE Karyawan (bawahan)
	    $to1    = $data->karyawan->user->device_token;
        $body1  = $user_id->name.' has approved your attendance request!';
        if($to){
	    $result = $this->sendPush($to,  $body, $data=$dataapp); ##Mengirin Notif KE FireBase Karyawan Sendiri) Atasan
	}
	if($to1){
	    $hasil1 = $this->sendPush($to = $to1, $body=$body1, $data=$dataapp); ##Mengirin Notif KE FireBase Bawahan
	}
        return response()->json(['message' => 'Request Attendance Has Approved!', 'code' => '200'], 200);
    }
   
    public function savebreak(Request $request)
    {
        $validator = Validator::make($request->all(), [
        #'tanggal'     => 'required',
        #'jam'         => 'required',
        'id_karyawan' => 'required',
        'jenis'       => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['message' => 'Cek Inputan Anda', 'code' => '400'], 200);
        }

        $skr = Carbon::now()->format('Y-m-d');
        $ayeuna = new DateTime(date('H:i:s'));
        $cekabsen = Presensi::where(['id_karyawan' =>$request->id_karyawan, 'tanggal' =>  $skr])->whereNotNull('jam_masuk')->take(1)->first();
        if($request->jenis == 'Out'){
            if ($cekabsen){
                $cekabsen->istirahat_keluar = $ayeuna;
                $cekabsen->save();
                return response()->json(['message' => 'Istirahat Keluar Telah Tersimpan', 'code' => '200'], 200);
            }
            if (!$cekabsen){
                return response()->json(['message' => 'Anda Belum Absen Masuk', 'code' => '400'], 400);
            }
        }if($request->jenis == 'In'){
            $cekistirahat = Presensi::where(['id_karyawan' => $request->id_karyawan, 'tanggal' =>  $skr])->whereNotNull('istirahat_keluar')->take(1)->first();
            if ($cekistirahat){
                $cekistirahat->istirahat_masuk = $ayeuna;
                $cekistirahat->save();
                return response()->json(['message' => 'Istirahat Masuk Telah Tersimpan', 'code' => '200'], 200);
                }
            if (!$cekistirahat){
                return response()->json(['message' => 'Anda Belum Absen Istirahat Keluar', 'code' => '400'], 400);
                }
        }
    	return response()->json(['message' => 'Cek Inputan Anda!', 'code' => '200'], 200);
    }

    ###Function Kirim Notif Ke Firebase
    private function sendPush($to, $body,$data)
    {
        $title = "Daily A Team Notification";
        $icon = 'https://hris.anyargroup.co.id/assets/bootstrap/img/icon-office.png';
        $url = 'https://hris.anyargroup.co.id/';

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
                'header'  => 'Content-type: application/json' . "\r\n" . 'Authorization: key=' . self::FCM_AUTH_KEY . "\r\n",
                'content' => $postdata
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
    ###Akhir Function Kirim Notif Ke Firebase

    ##Cancel Presensi Request
    public function cekpresensirequestpersonal($id)
    {
        $user_id = Auth::user();
        $dt =  PresensiRequest::where('id',$id)
            ->where('id_karyawan',$user_id->getkaryawan->id)
            ->first();
        return $dt;
    }

    public function cancelreqpres(Request $request)
    {
        $user_id = Auth::user();
        $validator = Validator::make($request->all(), [
        'id_reqpres' => 'required',
            ]);
        if($validator->fails()){
           return response()->json(['message' => 'Cek Inputan Anda', 'code' => '404'], 404);
        }
        $dt = $this->cekpresensirequestpersonal($request->id_reqpres);
        if(!($dt)){
            return response()->json(['message' => 'Presensi Request Tidak Ditemukan!!', 'code' => '404'], 404);
        }
        if($dt){
            if ($dt->status_approve == "ReqAttendance"){
                $dt->status_approve = "Cancel";
                $dt->save();
                return response()->json(['message' => 'Presensi Request Berhasil Di Batalkan', 'code' => '200'], 200);
            }
            if ($dt->status_approve != "ReqAttendance"){
                return response()->json(['message' => 'Cek Presensi Request Tidak Bisa Dicancel Karna Telah Di Approve / Cancel!', 'code' => '403'], 403);
            }
        }
    }
    ##Akhir Cancel Presensi Request
}

