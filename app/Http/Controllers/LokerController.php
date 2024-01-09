<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loker;
use App\Models\Posisijob;
use App\Models\Pelamar;
use App\Models\Presensi;
use App\Models\Apllyloker;
use App\Models\Cabang;
use App\Models\Verifikasi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DateTime;
use Carbon\Carbon;
class LokerController extends Controller
{
    public function index(Request $request)
    {

        return view('loker.index');
    }
    // public function show(Request $request)
    // {
    //     $length = $request->choiceValue ? $request->choiceValue : 10; #$request->choiceValue;
    //     $skr = Carbon::now()->toDateString();
    //     $cabs = Cabang::get();
    //     $uss = Pelamar::all()->first();
    //     $loks = Loker::where('status', 'aktif')
    //     ->paginate($length);    
    //     return view('loker.readdata', compact('loks', 'uss', 'cabs'));
    // }


    // public function readdata($status)
    // {
    //     $loks = Loker::where('status', $status)
    //     ->paginate(20);
    //    return view('loker.readdata', compact('loks'));
    // }

    public function show(Request $request)
    {
        // dd($request->all());
        $length = $request->choiceValue ? $request->choiceValue : 10;
        $search = $request->search ? $request->search : null;
        $skr = Carbon::now()->toDateString();
        $cabs = Cabang::get();
        $uss = Pelamar::all()->first();
    
        // Check if the 'status' parameter is present in the request
        if ($request->has('status')) {
            $status = $request->input('status');
    
            // Adjust your logic based on the status parameter
            if ($status == 'active') {
                $loks = Loker::where('status', 'aktif');
            } else {
                // Assuming 'nonactive' for non-active status
                $loks = Loker::where('status', 'non aktif');
            }
        } else {
            // If 'status' parameter is not present, load default active data
            $loks = Loker::where('status', 'aktif');
        }
    
        // Apply search if $search is not null
        if ($search) {
            $loks = $loks->where(function ($query) use ($search) {
                $query->where('lowongan_kerja', 'like', '%' . $search . '%')
                    // ->orWhere('field2', 'like', '%' . $search . '%')
                    // // Add more fields as needed
                    // ->orWhere('field3', 'like', '%' . $search . '%')
                ->orWhereHas('cabang', function ($query) use ($search) {       ##Tambahkan fungsi jika pencarian harus melalui relasi tabel
                    $query->where('nama', 'like', '%' . $search . '%');
                })
                ->orWhereHas('posisi', function ($query) use ($search) {       ##Tambahkan fungsi jika pencarian harus melalui relasi tabel
                    $query->where('nama', 'like', '%' . $search . '%');
                });
            });
        }
    
        // Paginate the results
        $loks = $loks->paginate($length);
    
        return view('loker.readdata', compact('loks', 'uss', 'cabs'));
    }
    


