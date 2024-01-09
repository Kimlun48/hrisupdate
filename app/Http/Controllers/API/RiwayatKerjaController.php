<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\RiwayatKerja;
use Illuminate\Support\Facades\DB;

class RiwayatKerjaController extends Controller
{
    public function index()
    {
        $kerjas = RiwayatKerja::all()->sortByDesc("id");
        return response()->json(['message' => 'Success', 'code' => '200', 'data' => $kerjas]);
    }

    public function insert(Request $request)
    {
        $data = $request->all();
        foreach ($data as $item) {
            $datasave = [
                'perusahaan' => $item['perusahaan'],
                'posisi' => $item['posisi'],
                'alamat' => $item['alamat'],
                'tanggal_masuk' => $item['tanggal_masuk'],
                'tanggal_keluar' => $item['tanggal_keluar'],
                'keterangan' => $item['keterangan'],
                'fk_pelamar' => $item['fk_pelamar'],
            ];
            $save = RiwayatKerja::insert($datasave);
        }
        return response()->json($request->all());
    }
    public function getkerja($id)
    {
        $ker = RiwayatKerja::where('fk_pelamar', $id)->get();
        return response()->json(['message' => 'Success', 'code' => '200', 'data' => $ker]);
    }
}

