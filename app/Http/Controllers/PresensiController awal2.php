<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\PresensiResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Presensi;
use App\Models\Karyawan;
use App\Models\Cabang;
use App\Models\Bagian;
use App\Models\LevelJabatan;
use App\Models\User;
use App\Imports\KaryawansImport;
use Maatwebsite\Excel\Facades\Excel;
use DateTime;
use Auth;
use Carbon\Carbon;
use App\Exports\PelamarExport;
use App\Exports\PresensisExport;
use Intervention\Image\Facades\Image;
use Storage;



class PresensiController extends Controller
{
    public function index(Request $request)
    {
      $karyawan = Karyawan::count();
      $skr = Carbon::now()->toDateString();
      $date_now = new DateTime(date('Y-m-d'));
      $karyawan_masuk = Presensi::whereDate('tanggal','=',$skr)->whereIn('presensi_status',['EarlyIn','Late','OnTime'])->count();
      $earlyin = Presensi::whereDate('tanggal','=',$skr)->where('presensi_status', '=', 'EarlyIn')->count();
      // $ontime = Presensi::whereDate('tanggal','=',$skr)->where('presensi_status', '=', 'OnTime')->count();
      $ontime = Presensi::whereDate('tanggal', '=', $skr)
                     ->where('presensi_status', '=', 'OnTime')
                     ->whereTime('jam_masuk', '>=', '08:00:00')
                     ->whereTime('jam_masuk', '<=', '08:00:59')
                     ->count();
      $late = Presensi::whereDate('tanggal','=',$skr)->where('presensi_status', '=', 'Late')->count();
      $attend = Presensi::whereDate('tanggal','=',$skr)->whereNotNull('jam_masuk')->count();
      $timeoff = Presensi::whereDate('tanggal','=',$skr)->where('presensi_status','=','TimeOff')->count();
      $dayoff = Presensi::whereDate('tanggal','=',$skr)->where('presensi_status','=','DayOff')->count();
      $absen = Presensi::whereDate('tanggal','=',$skr)->whereNull('presensi_status')->count();
      $noclockin = Presensi::whereDate('tanggal','=',$skr)->whereNull('jam_masuk')->count();
      $noclockout = Presensi::whereDate('tanggal','=',$skr)->whereNull('jam_pulang')->count();
      //$timeoff = Presensi::whereDate('tanggal','=',$skr)->whereIn('keterangan', ['CUTI', 'IJIN', 'SAKIT'])->count();
      $cabang = Cabang::get();
      $jabs = LevelJabatan::all();
      $bgn = Bagian::All();
      $selectedDate = $skr;

      
    // Check if 'inputtanggal' parameter is present in the request
    if ($request->has('inputtanggal')) {
        $selectedDate = $request->inputtanggal; // Get the selected date from the input field

        // Modify the queries to filter data based on the selected date
        $karyawan_masuk = Presensi::whereDate('tanggal', '=', $selectedDate)
            ->whereIn('presensi_status', ['EarlyIn', 'Late', 'OnTime'])
            ->count();
        $earlyin = Presensi::whereDate('tanggal', '=', $selectedDate)
            ->where('presensi_status', '=', 'EarlyIn')
            ->count();
        $ontime = Presensi::whereDate('tanggal', '=', $selectedDate)
            ->where('presensi_status', '=', 'OnTime')
            ->whereTime('jam_masuk', '>=', '08:00:00')
            ->whereTime('jam_masuk', '<=', '08:00:59')
            ->count();
        $late = Presensi::whereDate('tanggal', '=', $selectedDate)
            ->where('presensi_status', '=', 'Late')
            ->count();
        $attend = Presensi::whereDate('tanggal', '=', $selectedDate)
            ->whereNotNull('jam_masuk')
            ->count();
        $timeoff = Presensi::whereDate('tanggal', '=', $selectedDate)
            ->where('presensi_status', '=', 'TimeOff')
            ->count();
        $dayoff = Presensi::whereDate('tanggal', '=', $selectedDate)
            ->where('presensi_status', '=', 'DayOff')
            ->count();
        $absen = Presensi::whereDate('tanggal', '=', $selectedDate)
            ->whereNull('presensi_status')
            ->count();
        $noclockin = Presensi::whereDate('tanggal', '=', $selectedDate)
            ->whereNull('jam_masuk')
            ->count();
        $noclockout = Presensi::whereDate('tanggal', '=', $selectedDate)
            ->whereNull('jam_pulang')
            ->count();

        // Update the existing queries to filter data based on the selected date
        $krs = Presensi::whereDate('tanggal', '=', $selectedDate)
            ->whereHas('preskaryawan', function ($query) use ($request) {
                $query->where('nama_lengkap', 'like', '%' . $request->cabang . '%')
                    ->orWhere('nomor_induk_karyawan', 'like', '%' . $request->cabang . '%');
            })
            ->get();

        $prs = Presensi::whereDate('tanggal', '=', $selectedDate)
            ->whereHas('preskaryawan', function ($query) use ($request) {
                $query->where('nama_lengkap', 'like', '%' . $request->search . '%')
                    ->orWhere('nomor_induk_karyawan', 'like', '%' . $request->search . '%');
            })
            ->with(['parampresensi' => function ($query) {
                $query;
            }])
            ->orWhereHas('preskaryawan.jabatan', function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->search . '%');
            })
            ->with(['preskaryawan.bagian' => function ($query) {
                $query;
            }])
            ->orWhereHas('preskaryawan.cabang', function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->search . '%');
            })
            ->paginate(20)->withQueryString();

        // Return the view with the filtered data
        return view('presensi.index', compact('jabs','absen','noclockin','noclockout', 'bgn', 'krs', 'prs', 'karyawan', 'karyawan_masuk', 'ontime', 'earlyin', 'late', 'attend', 'timeoff', 'dayoff', 'cabang', 'skr', 'selectedDate'));
    }
    
     

      if ($request->has('search')) {
        $krs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
                ->whereHas('preskaryawan', function ($query) use ($request){
              $query->where('nama_lengkap', 'like', '%'.$request->cabang.'%')
              ->orwhere('nomor_induk_karyawan', 'like', '%'.$request->cabang.'%');});

        $prs = Presensi::whereDate('tanggal','=',$skr)->whereHas('preskaryawan', function ($query) use ($request){
          $query->where('nama_lengkap', 'like', '%'.$request->search.'%')
                ->orwhere('nomor_induk_karyawan', 'like', '%'.$request->search.'%');})
                ->with(['parampresensi' => function($query){
                $query;}])
                ->orwhereHas('preskaryawan.jabatan', function ($query) use ($request){
                  $query->where('nama', 'like', '%'.$request->search.'%');
                  })
                ->with(['preskaryawan.bagian' => function($query){
                $query;}])
                ->orwhereHas('preskaryawan.cabang', function ($query) use ($request){
                $query->where('nama', 'like', '%'.$request->search.'%');
                })->paginate(20)->withQueryString();
            return view('presensi.index', compact('jabs','bgn','krs','prs', 'karyawan', 'karyawan_masuk', 'ontime', 'earlyin', 'late', 'attend', 'timeoff', 'dayoff', 'cabang'));
        }


      if ($request->has('report')) {
        $this->validate($request, [
        'cabang' => 'required',
        'format'=> 'required',
        'startdate'=> 'required',
        'enddate'=> 'required',
        #'cari'=> 'required',
        

        ]);

        if(empty($request->cari) && $request->format=='view' ){ 
          
        $cabs = Cabang::All();
        
        $start_date = $request->startdate;
        $end_date = $request->enddate;
        $krs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
              ->whereHas('preskaryawan', function ($query) use ($request){
              $query->where('nama_lengkap', 'like', '%'.$request->cabang.'%')
              ->orWhere('nomor_induk_karyawan', 'like', '%'.$request->cabang.'%');});
              
        $prs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
          ->whereHas('preskaryawan', function ($query) use ($request){
          $query->where('fk_cabang','=', $request->cabang)
          ;})
          ->with(['parampresensi' => function($query){
          $query;}])
          ->with(['preskaryawan.jabatan' => function($query){
          $query;}])
          ->with(['preskaryawan.bagian' => function($query){
          $query;}])
          ->with(['preskaryawan.cabang' => function($query){
          $query;}])
          
          ->paginate(20)->withQueryString();
          
        }

        if(!empty($request->cari) && $request->format=='view' ){
        // if($request->format=='view'){    
            $cabs = Cabang::All();
            $start_date = $request->startdate;
            $end_date = $request->enddate;
            $krs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
                  ->whereHas('preskaryawan', function ($query) use ($request){
                  $query->where('nama_lengkap', 'like', '%'.$request->cabang.'%')
                  ->orWhere('nomor_induk_karyawan', 'like', '%'.$request->cabang.'%');});
              $prs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
              ->whereHas('preskaryawan', function ($query) use ($request){
              $query->where('fk_cabang','=', $request->cabang)
              ->where('nama_lengkap','=', $request->cari)
              ;})
              ->with(['parampresensi' => function($query){
              $query;}])
              ->with(['preskaryawan.jabatan' => function($query){
              $query;}])
              ->with(['preskaryawan.bagian' => function($query){
              $query;}])
              ->with(['preskaryawan.cabang' => function($query){
              $query;}])
              ->paginate(20)->withQueryString();
          } 
        #tanpa nama
        if(empty($request->cari) && $request->format=='excel' ){
        // if($request->format=='view'){    
        $cabs = Cabang::All();
        $start_date = $request->startdate;
        $end_date = $request->enddate;
        $krs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
            ->whereHas('preskaryawan', function ($query) use ($request){
            $query->where('nama_lengkap', 'like', '%'.$request->cabang.'%')
            ->orWhere('nomor_induk_karyawan', 'like', '%'.$request->cabang.'%');});
        $prs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
        ->whereHas('preskaryawan', function ($query) use ($request){
        $query->where('fk_cabang','=', $request->cabang)
        ;})
        ->with(['parampresensi' => function($query){
        $query;}])
        ->with(['preskaryawan.jabatan' => function($query){
        $query;}])
        ->with(['preskaryawan.bagian' => function($query){
        $query;}])
        ->with(['preskaryawan.cabang' => function($query){
        $query;}])
        ->get();
  
        return (new PresensisExport($cabang,$prs,$start_date,$end_date))->download('presensi_karyawan.xlsx');#membuat excel
       }
       #dengan nama cari
        if(!empty($request->cari) && $request->format=='excel' ){
        // if($request->format=='view'){    
          $cabs = Cabang::All();
          $start_date = $request->startdate;
          $end_date = $request->enddate;
          $krs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
                ->whereHas('preskaryawan', function ($query) use ($request){
                $query->where('nama_lengkap', 'like', '%'.$request->cabang.'%')
                ->orWhere('nomor_induk_karyawan', 'like', '%'.$request->cabang.'%');});
            $prs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
            ->whereHas('preskaryawan', function ($query) use ($request){
            $query->where('fk_cabang','=', $request->cabang)
            ->where('nama_lengkap','=', $request->cari)
            ;})
            ->with(['parampresensi' => function($query){
            $query;}])
            ->with(['preskaryawan.jabatan' => function($query){
            $query;}])
            ->with(['preskaryawan.bagian' => function($query){
            $query;}])
            ->with(['preskaryawan.cabang' => function($query){
            $query;}])
            ->get();
        return (new PresensisExport($cabang,$prs,$start_date,$end_date))->download('presensi_karyawan.xlsx');#membuat excel
        }
        #tanpa cari nama
        if(empty($request->cari) && $request->format=='pdf' ){
        // if($request->format=='view'){    
            $cabs = Cabang::All();
            $start_date = $request->startdate;
            $end_date = $request->enddate;
            $krs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
                  ->whereHas('preskaryawan', function ($query) use ($request){
                  $query->where('nama_lengkap', 'like', '%'.$request->cabang.'%')
                  ->orWhere('nomor_induk_karyawan', 'like', '%'.$request->cabang.'%');});
              $prs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
              ->whereHas('preskaryawan', function ($query) use ($request){
              $query->where('fk_cabang','=', $request->cabang)
              ;})
              ->with(['parampresensi' => function($query){
              $query;}])
              ->with(['preskaryawan.jabatan' => function($query){
              $query;}])
              ->with(['preskaryawan.bagian' => function($query){
              $query;}])
              ->with(['preskaryawan.cabang' => function($query){
              $query;}])
              ->get();
    
          $pdf = \PDF::loadView('presensi.report_presensi', compact('jabs','bgn','krs','prs','cabang','start_date','end_date'))->setPaper('a4', 'landscape');
          return $pdf->stream('data_presensi_karyawan.pdf');
        }
        
        if(!empty($request->cari) && $request->format=='pdf' ){
          // if($request->format=='view'){    
              $cabs = Cabang::All();
              $start_date = $request->startdate;
              $end_date = $request->enddate;
              $krs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
                    ->whereHas('preskaryawan', function ($query) use ($request){
                    $query->where('nama_lengkap', 'like', '%'.$request->cabang.'%')
                    ->orWhere('nomor_induk_karyawan', 'like', '%'.$request->cabang.'%');});
                $prs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
                ->whereHas('preskaryawan', function ($query) use ($request){
                $query->where('fk_cabang','=', $request->cabang)
                ->where('nama_lengkap','=', $request->cari)
                ;})
                ->with(['parampresensi' => function($query){
                $query;}])
                ->with(['preskaryawan.jabatan' => function($query){
                $query;}])
                ->with(['preskaryawan.bagian' => function($query){
                $query;}])
                ->with(['preskaryawan.cabang' => function($query){
                $query;}])
                ->get();
      
            $pdf = \PDF::loadView('presensi.report_presensi', compact('jabs','bgn','krs','prs','cabang','start_date','end_date'))->setPaper('a4', 'landscape');
            return $pdf->stream('data_presensi_karyawan.pdf');
          }
      

      }

    else{
            $skr = Carbon::now()->toDateString();
            $prs = Presensi::whereDate('tanggal','=',$skr)->with(['preskaryawan' => function($query){
            $query;}])
            ->with(['parampresensi' => function($query){
            $query;}])
            ->with(['preskaryawan.jabatan' => function($query){
            $query;}])
            ->with(['preskaryawan.bagian' => function($query){
            $query;}])
            ->with(['preskaryawan.cabang' => function($query){
            $query;}])->paginate(20);

            $krs = Presensi::whereDate('tanggal','=',$skr)->with(['preskaryawan' => function($query){
              $query;}])->get();
            
              session(['nama-datalist' => $krs]);

            return view('presensi.index', compact('noclockin', 'selectedDate','noclockout','absen','jabs','bgn','krs','prs','skr','date_now', 'karyawan', 'karyawan_masuk', 'ontime', 'earlyin', 'late', 'attend', 'timeoff', 'dayoff', 'cabang'));
    }

      return view('presensi.index', compact('noclockin', 'selectedDate','noclockout','absen','jabs','bgn','krs','prs','skr', 'karyawan', 'karyawan_masuk', 'ontime', 'earlyin', 'late', 'attend', 'timeoff', 'dayoff', 'cabang'));
    }

   	public function jarakabsen() {
    $nik = '105221372';
    $id_karyawan = Karyawan::where('nomor_induk_karyawan', $nik)->get()->last();
    $cek_radius = doubleval($id_karyawan->cabang->radius);
		$unit = $id_karyawan->cabang->satuan_radius;
		$cek_lat_cabang = $id_karyawan->cabang->latitude;
		$cek_lon_cabang = $id_karyawan->cabang->longitude;
		#$unit = 'miles';
    ###HITUNG JARAK AWAL
    // $latitude1  = -6.925254943306605; ###Posisi Absen
    // $longitude1 = 107.64630506836477; ###Posisi Absen

    $latitude1  = -6.907494466463305;#-6.912213466463305; ###Posisi Absen
    $longitude1 = 107.61666568555326;#107.63702538555326; ###Posisi Absen
    
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
    // dd(round($distance,2));
		return (round($distance,2)); 
	}

  public function detailspresensi(Request $request, $id)
  {
      // Mendapatkan tanggal hari ini dan konversi ke format tanggal (Y-m-d)
      $skr = Carbon::now()->toDateString();
      $karyawan = Karyawan::count();
      $karyawan_masuk = Presensi::whereDate('tanggal', '=', $skr)->whereIn('presensi_status', ['EarlyIn', 'Late', 'OnTime'])->count();
      $earlyin = Presensi::whereDate('tanggal', '=', $skr)->where('presensi_status', '=', 'EarlyIn')->count();
      // $ontime = Presensi::whereDate('tanggal','=',$skr)->where('presensi_status', '=', 'OnTime')->count();
      $ontime = Presensi::whereDate('tanggal', '=', $skr)
                      ->where('presensi_status', '=', 'OnTime')
                      ->whereTime('jam_masuk', '>=', '08:00:00')
                      ->whereTime('jam_masuk', '<=', '08:00:59')
                      ->count();
      $late = Presensi::whereDate('tanggal', '=', $skr)->where('presensi_status', '=', 'Late')->count();
      $attend = Presensi::whereDate('tanggal', '=', $skr)->whereNotNull('jam_masuk')->count();
      $timeoff = Presensi::whereDate('tanggal', '=', $skr)->where('presensi_status', '=', 'TimeOff')->count();
      $dayoff = Presensi::whereDate('tanggal', '=', $skr)->where('presensi_status', '=', 'DayOff')->count();
      $absen = Presensi::whereDate('tanggal', '=', $skr)->whereNull('presensi_status')->count();
      $noclockin = Presensi::whereDate('tanggal', '=', $skr)->whereNull('jam_masuk')->count();
      $noclockout = Presensi::whereDate('tanggal', '=', $skr)->whereNull('jam_pulang')->count();
      //$timeoff = Presensi::whereDate('tanggal','=',$skr)->whereIn('keterangan', ['CUTI', 'IJIN', 'SAKIT'])->count();
      $cabang = Cabang::get();
      $jabs = LevelJabatan::all();
      $bgn = Bagian::all();
      $employ = Karyawan::all();

      //Test
      if (Carbon::now()->format('d') < 21) { 
          $awal = Carbon::now()->subMonth()->format('Y-m-21'); 
          $akhir =  Carbon::now()->format('Y-m-20'); } 
      else { 
        $awal =  Carbon::now()->format('Y-m-21'); 
        $akhir = Carbon::now()->addMonth()->format('Y-m-20'); }

      $presensiKaryawan = Presensi::where('id_karyawan', $id)->whereBetween('tanggal', [$awal, $akhir])
          ->with('preskaryawan')->with('parampresensi')
        ->with('preskaryawan.jabatan')->with('preskaryawan.bagian')
        ->with('preskaryawan.cabang')
          ->get();
      // $presensiKaryawan = Presensi::where('id_karyawan',$id)->whereBetween('tanggal',[$awal, $akhir])->get();
  
    return view('presensi.detailindex', compact('employ','noclockin', 'presensiKaryawan', 'noclockout', 'absen', 'jabs', 'bgn', 'skr', 'karyawan', 'karyawan_masuk', 'ontime', 'earlyin', 'late', 'attend', 'timeoff', 'dayoff', 'cabang'));
  }

  // public function editpresensi(Request $request, $id)
  // {
  //     try {
  //         // Ambil data presensi berdasarkan ID
  //         $presensi = Presensi::findOrFail($id);
  
  //         // Lakukan validasi data dari form edit
  //         $request->validate([
  //             'clockIn' => 'required|date_format:H:i', // Format jam (HH:mm)
  //             'clockOut' => 'required|date_format:H:i', // Format jam (HH:mm)
  //         ]);
  
  //         // Simpan perubahan pada data presensi
  //         $presensi->jam_masuk = date('Y-m-d') . ' ' . $request->input('clockIn') . ':00';
  //         $presensi->jam_pulang = date('Y-m-d') . ' ' . $request->input('clockOut') . ':00';
  //         $presensi->save();
  
  //         // Kirim respons JSON sebagai konfirmasi berhasil
  //         return response()->json(['message' => 'Data presensi berhasil diperbarui.']);
  //     } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
  //         // Data tidak ditemukan
  //         return response()->json(['message' => 'Data presensi tidak ditemukan.'], 404);
  //     } catch (\Exception $e) {
  //         // Penanganan kesalahan lainnya
  //         return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data.'], 500);
  //     }
  // }

  public function showedit($id)
  {
    $presensi = Presensi::findOrFail($id);
    return view('presensi.showedit', compact('presensi'));

  }

  public function editpresensi(Request $request, $id)
  {
      try {
          // Ambil data presensi berdasarkan ID
          $presensi = Presensi::findOrFail($id);
  
          // Lakukan validasi data dari form edit
          $request->validate([
              'clockIn' => 'required|date_format:H:i', // Format jam (HH:mm)
              'clockOut' => 'required|date_format:H:i', // Format jam (HH:mm)
          ], [
              'clockIn.required' => 'Clock In field is required.',
              'clockOut.required' => 'Clock Out field is required.'
          ]);
  
          // Simpan perubahan pada data presensi
          $presensi->jam_masuk = date('Y-m-d') . ' ' . $request->input('clockIn') . ':00';
          $presensi->jam_pulang = date('Y-m-d') . ' ' . $request->input('clockOut') . ':00';
          $presensi->save();
  
          // Kirim variabel $presensi ke tampilan sebagai bagian dari respons JSON
          return response()->json([
              'message' => 'Data presensi berhasil diperbarui.',
              'presensi' => $presensi, // Tambahkan variabel $presensi ke respons JSON
          ]);
      } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
          // Data tidak ditemukan
          return response()->json(['error' => 'Data presensi tidak ditemukan.'], 404);
      } catch (\Illuminate\Validation\ValidationException $e) {
          // Validasi data tidak valid
          $errors = $e->validator->errors()->toArray();
          return response()->json(['errors' => $errors], 422);
      } catch (\Exception $e) {
          // Penanganan kesalahan lainnya
          return response()->json(['error' => 'Terjadi kesalahan saat menyimpan data.'], 500);
      }
  }
  
  
  
  
  
  

  public function earlyin()
  {
      $skr = Carbon::now()->toDateString();
      $earlyintoday = Presensi::whereDate('tanggal','=',$skr)->where('presensi_status','=','EarlyIn')
      ->with(['preskaryawan' => function($query){ $query;}])
      ->with(['preskaryawan.cabang' => function($query){ $query;}])->get();
      return view('presensi.daily.earlyin', compact('earlyintoday'));
  }

  public function ontime()
  {
      $skr = Carbon::now()->toDateString();
      $ontimetoday = Presensi::whereDate('tanggal','=',$skr)->where('presensi_status','=','OnTime')
      ->with(['preskaryawan' => function($query){ $query;}])
      ->with(['preskaryawan.cabang' => function($query){ $query;}])->get();
      return view('presensi.daily.ontime', compact('ontimetoday'));
  }

  public function latein()
  {
      $skr = Carbon::now()->toDateString();
      $latetoday = Presensi::whereDate('tanggal','=',$skr)->where('presensi_status','=','Late')
      ->with(['preskaryawan' => function($query){ $query;}])
      ->with(['preskaryawan.cabang' => function($query){ $query;}])->get();
      return view('presensi.daily.latein', compact('latetoday'));
  }

  public function attendin()
  {
      $skr = Carbon::now()->toDateString();
      $attendtoday = Presensi::whereDate('tanggal','=',$skr)->whereNotNull('jam_masuk')
      ->with(['preskaryawan' => function($query){ $query;}])
      ->with(['preskaryawan.cabang' => function($query){ $query;}])->get();
      return view('presensi.daily.attend', compact('attendtoday'));
  }

  public function timeoff()
  {
      $skr = Carbon::now()->toDateString();
      $timeofftoday = Presensi::whereDate('tanggal','=',$skr)->where('presensi_status','=','Timeoff')
      ->with(['preskaryawan' => function($query){ $query;}])
      ->with(['preskaryawan.cabang' => function($query){ $query;}])->get();
      return view('presensi.daily.timeoff', compact('timeofftoday'));
  }

  public function absen()
  {
      $skr = Carbon::now()->toDateString();
      $absenofftoday = Presensi::whereDate('tanggal','=',$skr)->whereNull('presensi_status')
      ->with(['preskaryawan' => function($query){ $query;}])
      ->with(['preskaryawan.cabang' => function($query){ $query;}])->get();
      return view('presensi.daily.absen', compact('absenofftoday'));
  }

  public function noclockin()
  {
      $skr = Carbon::now()->toDateString();
      $noclockinofftoday = Presensi::whereDate('tanggal','=',$skr)->whereNull('jam_masuk')
      ->with(['preskaryawan' => function($query){ $query;}])
      ->with(['preskaryawan.cabang' => function($query){ $query;}])->get();
      return view('presensi.daily.noclockin', compact('noclockinofftoday'));
  }

  public function noclockout()
  {
      $skr = Carbon::now()->toDateString();
      $noclockoutofftoday = Presensi::whereDate('tanggal','=',$skr)->whereNull('jam_pulang')
      ->with(['preskaryawan' => function($query){ $query;}])
      ->with(['preskaryawan.cabang' => function($query){ $query;}])->get();
      return view('presensi.daily.noclockout', compact('noclockoutofftoday'));
  }

  public function dayoff()
  {
      $skr = Carbon::now()->toDateString();
      $dayofftoday = Presensi::whereDate('tanggal','=',$skr)->where('presensi_status','=','DayOff')
      ->with(['preskaryawan' => function($query){ $query;}])
      ->with(['preskaryawan.cabang' => function($query){ $query;}])->get();
      return view('presensi.daily.dayoff', compact('dayofftoday'));
  }

