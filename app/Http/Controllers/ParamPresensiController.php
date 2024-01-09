<?php

namespace App\Http\Controllers;
use App\Models\ParamPresensi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ParamPresensiController extends Controller
{
    public function index()
    {
        $param = ParamPresensi::All();
        // return view('param.index');
        return response()->json(['message' => 'tess', 'data' => $param, 'code' => '200'], 200);
    }

    public function readparam()
    {
        $param = ParamPresensi::All();
        return view('param.readparam', compact('param'));
        
    }

    public function create()
    {
        $param = ParamPresensi::All();
        return view('param.create', compact('param'));
    }

    public function store(Request $request)
    {
    $request->validate([
        'awal_absen_masuk' => 'required',
        'jam_masuk' => 'required',
        'maks_telat' => 'required',
        'jam_pulang' => 'required',
        'jenis_shift' => 'required',
    ]);

    ParamPresensi::create([
        'awal_absen_masuk' => $request->awal_absen_masuk,
        'jam_masuk' => $request->jam_masuk,
        'maks_telat' => $request->maks_telat,
        'jam_pulang' => $request->jam_pulang,
        'status' => 'Aktif',
        'jenis_shift' => $request->jenis_shift,
        'jenis_karyawan' => 'Internal',
    ]);

    return response()->json(['message' => 'Data Param berhasil ditambahkan '], 200);
    }

    public function showisi($id)
    {
        $param = ParamPresensi::find($id);
        return view('param.showisi', compact('param'));
    }

    public function edit($id)
    {
        $param = ParamPresensi::find($id);
        return view('param.edit', compact('param'));
    }

    public function storeedit(Request $request) {
        $validator = Validator::make($request->all(), [
        'awal_absen_masuk' => 'required',
        'jam_masuk' => 'required',
        'maks_telat' => 'required',
        'jam_pulang' => 'required',
        'jenis_shift' => 'required',
        'status'       => 'required',
        ]);
    
        $param = ParamPresensi::find($request->id);
    
        $param->awal_absen_masuk = $request->awal_absen_masuk;
        $param->jam_masuk = $request->jam_masuk;
        $param->maks_telat = $request->maks_telat;
        $param->jam_pulang = $request->jam_pulang;
        $param->jenis_shift = $request->jenis_shift;
        $param->status = $request->status;
        $param->save();
    
        return response()->json(['message' => 'Edit data Param Presensi berhasil ditambahkan '], 200);
       }

}
