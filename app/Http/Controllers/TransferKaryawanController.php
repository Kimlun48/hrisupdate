<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\KaryawanTransfer;
use App\Models\Karyawan;
use App\Models\Cabang;
use App\Models\Perusahaan;
use App\Models\Bagian;
use App\Models\LevelJabatan;
use Auth;
use Illuminate\Support\Facades\DB;
use DateTime;
use Carbon\Carbon;

class TransferKaryawanController extends Controller
{

    public function getquerycabang($id)
    {
        
        $pts =  Cabang::select('id','nama')->where('fk_nama_perusahaan', $id)->get();
        // dd($pts);
        return response()->json($pts);
        // return response()->json(['pts' => $pts]);
        
    }
    // UNTUK DATA TRANSFER EXTERNAL    
    public function index()
    {
        return view('transfer.index');
    }
    public function read()
    {
        
        $data = KaryawanTransfer::orderBy('id', 'DESC')->get();
        // return view('transfer.tes')->with(['data' => $data]);
        return view('transfer.read')->with(['data' => $data]);
    }

    public function indexext()
    {
        return view('transfer.index_external');
    }

    public function readext()
    {
        #all();
        $data = KaryawanTransfer::whereHas('getkaryawan', function ($query) {
            $query->where('jenis_karyawan', '=', 'External');
          })->whereIn('status_karyawan',["Contract","K3",'aktif',"Permanent","PHL","Probation",'Resign', 'PHK'])
            ->orderBy('id', 'DESC')
            ->get();
        return view('transfer.read_external')->with(['data' => $data]);
    }

    public function detail($id)
    {
        $details = KaryawanTransfer::findorfail($id);
        return view('transfer.modaldetail')->with(['details' => $details]);
    }

    public function transferonclick(Request $request)
    {
        #$tr = Karyawan::find($id);
        $cabs = Cabang::all();
        $pt = Perusahaan::all();
        $bagian = Bagian::all();
        $jabatan = LevelJabatan::all();
        $kr = karyawan::whereHas('getjeniskar', function ($query) {
            $query->where('jenis_kar', '=', 'Internal');
          })->whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation",'Resign', 'PHK'])
            ->orderBy('id', 'DESC')
            ->get();
         return view('transfer.transferkaryawanonclick', compact('cabs', 'pt', 'jabatan', 'bagian', 'kr'));
    }


    public function cekkartrans($id)
    {
        $idArray = explode(',', $id);
        $data = Karyawan::select('id', 'nama_lengkap')->whereIn('id', $idArray)->get();
        return response()->json(['message' => 'Success', 'code' => '200', 'data' => $data]);
    }

    public function showtransfer(Request $request)
    {
        #$tr = Karyawan::find($id);
        $cabs = Cabang::all();
        $pt = Perusahaan::all();
        $bagian = Bagian::all();
        $jabatan = LevelJabatan::all();
        $kr = karyawan::whereHas('getjeniskar', function ($query) {
            $query->where('jenis_kar', '=', 'Internal');
          })->whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation"])
            ->orderBy('id', 'DESC')
            ->get();
        return view('transfer.transferkaryawan', compact('cabs', 'pt', 'jabatan', 'bagian', 'kr'));
    }

    public function showtransferexternal(Request $request)
    {
        #$tr = Karyawan::find($id);
        $cabs = Cabang::all();
        $pt = Perusahaan::all();
        $bagian = Bagian::all();
        $jabatan = LevelJabatan::all();
        $kr = karyawan::whereHas('getjeniskar', function ($query) {
            $query->where('jenis_kar', '=', 'External');
          })->whereIn('status_karyawan',["Contract","K3",'aktif',"Permanent","PHL","Probation"])
            ->orderBy('id', 'DESC')
            ->get();
        return view('transfer.transferkaryawan', compact('cabs', 'pt', 'jabatan', 'bagian', 'kr'));
    }


