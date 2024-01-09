<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\RiwayatPendidikan;
use Illuminate\Support\Facades\DB;

class RiwayatPendidikanController extends Controller
{
    public function index()
    {
        $didiks = RiwayatPendidikan::all()->sortByDesc("id");
        return response()->json(['message' => 'Success', 'code' => '200', 'data' => $didiks]);
    }

    public function insert(Request $request)
    {
        $data = $request->all();
        foreach ($data as $item) {
            $datasave = [
                'pendidikan'    => $item['pendidikan'],
                'institusi'     => $item['institusi'],
                'jurusan'       => $item['jurusan'],
                'tempat'        => $item['tempat'],
                'tahun_masuk'   => $item['tahun_masuk'],
                'tahun_keluar'  => $item['tahun_keluar'],
                'keterangan'    => $item['keterangan'],
                'nilai'         => $item['nilai'],
                'fk_pelamar'    => $item['fk_pelamar'],
            ];
            $save = RiwayatPendidikan::insert($datasave);
        }
        return response()->json($request->all());
    }
    public function getdidik($id)
    {
        $didik = RiwayatPendidikan::where('fk_pelamar', $id)->get();
        return response()->json(['message' => 'Success', 'code' => '200', 'data' => $didik]);
    }
}

