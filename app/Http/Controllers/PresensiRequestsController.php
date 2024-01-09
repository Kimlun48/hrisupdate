<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PresensiRequest;
use App\Models\LevelJabatan;
use App\Models\Karyawan;
use App\Models\User;
use App\Models\Presensi;
use App\Models\ParamCabang;
use Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PresensiRequestsController extends Controller
{
    public function index()
    {
        return view('reqattend.index');
    }

    public function index_admin()
    {
        return view('reqattend.index_admin');
    }


    public function reqattendkar()
    {
        return view('reqattend.reqattendkar');
    }

    public function readdata()
    {
        #VIA JABATAN
        // dd('aaaaaaaa');
	    $id_user = Auth::user();
        $lm =  Karyawan::where('fk_user', $id_user->id)->get()->last();
        $level_jab = $lm->fk_level_jabatan;
        $par = ParamCabang::where('id_kar',$lm->id)->pluck('id_cabang')->toarray();
        $tmlead = LevelJabatan::where('parent_id','=',$level_jab)->first();
        $dt = DB::table("presensi_requests")
            ->leftJoin("karyawans", function($join){
	        $join->on("karyawans.id", "=", "presensi_requests.id_karyawan");
        })
            ->leftJoin("level_jabatans", function($join){
	        $join->on("level_jabatans.id", "=", "karyawans.fk_level_jabatan");
        })
            ->select("karyawans.nama_lengkap", "karyawans.nomor_induk_karyawan", "presensi_requests.created_at","presensi_requests.id","presensi_requests.tanggal", "presensi_requests.status_approve","presensi_requests.notes")
            ->where("level_jabatans.parent_id", "=", $level_jab)
            ->where('presensi_requests.status_approve','=','ReqAttendance')
            // ->where('karyawans.fk_bagian','=', $lm->fk_bagian)
            ->wherein('karyawans.fk_cabang', $par)
            ->where("karyawans.approval_via","=","JABATAN")
            // ->where('karyawans.fk_cabang','=', $lm->fk_cabang)
            ->orderBy('tanggal', 'DESC');
        // ->get();
        #VIA PIV
        ##VIA PIC
        $alldata = DB::table("presensi_requests")
        ->leftJoin("karyawans", function($join){
        $join->on("karyawans.id", "=", "presensi_requests.id_karyawan");
    })
        ->leftJoin("pic_approves", function($join) use ($lm){
        $join->on("presensi_requests.id_karyawan", "=", "pic_approves.id_kar");
    })
        ->select("karyawans.nama_lengkap", "karyawans.nomor_induk_karyawan", "presensi_requests.created_at" , "presensi_requests.id","presensi_requests.tanggal", "presensi_requests.status_approve","presensi_requests.notes")
        ->where('pic_approves.kar_approve','=', $lm->id )
        ->where("karyawans.approval_via","=","PIC")
        ->where('presensi_requests.status_approve','=', "ReqAttendance")
        ->union($dt)
        ->get();
        // return response()->json([$cek_data]);

        // dd('ini data 1',$dt,'ini data 2',$cek_data);
    	return view('reqattend.readdata')->with(['alldata'=>$alldata]);
    }

    public function readkaryawan()
    {
        $id_user = Auth::user();
        $dt = PresensiRequest::where('id_karyawan', $id_user->getkaryawan->id)->get()
              ->where('status_approve','=', 'ReqAttendance');
        return view('reqattend.readkaryawan')->with(['data'=>$dt]);
    }

    public function create() {
        return view('reqattend.create');
    }
   
    public function store(Request $request)
    {
       $validator = \Validator::make($request->all(), [
       #'tanggal'     => 'required',
       #'clockin'     => 'required',
       #'clockout'    => 'required',
       #'reason'      => 'required',
       #'id_karyawan' => 'required',
       'tanggal'     => 'required',
       'clockin'     => 'required',
       'reason'      => 'required',
       'id_karyawan' => 'required',
       'jenis'       => 'required',
       ]);

       $cekabsen = Presensi::where(['id_karyawan' => $request->id_karyawan, 'tanggal' => $request->tanggal])->get()->last(); 
       if($cekabsen == Null){
           return response()->json(['message' => 'Presensi Belum Terdaftar', 'code' => 'warning'], 200);
       } elseif ($request->jenis == 'Pulang'  && $cekabsen->jam_masuk == Null) {
        return response()->json(['message' => 'Anda Belum Melakukan Presensi Masuk', 'code' => 'warning'], 200);
       }
       else{

       $data['tanggal']     = $request->tanggal;
       $data['jenis']       = $request->jenis;
       $data['jam']         = $request->clockin;
       #$data['jam_pulang']     = $request->clockout;
       $data['id_karyawan'] = $request->id_karyawan;
       $data['notes'] = $request->reason;
       $data['status_approve'] = 'ReqAttendance';
       PresensiRequest::insert($data);
       return response()->json(['message' => 'Request Attendance Has been Save!!', 'code' => 'warning1'], 200);
       }
    }

     // Tampilkan data Approve
     public function showupdate($id)
     {
         $data = PresensiRequest::findorfail($id);
         return view('reqattend.showedit')->with(['data'=>$data]);
     }

    // Simpan data Approve
    public function approve(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
        'tanggal'     => 'required',
        'nama'        => 'required',
        'stsapp'   => 'required',
        'id_karyawan' => 'required',
	]);
	$id_user = Auth::user();
	$data = PresensiRequest::findorfail($id);
	$tanggal = Carbon::now()->format('Y-m-d');
        $data->tanggal_approve = $tanggal;
	$data->status_approve = $request->stsapp;
	$data->user_approve_id = $id_user->id;

        ##tamabahan Ke presensi
        $cekabsen = Presensi::where(['id_karyawan' => $data->id_karyawan, 'tanggal' => $data->tanggal])->get()->last();
        $req_jam_msk = $data->jam;
        $req_tgl_msk = $data->tanggal;
        $cek_param_jam_masuk = Carbon::parse($cekabsen->parampresensi->jam)->format('H:i:s');
        $cek_tgl_jam_masuk = $req_tgl_msk . ' '.$data->jam;
	    $post_jam_masuk = Carbon::parse($cek_tgl_jam_masuk)->format('Y-m-d H:i:s');
        $cek_tgl_jam_pulang = $req_tgl_msk . ' '.$data->jam;
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
        if ($data->jenis == 'Masuk') {
                $prsn = $cekabsen->update(['keterangan' => $data->notes, 'jam_masuk'=>$post_jam_masuk, 'presensi_status' => $presensi_status]);
        }

        if ($data->jenis == 'Pulang') {
                $prsn = $cekabsen->update(['keterangan' => $data->notes, 'jam_pulang'=>$post_jam_pulang]);
        }

	#$prsn = $cekabsen->update(['keterangan' => $data->notes, 'jam_masuk'=>$post_jam_masuk,
        #	'jam_pulang'=>$post_jam_pulang, 'presensi_status' => $presensi_status
        // ]);
	$data->save();
	return response()->json(['message' => 'Request Attendance Has been Approve!!']);
    }
    #public function approve(Request $request, $id)
    #{
    #    $validator = \Validator::make($request->all(), [
    #    'tanggal'     => 'required',
    #    'nama'        => 'required',
    #    'stsapp'   => 'required',
    #    'id_karyawan' => 'required',
    #     ]);
    #    $data = PresensiRequest::findorfail($id);
    #    $data->status_approve = $request->stsapp;
    #    $data->save();
    #}

     // Tampilkan data reject
    public function showreject($id)
    {
        $data = PresensiRequest::findorfail($id);
        return view('reqattend.showreject')->with(['data'=>$data]);
    }

   // Simpan data reject
    public function reject(Request $request, $id)
    {      
        $validator = Validator::make($request->all(), [
            'stsapp'        => 'required',
            'id_karyawan'   => 'required',
            'notes'         => 'required',
        ]);
            $id_user = Auth::user();
            $tanggal = Carbon::now()->format('Y-m-d');
            $data = PresensiRequest::findorfail($id);      
            $data->notes = $request->notes;
            $data->status_approve = $request->stsapp;
            $data->tanggal_approve = $tanggal;
            $data->user_approve_id = $id_user->id;
            $data->save(); 
    }

   public function showbreaktime()
    {
        return view('reqattend.showbreaktime');
    }

    public function readbreaktime() {
        $id_user = Auth::user();
        $skr = Carbon::now()->format('Y-m-d');
        $dt = Presensi::where('id_karyawan', $id_user->getkaryawan->id)
              ->whereNotNull('istirahat_masuk')->get();
        return view('reqattend.readbreaktime')->with(['data'=>$dt]);
    }

    public function addbreaktime(Request $request) {
        $id_user = Auth::user();
        $kar = Karyawan::where('id', '=', $id_user->getkaryawan->id)->take(1)->first();
        return view('reqattend.modalbreaktime')->with(['data'=>$kar]);
    }

    public function savebreak(Request $request)
    {
        $validator = Validator::make($request->all(), [
        #'tanggal'     => 'required',
        #'jam'         => 'required',
        'id_karyawan' => 'required',
        'jenis'       => 'required', # Out / In
        ]);
        if($validator->fails()){
            return response()->json(['message' => 'Cek Inputan Anda', 'code' => '400'], 200);
        }

        $skr = Carbon::now();
        $ayeuna = new DateTime(date('H:i:s'));
        $cekabsen = Presensi::where(['id_karyawan' =>$request->id_karyawan, 'tanggal' =>  $skr])->whereNotNull('jam_masuk')->take(1)->first();
        if($request->jenis == 'Out'){
            if ($cekabsen){
                $cekabsen->istirahat_keluar = $ayeuna;
                $cekabsen->save();
                return response()->json(['message' => 'Istirahat Keluar Telah Tersimpan', 'code' => '200'], 200);
            }
            if (!$cekabsen){
                return response()->json(['message' => 'Anda Belum Absen Masuk', 'code' => '200'], 200);
            }
        }if($request->jenis == 'In'){
            $cekistirahat = Presensi::where(['id_karyawan' => $request->id_karyawan, 'tanggal' =>  $skr])->whereNotNull('istirahat_keluar')->take(1)->first();
            if ($cekistirahat){
                $cekistirahat->istirahat_masuk = $ayeuna;
                $cekistirahat->save();
                return response()->json(['message' => 'Istirahat Masuk Telah Tersimpan', 'code' => '200'], 200);
                }
            if (!$cekistirahat){
                return response()->json(['message' => 'Anda Belum Absen Istirahat Keluar', 'code' => '200'], 200);
                }
        }
    	return response()->json(['message' => 'Cek Inputan Anda!', 'code' => '200'], 200);
    }


    // public function attendance_admin()
    // {
    //     $alldata = DB::table("presensi_requests")
    //         ->leftJoin("karyawans", function($join){
	//         $join->on("karyawans.id", "=", "presensi_requests.id_karyawan");
    //     })
    //         ->select("karyawans.nama_lengkap", "karyawans.nomor_induk_karyawan", "presensi_requests.created_at", "presensi_requests.id","presensi_requests.tanggal", "presensi_requests.status_approve","presensi_requests.notes")
    //         ->where('presensi_requests.status_approve','=','ReqAttendance')
    //         ->orderBy('tanggal', 'DESC')->get();

            
    //     return view('reqattend.readdata')->with(['alldata'=>$alldata]);

    // }

    // public function attendance_admin(Request $request)
    // {
    //     $length = $request->input('length', 10);
    //     $search = $request->input('search');

    //     $query = DB::table("presensi_requests")
    //         ->leftJoin("karyawans", function ($join) {
    //             $join->on("karyawans.id", "=", "presensi_requests.id_karyawan");
    //         })
    //         ->select("karyawans.nama_lengkap", "karyawans.nomor_induk_karyawan", "presensi_requests.created_at", "presensi_requests.id", "presensi_requests.tanggal", "presensi_requests.status_approve", "presensi_requests.notes")
    //         ->where('presensi_requests.status_approve', '=', 'ReqAttendance');

    //     // Tambahkan kondisi pencarian
    //     if (!empty($search)) {
    //         $query->where(function ($subQuery) use ($search) {
    //             $subQuery->where('karyawans.nama_lengkap', 'like', '%' . $search . '%')
    //                 ->orWhere('karyawans.nomor_induk_karyawan', 'like', '%' . $search . '%')
    //                 ->orWhere('presensi_requests.tanggal', 'like', '%' . $search . '%')
    //                 ->orWhere('presensi_requests.status_approve', 'like', '%' . $search . '%')
    //                 ->orWhere('presensi_requests.notes', 'like', '%' . $search . '%');
    //         });
    //     }

    //     $alldata = $query->orderBy('tanggal', 'DESC')->paginate($length)->withQueryString();
        
    //     if ($request->ajax()) {
    //         $jsonData = json_encode($alldata);
    //         return view('reqattend.readdata')->with(['alldata' => $jsonData, 'search' => $search])->render();
    //     }

    //     return view('reqattend.readdata')->with(['alldata' => $alldata, 'search' => $search]);
    // }

    public function attendance_admin(Request $request)
    {
    $length = $request->input('length', 10);
    $search = $request->input('search');
    if ($request->ajax()) {
        $query = DB::table("presensi_requests")
            ->leftJoin("karyawans", function ($join) {
                $join->on("karyawans.id", "=", "presensi_requests.id_karyawan");
            })
            ->select("karyawans.nama_lengkap", "karyawans.nomor_induk_karyawan", "presensi_requests.created_at", "presensi_requests.id", "presensi_requests.tanggal", "presensi_requests.status_approve", "presensi_requests.notes")
            ->where('presensi_requests.status_approve', '=', 'ReqAttendance')->get();
            return response()->json(['data'=> $query]);
        }
        return view('reqattend.index_admin');
    // return view('mahasiswa.index');
    
            

}


    public function log_attendance_approve(Request $request)
    {
        $length = $request->input('length', 10);
        $search = $request->input('search');

        $query = DB::table("presensi_requests")
            ->leftJoin("karyawans", function ($join) {
                $join->on("karyawans.id", "=", "presensi_requests.id_karyawan");
            })
         ->select("karyawans.nama_lengkap", "karyawans.nomor_induk_karyawan", "presensi_requests.created_at", "presensi_requests.id","presensi_requests.tanggal", "presensi_requests.status_approve", "presensi_requests.tanggal_approve","presensi_requests.notes")
            ->where('presensi_requests.status_approve', '=', 'approve');

        // Tambahkan kondisi pencarian
        if (!empty($search)) {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('karyawans.nama_lengkap', 'like', '%' . $search . '%')
                    ->orWhere('karyawans.nomor_induk_karyawan', 'like', '%' . $search . '%')
                    ->orWhere('presensi_requests.tanggal', 'like', '%' . $search . '%')
                    // ->orWhere('presensi_requests.status_approve', 'like', '%' . $search . '%')
                    ->orWhere('presensi_requests.notes', 'like', '%' . $search . '%');
            });
        }

        $alldata = $query->orderBy('tanggal', 'DESC')->paginate($length)->withQueryString();

        if ($request->ajax()) {
            return view('reqattend.log_history.attend_approve')->with(['alldata' => $alldata, 'search' => $search])->render();
        }

        return view('reqattend.log_history.attend_approve')->with(['alldata' => $alldata, 'search' => $search]);
    }


    public function log_attendance_reject(Request $request)
    {
        $length = $request->input('length', 10);
        $search = $request->input('search');

        $query = DB::table("presensi_requests")
            ->leftJoin("karyawans", function ($join) {
                $join->on("karyawans.id", "=", "presensi_requests.id_karyawan");
            })
         ->select("karyawans.nama_lengkap", "karyawans.nomor_induk_karyawan", "presensi_requests.created_at", "presensi_requests.id","presensi_requests.tanggal", "presensi_requests.status_approve", "presensi_requests.tanggal_approve","presensi_requests.notes")
            ->where('presensi_requests.status_approve', '=', 'reject');

        // Tambahkan kondisi pencarian
        if (!empty($search)) {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('karyawans.nama_lengkap', 'like', '%' . $search . '%')
                    ->orWhere('karyawans.nomor_induk_karyawan', 'like', '%' . $search . '%')
                    ->orWhere('presensi_requests.tanggal', 'like', '%' . $search . '%')
                    // ->orWhere('presensi_requests.status_approve', 'like', '%' . $search . '%')
                    ->orWhere('presensi_requests.notes', 'like', '%' . $search . '%');
            });
        }

        $alldata = $query->orderBy('tanggal', 'DESC')->paginate($length)->withQueryString();

        if ($request->ajax()) {
            return view('reqattend.log_history.attend_reject')->with(['alldata' => $alldata, 'search' => $search])->render();
        }

        return view('reqattend.log_history.attend_reject')->with(['alldata' => $alldata, 'search' => $search]);
    }





}

