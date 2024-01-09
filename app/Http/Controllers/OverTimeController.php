<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OverTime;
use App\Models\Karyawan;
use App\Models\Perusahaan;
use App\Models\ParamCabang;
use App\Models\Cabang;
use App\Models\Presensi;
use Carbon\Carbon;
use Auth;
use Validator;

use Illuminate\Support\Facades\DB;

class OverTimeController extends Controller
{
    public function index()
    {
        return view('overtime.index');
    }

    public function readdata()
    {
        $ovtime = OverTime::all();
        return view('overtime.readdata', compact('ovtime'));
    }


    public function detail($id)
    {
        $ovtime = OverTime::findorfail($id);
        return view('overtime.showdetail', compact('ovtime'));
    }

    public function create()
    {
        $kr   = Karyawan::all();
        $pt   = Perusahaan::all();
        $cabs = Cabang::all();
        return view('overtime.create', compact('kr','pt','cabs'));
    }

    public function storeovertime(Request $request)
    {
        $result = $request->input('karyawan', []);
        $skr = Carbon::now()->format("Y-m-d");
        $user_id = Auth::user();
	    $validator = Validator::make($request->all(),[
            'karyawan'          => 'required',
            'tanggal_overtime'  => 'required',
            'kompensasi'        => 'required',
            'mulai'             => 'required',
            'akhir'             => 'required',
            'note'              => 'required',

        ]);
	    if($validator->fails()){
            return response()->json($validator->fails(), 400);
        }
        try {
            DB::beginTransaction();
        
            foreach ($result as $data) {
                $kar = Karyawan::findorFail($data);
                $tes = OverTime::where('id_kar','=',$kar->id)->where('tanggal_overtime','=', date('Y-m-d', strtotime($request->tanggal_overtime)))->first();
                // dd($tes);
                // Pemeriksaan apakah data sudah ada di tabel berdasarkan kondisi tertentu
                if ($tes) {
                    return response()->json(['message' => 'Data Pengajuan Dibatalkan karna Atas nama '.$tes->getkar->nama_lengkap.' Telah tedaftar', 'code' => '400'], 400);
                    // throw new \Exception("Data with field1 already exists");
                }
                $waktu1 = Carbon::parse($request->mulai);
                $waktu2 = Carbon::parse($request->akhir);
                $hitung_durasi = $waktu1->diff($waktu2);
                $jamDurasi = $hitung_durasi->format('%H');
                $menitDurasi = $hitung_durasi->format('%i');
                $durasi = $jamDurasi.":".$menitDurasi;
        
                $ovtime = new OverTime();
                    $ovtime->id_kar = $data;
                    $ovtime->tanggal = $skr;
                    $ovtime->tanggal_overtime = date('Y-m-d', strtotime($request->tanggal_overtime));
                    $ovtime->mulai = $request->mulai;
                    $ovtime->akhir = $request->akhir;
                    $ovtime->durasi = $durasi;
                    $ovtime->kompensasi = $request->kompensasi;
                    $ovtime->status_approve = "Request OverTime";
                    $ovtime->note = $request->note;
                    $ovtime->save();
            }
            DB::commit(); // Commit transaksi jika tidak ada kesalahan
        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan transaksi jika terjadi kesalahan
        }
        return response()->json(['message' => 'Data Pengajuan OverTIme Berhasil Ditambahkan!', 'code' => '200'], 200);
    }

// Crude Untuk Per user( Karyawan )
    public function ovtimekar()
    {
        return view('overtime.reqovertimekar');
    }

    public function bacadatakar()
    {
        
        $user_id = Auth::user();
        // dd($user_id->getkaryawan->id);
        $overtime = OverTime::where('id_kar','=',$user_id->getkaryawan->id)->get();
        // dd($over);
        return view('overtime.readovertimekar', compact('overtime'));
    }


    public function createovertimekar()
    {
        $kr   = Karyawan::all();
        $pt   = Perusahaan::all();
        $cabs = Cabang::all();
        return view('overtime.createovertimekar', compact('kr','pt','cabs'));
    }

    public function storeovertimekar(Request $request)
    {

        $skr = Carbon::now()->format("Y-m-d");
        $user_id = Auth::user();
	    $validator = Validator::make($request->all(),[
            'tanggal_overtime'  => 'required',
            'kompensasi'        => 'required',
            'mulai'             => 'required',
            'akhir'             => 'required',
            'note'              => 'required',

        ]);
	    if($validator->fails()){
            return response()->json($validator->fails(), 400);
        }
        $tes = OverTime::where('id_kar','=',$user_id->getkaryawan->id)->where('tanggal_overtime','=', date('Y-m-d', strtotime($request->tanggal_overtime)))->first();
        // Pemeriksaan apakah data sudah ada di tabel berdasarkan kondisi tertentu
        if ($tes) {
            return response()->json(['message' => 'Data Pengajuan Dibatalkan karna Atas nama '.$tes->getkar->nama_lengkap.' Telah tedaftar', 'code' => '400'], 400);
            // throw new \Exception("Data with field1 already exists");
        }            
            $waktu1 = Carbon::parse($request->mulai);
            $waktu2 = Carbon::parse($request->akhir);
            $hitung_durasi = $waktu1->diff($waktu2);
            $jamDurasi = $hitung_durasi->format('%H');
            $menitDurasi = $hitung_durasi->format('%i');
            $durasi = $jamDurasi.":".$menitDurasi;

            $ovtime = new OverTime();
            $ovtime->id_kar             = $user_id->getkaryawan->id;
            $ovtime->tanggal            = $skr;
            $ovtime->tanggal_overtime   = date('Y-m-d', strtotime($request->tanggal_overtime));
            $ovtime->mulai              = $request->mulai;
            $ovtime->akhir              = $request->akhir;
            $ovtime->durasi             = $durasi;
            $ovtime->kompensasi         = $request->kompensasi;
            $ovtime->status_approve     = "Request OverTime";
            $ovtime->note               = $request->note;
            $ovtime->save();
        return response()->json(['message' => 'Data Pengajuan OverTIme Berhasil Ditambahkan!', 'code' => '200'], 200);
    }