    public function storetransferonclick(Request $request)
    {
        $selectedOptions = $request->input('karyawan', []);
        $skr = Carbon::now();
        // Merubah array array:1 [  0 => "983-Firman Kemal. P,1000-Husni Zayyin Asoy,1203-Muhammad Mikhail Batara"]
        // Menjadi array:3 
        // [ 0 => 983
        //   1 => 1000
        //   2 => 1203 ]
        $resultArray = array_map(function ($item) {
            // Menggunakan explode untuk memisahkan string berdasarkan tanda koma
            $parts = explode(',', $item);
            // Menggunakan array_map lagi untuk memproses setiap bagian dan mendapatkan angka saja
            $numbers = array_map(function ($part) {
                return (int) explode('-', $part)[0];
            }, $parts);
            return $numbers;
        }, $selectedOptions);

        // Menggabungkan hasil array multidimensi menjadi satu array
        $result = array_merge(...$resultArray);
        if ($selectedOptions) {
            foreach ($result as $item) {
                $kar = Karyawan::find($item);
                // dd($kar->status_karyawan);
                $trans = KaryawanTransfer::create([
                    'tanggal'                => $skr,
                    'tgl_transfer'           => date('Y-m-d', strtotime($request->tgl_transfer)), ##efectif perpindahan
                    'id_karyawan'            => $item,
                    'type'                   => $request->type,
                    'status_karyawan'   => $request->status_karyawanchoice,
                    'fk_cabang'         => $request->fk_cabang,
                    'fk_bagian'         => $request->fk_bagian,
                    'fk_level_jabatan'  => $request->fk_level_jabatan,
                    'fk_nama_perusahaan'=> $request->fk_nama_perusahaan,
                    'keterangan'        => $request->keterangan,
                    'signdate'          => date('Y-m-d', strtotime($request->signdate)), ##Tanggal pengangkatan jadi permanent
                    'untildate'         => date('Y-m-d', strtotime($request->untildate)), ## Tanggal AKhir Kontrak

                    'status_karyawan_lama'      => $kar->status_karyawan,
                    'fk_cabang_lama'            => $kar->fk_cabang,
                    'fk_bagian_lama'            => $kar->fk_bagian,
                    'fk_level_jabatan_lama'     => $kar->fk_level_jabatan,
                    'fk_nama_perusahaan_lama'   => $kar->fk_nama_perusahaan,
                    'signdatelama'              => date('Y-m-d', strtotime($kar->tanggal_pengangkatan)),
                    'untildatelama'             => $kar->expired_kontrak,
                    'status_approval'           => "Approved",
                    #expire_kontrak nama field untuk yang until untildatelama untuk selain permanent
                ]);
                    $kar->fk_cabang               = $trans->fk_cabang;
                    $kar->fk_bagian               = $trans->fk_bagian;
                    $kar->fk_level_jabatan        = $trans->fk_level_jabatan;
                    $kar->status_karyawan         = $trans->status_karyawan;
                    $kar->fk_nama_perusahaan      = $trans->fk_nama_perusahaan;
                    // if ($trans->status_karyawanchoice=="Permanent"){
                    //     $kar->tanggal_pengangkatan    = $trans->signdate;
                    //     $kar->expired_kontrak         = Carbon::createFromDate(9999, 21, 31);
                    // }else{
                    //     $kar->tanggal_pengangkatan    = Carbon::createFromDate(9999, 21, 31);
                    //     $kar->expired_kontrak         = $trans->untildate;
                    // }
                    $kar->save();
            }
            
        }


    }    

