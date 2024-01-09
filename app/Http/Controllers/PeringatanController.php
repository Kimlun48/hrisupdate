<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Peringatan;
use App\Models\Watcher;
use App\Models\Karyawan;
use App\Models\PasalPelanggaran;
use Notification;
use App\Notifications\EmailSPNotification;   
use DateTime;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use App\Services\FCMService;

class PeringatanController extends Controller
{
    public function index()
    {
        return view('peringatan.index');
    }
    public function readsp()
    {
        $data = Peringatan::where('status_approve','=','Request')->get();
        return view('peringatan.read', compact('data'));
    }

    public function read_approve()
    {
        $data = Peringatan::where('status_approve','=','Approve')->get();
        return view('peringatan.approve_reject', compact('data'));
    }

    public function read_reject()
    {
        $data = Peringatan::where('status_approve','=','Reject')->get();
        return view('peringatan.approve_reject', compact('data'));
    }

    public function showapprove($id)
    {
        $data = Peringatan::find($id);
        $pasal = PasalPelanggaran::all();
        $employes = Karyawan::whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation"])->get();
        $wtch = Watcher::where('id_sp','=',$id)->get()->pluck('id_watcher');
        return view('peringatan.modalapprove', compact('data','pasal','employes','wtch'));
    }

    public function storeapprovesp(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'sangsi'       => 'required',
        'pasal'        => 'required',
        'keterangan'   => 'required',
        'idperingatan' => 'required',
        'approve'      => 'required',
        ]);
        
        $trans = Peringatan::findOrFail($request->idperingatan);
        // $wktu = Carbon::now()->format('Y-m-d');
        // $wktu_akhir = Carbon::create($wktu)->addDays(180)->format('Y-m-d');
        $currentDate = $request->input('startdate');
        $startDate = Carbon::parse($currentDate);
        $endDate = $startDate->addMonths(3);
        $tanggal3BulanKedepan = $endDate->format('Y-m-d');
        
        $user_id = Auth::id();
        $trans->update([
            #'id_karyawan'       => $trans->id_karyawan,
            'user_approve_id'    => $user_id,
            'tanggal_approve'    => $wktu,
            'pasal_id'           => $request->pasal,
            'jenis_peringatan'   => $request->sangsi,
            'status_approve'     => $request->approve,
            'note'               => $request->keterangan,
            'tgl_awal'           => $currentDate,#$wktu,
            'tgl_akhir'          => $tanggal3BulanKedepan,#$wktu_akhir,
            ]);
            $result = $this->sendPush();
            if($request->watcher){
                $wtch = Watcher::where('id_sp','=',$request->idperingatan)
                        ->get()->pluck('id_watcher'); ##Get Watcher Pertama Pengajuan
                $wtch_dua = Karyawan::whereIn('id',$request->watcher)
                            ->get()->pluck('id');
                // Mendapatkan data yang baru ditambahkan
                $addedData = $wtch_dua->diff($wtch); ##DATA BARU YANG DITAMBAHKAN DI APPORVE

                // Mendapatkan data yang lama dihapus
                $removedData = $wtch->diff($wtch_dua); ## Jika Data Lama Ada Yang di hapus di approve
                if($addedData){
                    foreach ($addedData as $item) {
                        $savewt = Watcher::create(['id_watcher' => $item,'id_sp' => $trans->id, ]);
                    }
                }
                if($removedData){
                    $wtch = Watcher::where('id_sp','=',$request->idperingatan)
                            ->whereIn('id_watcher',$removedData)
                            ->delete(); ##Hapus Data Yang DI keluarkan di Choices
                }
                
            }            
        #$kar = Karyawan::findOrFail($trans->id_karyawan);   
        $jml = Peringatan::where('id_karyawan',$trans->id_karyawan)->where('jenis_peringatan', 'like' , '%sp%')->where('tgl_akhir', '>' ,$wktu)->where('status_approve', 'like' , '%Approve%')->count();
        if($jml == 3) { 
        // Send Notif E-Mail
                $sp = [
                 'greeting' => 'Hi '.$trans->karyawan->nama_lengkap.',',
                 'body' => 'Status Surat Peringatan',
                 'thanks' => 'Ini cuma test',
                 'actionText' => 'Anda sudah menerima SP sebanyak '.$jml.' kali',
                 'actionURL' => url('https://hris.anyargroup.co.id/login'),
                 //'id' => $user->id
             ];
             Notification::send($trans->karyawan, new EmailSPNotification($sp));
        return response()->json(['message' => 'Email berhasil dikirim, Peringatan Berhasil Di Approve'], 200);
        } else {
        return response()->json(['message' => 'Peringatan Berhasil Di Approve'], 200);
        }
    }

    public function showreject($id)
    {
        $data = Peringatan::find($id);
        $pasal = PasalPelanggaran::all();
        return view('peringatan.modalreject', compact('data','pasal'));
    }

    public function storerejectsp(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'sangsi'       => 'required',
        'pasal'        => 'required',
        'keterangan'   => 'required',
        'idperingatan' => 'required',
        'reject'       => 'required',
        ]);
        
        $trans = Peringatan::findOrFail($request->idperingatan);
        $wktu = Carbon::now()->format('Y-m-d');
        $wktu_akhir = Carbon::create($wktu)->addDays(180)->format('Y-m-d');
        $user_id = Auth::id();
        $trans->update([
            #'id_karyawan'       => $trans->id_karyawan,
            'user_approve_id'    => $user_id,
            'tanggal_approve'    => $wktu,
            'pasal_id'           => $request->pasal,
            'jenis_peringatan'   => $request->sangsi,
            'status_approve'     => $request->reject,
            'note'               => $request->keterangan,
        //    'tgl_awal'           => $wktu,
        //    'tgl_akhir'          => $wktu_akhir,

            ]);
        return response()->json(['message' => 'Peringatan Berhasil Di Reject'], 200);
    }

    
    public function sendPush()
    {

        $fcmService = new FCMService();

        #hasan #$token = 'eL5jHFUFPKTntqiC9MM8-o:APA91bEK4aiccpcDedUVsSK_vV0d-waDwzcsqnLnUrnJsvAn5KGw8Otxxkry69nlAf0WchbAU6u5MHx0WECHpTNRRv_VlIEgocq6KTPSpMrCCU1MpQgbxXnTqOiJovLjeu9XVDyZVWIK';
        #husni #$token = 'dwa6StdZQ7meHPfhR2xAqX:APA91bGBPzMtziNr7zEhDxcSH7Qd7TKdWTg8YU1mRp1x7yK-_TpW7WWppgB6yuzQcHBmamO-nsrmWN6yKiy7xLy0bV1hA4Ubgwk93wEB6Xx8tZjSXnG0I5IqjVUbN6frpJTVYj04EhBH';
        #sepur 
        $token = 'cLuQn19v56-qTMBQJh2kfU:APA91bFDiJ-H6IyKirUOIxNlN7XpiAmomxmb1xH2-qlIdw9ilUcpgw6QI-leeO1GRszRW1_fbPkxXQqJfk2HQhoJ4-gy9MJePKjr9y9vIJiXOsMJQ-tBrj7m3CnvRS6-fPRq0vE6pghf';
        $title = 'Notification Title HUSNIIIIIIIIIIII';
        $body = 'Notification Body aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';

        $result = $fcmService->sendNotification($token, $title, $body);

        return response()->json(['result' => $result]);
        // return response()->json($result);

        // $url = 'https://fcm.googleapis.com/v1/projects/laravel-firebase-demo-8232d/messages:send';
        // $serverKey = 'AAAAh0sKUrQ:APA91bE_GW1p4poeSo7mVRC-O8ZbWnwj_6lVPqwhYz7Sr7-7GBTkfLzSwMjlz_O3gGq5JiMyWVCuCVHzI_1Nn2z0hwxB-V1MCZVkCTH8a7KHuUCMFdWWuihKVn759uNZ_CUEivoFoGLx';      
        // $fcmToken =  "chdV5UuVQFCg9K5oq8um4X:APA91bHSe2x5dXn9ZhSjkFD2eWUkicq5MIESScHGogiUJkeolq2pN-dl056lDESJdnFnKyqoDwfu__TBPJSbru_AKP3G_IhcO0s6aBdVSmEUy6zcO009shqu0h16k3n9x9bM66w4qcsO";
        // // $fcmToken = "cEjvfMTST6qPcA6GZlUlOr:APA91bGuifRM9MgUJoLKhtse2yeJRW86R7GBRj2w0YBby0gOiv5uUS9yC6MfpJow4Mjh-_GTd7Iix3i89iQku06UKedWVdivZzfDajVphBpEN2yuaP1LBQ4_sY8QBLl5pKBMdpwgyGdg"; #token Sepur
        // $notificationData = [
        //     'message' => [
        //         'token' => $fcmToken,
        //         'notification' => [
        //             'title' => 'Judul Notifikasi',
        //             'body' => 'Isi Notifikasi',
        //         ],
        //         'data' => [
        //             'key' => 'value',
        //         ],
        //     ],
        // ];
        // $response = Http::withHeaders([
        //     'method'  => 'POST',
        //     'Authorization' => 'Bearer ' . $serverKey,
        //     'Content-Type' => 'application/json',
        // ])->post($url, $notificationData);
        // dd($response);
        // return $response->json();
    }

}

?>