// public function earlyin()
// {
//     $skr = Carbon::now()->toDateString();
//     $earlyintoday = Presensi::whereDate('tanggal','=',$skr)->where('presensi_status','=','EarlyIn')->get();
//     return view('presensi.daily.earlyin', compact('earlyintoday'));
// }

// public function ontime()
// {
//     $skr = Carbon::now()->toDateString();
//     $ontimetoday = Presensi::whereDate('tanggal','=',$skr)->where('presensi_status','=','OnTime')->get();
//     return view('presensi.daily.ontime', compact('ontimetoday'));
// }

// public function latein()
// {
//     $skr = Carbon::now()->toDateString();
//     $latetoday = Presensi::whereDate('tanggal','=',$skr)->where('presensi_status','=','Late')->get();
//     return view('presensi.daily.latein', compact('latetoday'));
// }

// public function attendin()
// {
//     $skr = Carbon::now()->toDateString();
//     $attendtoday = Presensi::whereDate('tanggal','=',$skr)->whereNotNull('jam_masuk')->get();
//     $timeoff = Presensi::whereDate('tanggal','=',$skr)->where('presensi_status','=','Timeoff')->get();
//     return view('presensi.daily.attend', compact('attendtoday'));
// }

// public function timeoff()
// {
//     $skr = Carbon::now()->toDateString();
//     $timeofftoday = Presensi::whereDate('tanggal','=',$skr)->where('presensi_status','=','Timeoff')->get();
//     return view('presensi.daily.timeoff', compact('timeofftoday'));
// }

