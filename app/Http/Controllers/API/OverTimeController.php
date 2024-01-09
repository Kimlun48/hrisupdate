<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Models\OverTime;
use App\Models\ParamCabang;
use Carbon\Carbon;
class OverTimeController extends Controller
{

    public function index()
    {
	    $over = OverTime::all();
        return response()->json(['message' => 'List Data OverTime', 'data' =>  $over]);
    }

        public function getoverkar(Request $request)
    {
        $user_id = Auth::user();
	    $over = OverTime::where('id_kar','=',$user_id->getkaryawan->id)->get();
        return response()->json(['message' => 'List Data OverTime', 'data' =>  $over]);
    }

    public function overstore(Request $request)
    {
        $skr = Carbon::now()->format("Y-m-d");
        $user_id = Auth::user();
	    $validator = Validator::make($request->all(),[
	        #'id_kar'            => 'required',
            #'tanggal'           => 'required',
            'tanggal_overtime'  => 'required',
            'mulai'             => 'required',
            'akhir'             => 'required',
            #'durasi'            => 'required', 
            'kompensasi'        => 'required',
            'note'              => 'required',
        ]);
        $waktu1 = Carbon::parse($request->mulai);
        $waktu2 = Carbon::parse($request->akhir);
        
        $hitung_durasi = $waktu1->diff($waktu2);
        
        $jamDurasi = $hitung_durasi->format('%H');
        $menitDurasi = $hitung_durasi->format('%i');
        $durasi = $jamDurasi.":".$menitDurasi;

	    if($validator->fails())
            {
                return response()->json($validator->errors(), 400);
            }
        $cek = OverTime::where('id_kar','=',$user_id->getkaryawan->id)
                ->where('tanggal_overtime','=', $request->tanggal_overtime)->first();
        if($cek){
            return response()->json(['message' => 'Overtime Sudah Ada!'], 403);
        }else{
            $saveover = OverTime::create([
            'id_kar'            => $user_id->getkaryawan->id,
            'tanggal'           => $skr,
            'tanggal_overtime'  => $request->tanggal_overtime,
            'mulai'             => $waktu1,
            'akhir'             => $waktu2,
            'durasi'            => $durasi,
            'kompensasi'        => $request->kompensasi,
            'note'              => $request->note,
            'status_approve'    => "Request OverTime",
            ]);
            return response()->json(['message' => 'Data Pengajuan OverTIme Berhasil Ditambahkan!', 'code' => '200'], 200);
        }
    }

    public function lead_index_overtime() {
        $cekid = Auth::user()->getkaryawan->fk_level_jabatan;
        $id_user = Auth::user();
        $par = ParamCabang::where('id_kar',Auth::user()->getkaryawan->id)->pluck('id_cabang')->toarray();
        $data = OverTime::select('id','tanggal','tanggal_overtime','durasi','status_approve','kompensasi','note','id_kar')
        ->with('getkar:id,nama_lengkap,fk_cabang','getkar.cabang:id,nama')
        ->where('status_approve', '=', 'Request OverTime')
        ->whereHas('getkar.cabang', function ($query) use ($par) {
            $query->whereIn('fk_cabang',$par);})
        ->whereHas('getkar.jabatan', function ($query) use ($cekid) {
            $query->where('parent_id', '=', $cekid);})
            ->get();
        return response()->json(['success' => 'List Parameter Shift',$data]);
    }


    public function overtimeapproval(Request $request)
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
            // $pres = OverTime::where('tanggal','=',$ovtime->tanggal_overtime)->first();
            // // $pres->durasi    = $ovtime->durasi;
            // // $pres->save();
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


}