<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Keluarga;
use Illuminate\Support\Facades\DB;


class KeluargaController extends Controller
{
    public function insertawal(Request $request)

    {
        $keluargas = $request->get('keluargas');
        foreach ($keluargas as $item) {
            Keluarga::create([
                'anggota'         => $item['anggota'],
                'nama'            => $item['nama'],
                'jenis_kelamin'   => $item['jenis_kelamin'],
                'tempat_lahir'    => $item['tempat_lahir'],
                'tanggal_lahir'   => $item['tanggal_lahir'],
                'pendidikan'      => $item['pendidikan'],
                'pekerjaan'       => $item['pekerjaan'],
                'usia'            => $item['usia'],
                'urutan_anak'     => $item['urutan_anak'],
                'keterangan'      => $item['keterangan'],
                'fk_pelamar'      => $item['fk_pelamar']
            ]);
        }
        return response()->json(['success' => 'Data Telah Tersimpan', $keluargas]);
    }

    public function insert(Request $request)
    {
        $data = $request->all();
        foreach ($data as $item) {
            $datasave = [
                'anggota'       => $item['anggota'],
                'nama'          => $item['nama'],
                'jenis_kelamin' => $item['jenis_kelamin'],
                'tempat_lahir'  => $item['tempat_lahir'],
                'tanggal_lahir' => $item['tanggal_lahir'],
                'pendidikan'    => $item['pendidikan'],
                'pekerjaan'     => $item['pekerjaan'],
                'usia'          => $item['usia'],
                'urutan_anak'   => $item['urutan_anak'],
                'keterangan'    => $item['keterangan'],
                'fk_pelamar'    => $item['fk_pelamar'],
            ];
            $save = Keluarga::insert($datasave);
        }
        return response()->json($request->all());
    }

    public function index()
    {
        $klg = Keluarga::all()->sortByDesc("id");
        return response()->json(['message' => 'Success', 'code' => '200', 'data' => $klg]);
    }

    public function getkel($id)
    {
        $klg = Keluarga::where('fk_pelamar', $id)->get();
        return response()->json(['message' => 'Success', 'code' => '200', 'data' => $klg]);
    }
}

