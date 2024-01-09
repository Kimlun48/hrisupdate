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



class PerusahaanController extends Controller
{
    public function index()
    {

        $pts = Perusahaan::all();
        return view('perusahaan.index', compact('pts'));
    }

    public function create()
    {
	    $pts = Perusahaan::all();
        return view('perusahaan.create', compact('pts'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
        'nama' => 'required',
        'kode' => 'required',
        'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
  
        $logo = $request->file('logo');
        $nama_lengkap = $request->string('nama');
        $extLogo= $request->file('logo')->getClientOriginalExtension();
        $LogoName = time().'_'.$nama_lengkap.'.'.$extLogo;
        $logo->storeAs('pt', $LogoName);


	$ayeuna = new DateTime( date('Y-m-d H:i:s') );
    Perusahaan::create([
        'nama'                => $request->nama,
        'kode'                => $request->kode,
        'logo'                => $LogoName,
        'status'              => 'Aktif',
        ]);
        return redirect()->route('perusahaan.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    

    public function detail($id)
    {
        $pt = Perusahaan::where('id', $id)->take(1)->first();
        return view('perusahaan.detailpt', compact('pt'));
    } 

    public function destroy()
    {
	//
    }

    public function edit($id)
    {
        $pt = Perusahaan::findOrFail($id);
        return view('perusahaan.edit', compact('pt'));
    }

    public function storeedit(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'kode' => 'required',
            'status'  => 'required',
        ]);
        $pt = Perusahaan::findOrFail($id);

        $pt->update([
            'nama'                  => $request->nama,
            'kode'                  => $request->kode,
            'status'                => $request->status,
        ]);
        if ($request->file('logo')) {
            Storage::delete('pt/' . $pt->logo);
            $logo = $request->file('logo');
            $nama_lengkap = $request->string('nama');
            $extLogo = $request->file('logo')->getClientOriginalExtension();
            $LogoName = time() . '_' . $nama_lengkap . '.' . $extLogo;
            $logo->storeAs('pt', $LogoName);
            $pt->update(['logo' => $LogoName]);
        }
        if ($pt) {
            //redirect dengan pesan sukses
            return redirect()->route('perusahaan.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('perusahaan.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

}
