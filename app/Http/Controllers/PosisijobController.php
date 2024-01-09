<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posisijob;
class PosisijobController extends Controller
{
	public function index()
	{
	    $jobs = Posisijob::latest()->paginate(10);
	    return view('posisi.index', compact('jobs'));
	}
    public function show()
    {
        $jobs = Posisijob::all();
        return view('posisi.read', compact('jobs'));
    }
    public function create()
    {
        return view('posisi.create');
    }
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'nama'     => 'required|min:5',
            //'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            //'content'   => 'required|min:10'
        ]);

        //upload image
        //$image = $request->file('image');
        //$image->storeAs('public/posisi', $image->hashName());

        //create post
        Posisijob::create([
        'nama'     => $request->nama,
        'status'   => 'Aktif',
        //'content'   => $request->content
        //'image'     => $image->hashName(),
        ]);

        //redirect to index
        return redirect()->route('posisijob.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function destroy(Posisijob $posisijob)
    {
        $posisijob->delete();

        return redirect()->route('posisijob.index')
            ->withSuccess(__('Position job deleted successfully.'));
    }


    public function edit($id)
    {
        $jobs = Posisijob::findOrFail($id);
        return view('posisi.edit', compact('jobs'));
    }

    public function storeedit(Request $request, $id)
    {
        $this->validate($request, [
            'nama'   => 'required',
            'status' => 'required'

        ]);
        $jobs = Posisijob::findOrFail($id);

        $jobs->update(['nama' => $request->nama,'status'=> $request->status ]);

        if($jobs){
            //redirect dengan pesan sukses
            return redirect()->route('posisijob.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('posisijob.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }
}
