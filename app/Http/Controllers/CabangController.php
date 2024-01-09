<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cabang;
use App\Models\Perusahaan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Validator;



class CabangController extends Controller
{

    public function index()
    {

        $cabs = Cabang::all();
        return view('cabang.index', compact('cabs'));
    }

    public function create()
    {
        $cabs = Cabang::all();
	    $pts = Perusahaan::all();
        return view('cabang.create', compact('pts','cabs'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
        'nama' => 'required',
        'kode' => 'required',
        'alamat' => 'required',
        'no_hp' => 'required',
        'no_telp' => 'required',
        'fk_nama_perusahaan' => 'required',
	    'dokumen' => 'required|mimes:pdf|max:10000',

        'latitude' => 'required',
        'longitude' => 'required',
        'radius' => 'required',
        'satuan_radius' => 'required',
        ]);

        $cv = $request->file('dokumen');
        $nama_cabang = $request->string('nama');
        $extcv = $request->file('dokumen')->getClientOriginalExtension();
        $CvName = $nama_cabang.'_'.time().'.'.$extcv;
        $cv->storeAs('pelamar/', $CvName);	
    
    

    $id_parent = Perusahaan::findOrFail($request->fk_nama_perusahaan);
	$ayeuna = new DateTime( date('Y-m-d H:i:s') );
        Cabang::create([
        'nama'                => $request->nama,
        'fk_nama_perusahaan'  => $id_parent->id,
        'kode'                => $request->kode,
        'alamat'              => $request->alamat,	    
        'no_hp'               => $request->no_hp,
        'no_telp'             => $request->no_telp,
        'dokumen'             => $CvName,
	    'status'              => 'Aktif',

        'latitude'            => $request->latitude,
        'longitude'           => $request->longitude,
        'radius'              => $request->radius,
        'satuan_radius'       => $request->satuan_radius,
        ]);
        return redirect()->route('cabang.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    

    public function detail($id)
    {
        $cab = Cabang::where('id', $id)->take(1)->first();
        return view('cabang.detailcabang', compact('cab'));
    } 

    public function destroy()
    {
	//
    }

    public function edit($id)
    {
         $cab = Cabang::findOrFail($id);
         $pts = Perusahaan::all();
        return view('cabang.edit', compact('pts','cab'));
    }

    public function storeedit(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'kode' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'no_telp' => 'required',
            'fk_nama_perusahaan' => 'required',
            #'dokumen' => 'mimes:pdf|max:10000',
	        'status'  => 'required',

            'latitude' => 'required',
            'longitude' => 'required',
            'radius' => 'required',
            'satuan_radius' => 'required',

        ]);
        $cab = Cabang::findOrFail($id);

        $cab->update([
            'nama'                  => $request->nama,
            'kode'                  => $request->kode,
            'alamat'                => $request->alamat,
            'no_hp'                 => $request->no_hp,
            'no_telp'               => $request->no_telp,
            'fk_nama_perusahaan'    => $request->fk_nama_perusahaan,
	    'status'                => $request->status,
            'latitude'              => $request->latitude,
            'longitude'             => $request->longitude,
            'radius'                => $request->radius,
            'satuan_radius'         => $request->satuan_radius,
		]);
            if ($request->file('dokumen')) {
                Storage::delete('pelamar/'.$cab->dokumen);
                $dok = $request->file('dokumen');
                $nama_cabang = $request->string('nama');
                $extdok = $request->file('dokumen')->getClientOriginalExtension();
		$DokName = $nama_cabang.'_'.time().'.'.$extdok;
		$dok->storeAs('pelamar/', $DokName);
		$cab->update(['dokumen'=> $DokName]);
            }
        if($cab){
            //redirect dengan pesan sukses
            return redirect()->route('cabang.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('cabang.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }
}
