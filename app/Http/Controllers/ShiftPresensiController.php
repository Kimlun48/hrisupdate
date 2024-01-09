<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShiftPresensi;
use App\Imports\ShiftImport;
use App\Models\Presensi;
use App\Models\ParamPresensi;
use App\Models\Karyawan;
use App\Models\ParLevelJabatan;
use App\Models\Bagian;
use App\Models\LevelJabatan;
use Maatwebsite\Excel\Facades\Excel;
use DateTime;
use Auth;
use Maatwebsite\Excel\HeadingRowImport; #coba
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use App\Exports\ShiftExport;
use Illuminate\Support\Facades\Validator;
use App\Exports\EmployeeShiftExport;
use App\Exports\KehadiranEmployeeExport;
use App\Models\ChangeShift;
use App\Models\Cabang;

use Notification;
use App\Notifications\EmailApprovalNotification;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ShiftPresensiController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::now();
        $thn = $today->format('Y');
        $bln = $today->format('m');
        $start = $thn . '-' . $bln .'-'.'01';
        $end = date('Y-m-t'); ##Mendapatkan akhir bulan
        $bulanTahun = Carbon::now()->format('F Y');
        $bgn = Bagian::all();
        $jabs = LevelJabatan::all();
        $lvl = ParLevelJabatan::All();
        $cabang = Cabang::where('status','=','Aktif')->get();
        $employes = Karyawan::where('jenis_karyawan');            
        return view('shift.index', compact('bgn','jabs','lvl','cabang','employes','bulanTahun','start','end'));
    }

    
    public function read_data(Request $request)
    {
        // Pastikan $request->start dan $request->end adalah dalam format tanggal yang benar
        $startDate = Carbon::parse($request->start);
        $endDate = Carbon::parse($request->end);
        $dateRange = CarbonPeriod::create($startDate, $endDate);
        $length = $request->input('length', 10);
        $search = $request->input('search');
    
        // $shiftQuery = Karyawan::query();
        // dd($shiftQuery);
    
        if ($request->search) {
            // dd('ini search',$request->search);
            $shiftQuery = Presensi::join('karyawans', 'karyawans.id', '=', 'presensis.id_karyawan')
            ->whereBetween('presensis.tanggal', [$request->start,$request->end])
            ->where('karyawans.nama_lengkap', 'like', '%' . $request->search . '%')
            ->leftJoin('param_presensis', 'param_presensis.id', '=', 'presensis.id_parampresensi')
            ->select(
                'karyawans.nama_lengkap',
                'karyawans.nomor_induk_karyawan',
                'presensis.id',
                'presensis.id_parampresensi',
                'presensis.jam_masuk',
                'presensis.jam_pulang',
                DB::raw('COALESCE(param_presensis.jenis_shift, "Kosong") as shift')
            );
            // echo($shiftQuery->get());
            $shift = $shiftQuery
            ->paginate($length)
            ->withQueryString();
        // dd($shift);
        }
    

        $shift = Karyawan::where('nama_lengkap', 'like', '%' . $request->search . '%')
        ->paginate($length) // Menggunakan nilai "length" dalam metode paginasi
        ->withQueryString();

        $absen = Presensi::join('karyawans', 'karyawans.id', '=', 'presensis.id_karyawan')
            ->whereBetween('presensis.tanggal', [$startDate, $endDate])
            ->leftJoin('param_presensis', 'param_presensis.id', '=', 'presensis.id_parampresensi')
            ->select(
                'karyawans.nama_lengkap',
                'karyawans.nomor_induk_karyawan',
                'presensis.id',
                'presensis.id_parampresensi',
                'presensis.jam_masuk',
                'presensis.jam_pulang',
                DB::raw('COALESCE(param_presensis.jenis_shift, "Kosong") as shift')
            )
            ->get();
    
        return view('shift.read_data', compact('dateRange', 'shift', 'absen', 'search'));
    }
    


    public function search(Request $request)
    {
        $search = $request->input('search', ''); // Inisialisasi dengan nilai default ''
        $startDate = Carbon::parse($request->start);
        $endDate = Carbon::parse($request->end);
    
        $dateRange = CarbonPeriod::create($startDate, $endDate);
        $shiftQuery = Karyawan::query();
    
        if ($search) {
            $shiftQuery->where('nama_lengkap', 'like', '%' . $search . '%');
        }
    
        $shift = $shiftQuery->paginate(10); // Sesuaikan dengan jumlah yang Anda inginkan
    
        return view('shift.read_data', compact('shift'));
    }

    
    
    

    public function showedit($id)
    {
      $presensi = Presensi::findOrFail($id);
      $shift = ParamPresensi::All();
      return view('shift.modal.showedit', compact('presensi','shift'));
  
    }
    
    public function update(Request $request, $id)
    {
        // Validasi request jika diperlukan

        $presensi = Presensi::find($id);
        if (!$presensi) {
            return response()->json(['error' => 'Shift tidak ditemukan'], 404);
        }

        // Update data presensi
        $presensi->id_parampresensi = $request->input('shift_id');
        // Update kolom-kolom lain sesuai kebutuhan

        $presensi->save();

        return response()->json(['message' => 'shift updated successfully']);
    }

    public function exportExcel(Request $request)
    {
        $startDate = date('Y-m-d',strtotime($request->startDate));
        $endDate = date('Y-m-d',strtotime($request->endDate));      
        $shift = Karyawan::wherein('id',[1213,993,30])->get();
        $dateRange = CarbonPeriod::create($startDate, $endDate);
        // dd($dateRange);
        $absen = Presensi::join('karyawans', 'karyawans.id', '=', 'presensis.id_karyawan')
        ->whereBetween('presensis.tanggal', [$startDate,$endDate])
        ->leftJoin('param_presensis', 'param_presensis.id', '=', 'presensis.id_parampresensi')
        ->select(
            'karyawans.nama_lengkap',
            'karyawans.nomor_induk_karyawan',
            'presensis.id',
            'presensis.id_parampresensi',
            'presensis.jam_masuk',
            'presensis.jam_pulang',
            DB::raw('COALESCE(param_presensis.jenis_shift, "Kosong") as shift')
        )
        ->get();
        // dd($absen);
        return Excel::download(new EmployeeShiftExport($absen,$dateRange,$shift), 'employee_shift.xlsx');
    }

    public function shiftimport(Request $request)
    {
        $file = $request->file('file');
        $namaFile = $file->getClientOriginalName();
        $file->move('DataShift', $namaFile);

        Excel::import(new ShiftImport($file), public_path('/DataShift/' . $namaFile));
        return redirect()->route('shift.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function shiftexport(Request $request)
    {
        $this->validate($request, [
            'startdate' => 'required|min:5',
            'enddate' => 'required',
            'cabang' => 'required',
        ]);
        $startdate = $request->startdate;
        $enddate = $request->enddate;
        $cabang = $request->cabang;
        $thn = Carbon::now()->format('Y');
        $bln = Carbon::now()->format('m');
        // $blnskr = $thn . '-' . $bln . '-' . 21;
        // $blndepan = date('Y-m-20', strtotime('+1 month'));
        $blnskr = date($startdate);
        $blndepan = date($enddate);

        $dateRange = CarbonPeriod::create($blnskr, $blndepan);
        $shift =  Karyawan::where('fk_cabang', '=', $cabang)->get(); #all();
        $absen = Presensi::leftjoin('karyawans', 'karyawans.id', '=', 'presensis.id_karyawan')
            ->leftjoin('param_presensis', 'param_presensis.id', '=', 'presensis.id_parampresensi')
            ->where('karyawans.fk_cabang', '=', $cabang)
            ->whereBetween('tanggal', [$request->startdate, $request->enddate])
            ->orWhereNull('param_presensis.jenis_shift')
            ->get([
                'karyawans.nama_lengkap', 'karyawans.nomor_induk_karyawan',
                'presensis.id', 'presensis.id_parampresensi', 'param_presensis.jenis_shift'
            ]);
        return Excel::download(new ShiftExport($dateRange, $shift, $absen, $startdate, $enddate), 'Shift ' . $startdate . ' S.D ' . $enddate . '.xlsx');
    }


    public function shiftexportkehadiran(Request $request)
    {
        
        $this->validate($request, [
            'startdate' => 'required|min:5',
            'enddate' => 'required',
            'cabang' => 'required',
        ]);
        $startdate = $request->startdate;
        $enddate = $request->enddate;
        $cabang = $request->cabang;
        $thn = Carbon::now()->format('Y');
        $bln = Carbon::now()->format('m');
        // $blnskr = $thn . '-' . $bln . '-' . 21;
        // $blndepan = date('Y-m-20', strtotime('+1 month'));
        $blnskr = date($startdate);
        $blndepan = date($enddate);

        $dateRange = CarbonPeriod::create($blnskr, $blndepan);
        $shift =  Karyawan::with(['bagian','jabatan','jabatan.paramlevel'])->where('fk_cabang', '=', $cabang)->get(); #all();
        $absen = Presensi::leftjoin('karyawans', 'karyawans.id', '=', 'presensis.id_karyawan')
            ->leftjoin('param_presensis', 'param_presensis.id', '=', 'presensis.id_parampresensi')
            ->where('karyawans.fk_cabang', '=', $cabang)
            ->whereBetween('tanggal', [$request->startdate, $request->enddate])
            ->orWhereNull('param_presensis.jenis_shift')
            ->select([
                'karyawans.nama_lengkap', 'karyawans.nomor_induk_karyawan','karyawans.id',
                'presensis.id', 'presensis.id_parampresensi', 'presensis.presensi_status', 
                'param_presensis.jenis_shift', 'presensis.id_karyawan',
            ])->get();
        // dd($absen);
        // return response()->json($absen);
        return Excel::download(new KehadiranEmployeeExport($dateRange, $shift, $absen, $startdate, $enddate), 'kehadiran ' . $startdate . ' S.D ' . $enddate . '.xlsx');
    }


    public function index_shiftkar()
    {
        return view('shift.index_personal');
    }

    public function shiftkar()
    {
        $cekid = Auth::user()->getkaryawan->id;
        $thismonth = date('Y-m-20');
        $netxmonth = date('Y-m-21', strtotime('+1 month'));
        $thn = Carbon::now()->format('Y');
        $bln = Carbon::now()->format('m');
        $blnskr = $thn . '-' . $bln . '-' . 21;
        $blndepan = date('Y-m-20', strtotime('+1 month'));
        $dateRange = CarbonPeriod::create($blnskr, $blndepan);
        $data  = Presensi::leftjoin('karyawans', 'karyawans.id', '=', 'presensis.id_karyawan')
            ->leftjoin('param_presensis', 'param_presensis.id', '=', 'presensis.id_parampresensi')
            ->where('id_karyawan', '=', $cekid)
            ->whereBetween('tanggal', ['2022-12-21', '2023-01-20'])
            ->orWhereNull('param_presensis.jenis_shift')

            ->get([
                'karyawans.nama_lengkap', 'karyawans.nomor_induk_karyawan',
                'presensis.id', 'presensis.tanggal', 'presensis.id_parampresensi', 'param_presensis.jenis_shift'
            ]);
        return view('shift.list_shift_personal')->with(['data' => $data, 'dateRange' => $dateRange]);
    }

    public function karcreate()
    {
        $par = ParamPresensi::All();
        return view('shift.formchangeshift', compact('par'));
    }
    public function storechangeshift(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'startdate'     => 'required',
            'shift_awal'    => 'required',
            'enddate'       => 'required',
            'shift_akhir'   => 'required',
            'id_karyawan'   => 'required',
            'keterangan'    => 'required',
            #'tgl_off'      => 'required',
        ]);

        #$data['tanggal_awal']     = $request->startdate;
        #$data['shift_awal']       = $request->shift_awal;
        #$data['tanggal_akhir']    = $request->enddate;
        #$data['shift_akhir']      = $request->shift_akhir;
        #$data['keterangan']       = $request->keterangan;
        #$data['id_karyawan']      = $request->id_karyawan;
        #$data['status_approve']   = 'request';
        #ChangeShift::insert($data);

        $cekabsen1 = Presensi::where(['id_karyawan' => $request->id_karyawan, 'tanggal' => $request->startdate])->get()->last();
        $cekabsen2 = Presensi::where(['id_karyawan' => $request->id_karyawan, 'tanggal' => $request->enddate])->get()->last();
        if ($cekabsen1 == Null or $cekabsen2 == Null) {
            return response()->json([
                'message' => 'Absen Tidak Ada atau Belum Terdaftar!! ',
                'code' => 'Error'
            ], 400);
        }
        if ($cekabsen1 != Null and $cekabsen2 != Null) {

            $data['tanggal_awal']     = $request->startdate;
            $data['shift_awal']       = $request->shift_awal;
            $data['tanggal_akhir']    = $request->enddate;
            $data['shift_akhir']      = $request->shift_akhir;
            $data['keterangan']       = $request->keterangan;
            $data['id_karyawan']      = $request->id_karyawan;
            if ($request->tgl_off) {
                $cekoff = ParamPresensi::where(['jenis_shift' => 'Off'])->get()->last();
                $data['tanggal_off']    = $request->tgl_off;
                $data['shift_off']      = $cekoff->id;
            }
            $data['status_approve']   = 'request';
            ChangeShift::insert($data);
            return response()->json(['message' => 'Request Change Shift Berhasil!! ', 'code' => 'success'], 200);
        }
    }



    // public function requestshift() {
    //     $cekid = Auth::user()->getkaryawan->id;
    //     #$data = ChangeShift::where('id_karyawan', $cekid)->orderBy('id', 'DESC')->get();

    //     $data  = ChangeShift::leftjoin('karyawans', 'karyawans.id', '=', 'change_shifts.id_karyawan')
    //     ->leftjoin('param_presensis as s_awal','s_awal.id','=','change_shifts.shift_awal')
    //     ->leftjoin('param_presensis as s_akhir','s_akhir.id','=','change_shifts.shift_akhir')
    //     ->where('id_karyawan', '=', $cekid )
    //     #->orWhereNull('s_awal.jenis_shift')
    //     ->get(['karyawans.nama_lengkap', 'karyawans.nomor_induk_karyawan',
    //     'change_shifts.id','change_shifts.tanggal_akhir', 'change_shifts.status_approve',
    //     'change_shifts.tanggal_awal','s_awal.jenis_shift as shift_awal','s_akhir.jenis_shift as shift_akhir']);
    //     return view('shift.request')->with(['data'=>$data]);
    // }

    public function requestshift()
    {
        $cekid = Auth::user()->getkaryawan->id;
        
        $data = ChangeShift::where('id_karyawan', $cekid)
            ->orderBy('id', 'DESC')
            ->get([
                'id', 'tanggal_akhir', 'status_approve', 'tanggal_awal', 'shift_awal', 'shift_akhir','keterangan'
            ]);

        return view('shift.request')->with(['data' => $data]);
    }


    public function approvalreqshift()
    {
        $cekid = Auth::user()->getkaryawan->fk_level_jabatan;
        #$data = ChangeShift::where('id_karyawan', $cekid)->orderBy('id', 'DESC')->get();

        $data  = ChangeShift::leftjoin('karyawans', 'karyawans.id', '=', 'change_shifts.id_karyawan')
            ->leftjoin('param_presensis as s_awal', 's_awal.id', '=', 'change_shifts.shift_awal')
            ->leftjoin('param_presensis as s_akhir', 's_akhir.id', '=', 'change_shifts.shift_akhir')
            ->leftjoin('level_jabatans', 'level_jabatans.id', '=', "karyawans.fk_level_jabatan")
            ->where("level_jabatans.parent_id", "=", $cekid)
            ->where("status_approve", "=", 'request')
            #->where('id_karyawan', '=', $cekid )
            #->orWhereNull('s_awal.jenis_shift')
            ->get([
                'karyawans.nama_lengkap', 'karyawans.nomor_induk_karyawan',
                'change_shifts.id', 'change_shifts.tanggal_akhir', 'change_shifts.status_approve',
                'change_shifts.tanggal_awal', 'change_shifts.keterangan',
                's_awal.jenis_shift as shift_awal', 's_akhir.jenis_shift as shift_akhir'
            ]);
        #dd($data);
        return view('shift.list_approve_reject')->with(['data' => $data]);
    }

    
    public function approvalreqshift_admin()
    {
        $cekid = Auth::user();
        $data  = ChangeShift::leftjoin('karyawans', 'karyawans.id', '=', 'change_shifts.id_karyawan')
            ->leftjoin('param_presensis as s_awal', 's_awal.id', '=', 'change_shifts.shift_awal')
            ->leftjoin('param_presensis as s_akhir', 's_akhir.id', '=', 'change_shifts.shift_akhir')
            ->leftjoin('level_jabatans', 'level_jabatans.id', '=', "karyawans.fk_level_jabatan")
            ->where("status_approve", "=", 'request')
            ->get([
                'karyawans.nama_lengkap', 'karyawans.nomor_induk_karyawan',
                'change_shifts.id', 'change_shifts.tanggal_akhir', 'change_shifts.status_approve',
                'change_shifts.tanggal_awal', 'change_shifts.keterangan',
                's_awal.jenis_shift as shift_awal', 's_akhir.jenis_shift as shift_akhir'
            ]);
        return view('shift.list_approve_reject')->with(['data' => $data]);
    }

    public function log_changeshift_approve()
    {
        $cekid = Auth::user();
        $data  = ChangeShift::leftjoin('karyawans', 'karyawans.id', '=', 'change_shifts.id_karyawan')
            ->leftjoin('param_presensis as s_awal', 's_awal.id', '=', 'change_shifts.shift_awal')
            ->leftjoin('param_presensis as s_akhir', 's_akhir.id', '=', 'change_shifts.shift_akhir')
            ->leftjoin('level_jabatans', 'level_jabatans.id', '=', "karyawans.fk_level_jabatan")
            ->where("status_approve", "=", 'approve')
            ->get([
                'karyawans.nama_lengkap', 'karyawans.nomor_induk_karyawan',
                'change_shifts.id', 'change_shifts.tanggal_akhir', 'change_shifts.status_approve',
                'change_shifts.tanggal_awal', 'change_shifts.keterangan',
                's_awal.jenis_shift as shift_awal', 's_akhir.jenis_shift as shift_akhir'
            ]);
        return view('reqattend.log_history.changeshift_approve')->with(['data' => $data]);
    }


    public function log_changeshift_reject()
    {
        $cekid = Auth::user();
        $data  = ChangeShift::leftjoin('karyawans', 'karyawans.id', '=', 'change_shifts.id_karyawan')
            ->leftjoin('param_presensis as s_awal', 's_awal.id', '=', 'change_shifts.shift_awal')
            ->leftjoin('param_presensis as s_akhir', 's_akhir.id', '=', 'change_shifts.shift_akhir')
            ->leftjoin('level_jabatans', 'level_jabatans.id', '=', "karyawans.fk_level_jabatan")
            ->where("status_approve", "=", 'reject')
            ->get([
                'karyawans.nama_lengkap', 'karyawans.nomor_induk_karyawan',
                'change_shifts.id', 'change_shifts.tanggal_akhir', 'change_shifts.status_approve',
                'change_shifts.tanggal_awal', 'change_shifts.keterangan',
                's_awal.jenis_shift as shift_awal', 's_akhir.jenis_shift as shift_akhir'
            ]);
        return view('reqattend.log_history.changeshift_reject')->with(['data' => $data]);

    }


    

    public function showupdate($id)
    {
        $data = ChangeShift::findorfail($id);
        return view('shift.approve')->with(['data' => $data]);
    }

    // Simpan data Approve
    public function approve(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'stsapp'        => 'required',
            'id_karyawan'   => 'required',
            'notes'         => 'required',
        ]);

        $tanggal = Carbon::now()->format('Y-m-d');
        $data = ChangeShift::findorfail($id);
        $data->notes = $request->notes;
        $data->status_approve = $request->stsapp;
        $data->tanggal_approve = $tanggal;

        ##tamabahan Ke presensi
        $cekabsen1 = Presensi::where(['id_karyawan' => $data->id_karyawan, 'tanggal' => $data->tanggal_awal])->get()->last();
        $cekabsen2 = Presensi::where(['id_karyawan' => $data->id_karyawan, 'tanggal' => $data->tanggal_akhir])->get()->last();
        $shift1 = $data->shift_awal;
        $shift2 = $data->shift_akhir;
        $prsn1 = $cekabsen1->update(['id_parampresensi' => $shift1]);
        $prsn2 = $cekabsen2->update(['id_parampresensi' => $shift2]);
        $data->save();
        if ($data->tgl_off) {
            $cekoff = ParamPresensi::where(['id' => $data->shift_off])->get()->last();
            $cekabsen3 = Presensi::where(['id_karyawan' => $data->id_karyawan, 'tanggal' => $data->tanggal_off])->get()->last();
            $cekabsen3->update(['id_parampresensi' => $cekoff->id]);
        }
        $kar = Karyawan::findOrFail($data->id_karyawan);
        $status = ChangeShift::where('status_approve', $data->status_approve)->where('id_karyawan', $data->id_karyawan)->latest()->get();
        // Send Notif E-Mail
        $reqattend = [
            'greeting' => 'Dear ' . $kar->nama_lengkap . ',',
            'body' => 'Your Request for Change Shift from ' . Carbon::create($data->tanggal_awal)->format('d F Y') . ' to ' . Carbon::create($data->tanggal_akhir)->format('d F Y,'),
            'thanks' => 'Have a Wonderful Day  ',
            'actionText' => 'Has Been Approved',
            'actionURL' => url('https://hris.anyargroup.co.id/login'),
            #'id' => $user->id
        ];
        Notification::send($kar, new EmailApprovalNotification($reqattend));
        return response()->json(['message' => 'Request Change Shift Approved !', 'code' => '200'], 200);
    }
    // Tampilkan data reject
    public function showreject($id)
    {
        $data = ChangeShift::findorfail($id);
        return view('shift.reject')->with(['data' => $data]);
    }

    // Simpan data reject
    public function reject(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'stsapp'        => 'required',
            'id_karyawan'   => 'required',
            'notes'         => 'required',
        ]);

        $tanggal = Carbon::now()->format('Y-m-d');

        $data = ChangeShift::findorfail($id);
        $data->notes = $request->notes;
        $data->status_approve = $request->stsapp;
        $data->tanggal_approve = $tanggal;

        $data->save();
        $kar = Karyawan::findOrFail($data->id_karyawan);
        $status = ChangeShift::where('status_approve', $data->status_approve)->where('id_karyawan', $data->id_karyawan)->latest()->get();
        // Send Notif E-Mail
        $reqattend = [
            'greeting' => 'Dear ' . $kar->nama_lengkap . ',',
            'body' => 'Your Request for Change Shift from ' . Carbon::create($data->tanggal_awal)->format('d F Y') . ' to ' . Carbon::create($data->tanggal_akhir)->format('d F Y,'),
            'thanks' => 'Have a Wonderful Day  ',
            'actionText' => 'Has Been Rejected',
            'actionURL' => url('https://hris.anyargroup.co.id/login'),
            #'id' => $user->id
        ];
        Notification::send($kar, new EmailApprovalNotification($reqattend));
        return response()->json(['message' => 'Request Change Shift Rejected !', 'code' => '200'], 200);
    }

    public function shiftExportKehadiranSyis(Request $request)
    {
        
        // $this->validate($request, [
        //     'startdate' => 'required|min:5',
        //     'enddate' => 'required',
        //     'cabang' => 'required',
        // ]);

        $startdate = date('2023-12-21');
        $enddate =  date('2024-01-20');
        $cabang = [73,71,72,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,98];
        // receipt:no_kupon,image,signature
        return response()->json(
            // Cabang::whereIn('id', $cabang)->get(),
            Karyawan::with([
                'karyawanWithPresensi'  => fn($query) => 
                    $query->whereBetween('tanggal',[$startdate, $enddate])
            ])
            ->whereHas('karyawanWithPresensi', fn($query) => $query->whereBetween('tanggal',[$startdate, $enddate]))
            ->limit(100)->
            // get(),
            get([
                'id',
                'nomor_induk_karyawan',
                'nama_lengkap',
                'fk_cabang',
                'fk_bagian',
                'fk_level_jabatan',
            ]),
        );


        $dateRange = CarbonPeriod::create($startdate, $enddate);
        $shift = Karyawan::with(['bagian','jabatan','jabatan.paramlevel','karpres'])
        ->whereHas('karpres', function($query) use ($startdate, $enddate) {
            $query->whereBetween('tanggal', [$startdate, $enddate]);
        })
        // ->where('fk_cabang', '=', $request->cabang)
        // ->whereIn('fk_cabang', $cabang)
        ->get();

        return response()->json($shift);
        
        $absen = Presensi::leftjoin('karyawans', 'karyawans.id', '=', 'presensis.id_karyawan')
            ->leftjoin('param_presensis', 'param_presensis.id', '=', 'presensis.id_parampresensi')
            ->where('karyawans.fk_cabang', '=', $request->cabang)
            ->whereBetween('tanggal', [$request->startdate, $request->enddate])
            ->orWhereNull('param_presensis.jenis_shift')
            ->select([
                'karyawans.nama_lengkap', 'karyawans.nomor_induk_karyawan','karyawans.id',
                'presensis.id', 'presensis.id_parampresensi', 'presensis.presensi_status', 
                'param_presensis.jenis_shift', 'presensis.id_karyawan',
            ])->get();
        
        return Excel::download(new KehadiranEmployeeExport($dateRange, $shift, $absen, $startdate, $enddate), 'kehadiran ' . $startdate . ' S.D ' . $enddate . '.xlsx');
    }

}
