<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\TunjanganKaryawan;
use App\Models\Karyawan;
use App\Models\ParamComponen;
use App\Models\TransaksiPraPayrol;
use Carbon\Carbon;
class TunjanganKaryawanController extends Controller
{
    public function cekkomponen($id)
    {
        $data = Karyawan::findorFail($id);
        if($data->upah == 0 ){
            return response()->json(['data' =>  0]);
        }
        else{
            return response()->json(['data' =>  $data->upah]);
        }
    }

    public function autocomplete(Request $request)
    {
        $name = $request->input('nama');
        #$exists = false;
        $data = Karyawan::where('nama_lengkap', '=', $name)->first();
        #dd($data);
        return response()->json(['data' =>  $data]);
        #if ($data) {
        #    return response()->json(['message' => 'Nama Tunjangan Ini Sudah Ada!!!'], 403);
            // return response()->json(['message' => 'Nama Tunjangan Ini Sudah Ada!!!'], 200);
        #}
    }
    
    public function index()
    {
        $kar = Karyawan::where('jenis_karyawan','=','Internal')->whereNotIn('status_karyawan',['PHK','Resign','habiskontrak'])->get();#Karyawan::all();
        $param = ParamComponen::All();
        return view('tunkar.index', compact('param','kar'));
        // return view('tunkar.index');
    }

    public function readparam()
    {
        $kar = TransaksiPraPayrol::all();       
        // dd($kar);
        return view('tunkar.readparam', compact('kar'));
        
    }

    public function create()
    {
        $kar = Karyawan::all();
        $param = TransaksiPraPayrol::All();
        return view('tunkar.create', compact('param','kar'));
    }

    public function store(Request $request)
    {
	$skr = Carbon::now();
        $selectedOptions = $request->all();
        $tunjangan = $request->input('tunjangan');
        $array = explode(',', $tunjangan[0]);
        #dd($array);
        for ($i = 0; $i < count($array); $i += 3) {
            $newArray[] = [
                $array[$i],
                $array[$i + 1],
                $array[$i + 2]
            ];
        }

        foreach ($newArray as $item) {
            $field1 = $item[0]; // Nilai '30', '31', dst.
            $field2 = $item[1]; // Nilai '1-MAKAN-Tunjangan Tetap', '2-TRANSPORT-Tunjangan Tetap', dst.
            $field3 = $item[2]; // Nilai '170000', '200000', dst.
            $pisah = explode('-', $field2);
            $val_pisah = $pisah[0];
            $kar = Karyawan::find($field1);
            $tun = ParamComponen::where('id','=',$val_pisah)->get()->first();
            $datasave = [
                'id_kar'   => $kar->id,
                'id_param' => $tun->id,
                'nilai'    => $field3,
                'periode'  => $skr,
            ];
            $save = TransaksiPraPayrol::create($datasave);
        }
    #$selectedOptions = $request->input('selectedItems',[]);
    #if ($selectedOptions){
    #    $data =(explode(",",$selectedOptions));
    #        foreach ($data as $item) {
    #            $datasave = ['id_kar' => $item];
    #            $save = TransaksiPraPayrol::create($datasave);
    #        }
    #}
    #else{
    #    return response()->json(['message' => 'Data Tidak Boleh Kosong '], 200);    
    #}

    return response()->json(['message' => 'Data Param Tunjangan berhasil ditambahkan '], 200);

    }
    public function showisi($id)
    {
        $param = TunjanganKaryawan::find($id);
        return view('tunkar.showisi', compact('param'));
    }
    public function edit($id)
    {
        $param = TunjanganKaryawan::find($id);
        return view('tunkar.edit', compact('param'));
    }
    public function storeedit(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama'             => 'required',
            'jenis'            => 'required',
            'status_tunjangan' => 'required',
            'status_aktif'     => 'required',
        ]);
        $param = TunjanganKaryawan::find($request->id);
        $param->nama = $request->nama;
        $param->jenis = $request->jenis;
        $param->status_tunjangan = $request->status_tunjangan;
        $param->status_aktif = $request->status_aktif;
        $param->save();
        return response()->json(['message' => 'Edit data Param Tunjangan berhasil ditambahkan '], 200);
       }
}
