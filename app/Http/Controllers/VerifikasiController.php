<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loker;
use App\Models\Posisijob;
use App\Models\Pelamar;
use App\Models\Apllyloker;
use App\Models\Verifikasi;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ParamVerifikasi;
use App\Models\Karyawan;
use App\Models\Cabang;
use App\Models\Bagian;
use App\Models\LevelJabatan;
use DateTime;
use App\Models\PenawaranKerja;
use App\Models\NourutNik;
use Notification;
use App\Notifications\EmailNotification;

class VerifikasiController extends Controller
{
    public function index()
    {
        $lamar = Apllyloker::all();
        return view('pelamar.index', compact('lamar'));
    }
    public function create( $id)
    {
        $list = Apllyloker::where('id', $id)->first();
        #$param = ParamVerifikasi::where('progres', $list->progres)->get()->last();
        $idtea = $id;
        return view('verif.create', compact('list','idtea'));
        
    }
   
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'status'    => 'required',
            'note'      => 'required',
            #'progres'   => 'required',
            ]);
       
            $ayeuna = new DateTime( date('Y-m-d H:i:s') );
            $aplok = Apllyloker::findOrFail($id);
            $param = ParamVerifikasi::where('progres', $aplok->progres)->get()->last();
            $cek_level = $param->level + 1;
            $cek_next_param = ParamVerifikasi::where('level', $cek_level)->get()->last();

            ##Ketika Update Level Sebelumnya
            $ver_awal = Verifikasi::where('fk_apply', $id)->get()->last();
            #$ver_awal = Verifikasi::findorfail('fk_apply', $id);
            $ver_awal->status  = $request->status;
            $ver_awal->note    = $request->note;
            $ver_awal->save();
            if ($request->status == 'Approved') { 
               if($cek_next_param->progres == 'Finish'){
                #$aplok->progres = $cek_next_param->progres;
                $aplok->status  = 'Finish';
                $aplok->save();
               }
               else{
                $aplok->progres = $cek_next_param->progres;
                $aplok->status  = 'In Process';
                $aplok->save();
               }

            ##save Ke Tabel Verifikasi
            ##ini Nanti Dikasi Konsisi Klo Aprove maka Create Kalo Reject Maka Jangan Create
            Verifikasi::create(['fk_apply'=>$aplok->id, 'waktu'=>$ayeuna, 'status'=>"In Process",
                'maker'=> Auth::id(),'progres'=> $cek_next_param->progres]);#'note'      => "Antrian",#$request->note,
            }
            if ($request->status == 'Rejected') { 
               $aplok->status  = 'Rejected';
               $aplok->save();
            }
            // email notifikasi
            $user = User::where('id', $ver_awal->gt_fkapply->user_id)->get()->last();
            $ver_baru = Verifikasi::where('fk_apply', $id)->get()->last();
                $project = [
                    'greeting' => 'Hi '.$user->name.',',
                    'body' => 'Job Status',
                    'thanks' => 'Thank you this is from HRD PT.Anyar Group',
                    'actionText' => 'Your ' .$ver_awal->progres. ' Has ' .$ver_awal->status ,
                    'actionURL' => url('https://karir.anyargroup.co.id/login'),
                    'id' => $user->id
                ];
                Notification::send($user, new EmailNotification($project));
		return redirect()->to('loker/listapply/'.$aplok->loker_id)->with(['success' => 'Data Berhasil Disimpan!']);
    }
    public function storeapprove(Request $request)
    {
	    $this->validate($request, [
            'cekid'     => 'required',	    
	    'note'      => 'required',
	    'waktu'     => 'required'
            ]);
       
            $ayeuna = new DateTime( date('Y-m-d H:i:s') );
	    $aplok = Apllyloker::findOrFail($request->cekid);
            $param = ParamVerifikasi::where('progres', $aplok->progres)->get()->last();
            $cek_level = $param->level + 1;
            $cek_next_param = ParamVerifikasi::where('level', $cek_level)->get()->last();

            ##Ketika Update Level Sebelumnya
            $ver_awal = Verifikasi::where('fk_apply', $request->cekid)->get()->last();
            $ver_awal->status  = 'Approved';
            $ver_awal->note    = $request->note;
            $ver_awal->save();
               //if($cek_next_param->progres == 'Finish'){
               // $aplok->status  = 'Finish';
               // $aplok->save();
               //}
               //else{
                $aplok->progres = $cek_next_param->progres;
                $aplok->status  = 'In Process';
                $aplok->save();
               //}

            ##save Ke Tabel Verifikasi
            Verifikasi::create(['fk_apply'=>$aplok->id, 'waktu'=>$request->waktu, 'status'=>"In Process",
                'maker'=> Auth::id(),'progres'=> $cek_next_param->progres]);#'note'      => "Antrian",#$request->note,
            // email notifikasi
            $user = User::where('id', $ver_awal->gt_fkapply->user_id)->get()->last();
            $ver_baru = Verifikasi::where('fk_apply', $request->cekid)->get()->last();
                $project = [
                    'greeting' => 'Hi '.$user->name.',',
                    'body' => 'Job Status',
                    'thanks' => 'Thank you this is from HRD PT.Anyar Group',
                    'actionText' => 'Your ' .$ver_awal->progres. ' Has ' .$ver_awal->status ,
                    'actionURL' => url('https://karir.anyargroup.co.id/login'),
                    'id' => $user->id
                ];
	    Notification::send($user, new EmailNotification($project));
	    return response()->json(['success' => true,
                'message' => 'Data Berhasil Disimpan!'], 200);
		#return redirect()->to('loker/listapply/'.$aplok->loker_id)->with(['success' => 'Data Berhasil Disimpan!']);
    }
    public function storereject(Request $request)
    {
        $this->validate($request, [
            'cekidreject' => 'required',
            'notereject'  => 'required',
            ]);
       
            $ayeuna = new DateTime( date('Y-m-d H:i:s') );
            $aplok = Apllyloker::findOrFail($request->cekidreject);
            $param = ParamVerifikasi::where('progres', $aplok->progres)->get()->last();
            $cek_level = $param->level;
            $cek_next_param = ParamVerifikasi::where('level', $cek_level)->get()->last();

            ##Ketika Update Level Sebelumnya
            $ver_awal = Verifikasi::where('fk_apply', $request->cekidreject)->get()->last();
            $ver_awal->status  = 'Rejected';
            $ver_awal->note    = $request->notereject;
            $ver_awal->save();

            $aplok->progres = $cek_next_param->progres;
            $aplok->status  = 'Rejected';
            $aplok->save();
            // email notifikasi
            $user = User::where('id', $ver_awal->gt_fkapply->user_id)->get()->last();
            $ver_baru = Verifikasi::where('fk_apply', $request->cekidreject)->get()->last();
                $project = [
                    'greeting' => 'Hi '.$user->name.',',
                    'body' => 'Job Status',
                    'thanks' => 'Thank you this is from HRD PT.Anyar Group',
                    'actionText' => 'Your ' .$ver_awal->progres. ' Has ' .$ver_awal->status ,
                    'actionURL' => url('https://karir.anyargroup.co.id/login'),
                    'id' => $user->id
                ];
	    Notification::send($user, new EmailNotification($project));
	    return response()->json(['success' => true,
                'message' => 'Data Berhasil Disimpan!'], 200);
            #return redirect()->to('loker/listapply/'.$aplok->loker_id)->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function createoffering($id)
    {
        $list =  Apllyloker::findOrFail($id);#Apllyloker::where('id', $id)->first();
        $param = ParamVerifikasi::where('progres', $list->progres)->get()->last();
        $cabs = Cabang::All();
        $jabats = Posisijob::All();
        $bags = Bagian::All();
        $leveljabatans = LevelJabatan::All();
        $idtea = $id;
        return view('verif.create_overing', compact('list','idtea','cabs','jabats','bags','leveljabatans'));
    }
    public function storeoffering(Request $request, $id)
    {
        $this->validate($request, [
		#untuk Status Verif
            'note'              => 'required',
            // #untuk Penawaran Kerja
            'nama'              => 'required',
            'upah'              => 'required',
            'keterangan'        => 'required',
            'status_kerja'      => 'required',
            'tanggal_masuk'     => 'required',
            'lain_lain'         => 'required',
            'fk_bagian'         => 'required',
            'fk_cabang'         => 'required',
	    'fk_level_jabatan'  => 'required',
	    'waktu'             => 'required',
            ]);
       
            $ayeuna = new DateTime( date('Y-m-d H:i:s') );
            $aplok = Apllyloker::where('id', $id)->first();#Apllyloker::findOrFail($id);
            $param = ParamVerifikasi::where('progres', $aplok->progres)->get()->last();
            $cek_level = $param->level + 1;
            $cek_next_param = ParamVerifikasi::where('level', $cek_level)->get()->last();
            PenawaranKerja::create([
              'nama'              => $request->nama,
              'upah'              => str_replace('.','',$request->upah), #$request->upah,
              'keterangan'        => $request->keterangan,
              'status_kerja'      => $request->status_kerja,
              'tanggal_masuk'     => $request->tanggal_masuk,
              'lain_lain'         => $request->lain_lain,
              'fk_apllyloker'     => $id,
              'fk_bagian'         => $request->fk_bagian,
              'fk_cabang'         => $request->fk_cabang,
              'fk_level_jabatan'  => $request->fk_level_jabatan,#$request->level_job,
	    ]);
	      ##Ketika Update Level Sebelumnya
              $ver_awal = Verifikasi::where('fk_apply', $id)->get()->last();
              #$ver_awal = Verifikasi::findorfail('fk_apply', $id);
              $ver_awal->status  = 'Approved';
              $ver_awal->note    = $request->note;
              $ver_awal->save();

	      $aplok->progres = $cek_next_param->progres;
              $aplok->status  = 'In Process';
              $aplok->save();
              ##save Ke Tabel Verifikasi
              Verifikasi::create(['fk_apply'=>$aplok->id, 'waktu'=>$request->waktu, 'status'=>"In Process",
  	        'maker'=> Auth::id(),'progres'=> $cek_next_param->progres]);

            // email notifikasi
            $user = User::where('id', $ver_awal->gt_fkapply->user_id)->get()->last();
            $ver_baru = Verifikasi::where('fk_apply', $request->cekidreject)->get()->last();
                $project = [
                    'greeting' => 'Hi '.$user->name.',',
                    'body' => 'Job Status',
                    'thanks' => 'Thank you this is from HRD PT.Anyar Group',
                    'actionText' => 'Your ' .$ver_awal->progres. ' Has ' .$ver_awal->status ,
                    'actionURL' => url('https://karir.anyargroup.co.id/login'),
                    'id' => $user->id
                ];
                Notification::send($user, new EmailNotification($project));
	  return redirect()->to('loker/listapply/'.$aplok->loker_id)->with(['success' => 'Data Berhasil Disimpan!']);
    }

    //Create Karyawan
    public function createemploye($id)
    {
        $list =  Apllyloker::findOrFail($id);#Apllyloker::where('id', $id)->first();
        $param = ParamVerifikasi::where('progres', $list->progres)->get()->last();
        $cabs = Cabang::All();
        $jabats = Posisijob::All();
        $bags = Bagian::All();
        $offering = PenawaranKerja::where('fk_apllyloker', $id)->get()->last();
        $leveljabatans = LevelJabatan::All();
        $idtea = $id;
        return view('verif.create_employe', compact('list','idtea','cabs','jabats','bags','offering','leveljabatans'));
    }
    public function storeemploye(Request $request, $id)
    {
        $this->validate($request, [
            #untuk Status Verif
            'status'            => 'required',
            'note'              => 'required',
            // #untuk Penawaran Kerja
            'nama'              => 'required',
            'upah'              => 'required',
            'keterangan'        => 'required',
            'status_kerja'      => 'required',
            'tanggal_masuk'     => 'required',
            'lain_lain'         => 'required',
            'fk_bagian'         => 'required',
            'fk_cabang'         => 'required',
            'fk_level_jabatan'  => 'required',
            'jenis_karyawan'    => 'required',
            ]);
       
            $ayeuna = new DateTime( date('Y-m-d H:i:s') );
            $aplok = Apllyloker::where('id', $id)->first();#Apllyloker::findOrFail($id);
            $param = ParamVerifikasi::where('progres', $aplok->progres)->get()->last();
            $cek_level = $param->level + 1;
            $cek_next_param = ParamVerifikasi::where('level', $cek_level)->get()->last();
            $caa = Cabang::where('id', $request->fk_cabang)->get()->last();
            $bagian = Bagian::where('id', $request->fk_bagian)->get()->last();
            $jab = LevelJabatan::where('id', $request->fk_level_jabatan)->get()->last();
            #Format NIK KARYAWAN
            #ch ; 1072.2172.6 -> Intern
            #ch ; 207221726 -> Ekstern
            #Digit Pertama 1/2 Kode Internal/ Eksternal
            #Digit kedua dan ketiga Kode Bulan Gabung
            #Digit keempat dan kelima Kode Tahun Gabung
            #Digit ke enam hingga sembilan No urut
            #kondisi In/Eks

            
            if ($request->jenis_karyawan == 'Internal') {          
               $kode = 1;
            }elseif ($request->jenis_karyawan ==  'Eksternal') {
               $kode = 2;
            }
            $getbln = $request->tanggal_masuk;
            $getthn = $request->tanggal_masuk;
            $bln = date("m", strtotime($getbln));
            $thn = date("y", strtotime($getthn));
            $get_no_urut = NourutNik::get()->first();
            $no_urut = $get_no_urut->nourut + 1;
            $nik= $kode.$thn.$bln.$no_urut;
            
                Karyawan::create([
                    'nomor_induk_karyawan'      => $nik,
                    'nama_lengkap'              => $aplok->pelamar->nama_lengkap,
                    'nama_panggilan'            => $aplok->pelamar->nama_lengkap,
                    'no_identitas'              => $aplok->pelamar->nik,
		    #'fk_tempat_lahir'           => 1,
		    'tempat_lahir'              => $aplok->pelamar->tempat_lahir,
                    'tgl_lahir'                 => $aplok->pelamar->tgl_lahir,
                    'agama'                     => $aplok->pelamar->agama,
                    'gender'                    => $aplok->pelamar->gender,
                    'status_pernikahan'         => $aplok->pelamar->status_pernikahan,
                    #'jenis_identitas'           => $aplok->pelamar->nama_lengkap,
                    #'masa_berlaku_identitas'    => $aplok->pelamar->nama_lengkap,
                    'alamat'                    => $aplok->pelamar->alamat,
                    'rt'                        => $aplok->pelamar->rt,
                    'rw'                        => $aplok->pelamar->rw,
                    'desa'                      => $aplok->pelamar->desa,
                    'kecamatan'                 => $aplok->pelamar->kecamatan,
                    'kota'                      => $aplok->pelamar->kota,
                    'provinsi'                  => $aplok->pelamar->provinsi,
                    'kodepos'                   => $aplok->pelamar->kodepos,
                    'status_rumah'              => $aplok->pelamar->status_rumah,
                    'no_hp'                     => $aplok->pelamar->no_hp,
                    'no_telp'                   => $aplok->pelamar->no_telp,
                    'photo'                     => $aplok->pelamar->photo,
                    'fk_cabang'                 => $request->fk_cabang,
                    #'fk_sub_bagian'            => $bagian->id,
                    'fk_level_jabatan'          => $jab->id,
                    'status_karyawan'           => $request->status_kerja,
                    'fk_nama_perusahaan'        => $caa->perusahaan->id,
                    'tahun_gabung'              => $request->tanggal_masuk, #$ayeuna,
                    #'tahun_keluar'              => $ayeuna,
                    'fk_user'                   => $aplok->user_id,
		    'jenis_karyawan'            => $request->jenis_karyawan,
		    'upah'		        => str_replace('.','',$request->upah),
		    'fk_bagian'			=>$request->fk_bagian,
                ]);
       
                $get_no_urut->update(['nourut' => $no_urut]);
                
                $ver_awal = Verifikasi::where('fk_apply', $id)->get()->last();
                #$ver_awal = Verifikasi::findorfail('fk_apply', $id);
                $ver_awal->status  = $request->status;
                $ver_awal->note    = $request->note;
                $ver_awal->save();

                $aplok->progres = $cek_next_param->progres;
                $aplok->status  = 'Finish';
                $aplok->save();
                ##save Ke Tabel Verifikasi
                ##ini Nanti Dikasi Konsisi Klo Aprove maka Create Kalo Reject Maka Jangan Create
                Verifikasi::create(['fk_apply'=>$aplok->id, 'waktu'=>$ayeuna, 'status'=>"In Process",
			'maker'=> Auth::id(),'progres'=> $cek_next_param->progres]);#'note'      => "Antrian",#$request->note,
            // email notifikasi
		$user = User::where('id', $ver_awal->gt_fkapply->user_id)->get()->last();
		$user->update(['status_user' => 'Karyawan']);
                $ver_baru = Verifikasi::where('fk_apply', $request->cekidreject)->get()->last();
                $project = [
                    'greeting' => 'Hi '.$user->name.',',
                    'body' => 'Job Status',
                    'thanks' => 'Thank you this is from HRD PT.Anyar Group',
                    'actionText' => 'Your ' .$ver_awal->progres. ' Has ' .$ver_awal->status ,
                    'actionURL' => url('https://karir.anyargroup.co.id/login'),
                    'id' => $user->id
                ];
                Notification::send($user, new EmailNotification($project));

	    return redirect()->to('loker/listapply/'.$aplok->loker_id)->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function detail($id)
    {
        //get List Loker
        $list = Apllyloker::where('id', $id)->get();
        
        return view('pelamar.detailpelamar', compact('list'));
    } 
    public function listapply($id)
    {
        //get List Loker
    }

    public function cetakol($id)
    {
        //get List Loker
        $data = PenawaranKerja::where('fk_apllyloker', $id)->get()->last();
        $pdf = \PDF::loadView('verif.olpdf', compact('data'));
        return $pdf->download('laporan-pdf.pdf');
        #return view('pelamar.detailpelamar', compact('list'));
    } 
}
