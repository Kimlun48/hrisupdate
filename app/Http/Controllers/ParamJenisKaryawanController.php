<?php

namespace App\Http\Controllers;
use App\Models\ParamJenisKaryawan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ParamJenisKaryawanController extends Controller
{
    public function index()
    {
        return view('parjeniskar.index');
    }

    public function readparam()
    {
        $param = ParamJenisKaryawan::all();
        return view('parjeniskar.readparam', compact('param'));
        
    }

    public function create()
    {
        $param = ParamJenisKaryawan::All();
        return view('parjeniskar.create', compact('param'));
    }

    public function store(Request $request)
    {
       $request->validate([
        'nama' => 'required',
        'jenis_karyawan' => 'required',
        'no_urut' => 'required',
        'format_depan_nik' => 'required',
    ]);

    ParamJenisKaryawan::create([
        'nama' => $request->nama,
        'jenis_kar' => $request->jenis_karyawan,
        'no_urut' => $request->no_urut,
        'format_depan_nik' => $request->format_depan_nik,
        'status' => 'AKTIF',
    ]);

    return response()->json(['message' => 'Data Param berhasil ditambahkan '], 200);
    }

    public function showisi($id)
    {
        $param = ParamJenisKaryawan::find($id);
        return view('parjeniskar.showisi', compact('param'));
    }

    public function edit($id)
    {
        $param = ParamJenisKaryawan::find($id);
        return view('parjeniskar.edit', compact('param'));
    }

    public function storeedit(Request $request) {
        
        $request->validate([
            'nama' => 'required',
            'jenis_karyawan' => 'required',
            'no_urut' => 'required',
            'format_depan_nik' => 'required',
        ]);

        $param = ParamJenisKaryawan::find($request->id);
            $param->nama = $request->nama;
            $param->jenis_kar = $request->jenis_karyawan;
            $param->no_urut = $request->no_urut;
            $param->format_depan_nik = $request->format_depan_nik;
            $param->status = $request->status;
            $param->save();
    
        return response()->json(['message' => 'Edit data Param Jenis Karyawan berhasil ditambahkan '], 200);
       }

}
