<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rehire;
use App\Models\Karyawan;
use App\Models\Cabang;
use App\Models\Perusahaan;
use App\Models\Bagian;
use App\Models\LevelJabatan;
use App\Models\ResignTermination;
use App\Models\NourutNik;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Presensi;
class RehireController extends Controller
{
    public function index()
    {
        return view('rehire.index');
    }

    public function readdata()
    {
        $param = ParamCabang::with('getcabang')->with('getkaryawan')->get();
        return view('rehire.readdata', compact('param'));
    }

    public function create(Request $request,$id)
    {
        $kr = Karyawan::findorfail($id);
        $bagian = Bagian::all();
        $pt = Perusahaan::all();
        $cabs = Cabang::all();
        $jabs = LevelJabatan::all();
        return view('rehire.modalcreate', compact('cabs', 'kr','pt','bagian','jabs'));
    }


    public function store(Request $request)
    {
        $skr = Carbon::now()->format('Y-m-d');
        // dd($request->all());
        $kar = Karyawan::findOrFail($request->idkar);
        $resign = ResignTermination::where('karyawan_id', $request->idkar)->get()->last();
        // Create Rehide Record
        Rehire::create([
            'nomor_induk_karyawan'  => $kar->nomor_induk_karyawan,
            'jenis_karyawan'        => $kar->jenis_karyawan,
            'tahun_gabung_lama'     => $kar->tahun_gabung,
            'tahun_keluar_lama'     => $kar->tahun_keluar,
            'upah'                  => $kar->upah,
            'masa_kerja'            => $kar->masa_kerja,
            'ptpk_status'           => $kar->ptpk_status,
            'email'                 => $kar->email,
            'tanggal_pengangkatan'  => $kar->tanggal_pengangkatan,
            'status'                => "Rehire",
            'tanggal_rehire'        => $skr,
            'tanggal_effektif'      => Carbon::create($request->tgl)->format('Y-m-d'),
            'id_kar'                => $kar->id,
            'fk_cabang'             => $kar->fk_cabang,
            'fk_bagian'             => $kar->fk_bagian,
            'fk_level_jabatan'      => $kar->fk_level_jabatan,
            'status_karyawan'       => $kar->status_karyawan,
            'fk_nama_perusahaan'    => $kar->fk_nama_perusahaan,
            'fk_user'               => $kar->fk_user,
            'id_resign'             => $resign->id,
            'keterangan'            => $request->keterangan,
        ]);
        
        $tgl = $request->tgl;
        // dd($tgl);
        $kode = 2;
        $bln = date("m", strtotime($tgl));
        $thn = date("y", strtotime($tgl));
        $get_no_urut = NourutNik::get()->first();
        $no_urut = $get_no_urut->nourut + 1;
        $nik= $kode.$thn.$bln.$no_urut;
        // Update Data Karyawan
        $kar->update([
            'nomor_induk_karyawan'  => $nik,
            'fk_cabang'             => $request->fk_cabang,
            'fk_bagian'             => $request->fk_bagian,
            'fk_level_jabatan'      => $request->fk_level_jabatan,
            'status_karyawan'       => $request->status_karyawanchoice,
            'fk_nama_perusahaan'    => $request->fk_nama_perusahaan,
            'tahun_gabung'          => Carbon::create($request->tgl)->format('Y-m-d'),
            ]);
        if($request->status_karyawanchoice != "Permanent"){
            $kar->expired_kontrak = Carbon::create($request->tgl)->addDays(90)->format('Y-m-d');
            $kar->save();
        }

       
        $get_no_urut-> nourut = $no_urut;
        $get_no_urut->save();

        ##Membuat Shift mulai dari tgl Effektif Hingga Akhir Tahun, Tahun Ini
        $today = Carbon::now();
        $kamri = date('Y-01-01');#Carbon::create($request->tgl)->format('Y-m-d');
        $blnskr = date('Y-12-31');
        $dateRange = CarbonPeriod::create($kamri, $blnskr);
        foreach ($dateRange as $dr) {
            $cr = Presensi::create(['tanggal' => $dr->format('Y-m-d'),'id_karyawan' => $kar->id,
                'id_user' => $kar->fk_user, 'id_parampresensi' => 1,'created_at' => $today->format('Y-m-d H:i:s')]);
        }      
        return redirect()->back()->with('success', 'Data saved successfully');
    }

    // public function createallkarparam(Request $request)
    // {
    //     // Save the data to the "detail karyawan cabang" table
    //     $karyawanIds =  Karyawan::whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation","AKTIF"])->get();
        

    //     foreach ($karyawanIds as $karyawanId) {
    //             ParamCabang::create([
    //                 'id_kar' => $karyawanId->id,
    //                 'id_cabang' => $karyawanId->fk_cabang,
    //                 'status' => "aktif",
    //                 'created_at' => $today = Carbon::now(),
    //             ]);
    //         }
    //     // Redirect back or wherever you want
    //     return redirect()->back()->with('success', 'Data saved successfully');
    // }
}
