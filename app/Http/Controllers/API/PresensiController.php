<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PresensiResource;
use App\Models\Presensi;
use Illuminate\Support\Facades\Validator;
use App\Models\Karyawan;
use App\Models\User;
use DateTime;
use App\Models\Cabang;
use Carbon\Carbon;
use App\Models\ShiftPresensi;
use App\Models\ParamPeriode;
use Illuminate\Support\Facades\Storage;
class PresensiController extends Controller
{

    public function index()
    {
        $date_now = new DateTime(date('Y-m-d'));
	#$prs= Presensi::with('preskaryawan.jabatan')->where('tanggal', '=',$date_now)->get();
	$prs = Presensi::with('preskaryawan.jabatan')->where('tanggal', '=', $date_now)->whereNotNull('keterangan')->get();
	#$kar = Karyawan::all();
	#return response()
        #    ->json(['nama' => $prs]);
	return new PresensiResource(true, 'List Data Presensi', $prs);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
	    'nik'         => 'required',
	    'image_masuk' => 'required|image|mimes:jpeg,png,jpg,webp|max:50480',
	    'latitude'    => 'required',
	    'longitude'   => 'required',
	]);
	if ($validator->fails()){
	    return response()->json($validator->errors(),422);
	}
    
	$jam_masuk = $request->jam_masuk;
	$id_karyawan = Karyawan::where('nomor_induk_karyawan', $request->nik)->get()->last();
    $cab = Cabang::where('id', $id_karyawan->fk_cabang)->first(); ##Untuk Absen Yang Tidak Milih cabang(cabang dri table karyawan)
	$user = User::where('id','=',$id_karyawan->fk_user)->get()->last();
	if ($id_karyawan == Null) {
            return response()->json(['message' => 'Anda Belum Terdaftar Sebagai Karyawan', 'code' => 'warning7'], 403);
	}
	else{

        $cek_radius = $cab->radius;
        $unit = $cab->satuan_radius;
        $cek_lat_cabang = $cab->latitude;
        $cek_lon_cabang = $cab->longitude;


	    ###HITUNG JARAK AWAL
	    $latitude1  = doubleval($request->latitude);  ###Posisi Absen
        $longitude1 = doubleval($request->longitude); ###Posisi Absen
        $latitude2  = doubleval($cek_lat_cabang); ###Posisi Cabang
        $longitude2 = doubleval($cek_lon_cabang); ###Posisi Cabang
	    $theta = $longitude1 - $longitude2; 
	    $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta))); 
	    $distance = acos($distance); 
	    $distance = rad2deg($distance); 
	    $distance = $distance * 60 * 1.1515; 
	    switch($unit) { 
	        case 'miles': 
	      break; 
	        case 'Kilometer' : 
	          $distance = $distance * 1.609344; 
              break; 
                case 'Meter' : 
                  $distance = $distance *  1609.344; 
	    } 
	    if ($distance > $cek_radius) {
                return response()->json(['message' => 'Jarak Anda Diluar jangkauan!!'.'lat'.doubleval($request->latitude).'long'.doubleval($request->longitude) , 'code' => 'warning1','distance' => $distance ,'unit' => $unit], 403);#400);
	    }if ($distance <= $cek_radius) {
            $cv = $request->file('image_masuk');
            $extcv = $request->file('image_masuk')->getClientOriginalExtension();
	        $CvName = $request->nik.'_'.date('Y-m-d_H:i:s').'.'.'png';
	        $cv->storeAs('presensi', $CvName);	
            ##BUAT STORE DATA IMAGE KE SERVER NAS
            $newFileName = 'tesfirman/' . $CvName; // Nama baru yang ingin Anda gunakan
            Storage::disk('ftp_server')->put($newFileName, file_get_contents($request->file('image_masuk')));
            
	        $ayeuna = new DateTime( date('Y-m-d H:i:s') );
	        $date_now = new DateTime( date('Y-m-d'));
	        $cek_absen = Presensi::select('*')->where('id_karyawan', '=', $id_karyawan->id)->where('tanggal','=', $date_now)->get()->last();
	        $skr = $ayeuna->format('H:i:s');
        if ($cek_absen->parampresensi->jenis_shift == "Off") {
            return response()->json(['message' => 'Saat Ini Anda Sedang Off/Libur, Jika Ingin Melakukan Absensi Silahkan Ajukan Change Shift Terlebih Dahulu!!', 'code' => 'warning2'], 403); #403);
        }
        if ($cek_absen->parampresensi->jenis_shift != "Off") {
		    if ($cek_absen) {
                    $user->update(['device_token' => $request->tkn]); ##Untuk Menyimpan Token Firebase
	                $cek_jam_masuk = $cek_absen->parampresensi->jam_masuk;
                    $cek_jam_pulang = $cek_absen->parampresensi->jam_pulang;
                    $cek_awal_absen_masuk = $cek_absen->parampresensi->awal_absen_masuk;
                    $cek_maks_telat_kerja = $cek_absen->parampresensi->maks_telat;
                    $batas_ontime = Carbon::createFromFormat('H:i:s', $cek_jam_masuk)->subSecond(59)->format('H:i:s');
	        if ($cek_absen->jam_masuk != Null and $cek_absen->jam_pulang != Null) {
                    return response()->json(['message' => 'Anda Sudah Absen Pulang Kerja!!', 'code' => 'warning2'], 403); #403);
	        }if ($cek_absen->jam_masuk == Null) {
                 if($skr < $batas_ontime){
		            	$user->update(['device_token' => $request->tkn]); ##Untuk Menyimpan Token Firebase
                        $cek_absen->update([
                            'image_masuk'     => $CvName,
                            'jam_masuk'       => $ayeuna,
                            'id_user'         => $id_karyawan->fk_user,
                            'latitude'        => $request->latitude,
                            'longitude'       => $request->longitude,
                            'tanggal'         => $date_now,
                            'id_karyawan'     => $id_karyawan->id,
                            'keterangan'      => 'EarlyIn',##
                            'presensi_status' => 'EarlyIn',##Untuk Penarikan Report (EarlyIn,Late,Off,Cuti dll)
                        ]);
                        return response()->json(['message' => 'Absen Masuk Berhasil Early In!!', 'code' => 'Success1'], 200);
		    }
		    // if($skr == $cek_jam_masuk){
                if ($skr > $batas_ontime && $skr <= $cek_jam_masuk) {
                        $user->update(['device_token' => $request->tkn]); ##Untuk Menyimpan Token Firebase
                        $cek_absen->update([
                            'image_masuk'     => $CvName,
                            'jam_masuk'       => $ayeuna,
                            'id_user'         => $id_karyawan->fk_user,
                            'latitude'        => $request->latitude,
                            'longitude'       => $request->longitude,
                            'tanggal'         => $date_now,
                            'id_karyawan'     => $id_karyawan->id,
                            'keterangan'      => 'OnTime',
                            'presensi_status' => 'OnTime',
                        ]);
                        return response()->json(['message' => 'Absen Masuk Berhasil Ontime!!', 'code' => 'Success2'], 200);
		    }
		    if($skr > $cek_jam_masuk and $skr <= $cek_maks_telat_kerja){
			$user->update(['device_token' => $request->tkn]); ##Untuk Menyimpan Token Firebase
                        $cek_absen->update([
                            'image_masuk'     => $CvName,
                            'jam_masuk'       => $ayeuna,
                            'id_user'         => $id_karyawan->fk_user,
                            'latitude'        => $request->latitude,
                            'longitude'       => $request->longitude,
                            'tanggal'         => $date_now,
                            'id_karyawan'     => $id_karyawan->id,
                            'keterangan'      => 'Late',
                            'presensi_status' => 'Late',
                            ]);
                           return response()->json(['message' => 'Absen Masuk Berhasil Late!!', 'code' => 'Success3'], 200);
                        }elseif($cek_absen->jam_masuk == Null and $skr >= $cek_maks_telat_kerja){
                            return response()->json(['message' => 'Bukan Jam Masuk Kerja!!'.'lat'.doubleval($request->latitude).'long'.doubleval($request->longitude), 'code' => 'warning3'], 403);#403);
                    }
	        }
                if ($cek_absen->jam_masuk != Null and $skr < $cek_jam_pulang) {
	          return response()->json(['message' => 'Anda Sudah Melakukan Absen Masuk Kerja!!', 'code' => 'warning4'], 403);#403);
                }
	        if ($cek_absen->jam_masuk != Null and $skr >= $cek_jam_pulang) {
                    if($skr >= $cek_jam_pulang){
                        $user->update(['device_token' => $request->tkn]); ##Untuk Menyimpan Token Firebase
                        $cek_absen->update([
                            'image_pulang'           => $CvName,
                            'jam_pulang'             => $ayeuna,
                            'id_user'                => $id_karyawan->fk_user,
                            'latitude_pulang'        => $request->latitude,
                            'longitude_pulang'       => $request->longitude,
                            'presensi_status_pulang' => 'Late',
                        ]);
                        return response()->json(['message' => 'Absen Pulang Berhasil!!', 'code' => 'Success4'], 200);
                    }if($skr <= $cek_jam_pulang){
                        return response()->json(['message' => 'Bukan Jam Pulang Kerja!!', 'code' => 'warning5'], 403); #403);
                    }
                }
	    }
    }
	    #JIka Belum Ada Di Table Presensi (blom ke Create Absennya)
	    if (!($cek_absen)) {	
              return response()->json(['message' => 'Presensi Anda Belum Terdaftar!!', 'code' => 'warning6'], 403);#400
	    }

          }
        }
    }

    public function getpresensi($id)
	{
		$kar = Karyawan::findorFail($id);
        $prs = Presensi::where('id_karyawan', $kar->id)->whereNotNull('keterangan')->orderBy('tanggal', 'DESC')->get();
		if ($kar) {
			return new PresensiResource(true, 'List Data Presensi', $prs);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan', 'code' => 'Error1'], 401);
		}
	}	

        public function getbreaktime($id)
        {
                $kar = Karyawan::findorFail($id);
		$prs = Presensi::where('id_karyawan', $kar->id)->whereNotNull('istirahat_keluar')->orderBy('id', 'DESC')
		    ->select('tanggal','istirahat_keluar','istirahat_masuk')->get();
                if ($kar) {
                        return new PresensiResource(true, 'List Data Presensi', $prs);
                } else {
                        return response()->json(['message' => 'Data Tidak Ditemukan', 'code' => 'Error1'], 401);
                }
        }

    public function offday()
    {
        $date_now = new DateTime( date('Y-m-d'));
	$prs= Presensi::with('preskaryawan.jabatan')->wherein('keterangan',['CUTI','SAKIT','ALPHA'])->get();
	if ($prs) {
            return response()->json(['success' => '200', 'data' => $prs], 200);
        } else {
            return response()->json(['message' => 'Data Tidak Ditemukan', 'code' => 'Error1'], 404);
        }

    }

    // public function getshifkar($id)
    //     {
    //             $duablnlalu = date('Y-m-21', strtotime('-1 month'));
    //             $nextmonth = date('Y-m-20', strtotime('+1 month'));
    //             $kar = Karyawan::findorFail($id);
    //             $prs = Presensi::select('tanggal','id_parampresensi')
    //                     ->with('parampresensi')->where('id_karyawan', $kar->id)
    //                     ->whereBetween('tanggal', [$duablnlalu, $nextmonth])
    //                     ->orderBy('tanggal', 'DESC')->get();
    //             return new PresensiResource(true, 'List Data Presensi', $prs);
    //     }
    public function getshifkar($id)
    {
        $parperiod = ParamPeriode::where('status','=','Aktif')->first();
        if (Carbon::now()->format('d') < $parperiod->startdate) {
            $periodeawal = Carbon::now()->subMonth()->format('Y-m-'.$parperiod->startdate);
            $periodeakhir =  Carbon::now()->format('Y-m-'.$parperiod->enddate);
         }else {
            $periodeawal =  Carbon::now()->format('Y-m-'.$parperiod->startdate);
            $periodeakhir = Carbon::now()->addMonth()->format('Y-m-'.$parperiod->enddate);
        }
        $kar = Karyawan::findorFail($id);
        $prs = Presensi::select('tanggal','id_parampresensi')
            ->with('parampresensi')->where('id_karyawan', $kar->id)
            ->whereBetween('tanggal', [$periodeawal, $periodeakhir])
            ->orderBy('tanggal', 'DESC')->get();
        return new PresensiResource(true, 'List Data Presensi', $prs);
     }


}