// public function dayoff()
// {
//     $skr = Carbon::now()->toDateString();
//     $dayofftoday = Presensi::whereDate('tanggal','=',$skr)->where('presensi_status','=','DayOff')->get();
//     return view('presensi.daily.dayoff', compact('dayofftoday'));
// }

  public function logpresensikar($id) {
    $prs = Presensi::where('id_karyawan','=', $id)->orderBy('tanggal', 'DESC')->paginate(31);
    return view('presensi.attendancelogkar', compact('prs'));
  }
  public function breaktime(Request $request) {
    $karyawan = Karyawan::whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation"])->count();
    $skr = Carbon::now()->toDateString();
    $date_now = new DateTime(date('Y-m-d'));
    $out = Presensi::whereDate('tanggal','=',$skr)->whereNotNull('istirahat_keluar')->count();
    $in = Presensi::whereDate('tanggal','=',$skr)->whereNotNull('istirahat_masuk')->count();
    $cabang = Cabang::get();

    if ($request->has('search')) {
      $krs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
              ->whereHas('preskaryawan', function ($query) use ($request){
            $query->where('nama_lengkap', 'like', '%'.$request->cabang.'%')
            ->orwhere('nomor_induk_karyawan', 'like', '%'.$request->cabang.'%');});

      $prs = Presensi::whereDate('tanggal','=',$skr)->whereHas('preskaryawan', function ($query) use ($request){
        $query->where('nama_lengkap', 'like', '%'.$request->search.'%')
              ->orwhere('nomor_induk_karyawan', 'like', '%'.$request->search.'%');})
              ->with(['parampresensi' => function($query){
              $query;}])
              ->orwhereHas('preskaryawan.jabatan', function ($query) use ($request){
                $query->where('nama', 'like', '%'.$request->search.'%');
                })
              ->with(['preskaryawan.bagian' => function($query){
              $query;}])
              ->orwhereHas('preskaryawan.cabang', function ($query) use ($request){
              $query->where('nama', 'like', '%'.$request->search.'%');
              })->paginate(20)->withQueryString();
            return view('presensi.istirahat', compact('karyawan', 'out', 'in', 'cabang', 'krs', 'prs'));

      }


    if ($request->has('report')) {
      $this->validate($request, [
      'cabang' => 'required',
      'format'=> 'required',
      'startdate'=> 'required',
      'enddate'=> 'required',
      #'cari'=> 'required',


      ]);

      if(empty($request->cari) && $request->format=='view' ){

      $cabs = Cabang::All();

      $start_date = $request->startdate;
      $end_date = $request->enddate;
      $krs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
            ->whereHas('preskaryawan', function ($query) use ($request){
            $query->where('nama_lengkap', 'like', '%'.$request->cabang.'%')
            ->orWhere('nomor_induk_karyawan', 'like', '%'.$request->cabang.'%');});

      $prs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
        ->whereHas('preskaryawan', function ($query) use ($request){
        $query->where('fk_cabang','=', $request->cabang)
        ;})
        ->with(['parampresensi' => function($query){
        $query;}])
        ->with(['preskaryawan.jabatan' => function($query){
        $query;}])
        ->with(['preskaryawan.bagian' => function($query){
        $query;}])
        ->with(['preskaryawan.cabang' => function($query){
        $query;}])

        ->paginate(20)->withQueryString();

      }

      if(!empty($request->cari) && $request->format=='view' ){
      // if($request->format=='view'){
          $cabs = Cabang::All();
          $start_date = $request->startdate;
          $end_date = $request->enddate;
          $krs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
                ->whereHas('preskaryawan', function ($query) use ($request){
                $query->where('nama_lengkap', 'like', '%'.$request->cabang.'%')
                ->orWhere('nomor_induk_karyawan', 'like', '%'.$request->cabang.'%');});
            $prs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
            ->whereHas('preskaryawan', function ($query) use ($request){
            $query->where('fk_cabang','=', $request->cabang)
            ->where('nama_lengkap','=', $request->cari)
            ;})
            ->with(['parampresensi' => function($query){
            $query;}])
            ->with(['preskaryawan.jabatan' => function($query){
            $query;}])
            ->with(['preskaryawan.bagian' => function($query){
            $query;}])
            ->with(['preskaryawan.cabang' => function($query){
            $query;}])
            ->paginate(20)->withQueryString();
        }
      #tanpa nama
      if(empty($request->cari) && $request->format=='excel' ){
      // if($request->format=='view'){
      $cabs = Cabang::All();
      $start_date = $request->startdate;
      $end_date = $request->enddate;
      $krs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
          ->whereHas('preskaryawan', function ($query) use ($request){
          $query->where('nama_lengkap', 'like', '%'.$request->cabang.'%')
          ->orWhere('nomor_induk_karyawan', 'like', '%'.$request->cabang.'%');});
      $prs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
      ->whereHas('preskaryawan', function ($query) use ($request){
      $query->where('fk_cabang','=', $request->cabang)
      ;})
      ->with(['parampresensi' => function($query){
      $query;}])
      ->with(['preskaryawan.jabatan' => function($query){
      $query;}])
      ->with(['preskaryawan.bagian' => function($query){
      $query;}])
      ->with(['preskaryawan.cabang' => function($query){
      $query;}])
      ->get();

      return (new PresensisExport($cabang,$prs,$start_date,$end_date))->download('presensi_karyawan.xlsx');#membuat excel
     }
     #dengan nama cari
      if(!empty($request->cari) && $request->format=='excel' ){
      // if($request->format=='view'){
        $cabs = Cabang::All();
        $start_date = $request->startdate;
        $end_date = $request->enddate;
        $krs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
              ->whereHas('preskaryawan', function ($query) use ($request){
              $query->where('nama_lengkap', 'like', '%'.$request->cabang.'%')
              ->orWhere('nomor_induk_karyawan', 'like', '%'.$request->cabang.'%');});
          $prs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
          ->whereHas('preskaryawan', function ($query) use ($request){
          $query->where('fk_cabang','=', $request->cabang)
          ->where('nama_lengkap','=', $request->cari)
          ;})
          ->with(['parampresensi' => function($query){
          $query;}])
          ->with(['preskaryawan.jabatan' => function($query){
          $query;}])
          ->with(['preskaryawan.bagian' => function($query){
          $query;}])
          ->with(['preskaryawan.cabang' => function($query){
          $query;}])
          ->get();
      return (new PresensisExport($cabang,$prs,$start_date,$end_date))->download('presensi_karyawan.xlsx');#membuat excel
      }
      #tanpa cari nama
      if(empty($request->cari) && $request->format=='pdf' ){
      // if($request->format=='view'){
          $cabs = Cabang::All();
          $start_date = $request->startdate;
          $end_date = $request->enddate;
          $krs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
                ->whereHas('preskaryawan', function ($query) use ($request){
                $query->where('nama_lengkap', 'like', '%'.$request->cabang.'%')
                ->orWhere('nomor_induk_karyawan', 'like', '%'.$request->cabang.'%');});
            $prs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
            ->whereHas('preskaryawan', function ($query) use ($request){
            $query->where('fk_cabang','=', $request->cabang)
            ;})
            ->with(['parampresensi' => function($query){
            $query;}])
            ->with(['preskaryawan.jabatan' => function($query){
            $query;}])
            ->with(['preskaryawan.bagian' => function($query){
            $query;}])
            ->with(['preskaryawan.cabang' => function($query){
            $query;}])
            ->get();

        $pdf = \PDF::loadView('presensi.report_presensi', compact('krs','prs','cabang','start_date','end_date'))->setPaper('a4', 'landscape');
        return $pdf->stream('data_presensi_karyawan.pdf');
      }

      if(!empty($request->cari) && $request->format=='pdf' ){
        // if($request->format=='view'){
            $cabs = Cabang::All();
            $start_date = $request->startdate;
            $end_date = $request->enddate;
            $krs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
                  ->whereHas('preskaryawan', function ($query) use ($request){
                  $query->where('nama_lengkap', 'like', '%'.$request->cabang.'%')
                  ->orWhere('nomor_induk_karyawan', 'like', '%'.$request->cabang.'%');});
              $prs = Presensi::whereBetween('tanggal',[$request->startdate, $request->enddate])
              ->whereHas('preskaryawan', function ($query) use ($request){
              $query->where('fk_cabang','=', $request->cabang)
              ->where('nama_lengkap','=', $request->cari)
              ;})
              ->with(['parampresensi' => function($query){
              $query;}])
              ->with(['preskaryawan.jabatan' => function($query){
              $query;}])
              ->with(['preskaryawan.bagian' => function($query){
              $query;}])
              ->with(['preskaryawan.cabang' => function($query){
              $query;}])
              ->get();

          $pdf = \PDF::loadView('presensi.report_presensi', compact('krs','prs','cabang','start_date','end_date'))->setPaper('a4', 'landscape');
          return $pdf->stream('data_presensi_karyawan.pdf');
        }


    }

  else{
          $skr = Carbon::now()->toDateString();
          $prs = Presensi::whereDate('tanggal','=',$skr)->with(['preskaryawan' => function($query){
          $query;}])
          ->with(['parampresensi' => function($query){
          $query;}])
          ->with(['preskaryawan.jabatan' => function($query){
          $query;}])
          ->with(['preskaryawan.bagian' => function($query){
          $query;}])
          ->with(['preskaryawan.cabang' => function($query){
          $query;}])->paginate(20);

          $krs = Presensi::whereDate('tanggal','=',$skr)->with(['preskaryawan' => function($query){
            $query;}])->get();

            session(['nama-datalist' => $krs]);

            return view('presensi.istirahat', compact('karyawan', 'out', 'in', 'cabang', 'krs', 'prs'));

  }
    return view('presensi.istirahat', compact('karyawan', 'out', 'in', 'cabang'));
  }
