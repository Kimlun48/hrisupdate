<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\CutiKaryawan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use Auth;
use Notification;
use App\Notifications\EmailSPNotification;
use Exception;

use App\Imports\BulkCutiKaryawan;
use App\Exports\CutiFormatExcel;
class CutiController extends Controller
{
    public function index()
    {
        
        $cuti = CutiKaryawan::all();
        // return view ('employ.bulk.bulkcutikar',compact('cuti'));
        return view ('cuti.bulkcutikar',compact('cuti'));
    }    

    public function cutiformatexcel(Request $request)
    {
        return Excel::download(new CutiFormatExcel, 'FormatExcelCuti.xlsx');
    }

    public function eksebulkcutikar()
    {
        try {
            $file = request()->file('filecutibulk');
            if (!$file) {
                throw new Exception('Silakan pilih file untuk diunggah.');
            }
            Excel::import(new BulkCutiKaryawan, $file);
            return response()->json(['message' => 'Data Cuti karyawan berhasil diimport!']);
        }
            catch (\Exception $e) {
                return response()->json(['message' => 'Terjadi kesalahan saat mengimport data: ' . $e->getMessage()], 500);
        }
    }
    public function readcuti()
    {
        $cuti = CutiKaryawan::all();
        return view ('cuti.readdata',compact('cuti'));
        
    }

    public function create()
    {
        return view('cuti.create');
    }

    public function edit($id)
    {
        $cuti = CutiKaryawan::find($id);
        return view('cuti.edit', compact('cuti'));
    }

    public function storeedit(Request $request) {
        $request->validate([
            'jumlah_cuti' => 'required',
            'sisa_cuti' => 'required',
        ]);
            $cuti = CutiKaryawan::find($request->id);
            $cuti->jumlah_cuti = $request->jumlah_cuti;
            $cuti->sisa_cuti = $request->sisa_cuti;
            $cuti->save();
    
        return response()->json(['message' => 'Edit data Param Cuti Karyawan berhasil di Edit '], 200);
       }

}
    
