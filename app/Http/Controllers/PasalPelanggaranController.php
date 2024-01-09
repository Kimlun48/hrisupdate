<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PasalPelanggaran;
use Illuminate\Support\Facades\Validator;


class PasalPelanggaranController extends Controller
{
    public function index()
    {
        $pas = PasalPelanggaran::paginate(30);
        return view('pasal.index', compact('pas'));
        
    }
    public function readpasal()
    {
        $pas = PasalPelanggaran::all();
        return view('pasal.readpasal', compact('pas'));
        
    }

    public function showisi($id)
{
    $pas = PasalPelanggaran::find($id);
    return view('pasal.showisi', compact('pas'));
}


    public function create()
   {
       $pas = PasalPelanggaran::all();
       return view('pasal.create', compact('pas'));
   }

   public function store(Request $request)
    {
        $request->validate([
            'pasal' => 'required',
            'ayat' => 'required',
            'isiayat' => 'required',
            


        ]);

        PasalPelanggaran::create([
            'pasal' => $request->pasal,
            'ayat' => $request->ayat,
            'isiayat' => $request->isiayat,
            'status' => 'Aktif'

        ]);

        return response()->json(['message' => 'Data Pasal berhasil ditambahkan '], 200);
    }
    



    public function edit($id)
    {
        $pas = PasalPelanggaran::find($id);
        return view('pasal.edit', compact('pas'));
    }

    public function storeedit(Request $request) {
        $validator = Validator::make($request->all(), [
        'id'                => 'required',
        'pasal'             => 'required',
        'ayat'             => 'required',
        'isiayat'      => 'required',
        'status'       => 'required',
        ]);
    
        $pasal= PasalPelanggaran::find($request->id);
    
    
    
        $pasal->pasal = $request->pasal;
        $pasal->ayat = $request->ayat;
        $pasal->isiayat = $request->isiayat;
        $pasal->status = $request->status;
        $pasal->save();
    
        return response()->json(['message' => 'Edit data Pasal berhasil ditambahkan '], 200);
       }

    

    
    

    public function destroy($id)
    {
        $PasalPelanggaran = PasalPelanggaran::find($id);
        $PasalPelanggaran->delete();
        

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus.'
        ]);
    }

    
    





}

