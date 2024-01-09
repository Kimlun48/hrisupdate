<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParamTimeOff;
use Carbon\Carbon;

class ParamTimeOffController extends Controller
{
    public function index()
    {
        return view('partimeoff.index');
    }

    public function readparam()
    {
        $param = ParamTimeOff::orderBy('id', 'desc')->paginate(20);#->withQueryString();
        return view('partimeoff.readparam', compact('param'));

    }

    public function create()
    {
        $choices = range(1, 31);
        $list = array_combine($choices, $choices);
        $param = ParamTimeOff::All();
        return view('partimeoff.create', compact('param','list'));
    }

    public function store(Request $request)
    {
    $request->validate([
        'type'          => 'required',
        'name'          => 'required',
        // 'duration'      => 'required',
        'code'         => 'required',
        'effectivedate' => 'required',
        // 'enddate'       => 'required',
        'dokumen'   => 'required',
        'kuota'     => 'required',
    ]);
    
    ParamTimeOff::create([
        'type' => $request->type,
        'nama' => $request->name,
        'durasi' => $request->duration,      
        'kode' => $request->code,
        'kuota' => $request->kuota,      
        'dokumen' => $request->dokumen,
        'efektif_date' => Carbon::create($request->effectivedate)->format('Y-m-d'),
        'expire_date' => Carbon::create($request->enddate)->format('Y-m-d'),
    	'status' => 'Aktif',
    ]);

    return response()->json(['message' => 'Data Param Time Off berhasil di ditambahkan'], 200);
    }

    public function edit($id)
    {
        $choices = range(1, 31);
        $list = array_combine($choices, $choices);
        $param = ParamTimeOff::findOrFail($id);
        return view('partimeoff.edit', compact('param','list'));
    }

    public function storeedit(Request $request,$id) {
        $request->validate([
            'name'          => 'required',
            'duration'      => 'required',
            'code'          => 'required',
            'effectivedate' => 'required',
            'status'        => 'required',
            'dokumen'       => 'required',
            'kuota'         => 'required',
        ]);
        
        $param = ParamTimeOff::find($request->id);
        $param->nama = $request->name;
        $param->durasi = $request->duration;
        $param->kode = $request->code;
        $param->efektif_date  = Carbon::create($request->effectivedate)->format('Y-m-d');
        $param->expire_date = Carbon::create($request->enddate)->format('Y-m-d');
    	$param->status = $request->status;
        $param->kuota = $request->kuota;
        $param->dokumen = $request->dokumen;
        $param->save();
        return response()->json(['message' => 'Edit Param Periode berhasil'], 200);
    }
}
