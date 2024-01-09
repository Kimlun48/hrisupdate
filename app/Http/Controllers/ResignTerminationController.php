<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResignTermination;
use App\Models\LevelJabatan;
use App\Models\Karyawan;
use App\Models\User;
use Auth;
use Validator;
use App\Models\Presensi;
use Illuminate\Support\Facades\DB;
use DateTime;
use Carbon\Carbon;


class ResignTerminationController extends Controller
{
    public function index()
    {
        return view('resignterm.index');
    }
    public function create() {
        return view('resignterm.create');
    }
    public function readpersonal()
    {
	    $id_user = Auth::user();
        $dt =  ResignTermination::where('karyawan_id', $id_user->getkaryawan->id)->get();
    	return view('resignterm.readpersonal')->with(['data'=>$dt]);
    }
    public function listajuresign()
    {
        return view('resignterm.pengajuanresign');
    }   
    public function listajuresign_external()
    {
        return view('resignterm.pengajuanresign_external');
    }  

    public function readallaju()
    {
        $dt =  ResignTermination::where('status_approve', '=', null)
            ->whereHas('karyawan', function ($query) {
                $query->where('jenis_karyawan', '=', 'Internal');
            })
            ->paginate(20)
            ->withQueryString();    
        return view('resignterm.readallaju')->with(['data' => $dt]);
    }
    
    
    public function readallaju_external()
    {
        $dt =  ResignTermination::where('status_approve', '=', null)
            ->whereHas('karyawan', function ($query) {
                $query->where('jenis_karyawan', '=', 'External');
            })
            ->paginate(20)
            ->withQueryString();
    	return view('resignterm.readallaju_external')->with(['data'=>$dt]);
    }
    public function storeresign(Request $request)
     {
        $id_user = Auth::user();
        $id = $id_user->getkaryawan->id;
        $skr = Carbon::now()->format('Y-m-d');
        $validator = Validator::make($request->all(), [
        'tanggal_pengajuan'     => 'required',
        'tanggal_akhirkerja'   => 'required',
        'keterangan'  => 'required',
        'dokumen'     => 'required|mimes:pdf|max:5000',/*If commented, validation passes.*/
        'reason'      => 'required'
        ]);
            $image_name                   = $id.'_'.$skr.'_'.$request->dokumen->getClientOriginalName();
            $file                         = $request->file('dokumen');
            $filePath                     = $file->storeAs('resign', $image_name);
            $data['dokumen']              = $image_name;
            $data['tanggal']              = $skr;
            $data['tanggal_pengajuan']    = $request->tanggal_pengajuan;
            $data['tanggal_akhirkerja']   =   $request->tanggal_akhirkerja;
            $data['status']               = 'Resign';
            $data['notes']                =  $request->reason;
            $data['karyawan_id']          = $id;
	    ResignTermination::insert($data);
	    #$kar = Karyawan::findOrfail($request->id);
            #$kar->status_karyawan = $request->stsapp;
            #$kar->save();
            return response()->json(['message' => 'Inputan Resign berhasil ditambahkan '], 200);
        }
    public function approve($id)
    {
        $tr = ResignTermination::find($id);
        return view('resignterm.approve')->with(['data'=>$tr]);
    }


    public function storeapprove(Request $request)
    {
       $validator = Validator::make($request->all(), [
       'nama'     => 'required',
       'nik'      => 'required',
       'stsapp'   => 'required',
       'id_req'   => 'required',
       ]);
       $app = ResignTermination::find($request->id_req);
       $skr = Carbon::now()->format('Y-m-d');
       $app->tanggal_approve  = $skr;
       $app->status_approve   = $request->stsapp;
       $app->save();
       $kar = Karyawan::find($app->karyawan_id);
       $upkar = $kar->update(['status_karyawan' => $app->status]);
       return response()->json(['message' => 'Request Resign Telah Di Approve'], 200);
    }

    public function reject($id)
    {
        $tr = ResignTermination::find($id);
        return view('resignterm.reject')->with(['data'=>$tr]);
    }