    public function lead_index_overtime()
    {
        return view('overtime.indexleader');
    }


    public function read_lead_index_overtime() {
        $cekid = Auth::user()->getkaryawan->fk_level_jabatan;
        
        $id_user = Auth::user();
        $par = ParamCabang::where('id_kar',Auth::user()->getkaryawan->id)->pluck('id_cabang')->toarray();
        $data = OverTime::select('id','tanggal','tanggal_overtime','durasi','status_approve','kompensasi','note','id_kar','mulai','akhir')
        ->with('getkar:id,nama_lengkap,fk_cabang,nomor_induk_karyawan','getkar.cabang:id,nama')
        ->where('status_approve', '=', 'Request OverTime')
        ->whereHas('getkar.cabang', function ($query) use ($par) {
            $query->whereIn('fk_cabang',$par);})
        ->whereHas('getkar.jabatan', function ($query) use ($cekid) {
            $query->where('parent_id', '=', $cekid);})
            ->get();
        // dd('ini pa',$par,'ini data',$data);
        return view('overtime.readindexleader', compact('data'));
        // return response()->json(['success' => 'List Parameter Shift',$data]);
    }

    
    public function read_overtime_admin()
    {
        $data = OverTime::select('id','tanggal','tanggal_overtime','durasi','status_approve','kompensasi','note','id_kar','mulai','akhir')
        ->with('getkar:id,nama_lengkap,fk_cabang,nomor_induk_karyawan','getkar.cabang:id,nama')
        ->where('status_approve', '=', 'Request OverTime')
        ->get();
        return view('reqattend.log_history.overtime_approve', compact('data'));
    }

    public function log_overtime_approve()
    {
        $data = OverTime::select('id','tanggal','tanggal_overtime','durasi','status_approve','kompensasi','note','id_kar','mulai','akhir')
        ->with('getkar:id,nama_lengkap,fk_cabang,nomor_induk_karyawan','getkar.cabang:id,nama')
        ->where('status_approve', '=', 'approve')
        ->get();
        return view('reqattend.log_history.overtime_approve', compact('data'));
    }
    
    public function log_overtime_reject()
    {
        $data = OverTime::select('id','tanggal','tanggal_overtime','durasi','status_approve','kompensasi','note','id_kar','mulai','akhir')
        ->with('getkar:id,nama_lengkap,fk_cabang,nomor_induk_karyawan','getkar.cabang:id,nama')
        ->where('status_approve', '=', 'reject')
        ->get();
        return view('reqattend.log_history.overtime_reject', compact('data'));
    }

    public function showupdate($id)
    {
        $data = OverTime::findorfail($id);
        return view('overtime.showapprove')->with(['data'=>$data]);
    }
    public function overtimeapproval(Request $request,$id)
    {
        $skr = Carbon::now()->format("Y-m-d");
        $user_id = Auth::user();
	    $validator = Validator::make($request->all(),[
            'status_approve'   => 'required',
            'id_ovtime'        => 'required',
        ]);       

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }
        // $ovtime = OverTime::find($request->id_ovtime)->latest();
        $ovtime = OverTime::findorfail($request->id_ovtime);
        // dd($ovtime);
        if($request->status_approve == "approve")
        {
            $ovtime->status_approve = $request->status_approve;
            $ovtime->user_approve   = $user_id->id;
            $ovtime->tgl_approve    = $skr;
            $ovtime->save();
            $pres = Presensi::where('tanggal','=',$ovtime->tanggal_overtime)->first();
            // dd($pres->id);
            $pres->fk_overtime = $ovtime->id;
            $pres->save();
            return response()->json(['message' => 'You Has been Approved Overtime!'], 200);
        }else if($request->status_approve == "reject"){
            $ovtime->status_approve = $request->status_approve;
            $ovtime->user_approve   = $user_id->id;
            $ovtime->tgl_approve    = $skr;
            $ovtime->save();
            return response()->json(['message' => 'You Has been Rejecteded Overtime!', 'code' => '200'], 200);
        }
        else{
            return response()->json(['message' => 'Please Cek Your Input!', 'code' => '403'], 403);
        }
    }

    public function showreject($id)
    {
        $data = OverTime::findorfail($id);
        return view('overtime.showreject')->with(['data'=>$data]);
    }

    // COBA FTP
    
}
