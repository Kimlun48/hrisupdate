<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loker;
use App\Models\Pelamar;
use App\Models\Apllyloker;
use App\Models\User;
use App\Models\Verifikasi;
use DateTime;
use Auth;
use App\Http\Resources\ApiLokerResource;


class ApiLokerController extends Controller
{
    public function index()
    {
        #$loker = Loker::all();
        $loker = Loker::where('status', 'Aktif')->with('cabang')->get();
	return new ApiLokerResource(true, 'List Data Loker', $loker);
    }

    public function show($id_lamar)
    {
	$loker = Loker::with('cabang')->where('id', $id_lamar)->take(1)->get();
	return new ApiLokerResource(true, 'Data Loker Berhasil Ditemukan!', $loker);    
    }

    public function showcab($kocab)
    {
    $loker = Loker::select('*')->where('fk_penempatan', '=', $kocab)->get();
	return new ApiLokerResource(true, 'Data Loker Berhasil Ditemukan!', $loker);
    }

    public function saveaplly($id_loker,$id_lamar,$id_user)
    {
	$id_loker = Loker::findOrFail($id_loker);
	$id_lamar = Pelamar::findOrFail($id_lamar);
    $id_user = User::findOrFail($id_user);
    #$uss = User::where('id', $id_lamar->fk_user)->firstOrFail();

    $ayeuna = new DateTime( date('Y-m-d H:i:s') );
        $lkr = Apllyloker::create([
        'loker_id'      => $id_loker->id,
        'pelamar_id'    => $id_lamar->id,
        'user_id'       => $id_user->id,
	    'tanggal'       => $ayeuna,
        'status'        => "In Process",
        'progres'       => 'Administration',
        ]);

        Verifikasi::create([
            'fk_apply'    => $lkr->id,
            'waktu'       => $ayeuna,
            'status'      => "In Process",
            'maker'       =>  $id_user->id, #$lkr->pelamar->userlamar->id,
            'progres'     => 'Administration',
            ]);

        return new ApiLokerController(true, 'Berhasil Aplly!');
    }

}			

