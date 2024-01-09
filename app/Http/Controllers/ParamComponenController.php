<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParamComponen;
class ParamComponenController extends Controller
{
    public function cekinputparcom(Request $request)
    {
    $name = $request->input('nama');
    #$exists = false;
    $data = ParamComponen::where('nama', $name)->first();
    if ($data) {
        return response()->json(['message' => 'Nama Componen Ini Sudah Ada!!!'], 403);
        // return response()->json(['message' => 'Nama Tunjangan Ini Sudah Ada!!!'], 200);
    }

    }

    public function index()
    {
        return view('parcom.index');
    }

    public function readparam()
    {
        $param = ParamComponen::where('status_aktif','=','Aktif')->orderBy('id', 'desc')->get();#->paginate(20)->withQueryString();
        return view('parcom.readparam', compact('param'));

    }

    public function create()
    {
        $param = ParamComponen::All();
        return view('parcom.create', compact('param'));
    }

    public function store(Request $request)
    {
    $request->validate([
        'nama' => 'required',
        'jenis' => 'required',
        'status_tunjangan' => 'required',
        'komponen' =>'required',
    ]);

    ParamComponen::create([
        'nama' => $request->nama,
        'jenis' => $request->jenis,
        'status_tunjangan' => $request->status_tunjangan,
	'status_aktif' => 'Aktif',
	'komponen' => $request->komponen,

    ]);

    return response()->json(['message' => 'Data Param Componen berhasil di ditambahkan'], 200);
    }

    public function storeedit(Request $request,$id) {
        #$validator = Validator::make($request->all(), [
        #    'idaparam'     => 'required',
        #]);

        $param = ParamComponen::find($request->id);
        $param->status_aktif = "NonAktif";
        $param->save();

        return response()->json(['message' => 'Edit data Param Componen berhasil Non Aktifkan '], 200);
    }
}
