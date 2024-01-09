<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\ShiftPresensi;
use App\Models\Presensi;
use App\Models\ParamPresensi;
use App\Models\Karyawan;
use App\Models\ChangeShift;
use DateTime;
use Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
// use Validator;
use Illuminate\Support\Facades\Validator;

class ShiftPresensiController extends Controller
{
    public function changeshift(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'startdate'     => 'required',
            'shift_awal'    => 'required',
            'enddate'       => 'required',
            'shift_akhir'   => 'required',
            'id_karyawan'   => 'required',
            'keterangan'    => 'required',
        ]);
        $shif_awal_baru = ParamPresensi::where(['jenis_shift' => $request->shift_awal])->get()->last();
        $cekabsen1 = Presensi::where(['id_karyawan' => $request->id_karyawan, 'tanggal' => $request->startdate])->get()->last();
        $cekabsen2 = Presensi::where(['id_karyawan' => $request->id_karyawan, 'tanggal' => $request->enddate])->get()->last();
        if ($cekabsen1 == Null or $cekabsen2 == Null) {
            return response()->json([
                'message' => 'Absen Tidak Ada atau Belum Terdaftar!! ',
                'code' => 'Error'
            ], 400);
        }
        if ($cekabsen1 != Null and $cekabsen2 != Null) {
            $cekshift_awal = ParamPresensi::where(['id' => $request->shift_awal])->get()->last();
            $cekshift_akhir = ParamPresensi::where(['id' => $request->shift_akhir])->get()->last();
            $data['tanggal_awal']     = $request->startdate;
            $data['shift_awal']       = $shif_awal_baru->id;#$request->shift_awal;#$cekshift_awal->jenis_shift;
            $data['tanggal_akhir']    = $request->enddate;
            $data['shift_akhir']      = $request->shift_akhir;#$cekshift_akhir->jenis_shift;
            $data['keterangan']       = $request->keterangan;
            $data['id_karyawan']      = $request->id_karyawan;
            if ($request->tgl_off) {
                // dd('ayaaaaaaaaaaaaaaaaaaaan');
                $cekoff = ParamPresensi::where(['jenis_shift' => 'Off'])->get()->last();
                $data['tanggal_off']    = $request->tgl_off;
                $data['shift_off']      = $cekoff->id;
                
            }
            $data['status_approve']   = 'request';
            $saveshift = ChangeShift::insert($data);
            
            $dataapp = ['key1' => 'RequestChangeShift']; ##Untuk tanda saat Di Klik Di Mobil (android) 
            $to    = $data->karyawan->user->device_token;
            $body  = $user_id->name.' has Waiting your Approval Request Change Shift!';
            if($to){
                $hasil1 = $this->sendPushChangeShift($to, $body, $data=$dataapp); ##Mengirin Notif KE FireBase Bawahan
            }

            return response()->json(['success' => 'Data Telah Tersimpan', $saveshift, 'code' => 'success'], 200);
        }
    }

    public function getchangeshift($id)
    {
        // $shift = ChangeShift::where('id_karyawan', $id)->get();

        $shift = ChangeShift::where('change_shifts.id_karyawan', $id)
        ->join('param_presensis as shift_awal', 'shift_awal.id', '=', 'change_shifts.shift_awal')
        ->join('param_presensis as shift_akhir', 'shift_akhir.id', '=', 'change_shifts.shift_akhir')
        ->leftjoin('param_presensis as shift_off', 'shift_off.id', '=', 'change_shifts.shift_off')            
        ->select(
            "change_shifts.id", 
            "shift_awal.jenis_shift as shift_awal",
            "change_shifts.tanggal_awal",
            "shift_akhir.jenis_shift as shift_akhir",
            "change_shifts.tanggal_akhir",
            "change_shifts.id_karyawan",
            "change_shifts.keterangan",
            "change_shifts.status_approve",
            "change_shifts.tanggal_approve",
            "change_shifts.notes",
            "change_shifts.created_at",
            "change_shifts.updated_at",
            "change_shifts.tanggal_off", 
            DB::raw('CASE WHEN shift_off.id IS NULL THEN NULL ELSE shift_off.jenis_shift END AS shift_off')
        )->get();       
        return response()->json(['message' => 'Success', 'code' => '200', 'data' => $shift]);
    }

    
    public function getparam()
    {

        $pars = ParamPresensi::select('id', 'jenis_shift')->get();
        return response()->json(['success' => 'List Parameter Shift', $pars]);
    }

    public function leadchshift()
    {
        $cekid = Auth::user()->getkaryawan->fk_level_jabatan;
        ##Via Jabatan
        $data  = ChangeShift::leftjoin('karyawans', 'karyawans.id', '=', 'change_shifts.id_karyawan')
            ->leftjoin('param_presensis as s_awal', 's_awal.id', '=', 'change_shifts.shift_awal')
            ->leftjoin('param_presensis as s_akhir', 's_akhir.id', '=', 'change_shifts.shift_akhir')
            ->leftjoin('level_jabatans', 'level_jabatans.id', '=', "karyawans.fk_level_jabatan")
            ->where("level_jabatans.parent_id", "=", $cekid)
            ->where("status_approve", "=", 'request');
            // ->get([
            //     'karyawans.nama_lengkap', 'karyawans.id as id_karyawan', 'karyawans.nomor_induk_karyawan',
            //     'change_shifts.id', 'change_shifts.tanggal_akhir', 'change_shifts.status_approve',
            //     'change_shifts.tanggal_awal', 'change_shifts.keterangan',
            //     'change_shifts.shift_awal as shift_awal', 'change_shifts.shift_akhir as shift_akhir',
            //     's_awal.jenis_shift as shift_awal','s_akhir.jenis_shift as shift_akhir'
            // ]);

            ##VIA PIC
            $dataall = DB::table("change_shifts")
                ->leftJoin("karyawans", function($join){
                $join->on("karyawans.id", "=", "change_shifts.id_karyawan");
            })
                ->leftJoin("param_presensis as s_awal", function($join){
                $join->on("s_awal.id", "=", "change_shifts.shift_awal");
            })
                ->leftJoin("param_presensis as s_akhir", function($join){
                $join->on("s_akhir.id", "=", "change_shifts.shift_akhir");
            })

                ->leftJoin("pic_approves", function($join) use ($lm){
                $join->on("change_shifts.id_karyawan", "=", "pic_approves.id_kar");
            })
                ->select('karyawans.nama_lengkap', 'karyawans.id as id_karyawan', 'karyawans.nomor_induk_karyawan',
                         'change_shifts.id', 'change_shifts.tanggal_akhir', 'change_shifts.status_approve',
                         'change_shifts.tanggal_awal', 'change_shifts.keterangan',
                         's_awal.jenis_shift as shift_awal','s_akhir.jenis_shift as shift_akhir')
                ->where('pic_approves.kar_approve','=', $lm->id )
                ->where("karyawans.approval_via","=","PIC")
                ->where('change_shifts.status_approve','=', "request")
                ->union($data)
                ->orderBy('tanggal', 'DESC')->get();
        return response()->json(['success' => 'List Parameter Shift', 'data'=>$dataall]);
    }

    public function changeshiftapp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'stsapp'        => 'required',
            #'id_karyawan'   => 'required',
            'notes'         => 'required',
            'idshift'    => 'required',
        ]);
        $tanggal = Carbon::now()->format('Y-m-d');
        $data = ChangeShift::findorfail($request->idshift);
        $data->notes = $request->notes;
        $data->status_approve = $request->stsapp;
        $data->tanggal_approve = $tanggal;
        $data->save();

        ##tamabahan Ke presensi
        if( $request->stsapp == "approve"){
            $cekabsen1 = Presensi::where(['id_karyawan' => $data->id_karyawan, 'tanggal' => $data->tanggal_awal])->get()->last();
            $cekabsen2 = Presensi::where(['id_karyawan' => $data->id_karyawan, 'tanggal' => $data->tanggal_akhir])->get()->last();
            $shift1 = $data->shift_awal;
            $shift2 = $data->shift_akhir;
            $prsn1 = $cekabsen1->update(['id_parampresensi' => $shift1]);
            $prsn2 = $cekabsen2->update(['id_parampresensi' => $shift2]);
            // dd($data->tanggal_off);
            if ($data->tanggal_off != Null) {
                $cekoff = ParamPresensi::where(['id' => $data->shift_off])->get()->last();
                // dd($cekoff);
                $cekabsen3 = Presensi::where(['id_karyawan' => $data->id_karyawan, 'tanggal' => $data->tanggal_off])->get()->last();
                // dd($cekabsen3);
                $cekabsen3->update(['id_parampresensi' => $cekoff->id]);
                // $cekabsen3->id_parampresensi = $cekoff->id;
                // $cekabsen3->save();
                }
        }
        $kar = Karyawan::findOrFail($data->id_karyawan);
        $status = ChangeShift::where('status_approve', $data->status_approve)->where('id_karyawan', $data->id_karyawan)->latest()->get();
        // Send Notif E-Mail
        // $reqattend = [
        //     'greeting' => 'Dear ' . $kar->nama_lengkap . ',',
        //     'body' => 'Your Request for Change Shift from ' . Carbon::create($data->tanggal_awal)->format('d F Y') . ' to ' . Carbon::create($data->tanggal_akhir)->format('d F Y,'),
        //     'thanks' => 'Have a Wonderful Day  ',
        //     'actionText' => 'Has Been Approved',
        //     'actionURL' => url('https://hris.anyargroup.co.id/login'),
        //     #'id' => $user->id
        // ];
        // Notification::send($kar, new EmailApprovalNotification($reqattend));
        return response()->json(['message' => 'Request Change Shift Approved !', 'code' => '200'], 200);
        // $tanggal = Carbon::now()->format('Y-m-d');
        // $data = ChangeShift::findorfail($request->idshift);
        // $data->notes = $request->notes;
        // $data->status_approve = $request->stsapp;
        // $data->tanggal_approve = $tanggal;
        // $data->save();
        // $cekabsen1 = Presensi::where(['id_karyawan' => $data->id_karyawan, 'tanggal' => $data->tanggal_awal])->get()->last();
        // $cekabsen2 = Presensi::where(['id_karyawan' => $data->id_karyawan, 'tanggal' => $data->tanggal_akhir])->get()->last();
        // if ($cekabsen1 == Null) {
        //     return response()->json(['message' => 'Absen Tidak Ada atau Belum Terdaftar!! ', 'code' => 'Error'], 200);
        // }
        // if ($cekabsen1 != Null) {
        //     if ($data->status_approve == "Approve") {
        //         ##tamabahan Ke presensi
        //         $shift1 = $data->shift_awal;
        //         $shift2 = $data->shift_akhir;
        //         $prsn1 = $cekabsen1->update(['id_parampresensi' => $shift1]);
        //         $prsn2 = $cekabsen2->update(['id_parampresensi' => $shift2]);
        //         #$data->save();
        //         if ($data->tanggal_off) {
        //             $cekoff = ParamPresensi::where(['id' => $data->shift_off])->get()->last();
        //             $cekabsen3 = Presensi::where(['id_karyawan' => $data->id_karyawan, 'tanggal' => $data->tanggal_off])->get()->last();
        //             $prsn3 = $cekabsen3->update(['id_parampresensi' => $cekoff->id]);
        //         }
        //     }
        //     return response()->json(['message' => 'Data Change Shift Approved!', 'data' =>  $data]);
        // }
    }



    ###Function Kirim Notif Ke Firebase
    const FCM_AUTH_KEY = 'AAAAh0sKUrQ:APA91bE_GW1p4poeSo7mVRC-O8ZbWnwj_6lVPqwhYz7Sr7-7GBTkfLzSwMjlz_O3gGq5JiMyWVCuCVHzI_1Nn2z0hwxB-V1MCZVkCTH8a7KHuUCMFdWWuihKVn759uNZ_CUEivoFoGLx';
    private function sendPushChangeShift($to, $body,$data)
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
     ##Cancel Change Shift
     public function cekchangeshiftpersonal($id)
     {
         $user_id = Auth::user();
         $dt =  ChangeShift::where('id',$id)->where('id_karyawan',$user_id->getkaryawan->id)->first();
         return $dt;
     }
 
     public function cancelchangeshift(Request $request)
     {
         $user_id = Auth::user();
         $validator = Validator::make($request->all(), [
         'id_changeshift' => 'required',
             ]);
         if($validator->fails()){
            return response()->json(['message' => 'Cek Inputan Anda', 'code' => '404'], 404);
         }
         $dt = $this->cekchangeshiftpersonal($request->id_changeshift);
         if(!($dt)){
             return response()->json(['message' => 'Change Shift Tidak Ditemukan!!', 'code' => '404'], 404);
         }
         if($dt){
             if ($dt->status_approve == "request"){
                 $dt->status_approve = "Cancel";
                 $dt->save();
                 return response()->json(['message' => 'Change Shift Berhasil Di Batalkan', 'code' => '200'], 200);
             }
             if ($dt->status_approve != "request"){
                 return response()->json(['message' => 'Cek Change Shift Tidak Bisa Dicancel Karna Telah Di Approve / Cancel!', 'code' => '403'], 403);
             }
         }
     }
     ##Akhir Change Shift
}
