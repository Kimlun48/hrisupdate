<?php

namespace App\Http\Controllers;
use App\Models\LevelJabatan;
use App\Models\PicApprove;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PicApproveController extends Controller
{


public function index()
{
    return view('picapprove.index');
        
}
    public function readpic()
    {
        $pics = PicApprove::all();#where("status",'=',"Aktif")->get();
        return view('picapprove.readpic', compact('pics'));
        
    }

    public function showisi($id)
{
    $jabs = LevelJabatan::find($id);
    return view('picapprove.showjabatan', compact('jabs'));
}


    public function create()
   {
       $kar = Karyawan::where('jenis_karyawan','=','Internal')
       ->whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation"])->get();
       return view('picapprove.create', compact('kar'));
   }

   public function storecreate(Request $request)
    {
        $karids = $request->input('nama', []);
        $cekah = implode(',', $karids);
        $cek = PicApprove::whereIn('id_kar',[$cekah])->count();       
        if($cek == 0){
            DB::beginTransaction();
            try {
            foreach ($karids as $karid) {
                PicApprove::create([
                    'id_kar' => $karid,
                    'kar_approve' => $request->pic,
                    'status' => "aktif",
                    'created_at' => Carbon::now(),
                ]);
            }
            $kar = Karyawan::whereIn('id',$karids)->update(array('approval_via' => "PIC"));
            DB::commit();
            } catch (\Exception $e) {
                // Tangani kesalahan jika terjadi
                DB::rollBack();
            }
            return response()->json(['message' => 'Data PIC Approval berhasil ditambahkan '], 200);
        }else{
            $cek2 = PicApprove::join('karyawans', 'pic_approves.id_kar', '=', 'karyawans.id')
            ->whereIn('pic_approves.id_kar', $karids)
            ->pluck('karyawans.nama_lengkap')
            ->toArray();
            $dataNama = implode(', ', $cek2);
            throw new \Exception('Atas Nama '.$dataNama.' Sudah Terdaftar');
            // return response()->json(['message' => 'Data PIC Sudah Terdaftar '], 402);
        }
    }
    

    public function edit($id)
    {
        $kar = Karyawan::where('jenis_karyawan','=','Internal')
                ->whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation"])->get();
        $pic = PicApprove::find($id);
        return view('picapprove.edit', compact('pic','kar'));
    }

    public function storeedit(Request $request) {
        $validator = Validator::make($request->all(), [
        'nama'    => 'required',
        'pic'     => 'required',
        'status'  => 'required',
        'idpic'   =>  'required',
        ]);
        // dd($request->all());
        $pic= PicApprove::findorfail($request->idpic);
        $updt = $pic->update([
            'id_kar'      => $request->nama,
            'kar_approve' => $request->pic,
            'status'      => $request->status,
            ]);
        $pic->save();
        if ($request->status == "aktif"){
            $kar = Karyawan::where('id',$pic->id_kar)->update(array('approval_via' => "PIC"));
        }else{
            $kar = Karyawan::where('id',$pic->id_kar)->update(array('approval_via' => "JABATAN"));
        }
        return response()->json(['message' => 'Edit PIC Approval Atas Nama '.$pic->get_kar->nama_lengkap .', Berhasil'], 200);
       }
    

    // public function destroy($id)
    // {
    //     $jabatanlevel = LevelJabatan::find($id);
    //     $jabatanlevel->delete();
        

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Data berhasil dihapus.'
    //     ]);
    // }

}
