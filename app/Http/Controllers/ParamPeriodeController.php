<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParamPeriode;

class ParamPeriodeController extends Controller
{
    public function index()
    {
        return view('parperiod.index');
    }

    public function readparam()
    {
        $param = ParamPeriode::orderBy('id', 'desc')->paginate(20);#->withQueryString();
        return view('parperiod.readparam', compact('param'));

    }

    public function create()
    {
        $choices = range(1, 31);
        $list = array_combine($choices, $choices);
        $param = ParamPeriode::All();
        return view('parperiod.create', compact('param','list'));
    }

    public function store(Request $request)
    {
    $request->validate([
        'startdate' => 'required',
        'enddate' => 'required',
    ]);
    $cek_param = ParamPeriode::where('status','=','Aktif')->update(['status' =>'NonAktif']);
    // $cek_param->update('status'=>"NonAktif")
    ParamPeriode::create([
        'startdate' => $request->startdate,
        'enddate' => $request->enddate,
    	'status' => 'Aktif',
    ]);

    return response()->json(['message' => 'Data Param Periode berhasil di ditambahkan'], 200);
    }

    public function edit($id)
    {
        $choices = range(1, 31);
        $list = array_combine($choices, $choices);
        $param = ParamPeriode::findOrFail($id);
        return view('parperiod.edit', compact('param','list'));
    }

    public function storeedit(Request $request,$id) {
        // $request->validate([
        //     'startdate' => 'required',
        //     'enddate' => 'required',
        //     'status' => 'required',
        // ]);
        
        $param = ParamPeriode::find($request->id);
        $param->startdate = $request->startdate;
        $param->enddate = $request->enddate;
        $param->status = $request->status;#"NonAktif";
        $param->save();
        return response()->json(['message' => 'Edit Param Periode berhasil'], 200);
    }
}
