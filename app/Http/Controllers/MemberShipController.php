<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MemberShip;
use Validator;
use Illuminate\Support\Str;

class MemberShipController extends Controller
{
    public function index()
    {
        $mems = MemberShip::paginate(20); #all();
        return view('member.index', compact('mems'));
    }

    public function create()
    {
        $mems = MemberShip::all();

        return view('member.create', compact('mems'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'loyaltycode' => 'required',
            'nama' => 'required',
            'loyaltykategori' => 'required',
            'gender' => 'required',
            'idtype' => 'required|unique:member_ships|min:16',  ##No KTP Atau SIM
            'idnum' => 'required',
            'pendididkan' => 'required',
            'alamat' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'kodepos' => 'required',
            'email' => 'required',
            'job' => 'required',
            'tempatlahir' => 'required',
            'tgllahir' => 'required',
            'agama' => 'required',
            'statusnikah' => 'required',
            'statusaktif' => 'required',
	    'loyaltypotensi' => 'required',
	    'notelp'=> 'required'
        ]);
        $ktp =  $request['idtype'];
        $hrktp = substr($ktp, 6, 2);
        $blnktp = substr($ktp, 8, 2);
	$thn_ktp = substr($ktp, 10, 2);
        if ($request['gender'] == "LAKI-LAKI"){
		$ktp = $hrktp . $blnktp . $thn_ktp;
	}
	if($request['gender'] == "PEREMPUAN"){
            $cek_awal = $hrktp - 40;
	    $cek_ktp = $cek_awal . $blnktp . $thn_ktp;
	    $cek = Str::length($cek_ktp);
	    if($cek === 5){
            $ktp = '0'.$cek_ktp;
            }if(!($cek === 5)){
             $ktp = $cek_awal . $blnktp . $thn_ktp;
	    }
	}
	$no_phone = $request['notelp'];
        if ($no_phone[0] == "0") {
            $cek_phone = substr($no_phone, 1);
            $phone ="62" . $cek_phone;
        }

        if ($no_phone[0] == "8") {
            $phone = "62" . $no_phone;
        }


        $lahir =  $request['tgllahir'];
        $hrlhr = substr($lahir, 8, 2);
        $blnlhr = substr($lahir, 5, 2);
        $thnlhr = substr($lahir, 2, 2);
        $cek_lahir = $hrlhr . $blnlhr . $thnlhr;

        if ($ktp === $cek_lahir) {
            MemberShip::create([
                'loyaltycode' => $request->loyaltycode,
                'nama' => $request->nama,
                'loyaltykategori' => $request->loyaltykategori,
                'gender' => $request->gender,
                'idtype' => $request->idtype, ##No KTP Atau SIM
                'idnum' => $request->idnum,
                'pendididkan' => $request->pendididkan,
                'alamat' => $request->alamat,
                'provinsi' => $request->provinsi,
                'kota' => $request->kota,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'kodepos' => $request->kodepos,
                'email' => $request->email,
                'job' => $request->job,
                'tempatlahir' => $request->tempatlahir,
                'tgllahir' => $request->tgllahir,
                'agama' => $request->agama,
                'statusnikah' => $request->statusnikah,
                'statusaktif' => $request->statusaktif,
		'loyaltypotensi' => $request->loyaltypotensi,
		'notelp' => $phone,
            ]);
            return redirect()->route('member')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return view('member.create');
        }
    }

    public function detail($id)
    {
        $mems = MemberShip::where('id', $id)->take(1)->first();
        return view('member.detail', compact('mems'));
    }

    public function edit($id)
    {
        $mems = MemberShip::findOrFail($id);
        return view('member.edit', compact('mems'));
    }


    public function storeedit(Request $request, $id)
    {
        $this->validate($request, [
            'loyaltycode' => 'required',
            'nama' => 'required',
            'loyaltykategori' => 'required',
            'gender' => 'required',
            'idnum' => 'required',
            'pendididkan' => 'required',
            'alamat' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'kodepos' => 'required',
            'email' => 'required',
            'job' => 'required',
            'tempatlahir' => 'required',
            'tgllahir' => 'required',
            'agama' => 'required',
            'statusnikah' => 'required',
            'statusaktif' => 'required',
	    'loyaltypotensi' => 'required',
	    'notelp' => 'required'
        ]);
	$mems = MemberShip::findOrFail($id);
	$no_phone = $request['notelp'];
        if ($no_phone[0] == "0") {
	    $cek_phone = substr($no_phone, 1);
            $phone ="62" . $cek_phone;
        }

        if ($no_phone[0] == "8") {
            $phone = "62" . $no_phone;
        }
        $mems->update([
            'loyaltycode' => $request->loyaltycode,
            'nama' => $request->nama,
            'loyaltykategori' => $request->loyaltykategori,
            'gender' => $request->gender,
            'idnum' => $request->idnum,
            'pendididkan' => $request->pendididkan,
            'alamat' => $request->alamat,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'kodepos' => $request->kodepos,
            'email' => $request->email,
            'job' => $request->job,
            'tempatlahir' => $request->tempatlahir,
            'tgllahir' => $request->tgllahir,
            'agama' => $request->agama,
            'statusnikah' => $request->statusnikah,
            'statusaktif' => $request->statusaktif,
	    'loyaltypotensi' => $request->loyaltypotensi,
	    'notelp' => $phone
        ]);
        return redirect()->route('member')->with(['success' => 'Data Berhasil Disimpan!']);
    }
}

