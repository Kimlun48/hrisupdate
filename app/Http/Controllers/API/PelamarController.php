<?php

namespace App\Http\Controllers\API;

use App\Models\Pelamar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PelamarResource;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PelamarController extends Controller
{
    public function index()
    {
        $lamar = Pelamar::all();
	return new PelamarResource(true, 'List Data Pelamar', $lamar);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
	    'nama_lengkap'        => 'required',
	    'nik'                 => 'required',
	    'no_hp'               => 'required',
	    'no_telp'             => 'required',
	    'tgl_lahir'           => 'required',
	    'agama'               => 'required',
	    'photo'               => 'required|image|mimes:jpeg,png,jpg|max:2048',
	    'gender'              => 'required',
	    'tempat_lahir'        => 'required',
	    'status_pernikahan'   => 'required',
	    'cv'                  => 'required|mimes:pdf|max:5000',
	    'alamat'              => 'required',
	    'rt'                  => 'required',
	    'rw'                  => 'required',
	    'desa'                => 'required',
	    'kecamatan'           => 'required',
	    'kota'                => 'required',
	    'provinsi'            => 'required',
	    'kodepos'             => 'required',
	    'status_rumah'        => 'required',
	    'pendidikan_terakhir' => 'required',
	    'nama_sekolah'        => 'required',
	    'jurusan'             => 'required',
	    'tahun_masuk'         => 'required',
	    'tahun_lulus'         => 'required',
	    'ipk'                 => 'required', 
	    'fk_user'		  => 'required',
	    'hubungan_keluarga'   => 'required',
	    'sosial_media'        => 'required',
	    'referensi_job'       => 'required',
	    'ekspektasi_gaji'     => 'required',
	]);
	if ($validator->fails()){
	    return response()->json($validator->errors(),422);
	}

	//Upload
	$photo = $request->file('photo');
	$nama_lengkap = $request->string('nama_lengkap');
	$user_id = $request->string('fk_user');
	$extphoto = $request->file('photo')->getClientOriginalExtension();
	$PhotoName = $user_id.'_'.$nama_lengkap.'_'.time().'.'.$extphoto;
	$photo->storeAs('pelamar', $PhotoName);
	$cv = $request->file('cv');
	$extcv = $request->file('cv')->getClientOriginalExtension();
	$CvName = $user_id.'_'.$nama_lengkap.'_'.time().'.'.$extcv;
	$cv->storeAs('pelamar', $CvName);	

	$cek_nik_pelamar = Pelamar::where('nik', $request->nik)->get()->last();
	if ($cek_nik_pelamar === null) {

        //create post
	$lamar = Pelamar::create([	
            'photo'               => $PhotoName, #$photo,
	    	'cv'                  => $CvName, #$cv,
            'nama_lengkap'        => $request->nama_lengkap,
            'nik'                 => $request->nik,
            'no_hp'               => $request->no_hp,
            'no_telp'             => $request->no_telp,
            'tgl_lahir'           => $request->tgl_lahir,
            'agama'               => $request->agama,
            'gender'              => $request->gender,
            'tempat_lahir'        => $request->tempat_lahir,
            'status_pernikahan'   => $request->status_pernikahan,
            'alamat'              => $request->alamat,
            'rt'                  => $request->rt,
            'rw'                  => $request->rw,
            'desa'                => $request->desa,
            'kecamatan'           => $request->kecamatan,
            'kota'                => $request->kota,
            'provinsi'            => $request->provinsi,
            'kodepos'             => $request->kodepos,
            'status_rumah'        => $request->status_rumah,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'nama_sekolah'        => $request->nama_sekolah,
            'jurusan'             => $request->jurusan,
            'tahun_masuk'         => $request->tahun_masuk,
            'tahun_lulus'         => $request->tahun_lulus,
	    'ipk'                 => $request->ipk,
	    'hubungan_keluarga'   => $request->hubungan_keluarga,
	    'fk_user'             => $request->fk_user,
	    'sosial_media'        => $request->sosial_media,
	    'referensi_job'       => $request->referensi_job,
	    'ekspektasi_gaji'     => $request->ekspektasi_gaji,
	]);
            return new PelamarResource(true, 'Data Pelamar Berhasil Ditambahkan!', $lamar);
	} else {
	    return response()->json(['message' => 'Your NIK Is Already Registered, Please Apply Again For Job Vacancies', 'code' => 'reg1'], 401);
	}
    }
    public function show($lamar)
    {
	$lamar = Pelamar::where('id', $lamar)->take(1)->get();
	return new PelamarResource(true, 'Data Pelamar Berhasil Ditemukan!', $lamar);

    }

    public function updateprofile(Request $request, $idlamar)
    {
	$lamar = Pelamar::findOrFail($idlamar);
	$us = User::findOrFail($lamar->fk_user);
        $validator = Validator::make($request->all(), [
           # 'nik'                 => 'required',
            'nama_lengkap'        => 'required',
	    #'tgl_lahir'           => 'required',
	    #'email'           	  => 'required',
	    #'no_hp'               => 'required',
	    #'no_telp'             => 'required',
	    'agama'               => 'required',
	    'alamat'              => 'required',
	    'rt'                  => 'required',
	    'rw'                  => 'required',
	    'desa'                => 'required',
	    'kecamatan'           => 'required',
	    'kota'                => 'required',
	    'provinsi'            => 'required',
	    'kodepos'             => 'required',
	    'pendidikan_terakhir' => 'required',
	    'nama_sekolah'        => 'required',
	    'jurusan'             => 'required',
	    'tahun_masuk'         => 'required',
	    'tahun_lulus'         => 'required',
	    'ipk'                 => 'required', 
	    'hubungan_keluarga'   => 'required',
#	    'cv'                  => 'mimes:pdf|max:5000',
#	    'photo'               => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
		$lamar->update([
			#'nik'                 => $request->nik,
			'nama_lengkap'        => $request->nama_lengkap,
			#'tgl_lahir'           => $request->tgl_lahir,
			#'no_hp'               => $request->no_hp,
			#'no_telp'             => $request->no_telp,
			'agama'               => $request->agama,
			'alamat'              => $request->alamat,
			'rt'                  => $request->rt,
			'rw'                  => $request->rw,
			'desa'                => $request->desa,
			'kecamatan'           => $request->kecamatan,
			'kota'                => $request->kota,
			'provinsi'            => $request->provinsi,
			'kodepos'             => $request->kodepos,
			'pendidikan_terakhir' => $request->pendidikan_terakhir,
			'nama_sekolah'        => $request->nama_sekolah,
			'jurusan'             => $request->jurusan,
			'tahun_masuk'         => $request->tahun_masuk,
			'tahun_lulus'         => $request->tahun_lulus,
			'ipk'                 => $request->ipk, 	
			'hubungan_keluarga'   => $request->hubungan_keluarga,
		]);
              # $us->update(['email' => $request->email]);
               if ($request->hasFile('cv')) {
			Storage::delete('pelamar/'.$lamar->cv);
			$nama_lengkap = $request->string('nama_lengkap');
			$cv = $request->file('cv');
			$extcv = $request->file('cv')->getClientOriginalExtension();
			$CvName =$nama_lengkap.'_'.time().'.'.$extcv;
			$cv->storeAs('pelamar', $CvName);	
			$lamar->update(['cv'=> $CvName]);
		}
			if ($request->hasFile('photo')) {
			Storage::delete('pelamar/'.$lamar->photo);
			$photo = $request->file('photo');
			$nama_lengkap = $request->string('nama_lengkap');
			$extphoto = $request->file('photo')->getClientOriginalExtension();
			$PhotoName = $nama_lengkap.'_'.time().'.'.$extphoto;
			$photo->storeAs('pelamar', $PhotoName);
			$lamar->update(['photo' => $PhotoName]);
		}
        return new PelamarResource(true, 'Data Post Berhasil Diubah!', $lamar);
    }
}
