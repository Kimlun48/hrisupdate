<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataImport;
use App\Models\Karyawan;
use App\Http\Controllers\Controller;


class TesImportController extends Controller
{
    public function index()
    {
        return view('tesimport.form');
    }

    public function preview(Request $request)
    {
        $file = $request->file('file');
        $import = new DataImport;
        $data = Excel::toCollection($import, $file);
        // dd($data[0]);
        // $kar = Karyawan::where('id','=',$data[0][0][0])->get();
        // dd($kar);
        // Tampilkan data dalam bentuk preview
        return view('tesimport.preview', compact('data'));
    }
    public function cekdata(Request $request)
    {
        $kar = Karyawan::where('id','=',$data[0][0][0])->get();     
        return view('tesimport.preview', compact('data'));
    }
}