    public function storetransfer(Request $request)
    {
        // $all=$request->all();
        // dd($all);
        $selectedOptions = $request->input('karyawan', []);
        $skr = Carbon::now();
        if ($selectedOptions) {
            foreach ($selectedOptions as $item) {
                $kar = Karyawan::find($item);
                $datasave = ['id_kar' => $item];
                // dd($request->signdate,$request->untildate);
                $trans = KaryawanTransfer::create([
                    'tanggal'           => $skr,
                    'tgl_transfer'      => $request->tgl_transfer, ##efectif perpindahan
                    'id_karyawan'       => $item,
                    'type'              => $request->type,
                    'status_karyawan'   => $request->status_karyawan,
                    'fk_cabang'         => $request->fk_cabang,
                    'fk_bagian'         => $request->fk_bagian,
                    'fk_level_jabatan'  => $request->fk_level_jabatan,
                    'fk_nama_perusahaan'=> $request->fk_nama_perusahaan,
                    'keterangan'        => $request->keterangan,
                    'signdate'          => $request->signdate, ##Tanggal pengangkatan jadi permanent
                    'untildate'         => $request->untildate, ## Tanggal AKhir Kontrak

                    'status_karyawan_lama'      => $kar->status_karyawan,
                    'fk_cabang_lama'            => $kar->fk_cabang,
                    'fk_bagian_lama'            => $kar->fk_bagian,
                    'fk_level_jabatan_lama'     => $kar->fk_level_jabatan,
                    'fk_nama_perusahaan_lama'   => $kar->fk_nama_perusahaan,
                    'signdatelama'              => $kar->tanggal_pengangkatan,
                    'untildatelama'             => $kar->expired_kontrak,
                    'status_approval'           => "Pending",#"Approved",
                    #expire_kontrak nama field untuk yang until untildatelama untuk selain permanent
                ]);
                    
                    // $kar->fk_cabang               = $trans->fk_cabang;
                    // $kar->fk_bagian               = $trans->fk_bagian;
                    // $kar->fk_level_jabatan        = $trans->fk_level_jabatan;
                    // $kar->status_karyawan         = $trans->status_karyawan;
                    // $kar->fk_nama_perusahaan      = $trans->fk_nama_perusahaan;
                    // if ($trans->status_karyawan=="Permanent"){
                    //     $kar->tanggal_pengangkatan    = $trans->signdate;
                    //     $kar->expired_kontrak         = Carbon::createFromDate(9999, 21, 31);
                    // }else{
                    //     $kar->tanggal_pengangkatan    = Carbon::createFromDate(9999, 21, 31);
                    //     $kar->expired_kontrak         = $trans->untildate;
                    // }
                    // $kar->save();

            }
        }
        // dd($selectedOptions);
        // $validator = Validator::make($request->all(), [
        //     #'tanggal'           => 'required',
        //     'tgl_transfer'      => 'required',
        //     'id_karyawan'       => 'required',
        //     'type'              => 'required',
        //     'status_karyawan'   => 'required',
        //     'fk_cabang'         => 'required',
        //     'fk_bagian'         => 'required',
        //     'fk_level_jabatan'  => 'required',
        //     'fk_nama_perusahaan'=> 'required',
        //     'keterangan'        => 'required',
        // ]);

        // $data = Karyawan::find($request->id_karyawan);
        // $skr = Carbon::now();
        // #create history Transfer
        // $trans = KaryawanTransfer::create([
        //     'tanggal'           => $skr,
        //     'tgl_transfer'      => $request->tgl_transfer,
        //     'id_karyawan'       => $request->id_karyawan,
        //     'type'              => $request->type,
        //     'status_karyawan'   => $data->status_karyawan,
        //     'fk_cabang'         => $data->fk_cabang,
        //     'fk_bagian'         => $data->fk_bagian,
        //     'fk_level_jabatan'  => $data->fk_level_jabatan,
        //     'fk_nama_perusahaan'=> $data->fk_nama_perusahaan,
        //     'keterangan'        => $request->keterangan,
        // ]);

        // $pt = Perusahaan::findOrFail($request->fk_nama_perusahaan);
        // $cabang = Cabang::findOrFail($request->fk_cabang);
        // $jabatan = LevelJabatan::findOrFail($request->fk_level_jabatan);
        // $bagian = Bagian::findOrFail($request->fk_bagian);

        // #Update Transfer data
        // $data->fk_cabang           = $cabang->id;
        // $data->fk_bagian           = $bagian->id;
        // $data->fk_level_jabatan    = $jabatan->id;
        // $data->status_karyawan     = $request->status_karyawan;
        // $data->fk_nama_perusahaan  = $pt->id;

        // $data->save();
        // return response()->json(['message' => 'Transfer karyawan berhasil di update'], 200);
    }

    public function canceltransfer($id)
    {
        $trans = KaryawanTransfer::find($id);
        $trans->status_approval = "Cancelled";
        $trans->save();
    }
    // AKHIR UNTUK DATA TRANSFER EXTERNAL
    // UNTUK DATA INTERNAL
    public function indexinternal()
    {
        return view('transfer.indexinternal');
    }
    public function readinternal()
    {
        $data = KaryawanTransfer::all();
        return view('transfer.readinternal')->with(['data' => $data]);
    }
    // AKHIR UNTUK DATA TRANSFER INTERNAL


}
