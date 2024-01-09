<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\RiwayatKesehatan;
use Illuminate\Support\Facades\DB;

class RiwayatKesehatanController extends Controller
{
    public function index()
    {
        $sehats = RiwayatKesehatan::all()->sortByDesc("id");
        return response()->json(['message' => 'Success', 'code' => '200', 'data' => $sehats]);
    }

    public function insert(Request $request)
    {
        $data = $request->all();
        foreach ($data as $item) {
            $datasave = [
                'type_penyakit'     => $item['type_penyakit'],
                'nama_penyakit'     => $item['nama_penyakit'],
                'penyembuhan'       => $item['penyembuhan'],
                'tahun_kejadian'    => $item['tahun_kejadian'],
                'akibat'            => $item['akibat'],
                'fk_pelamar'        => $item['fk_pelamar'],
            ];
            $save = RiwayatKesehatan::insert($datasave);
        }
        return response()->json($request->all());
    }
    public function getsehat($id)
    {
        $sehat = RiwayatKesehatan::where('fk_pelamar', $id)->get();
        return response()->json(['message' => 'Success', 'code' => '200', 'data' => $sehat]);
    }
}