    public function rejectresign(Request $request)
    {      
        $validator = Validator::make($request->all(), [
        'nama'     => 'required',
        'nik'      => 'required',
        'stsapp'   => 'required',
        'id_req'   => 'required',
        ]);
        $rsg = ResignTermination::find($request->id_req);
        $skr = Carbon::now()->format('Y-m-d');
        $rsg->tanggal_approve  = $skr;
        $rsg->status_approve   = $request->stsapp;
        $rsg->save();
        return response()->json(['message' => 'Request Resign Telah Di Reject'], 200);

    }

    public function showphk($id)
    {
        $tr = Karyawan::find($id);
        return view('resignterm.showphk')->with(['data'=>$tr]);
    }

    public function storephk(Request $request)
    {      
        $skr = Carbon::now()->format('Y-m-d');
        $tahunini = Carbon::now()->format('Y');
        $validator = Validator::make($request->all(), [
        'tanggal_pengajuan'  => 'required',
        'tanggal_akhirkerja' => 'required',
        'keterangan'         => 'required',
        'stsapp'             => 'required',
        'id_req'             => 'required',
        ]);

        $data['tanggal']              = $skr;
        $data['tanggal_pengajuan']    = $request->tanggal_pengajuan;
        $data['tanggal_akhirkerja']   = $request->tanggal_akhirkerja;
        $data['status']               = $request->stsapp;
        $data['notes']                = $request->keterangan;
	$data['karyawan_id']          = $request->id_req;
	$data['status_approve']	      = 'approve';
	$data['tanggal_approve']      = $skr;
	ResignTermination::insert($data);
        $kar = Karyawan::find($request->id_req);
        $upkar = $kar->update(['status_karyawan' => $request->stsapp,'tahun_keluar' =>$request->tanggal_akhirkerja ]);

        return response()->json(['message' => 'Inputan Resign berhasil ditambahkan '], 200);
    }

    public function readalmostexpired(Request $request)
    {
        $skr = Carbon::now()->subDays(-30);
        $blnlalu = Carbon::now()->subDays(30);
        $kemarin = Carbon::now()->subDays(1);
        $show = $request->input('show'); // Ambil nilai dari parameter show, defaultnya adalah 25.
        $tr = Karyawan::whereNotIn('expired_kontrak', ['Permanent'])
            ->where('expired_kontrak', '<=', $skr)
            ->where('jenis_karyawan', '=', 'Internal')
            ->paginate($show) // Menggunakan nilai show yang diambil dari parameter.
            ->withQueryString();
        return view('resignterm.almostexpired')->with(['data' => $tr]);
    }
    


    public function readalmostexpired_external()
    {
        $skr = Carbon::now()->subDays(-30);
        $blnlalu = Carbon::now()->subDays(30);
        $kemarin = Carbon::now()->subDays(1);
        $tr = Karyawan::whereNotIn('expired_kontrak', ['Permanent'])
            ->where('expired_kontrak', '<=', $skr)
            ->where('jenis_karyawan', '=', 'External')
            ->get();
    
        return view('resignterm.almostexpired_external')->with(['data' => $tr]);
    }
    
    

    // public function searchalmostexpired(Request $request)
    // {
    //     $skr = Carbon::now()->subDays(-30);
    //     $blnlalu = Carbon::now()->subDays(30);
    //     $kemarin = Carbon::now()->subDays(1);

    //     $search = $request->input('search'); // Mendapatkan nilai pencarian dari input

    //     $query = Karyawan::whereNotIn('expired_kontrak', ['Permanent'])
    //                     ->where('expired_kontrak', '<=', $skr);

    //     if ($search) {
    //         $query->where(function($q) use ($search) {
    //             $q->where('nomor_induk_karyawan', 'like', "%$search%")
    //             ->orWhere('nama_lengkap', 'LIKE', '%'.$search.'%')
    //             ->orWhere('no_identitas', 'LIKE', '%'.$search.'%');
    //         });
    //     }

    //     $tr = $query->paginate(10);

    //     if ($request->ajax()) {
    //         return view('resignterm.almostexpired')->with(['data' => $tr])->render();
    //     }

    //     return view('resignterm.almostexpired')->with(['data' => $tr]);
    // }

    public function readexpired()
    {
        $skr = Carbon::now()->subDays(30);
        $blnlalu = Carbon::now()->subDays(30);
        $kemarin = Carbon::now()->subDays(1);
        // dd($blndepan);
        $tr = Karyawan::whereNotIn('expired_kontrak', ['Permanent'])
            ->where('expired_kontrak','>',$skr)
            ->where('jenis_karyawan', 'Internal') 
            ->paginate(20)
            ->withQueryString();
        return view('resignterm.expiredkontrak')->with(['data'=>$tr]);
    }


