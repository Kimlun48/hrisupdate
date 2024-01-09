<?php

namespace App\Http\Controllers;
use App\Models\DokumenKaryawan;
use App\Models\Karyawan;
use Carbon\Carbon;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumenKaryawanController extends Controller
{

    public function index()
    {       
        return view ('dokar.index');
    }   
    public function read()
    {       
        $dok = DokumenKaryawan::all();
        return view ('dokar.read',compact('dok'));
    }    

    public function create()
    {       
        $kar = Karyawan::whereIn('status_karyawan', ['permanent','Contract', 'K3', 'PHL', 'Probation'])->get();
        $skr = Carbon::now()->format('Y-m-d');
        return view ('dokar.create',compact('kar','skr'));
    }  

    public function edit($id)
    {
        
        $dokumenKaryawan = DokumenKaryawan::findorfail($id);
        $kar = Karyawan::findorfail($dokumenKaryawan->id_kar);
        $skr = Carbon::now()->format('Y-m-d');
        // dd('aaaaaaaaaaaaaaaaaaaaa',$dokumenKaryawan,$kar);
        return view('dokar.edit', compact('dokumenKaryawan', 'kar', 'skr'));
    }

    
    public function storecreate(Request $request)
    {        
        
        $data = $request->validate([
            'id_kar.*' => 'required|string|max:255',
            'lokasi_penyimpanan.*'  => 'required|string|max:255',
            'tanggal.*'  => 'required|string|max:255',
            'nomor_dok.*' => 'required|string|max:255',
            'tipe_dok.*' => 'required|string|max:255',
            'nama.*' => 'required|string|max:255',
            'dok_file.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $formDatas = [];
        foreach ($data['nama'] as $key => $nama) {
            $kar = Karyawan::findorfail( $request->id_kar[$key]);
            
            $image = $request->file('dok_file')[$key];
            // dd($image->getClientOriginalExtension());
            $imageName = $kar->nama_lengkap . '-' .$kar->nomor_induk_karyawan .'-'.time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('DokumenKaryawan/', $imageName); // Simpan gambar ke direktori storage/images

            $newFileName = 'DokKar/' . $imageName; // Nama baru yang ingin Anda gunakan
            Storage::disk('ftp_server')->put($newFileName, file_get_contents($request->file('dok_file')[$key]));

            $formDatas[] = [
                'lokasi_penyimpanan'=> $data['lokasi_penyimpanan'][$key],
                'tanggal'           => $data['tanggal'][$key],
                'nomor_dok'         => $data['nomor_dok'][$key],
                'tipe_dok'          => $data['tipe_dok'][$key],
                'id_kar'            => $data['id_kar'][$key],
                'nama'              => $nama,
                'dok_file'          => $imageName,
            ];
        }

        // Simpan data ke database
        DokumenKaryawan::insert($formDatas);
        return back()->with('success', 'Record Created Successfully.');

    }

    public function storeedit(Request $request)
    {
        // Validasi data input (disesuaikan dengan kebutuhan Anda)
        $data = $request->validate([
            'id_kar.*' => 'required|string|max:255',
            'lokasi_penyimpanan.*' => 'required|string|max:255',
            'tanggal.*' => 'required|string|max:255',
            'nomor_dok.*' => 'required|string|max:255',
            'tipe_dok.*' => 'required|string|max:255',
            'nama.*' => 'required|string|max:255',
            'dok_file.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $kar = DokumenKaryawan::findorfail($request->id);
    
        if ($request->hasFile('dok_file')) {
            $image = $request->file('dok_file');
            $imageName = $kar->nama_lengkap . '-' . $kar->nomor_induk_karyawan . '-' . time() . '.' . $image->getClientOriginalExtension();
    
            $image->storeAs('DokumenKaryawan/', $imageName); // Simpan gambar ke direktori storage/images
    
            $newFileName = 'DokKar/' . $imageName; // Nama baru yang ingin Anda gunakan
            Storage::disk('ftp_server')->put($newFileName, file_get_contents($request->file('dok_file')));
    
            $kar->dok_file = $imageName;
        }
    
        $kar->lokasi_penyimpanan = $request->lokasi_penyimpanan;
        $kar->tanggal = $request->tanggal;
        $kar->nomor_dok = $request->nomor_dok;
        $kar->tipe_dok = $request->tipe_dok;
        $kar->id_kar = $request->id_kar;
        $kar->nama = $request->nama;
    
        $kar->save();
    
        return response()->json(['message' => 'Data berhasil disimpan.']);
    }
    

}