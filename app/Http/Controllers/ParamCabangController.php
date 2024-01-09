<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParamCabang;
use App\Models\Karyawan;
use App\Models\Cabang;
use Carbon\Carbon;
class ParamCabangController extends Controller
{
    public function index()
    {
        return view('parcab.index');
    }

    public function readdata()
    {
        $param = ParamCabang::with('getcabang')->with('getkaryawan')->get();
        return view('parcab.readdata', compact('param'));
    }

    public function create()
    {
        $kr = Karyawan::all();
        $cabs = Cabang::all();
        return view('parcab.create', compact('cabs','kr'));
    }


    public function showparam(Request $request)
    {
        $cabs = Cabang::all();
        $kr = Karyawan::all();
        return view('parcab.showparammodal', compact('cabs', 'kr'));
    }

    public function showedit($id)
    {
        $param = ParamCabang::findorfail($id);
        $kr = Karyawan::all();
        $cabs = Cabang::all();
        return view('parcab.edit', compact('param','cabs','kr'));
    }


    public function saveparam(Request $request)
    {
        // Validasi data formulir
        $request->validate([
            'karyawan' => 'required|array',
            'cabang' => 'required|exists:cabangs,id',
        ]);

        // Simpan data ke tabel "detail karyawan cabang"
        $karyawanIds = $request->input('karyawan');
        $cabangId = $request->input('cabang');

        // Pastikan setidaknya satu "Employee Name" dipilih
        if (count($karyawanIds) === 0) {
            return redirect()->back()->withErrors(['karyawan' => 'Pilih setidaknya satu Employee Name.'])->withInput();
        }

        foreach ($karyawanIds as $karyawanId) {
            // Periksa apakah kombinasi sudah ada untuk menghindari duplikasi
            $existingEntry = ParamCabang::where('id_kar', $karyawanId)
                ->where('id_cabang', $cabangId)
                ->first();

            if (!$existingEntry) {
                ParamCabang::create([
                    'id_kar' => $karyawanId,
                    'id_cabang' => $cabangId,
                    'status' => "aktif",
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        // Redirect kembali atau ke mana pun yang diinginkan
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }


    // public function createallkarparam(Request $request)
    // {
    //     // Save the data to the "detail karyawan cabang" table
    //     $karyawanIds =  Karyawan::whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation","AKTIF"])->get();
        

    //     foreach ($karyawanIds as $karyawanId) {
    //             ParamCabang::create([
    //                 'id_kar' => $karyawanId->id,
    //                 'id_cabang' => $karyawanId->fk_cabang,
    //                 'status' => "aktif",
    //                 'created_at' => $today = Carbon::now(),
    //             ]);
    //         }
    //     // Redirect back or wherever you want
    //     return redirect()->back()->with('success', 'Data saved successfully');
    // }

    public function createallkarparam(Request $request)
    {
        // Validate the form data
        $request->validate([
            'karyawan' => 'required',
            'cabang' => 'required',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        // Find the record you want to update
        $param  = ParamCabang::findorfail($request->id);

        // Update the record with the new data
        $param->update([
            'id_kar' => $request->input('karyawan'),
            'id_cabang' => $request->input('cabang'),
            'status' => $request->input('status'),
            // Add other fields if needed
        ]);

        // Redirect back or wherever you want
        return redirect()->back()->with('success', 'Data updated successfully');
    }


}