    public function readexpired_external()
    {
        $skr = Carbon::now()->subDays(30);
        $blnlalu = Carbon::now()->subDays(30);
        $kemarin = Carbon::now()->subDays(1);
        
        $tr = Karyawan::whereNotIn('expired_kontrak', ['Permanent'])
            ->where('expired_kontrak', '>', $skr)
            ->where('jenis_karyawan', 'External') 
            ->get();
        
        return view('resignterm.expiredkontrak_external')->with(['data' => $tr]);
    }
    

    // public function searchexpired(Request $request)
    // {
    //     $skr = Carbon::now()->subDays(30);
    //     $blnlalu = Carbon::now()->subDays(30);
    //     $kemarin = Carbon::now()->subDays(1);

    //     if ($request->ajax()) {
    //         $search = $request->input('search');
    //         $tr = Karyawan::whereNotIn('expired_kontrak', ['Permanent'])
    //             ->where('expired_kontrak', '>', $skr)
    //             ->where(function ($query) use ($search) {
    //                 $query->where('nomor_induk_karyawan', 'LIKE', '%'.$search.'%')
    //                 ->orWhere('nama_lengkap', 'LIKE', '%'.$search.'%')
    //                 ->orWhere('no_identitas', 'LIKE', '%'.$search.'%');
    //                 })
    //             ->paginate(10);

    //         return view('resignterm.expiredkontrak')->with(['data' => $tr])->render();
    //     }

    //     $tr = Karyawan::whereNotIn('expired_kontrak', ['Permanent'])
    //         ->where('expired_kontrak', '>', $skr)
    //         ->paginate(10);

    //     return view('resignterm.expiredkontrak')->with(['data' => $tr]);
    // }

    public function qpi($id)
    {
        $kar = Karyawan::findOrFail($id);
        $pdf = \PDF::loadView('resignterm.qpi', compact('kar'))->setPaper('a4', 'potrait');
        return $pdf->stream('QPI.pdf');
    }

    public function sphk($id)
    {
        $kar = Karyawan::findOrFail($id);
        $pdf = \PDF::loadView('resignterm.sphk', compact('kar'))->setPaper('A4', 'potrait');
        return $pdf->stream('SPHK.pdf');
    }     
    
    
    public function nonactive()
    {
        // if (request()->ajax()) {
        //     $search = request()->input('searchValue');
        //     $data = Karyawan::where('jenis_karyawan','=','Internal')
        //     ->whereIn('status_karyawan',["Resign","PHK","phk"])
        //         ->where(function ($query) use ($search) {
        //             $query->where('nama_lengkap', 'LIKE', '%' . $search . '%')
        //                 ->orWhere('no_identitas', 'LIKE', '%' . $search . '%');
        //         })
        //         ->paginate(20)
        //         ->withQueryString();
        //     return view('resignterm.nonactive')->with(['data' => $data]);
        // }

        $data = Karyawan::where('jenis_karyawan','=','Internal')
            ->whereIn('status_karyawan',["Resign","PHK","phk"])
            ->paginate(20)
            ->withQueryString();

        return view('resignterm.nonactive')->with(['data' => $data]);
    }

    public function nonactive_external(Request $request)
    {
        // if (request()->ajax()) {
        //     $search = request()->input('searchValue');
        //     $data = Karyawan::where('jenis_karyawan','=','External')
        //     ->whereIn('status_karyawan',["Resign","PHK","phk"])
        //         ->where(function ($query) use ($search) {
        //             $query->where('nama_lengkap', 'LIKE', '%' . $search . '%')
        //                 ->orWhere('no_identitas', 'LIKE', '%' . $search . '%');
        //         })
        //         ->paginate(20)
        //         ->withQueryString();
        //     return view('resignterm.nonactive')->with(['data' => $data]);
        // }

        $data = Karyawan::where('jenis_karyawan','=','External')
            ->whereIn('status_karyawan',["Resign","PHK","phk"])
            ->get();

        return view('resignterm.nonactive_external')->with(['data' => $data]);
    } 
}
