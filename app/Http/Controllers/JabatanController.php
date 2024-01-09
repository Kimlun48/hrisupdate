<?php

namespace App\Http\Controllers;
use App\Models\LevelJabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class JabatanController extends Controller
{

	 public function autofill(Request $request)
	 {
	     $q = $request->q;
             $data = LevelJabatan::select('id', 'nama')->where('nama', 'like', "%$q%")->get();


	    #$nama = $request->input('parent_id');
	    #$data = LevelJabatan::where('nama', $nama)->get();
            return response()->json(['data'=>$data], 200);
        // return response()->json(['message' => 'Nama Tunjangan Ini Sudah Ada!!!'], 200);
    }

public function index()
{
    $jabs = LevelJabatan::paginate(30);
    return view('jabatan.index', compact('jabs'));
        
}
    public function readjabatan()
    {
        $jabs = LevelJabatan::all();
        return view('jabatan.readjabatan', compact('jabs'));
        
    }

    public function showisi($id)
{
    $jabs = LevelJabatan::find($id);
    return view('jabatan.showjabatan', compact('jabs'));
}


    public function create()
   {
        $jabs = LevelJabatan::all();
       return view('jabatan.create', compact('jabs'));
   }

   public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kode' => 'required',
            'parent_id' => 'required',
            
            


        ]);

        LevelJabatan::create([
            'nama' => $request->nama,
            'kode' => $request->kode,
            'status' => 'Aktif',
            'parent_id' => $request->parent_id

        ]);

        return response()->json(['message' => 'Data jabatan parent berhasil ditambahkan '], 200);
    }
    

    public function edit($id)
    {
        $jabsn = LevelJabatan::find($id);
        $jabs = LevelJabatan::all();
        return view('jabatan.edit', compact('jabsn','jabs'));
    }

    public function storeedit(Request $request) {
        $validator = Validator::make($request->all(), [
        'nama'                => 'required',
        'kode'             => 'required',
        'status'             => 'required',
        'parent_id'      => 'required',
        ]);
    
        $jabatan= LevelJabatan::find($request->id);
    
    
    
        $jabatan->nama = $request->nama;
        $jabatan->kode = $request->kode;
        $jabatan->status = $request->status;
        $jabatan->parent_id = $request->parent_id;
        $jabatan->save();
    
        return response()->json(['message' => 'Edit data jabatan parent berhasil ditambahkan '], 200);
       }
    

    public function destroy($id)
    {
        $jabatanlevel = LevelJabatan::find($id);
        $jabatanlevel->delete();
        

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus.'
        ]);
    }

}