public function showcapture(Request $request)
  {
    $nik = Auth::user()->getkaryawan->nomor_induk_karyawan;
    $id_karyawan = Karyawan::where('nomor_induk_karyawan', $nik)->get()->last();
    $cek_lat_cabang = $id_karyawan->cabang->latitude;
		$cek_lon_cabang = $id_karyawan->cabang->longitude;
    return view('presensi.capture', compact('cek_lat_cabang', 'cek_lon_cabang'));
  }
  public function capturestore(Request $request)
    {
    //   $validator = Validator::make($request->all(), [
    //     'nik'    => 'nullable',
    //     'image'  => 'nullable',
    //     'lat'    => 'nullable',
    //     'long'   => 'nullable',
    //     'foto'   => 'nullable',
    // ]);
    // dd($request->all());
    // if ($validator->fails()){
    //     #return response()->json($validator->errors(),422);
    //     return response()->json(['message' => 'Perikasa Kembali Inputan Anda', 'code' => 'error'], 422);
    // }
    $id_karyawan = Karyawan::where('nomor_induk_karyawan', $request->nik)->get()->last();
	  if ($id_karyawan == Null) {
      return response()->json(['message' => 'Anda Belum Terdaftar Sebagai Karyawan', 'code' => 'warning7'], 200);
	  }
    else{
      $cek_radius     = $id_karyawan->cabang->radius;
      $unit           = $id_karyawan->cabang->satuan_radius;
      $cek_lat_cabang = $id_karyawan->cabang->latitude;
      $cek_lon_cabang = $id_karyawan->cabang->longitude;
    ###HITUNG JARAK AWAL
    $latitude1  = doubleval($request->lat);  ###Posisi Absen
    $longitude1 = doubleval($request->long); ###Posisi Absen
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
              return response()->json(['message' => 'Jarak Anda Diluar jangkauan!!'.'ieu jarakna'.$distance, 'code' => 'warning1','distance' => $distance ,'unit' => $unit], 200);#400);
    }if ($distance <= $cek_radius) {
        // $cv = $request->file('image_masuk');
        // $extcv = $request->file('image_masuk')->getClientOriginalExtension();
        // $CvName = $request->nik.'_'.date('Y-m-d_H:i:s').'.'.'png';
        // $cv->storeAs('presensi', $CvName);	
        
        $image = $request->image;
        #$latitude = $request->lat;
        #$longitude = $request->long;
        $image_parts = explode(";base64,", $image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[01]);
        $FotoName = $request->nik.'_'.date('Y-m-d_H:i:s').'.'.'png';
        $folderPath = "presensi/";
        $file = $folderPath . $FotoName;
        Storage::put($file, $image_base64);

        $ayeuna = new DateTime( date('Y-m-d H:i:s') );
        $date_now = new DateTime( date('Y-m-d'));
        $cek_absen = Presensi::select('*')->where('id_karyawan', '=', $id_karyawan->id)->where('tanggal','=', $date_now)->get()->last();
        $skr = $ayeuna->format('H:i:s');
        if ($cek_absen) {
            $cek_jam_masuk = $cek_absen->parampresensi->jam_masuk;
            $cek_jam_pulang = $cek_absen->parampresensi->jam_pulang;
            $cek_awal_absen_masuk = $cek_absen->parampresensi->awal_absen_masuk;
            $cek_maks_telat_kerja = $cek_absen->parampresensi->maks_telat;
        if ($cek_absen->jam_masuk != Null and $cek_absen->jam_pulang != Null) {
              return response()->json(['message' => 'Anda Sudah Absen Pulang Kerja!!', 'code' => 'warning2'], 200); #403);
        }if ($cek_absen->jam_masuk == Null) {
            if($skr < $cek_jam_masuk){
                $cek_absen->update([
                    'image_masuk'     => $FotoName,
                    'jam_masuk'       => $ayeuna,
                    'id_user'         => $id_karyawan->fk_user,
                    'latitude'        => $request->lat,
                    'longitude'       => $request->long,
                    'tanggal'         => $date_now,
                    'id_karyawan'     => $id_karyawan->id,
                    'keterangan'      => 'EarlyIn',##
                    'presensi_status' => 'EarlyIn',##Untuk Penarikan Report (EarlyIn,Late,Off,Cuti dll)
                ]);
                  return response()->json(['message' => 'Absen Masuk Berhasil Early In!!', 'code' => 'Success1'], 200);
        }
            if($skr == $cek_jam_masuk){
                $cek_absen->update([
                    'image_masuk'     => $FotoName,
                    'jam_masuk'       => $ayeuna,
                    'id_user'         => $id_karyawan->fk_user,
                    'latitude'        => $request->lat,
                    'longitude'       => $request->long,
                    'tanggal'         => $date_now,
                    'id_karyawan'     => $id_karyawan->id,
                    'keterangan'      => 'OnTime',
                    'presensi_status' => 'OnTime',
                 ]);
                 return response()->json(['message' => 'Absen Masuk Berhasil Ontime!!', 'code' => 'Success2'], 200);
      }

      if($skr > $cek_jam_masuk and $skr <= $cek_maks_telat_kerja){ 
          //Cek periode dari tanggal sekarang (tentukan awal dan akhir periode)
          // if (Carbon::now()->format('d') < 21) {
          //    $awal = Carbon::now()->subMonth()->format('Y-m-d');
          //    $akhir =  Carbon::now()->format('Y-m-d');
          // } else {
          //    $awal =  Carbon::now()->format('Y-m-d');
          //    $akhir = Carbon::now()->addMonth()->format('Y-m-d');
          // }
          //Query Get Consecutive Late in this periode by id_karyawan
          //    $consect = DB::select(DB::raw("SELECT max(Consecutive_Days) as jumlah_consecutive 
          //        from (SELECT t.tanggal, t.id_karyawan, t.presensi_status, 
          //        DATEDIFF(t.tanggal, MIN(t.tanggal) 
          //            OVER( PARTITION BY t.DateGroup_Num ORDER BY t.tanggal)) +1 AS Consecutive_Days
          //        FROM( SELECT tanggal, id_karyawan, presensi_status, SUM( IF( DATEDIFF(tanggal, Prev_Date) = 1, 0, 1) ) 
          //            OVER( PARTITION BY id_karyawan ORDER BY tanggal)  AS DateGroup_Num
          //                FROM ( SELECT tanggal, id_karyawan, presensi_status, 
          //                    LAG(tanggal,1) OVER (PARTITION BY id_karyawan ORDER BY tanggal) AS Prev_Date
          //                        FROM presensis
          //                        where presensi_status = 'Late' and id_karyawan = '$id_karyawan'
          //                        and tanggal between '$awal' and '$akhir'
          //                    ) grp
          //                ) t 
          //                ) ta"));
          //            //Query Get Late amount
          //    $late_amount = DB::select(DB::raw("SELECT count(id_karyawan)
          //        FROM presensis
          //        where presensi_status = 'Late' and id_karyawan = '$id_karyawan' 
          //        and tanggal between '$awal' and '$akhir'"));
          //        if ($con == 3) {
          //            return response()->json(['message' => 'Tidak bisa absen, sudah telat 3 kali berturut-turut di periode ini'], 200);
          //        }
          //        elseif ($late == 5) {
          //           return response()->json(['message' => 'Tidak bisa absen, sudah telat 5 kali di periode ini'], 200);
          //        }
          //        else {
                      $cek_absen->update([
                          'image_masuk'     => $FotoName,
                          'jam_masuk'       => $ayeuna,
                          'id_user'         => $id_karyawan->fk_user,
                          'latitude'        => $request->lat,
                          'longitude'       => $request->long,
                          'tanggal'         => $date_now,
                          'id_karyawan'     => $id_karyawan->id,
                          'keterangan'      => 'Late',
                          'presensi_status' => 'Late',
		      ]); 
           // }
                      return response()->json(['message' => 'Absen Masuk Berhasil Late!!', 'code' => 'Success3'], 200);
                  }elseif($cek_absen->jam_masuk == Null and $skr >= $cek_maks_telat_kerja){
                      return response()->json(['message' => 'Bukan Jam Masuk Kerja!!', 'code' => 'warning3'], 200);#403);
              }
        }
              if ($cek_absen->jam_masuk != Null and $skr < $cek_jam_pulang) {
          return response()->json(['message' => 'Anda Sudah Melakukan Absen Masuk Kerja!!', 'code' => 'warning4'], 200);#403);
              }
        if ($cek_absen->jam_masuk != Null and $skr >= $cek_jam_pulang) {
                  if($skr >= $cek_jam_pulang){
                      $cek_absen->update([
                          'image_pulang'     => $FotoName,
                          'jam_pulang'       => $ayeuna,
                          'id_user'          => $id_karyawan->fk_user,
                          'latitude_pulang'  => $request->lat,
                          'longitude_pulang' => $request->long,
                      ]);
                      return response()->json(['message' => 'Absen Pulang Berhasil!!', 'code' => 'Success4'], 200);
                  }if($skr <= $cek_jam_pulang){
                      return response()->json(['message' => 'Bukan Jam Pulang Kerja!!', 'code' => 'warning5'], 200); #403);
                  }
              }
    }
    #JIka Belum Ada Di Table Presensi (blom ke Create Absennya)
    if (!($cek_absen)) {	
            return response()->json(['message' => 'Presensi Anda Belum Terdaftar!!', 'code' => 'warning6'], 200);#400
    }

        }
      }
    
   
        // $image = $request->image;
        // $latitude = $request->lat;
        // $longitude = $request->long;
        // $image_parts = explode(";base64,", $image);
        // $image_type_aux = explode("image/", $image_parts[0]);
        // $image_type = $image_type_aux[1];
        // $image_base64 = base64_decode($image_parts[01]);
        // $FotoName = $request->nik.'_'.$latitude.'_'.$longitude.'_'.date('Y-m-d_H:i:s').'.'.'png';
        // $folderPath = "presensi/";
        // $file = $folderPath . $FotoName;
	      // Storage::put($file, $image_base64);
        
        // $data = [
        //     'filename' => $FotoName,
        //     'latitude' => $latitude,
        //     'longitude' => $longitude,
        // ];
        #Foto::create($data);
        #return redirect()->back();
        #return response()->json(['message' => 'Anda Berhasil Absen cooyyy', 'code' => 'berhasil'], 200);#400);
    }
}