    public function nonactive(Request $request)
    {
        $length = $request->choiceValue ? $request->choiceValue : 10; #$request->choiceValue;
        $skr = Carbon::now()->toDateString();
        $cabs = Cabang::get();
        $uss = Pelamar::all()->first();
        $loks = Loker::where('status', 'non aktif')
        ->paginate($length);    
       return view('loker.readdata', compact('loks','uss','cabs'));
    }
    public function readloker(Request $request)
    {

    }
    public function create()
    {
        $posisijobs = Posisijob::all();
        $cabs = Cabang::all();
        return view('loker.create', compact('posisijobs','cabs'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
        'lowongan_kerja' => 'required|min:5',
        'fk_penempatan'=> 'required',
        'posisi_id'    => 'required',
        'deskripsi'    => 'required|min:5',
        'kualifikasi'  => 'required|min:5',
        'dok_header' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'dok_poster' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'pendidikan' => 'required|min:1',
        'pengalaman' => 'required|min:1',
        'level_job'  => 'required|min:1',
        'kategory_job'  => 'required|min:1',
        ]);
	//create post
    //$dok_header = $request->file('dok_header');
    //$dok_header->storeAs('public/posts', $dok_header);


    $dok_header = $request->file('dok_header');
    if ($dok_header) {
        $dok_header_Name = time().'_'.$dok_header->getClientOriginalName();
        $filePath = $dok_header->storeAs('images/posts', $dok_header_Name, 'public');
    }

    //$dok_poster = $request->file('dok_poster');
    //$dok_poster->storeAs('public/posts', $dok_poster);

    $dok_poster = $request->file('dok_poster');
    if ($dok_poster) {
        $dok_poster_Name = time().'_'.$dok_poster->getClientOriginalName();
        $filePath = $dok_poster->storeAs('images/posts', $dok_poster_Name, 'public');
    }

    $id_tempat = Cabang::findOrFail($request->fk_penempatan);
	$jangsave = Posisijob::findOrFail($request->posisi_id);
	$ayeuna = new DateTime( date('Y-m-d H:i:s') );
        Loker::create([
        'lowongan_kerja' => $request->lowongan_kerja,
        'fk_penempatan'  => $id_tempat->id,
        'posisi_id'      => $jangsave->id,
        'deskripsi'      => $request->deskripsi,
        'kualifikasi'    => $request->kualifikasi,	    
        'status'         => 'Aktif',
        'tanggal'        => $ayeuna,
        'dok_header'     => $dok_header_Name,
        'dok_poster'     => $dok_poster_Name,
        'pendidikan'     => $request->pendidikan,
        'pengalaman'     => $request->pengalaman,
        'level_job'      => $request->level_job,
        'kategory_job'   => $request->kategory_job,
        ]);
        return redirect()->route('loker.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    
    public function saveaplly($idloker,$idlamar,$id_user)
    {
	$id_loker = Loker::findOrFail($idloker);
	$id_lamar = Pelamar::findOrFail($idlamar);
    $id_user = User::findOrFail($id_user);

	$ayeuna = new DateTime( date('Y-m-d H:i:s') );
        Apllyloker::create([
        'loker_id'      => $id_loker->id,
        'pelamar_id'    => $id_lamar->id,
        'user_id'       => $id_user->id,
        'tanggal'       => $ayeuna,
        ]);
    $aply = Apllyloker::take(1)->get();
        Verifikasi::create([
            'fk_apply'    => $id_lamar->fk_user,
            'waktu'       => $ayeuna,
            'status'      => "In Process",
            #'note'        => "Antrian",
            'maker'       => $id_lamar->fk_user,
            'progres'     => 'Administrasi',
            ]);
        return redirect()->route('loker.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    public function detail($id)
    {
      
        $cabs = Cabang::All();
        $list =  Loker::find($id);
        return view('loker.detailloker', compact('list','cabs'  ));
    } 
    public function listapply($id,Request $request)
    {
        //get List Loker
	#$list = Apllyloker::where('loker_id',$id)->paginate(20);
	$getid = Loker::find($id);
        if ($request->has('search')) {
            $list = Apllyloker::where('loker_id',$id)->whereHas('pelamar', function ($query) use ($request){
                $query->where('progres', 'like', "%{$request->search}%")
                ->orwhere('nama_lengkap', 'like', '%'.$request->search.'%')
                ->orwhere('nama_sekolah', 'like', '%'.$request->search.'%')
                ->orwhere('pendidikan_terakhir', 'like', '%'.$request->search.'%');
            })->latest()->paginate(20);
        }else {
		$list = Apllyloker::where('loker_id',$id)->paginate(20);
	}
        if ($request->ajax()) {
            return view('loker.listdetail', ['list' => $list])->render();
        }    
        return view('loker.detailapply', compact('list','getid'));
        #return view('loker.detailapply', compact('list','getid'));
    }  
    
    
    public function edit($id)
    {
        $loks = Loker::findOrFail($id);
        $posisijobs = Posisijob::all();
        $cabs = Cabang::all();
        return view('loker.edit', compact('loks','posisijobs','cabs'));
    }
    
    public function storeedit(Request $request, $id)
    {
        $this->validate($request, [
            'lowongan_kerja' => 'required|min:5',
            'fk_penempatan'=> 'required',
            'posisi_id'    => 'required',
            'deskripsi'    => 'required|min:5',
            'kualifikasi'  => 'required|min:5',
            'dok_header' => 'image|mimes:jpeg,png,jpg|max:2048',
            'dok_poster' => 'image|mimes:jpeg,png,jpg|max:2048',
            'pendidikan' => 'required|min:1',
            'pengalaman' => 'required|min:1',
            'level_job'  => 'required|min:1',
            'kategory_job'  => 'required|min:1',
        ]);
        $lok = Loker::findOrFail($id);
        $id_tempat = Cabang::findOrFail($request->fk_penempatan);
        $jangsave = Posisijob::findOrFail($request->posisi_id);
        $ayeuna = new DateTime( date('Y-m-d H:i:s') );
        $lok->update([
            'lowongan_kerja' => $request->lowongan_kerja,
            'fk_penempatan'  => $id_tempat->id,
            'posisi_id'      => $jangsave->id,
            'deskripsi'      => $request->deskripsi,
            'kualifikasi'    => $request->kualifikasi,	    
            'tanggal'        => $ayeuna,
            'pendidikan'     => $request->pendidikan,
            'pengalaman'     => $request->pengalaman,
            'level_job'      => $request->level_job,
            'kategory_job'   => $request->kategory_job,
            'status'         => $request->status,
           ]);

            $dok_header = $request->file('dok_header');
            if ($dok_header) {
                Storage::delete('images/posts/'.$lok->dok_header);
                $dok_header_Name = time().'_'.$dok_header->getClientOriginalName();
                $filePath = $dok_header->storeAs('images/posts', $dok_header_Name, 'public');
                $lok->update(['dok_header'     => $dok_header_Name]);
            }
            $dok_poster = $request->file('dok_poster');
            if ($dok_poster) {
                Storage::delete('images/posts/'.$lok->dok_poster);
                $dok_poster_Name = time().'_'.$dok_poster->getClientOriginalName();
                $filePath = $dok_poster->storeAs('images/posts', $dok_poster_Name, 'public');
                $lok->update(['dok_poster'     => $dok_poster_Name]);
            }

        if($lok){
            //redirect dengan pesan sukses
            return redirect()->route('loker.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('loker.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }    
}

