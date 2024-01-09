<?php

namespace App\Http\Controllers\Api;

use DateTime;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Models\Pelamar;
use App\Models\BerkasLamaran;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\BerkasLamaranResource;




// use App\Http\Resources\BerkasLamaran;

class BerkasLamaranController extends Controller
{
    public function getberkas($id)
    {
        $berkas = BerkasLamaran::where('pelamar_id', $id)->get();
        return new BerkasLamaranResource(true, 'Data', $berkas);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'cv' => 'required|mimes:pdf|max:10000',
            'lamaran' => 'required|mimes:pdf|max:10000',
            'photo' => 'required|mimes:pdf|max:10000',
            'skck' => 'nullable|mimes:pdf|max:10000',
            'kk' => 'required|mimes:pdf|max:10000',
            'npwp' => 'nullable|mimes:pdf|max:10000',
            'paklaring' => 'nullable|mimes:pdf|max:10000',
            'sim' => 'nullable|mimes:pdf|max:10000',
            'sio' => 'nullable|mimes:pdf|max:10000',
            'sertipikat' => 'nullable|mimes:pdf|max:10000',
            'ijazah' => 'required|mimes:pdf|max:10000',
            'transkrip_nilai' => 'nullable|mimes:pdf|max:10000',
            'ktp' => 'required|mimes:pdf|max:10000',
            'vaksin' => 'nullable|mimes:pdf|max:10000',
        ]);
        $lamar = Pelamar::findOrFail($request->id);
        if ($request->file('cv')) {
            $cv = $request->file('cv');
            $nama_dokumen = $lamar->nama_lengkap;
            $extcv = $request->file('cv')->getClientOriginalExtension();
            $CvName = $nama_dokumen . '_' . time() . '.' . $extcv;
            $cv->storeAs('berkaspelamar/', $CvName);
        }
        if ($request->file('lamaran')) {
            $lamaran = $request->file('lamaran');
            $nama_dokumen = $lamar->nama_lengkap;
            $extlamaran = $request->file('lamaran')->getClientOriginalExtension();
            $lamaranName = $nama_dokumen . '_' . time() . '.' . $extlamaran;
            $lamaran->storeAs('berkaspelamar/', $lamaranName);
        }
        if ($request->file('photo')) {
            $photo = $request->file('photo');
            $nama_dokumen = $lamar->nama_lengkap;
            $extphoto = $request->file('photo')->getClientOriginalExtension();
            $photoName = $nama_dokumen . '_' . time() . '.' . $extphoto;
            $photo->storeAs('berkaspelamar/', $photoName);
        }

        if ($request->file('kk')) {
            $kk = $request->file('kk');
            $nama_dokumen = $lamar->nama_lengkap;
            $extkk = $request->file('kk')->getClientOriginalExtension();
            $kkName = $nama_dokumen . '_' . time() . '.' . $extkk;
            $kk->storeAs('berkaspelamar/', $kkName);
        }

        if ($request->file('ijazah')) {
            $ijazah = $request->file('ijazah');
            $nama_dokumen = $lamar->nama_lengkap;
            $extijazah = $request->file('ijazah')->getClientOriginalExtension();
            $ijazahName = $nama_dokumen . '_' . time() . '.' . $extijazah;
            $ijazah->storeAs('berkaspelamar/', $ijazahName);
        }

        if ($request->file('ktp')) {
            $ktp   = $request->file('ktp');
            $nama_dokumen = $lamar->nama_lengkap;
            $extktp = $request->file('ktp')->getClientOriginalExtension();
            $ktpName = $nama_dokumen . '_' . time() . '.' . $extktp;
            $ktp->storeAs('berkaspelamar/', $ktpName);
        }

        $ayeuna = new DateTime(date('Y-m-d H:i:s'));

        $ber = BerkasLamaran::where('pelamar_id', $request->id)->take(1)->first();
        if ($ber) {
            return response()->json(['message' => 'Berkas Telah Ada!! ', 'code' => 'Error'], 403);
        } else {
            $berkas = BerkasLamaran::create([
                'id_user' => $lamar->fk_user,
                'pelamar_id' => $lamar->id,
                'tanggal' => $ayeuna,
                'cv' => $CvName,
                'lamaran' => $lamaranName,
                'photo' => $photoName,
                #'skck' => $skckName,
                'kk' => $kkName,
                #'npwp' => $npwpName,
                #'paklaring' => $paklaringName,
                #'sim' => $simName,
                #'sio' => $sioName,
                #'sertipikat' => $sertipikatName,
                'ijazah' => $ijazahName,
                #'transkrip_nilai' => $transkrip_nilaiName,
                'ktp' => $ktpName,
                #'vaksin' => $vaksinName,
            ]);
            if ($request->file('npwp')) {
                $npwp = $request->file('npwp');
                $nama_dokumen = $lamar->nama_lengkap;
                $extnpwp = $request->file('npwp')->getClientOriginalExtension();
                $npwpName = $nama_dokumen . '_' . time() . '.' . $extnpwp;
                $npwp->storeAs('berkaspelamar/', $npwpName);
                $berkas->update(['npwp' => $npwpName]);
            }
            if ($request->file('paklaring')) {
                $paklaring = $request->file('paklaring');
                $nama_dokumen = $lamar->nama_lengkap;
                $extpaklaring = $request->file('paklaring')->getClientOriginalExtension();
                $paklaringName = $nama_dokumen . '_' . time() . '.' . $extpaklaring;
                $paklaring->storeAs('berkaspelamar/', $paklaringName);
                $berkas->update(['paklaring' => $paklaringName]);
            }
            if ($request->file('sim')) {
                $sim = $request->file('sim');
                $nama_dokumen = $lamar->nama_lengkap;
                $extsim = $request->file('sim')->getClientOriginalExtension();
                $simName = $nama_dokumen . '_' . time() . '.' . $extsim;
                $sim->storeAs('berkaspelamar/', $simName);
                $berkas->update(['sim' => $simName]);
            }
            if ($request->file('sio')) {
                $sio = $request->file('sio');
                $nama_dokumen = $lamar->nama_lengkap;
                $extsio = $request->file('sio')->getClientOriginalExtension();
                $sioName = $nama_dokumen . '_' . time() . '.' . $extsio;
                $sio->storeAs('berkaspelamar/', $sioName);
                $berkas->update(['sio' => $sioName]);
            }
            if ($request->file('sertipikat')) {
                $sertipikat = $request->file('sertipikat');
                $nama_dokumen = $lamar->nama_lengkap;
                $extsertipikat = $request->file('sertipikat')->getClientOriginalExtension();
                $sertipikatName = $nama_dokumen . '_' . time() . '.' . $extsertipikat;
                $sertipikat->storeAs('berkaspelamar/', $sertipikatName);
                $berkas->update(['sertipikat' => $sertipikatName]);
            }
            if ($request->file('vaksin')) {
                $vaksin   = $request->file('vaksin');
                $nama_dokumen = $lamar->nama_lengkap;
                $extvaksin_nilai = $request->file('vaksin')->getClientOriginalExtension();
                $vaksinName = $nama_dokumen . '_' . time() . '.' . $extvaksin_nilai;
                $vaksin->storeAs('berkaspelamar/', $vaksinName);
                $berkas->update(['vaksin' => $vaksinName]);
            }
            if ($request->file('transkrip_nilai')) {
                $transkrip_nilai   = $request->file('transkrip_nilai');
                $nama_dokumen = $lamar->nama_lengkap;
                $exttranskrip_nilai = $request->file('transkrip_nilai')->getClientOriginalExtension();
                $transkrip_nilaiName = $nama_dokumen . '_' . time() . '.' . $exttranskrip_nilai;
                $transkrip_nilai->storeAs('berkaspelamar/', $transkrip_nilaiName);
                $berkas->update(['transkrip_nilai' => $transkrip_nilaiName]);
            }
            if ($request->file('skck')) {
                $skck = $request->file('skck');
                $nama_dokumen = $lamar->nama_lengkap;
                $extskck = $request->file('skck')->getClientOriginalExtension();
                $skckName = $nama_dokumen . '_' . time() . '.' . $extskck;
                $skck->storeAs('berkaspelamar/', $skckName);
                $berkas->update(['skck' => $skckName]);
            }
        }
        return new BerkasLamaranResource(true, 'Berkas Pelamar Berhasil Ditambahkan!', $lamar);
        #return redirect()->route('pelamar.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
}

