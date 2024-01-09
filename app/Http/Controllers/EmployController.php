<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\Karyawan;
use App\Models\Pelamar;
use Illuminate\Http\Request;
use App\Models\Cabang;
use App\Models\Perusahaan;
use App\Models\Bagian;
use App\Models\NourutNik; ##Ga DI apke Lagi
use App\Models\ParamJenisKaryawan;
use App\Models\User;
use App\Models\LevelJabatan;
use App\Models\ParLevelJabatan;
use App\Models\KaryawanTransfer;
use App\Models\KaryawanEditLog;
use App\Models\PasalPelanggaran;
use App\Models\Peringatan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Presensi;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use Auth;
use Notification;
use App\Notifications\EmailSPNotification;
use App\Imports\ExternalKaryawanImport;
##Export Data Template Iport Data External
use App\Exports\EmployeesExport;
use App\Exports\ExportEmployeExternal;
use App\Exports\ExportEmployeInternal;
use App\Exports\EksternalbulkExport;
use App\Exports\InternalbulkExport;
use App\Exports\CutiFormatExcel;
use App\Exports\TemplateEksternalExport;
use App\Exports\TemplateInternalExport;
use Exception;
use App\Imports\EditBulkKaryawanExternal;
use App\Imports\EditBulkKaryawanInternal;
use App\Models\Watcher;
use App\Imports\BulkCutiKaryawan;
class EmployController extends Controller
{
     public function indexfire()
    {
        return view('firebase.sendnotif');
    }

    // public function index()
    // {
    //      $data = Karyawan::all();
    //     // $data = [];
    //     // // Use the chunk method to retrieve and process records in chunks
    //     // Karyawan::chunk(200, function ($records) use (&$data) {
    //     //     foreach ($records as $record) {
    //     //         // Process each record or prepare data for the view
    //     //         $data[] = $this->prepareRecordForView($record);
    //     //     }
    //     // });
    //     // // return view('employ.index', compact('employes','lvl','cabs','jabs','bgn'));
    //     return view('employ.indexbaruemploy', ['employes' => $data]);
    // }

    private function prepareRecordForView($record)
    {
        return [
            'id' => $record->id,
            'nama_lengkap' => $record->nama_lengkap,
            'nomor_induk_karyawan' => $record->nomor_induk_karyawan,
            // Add more fields as needed
        ];
    }

    public function index(Request $request) 
    {
        $cabs = Cabang::select('id','nama')->get();
        $vendor = Karyawan::whereNotNull('vendor')->distinct()->pluck('vendor');
        $brands = Karyawan::whereNotNull('brand')->distinct()->pluck('brand');
        // $dakar = Karyawan::whereNotNull('status_karyawan')->distinct()->pluck('status_karyawan');
        $dakar = Karyawan::select('status_karyawan')->where('jenis_karyawan', "Internal")->distinct()->get();
        // $dakar = Karyawan::select('status_karyawan')->where('jenis_karyawan','=','Internal')->groupBy('status_karyawan')->get();
        $bgn = Bagian::select('id','nama')->get();
        $jabs = LevelJabatan::select('id','nama')->get();
        $lvl = ParLevelJabatan::select('id','nama')->get();
        return view('employ.index',compact('cabs','vendor','brands','dakar','bgn','jabs','lvl'));

    }

    public function index_read(Request $request) 
    {        
            // dd($request->all());
            $length = $request->choiceValue ? $request->choiceValue : 10; #$request->choiceValue;
            $search = $request->search ? $request->search : null;
            $employmentcabang = $request->employmentcabang ? explode(',', $request->employmentcabang) : [''];
            $employmentvendor = $request->employmentvendor ? explode(',', $request->employmentvendor) : [''];
            $employmentbagian = $request->employmentbagian ? explode(',', $request->employmentbagian) : [''];
            $employmentjabatan = $request->employmentjabatan ? explode(',', $request->employmentjabatan) : [''];
            $employmentlevel = $request->employmentlevel ? explode(',', $request->employmentlevel) : [''];
            
            $dataaktif = ["Probation","PHL","AKTIF"];
            $datanonaktif = ["resign","PHK","Habis Kontak","NONAKTIF"];
            if ($request->status == "aktif" && $request->statusNonAktif == null) {
                $semuaStatus = $dataaktif;
            }elseif ($request->status == Null && $request->statusNonAktif == "Non Aktif") {
                $semuaStatus = $datanonaktif;
            }elseif ($request-> status == "aktif" && $request->statusNonAktif == "Non Aktif") {
                $semuaStatus = array_merge($dataaktif, $datanonaktif);
            }elseif ($request->status == Null && $request->statusNonAktif == Null ) {
                $semuaStatus = [''];   
            }
            $employes = Karyawan::with(['cabang','getjeniskar','bagian','jabatan','jabatan.paramlevel'])
                ->whereHas('getjeniskar', function ($query) {
                    $query->where('jenis_kar', '=', 'Internal');
                })
                ->when($request->employmentlevel, function ($query) use ($employmentlevel) {
                    return $query->whereHas('jabatan', function ($query)  use ($employmentlevel){
                            $query->whereIn('param_level',$employmentlevel);
                    });
                })
                ->when($request->employmentcabang, function ($query) use ($employmentcabang) {
                    return $query->whereIn('fk_cabang', $employmentcabang);
                })
                ->when($request->employmentvendor, function ($query) use ($employmentvendor) {
                    return $query->whereIn('vendor', $employmentvendor);
                })
                ->when($request->employmentbagian, function ($query) use ($employmentbagian) {
                    return $query->whereIn('fk_bagian', $employmentbagian);
                })
                ->when($request->employmentjabatan, function ($query) use ($employmentjabatan) {
                    return $query->whereIn('fk_level_jabatan', $employmentjabatan);
                })                
                ->wherein('status_karyawan', $semuaStatus)
                ->where('jenis_karyawan','=', "Internal")
                ->where(function ($cekdata) use ($search) {
                    $cekdata->where('nama_lengkap', 'like', '%' . $search . '%')
                    ->orWhere('nomor_induk_karyawan', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhereHas('cabang', function ($query) use ($search) {       ##Tambahkan fungsi jika pencarian harus melalui relasi tabel
                        $query->where('nama', 'like', '%' . $search . '%');
                    })                                                             ##Akhir fungsi jika pencarian harus melalui relasi tabel
                    ->orWhereHas('bagian', function ($query) use ($search) {
                        $query->where('nama', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('jabatan', function ($query) use ($search) {
                        $query->where('nama', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('jabatan.paramlevel', function ($query) use ($search) {
                        $query->where('nama', '=', $search );
                    });
                    
                })
                ->paginate($length)
                ->withQueryString();
         return view('employ.reademploy', compact('employes'));
    }


    // public function index(Request $request) 
    // {
    //     // $perPage = $request->input('per_page', 20); // Ambil nilai per_page dari query string, default 20 jika tidak ada
	//  if($request->ajax()) {
    //         $employes = Karyawan::query()
    //         ->whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation"])
    //         ->where('nama_lengkap', 'like', '%'.$request->search.'%')
    //         ->with(['cabang' => function($query){
    //         $query;}])
    //         ->with(['jabatan' => function($query){
    //         $query;}])
    //         ->with(['bagian' => function($query){
    //         $query;}]) 
    //         ->latest()->paginate(20)->withQueryString();
    //         return response()->json($employes);
	//     }
	// if ($request->has('report')) {
    //         $this->validate($request, [
    //         'cabang' => 'required',
    //         'format'=> 'required',
    //         ]);
	//         if($request->format=='view' && $request->cabang == 65){
    //             $cabs = Cabang::All();
    //             $employes = Karyawan::where('jenis_karyawan','=','Internal')
	//  	        ->whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation"])
	// 	        ->paginate(20)->withQueryString();
    //             return view('employ.index', compact('employes','cabs'));
	//         }
    //         if($request->format=='view' && $request->cabang != 65){
	// 	        $cabs = Cabang::All();
	// 	        $employes = Karyawan::where('jenis_karyawan','=','Internal')
	// 	        ->where('fk_cabang', '=', $request->cabang)
	//  	        ->whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation"])
	// 	        ->paginate(20)->withQueryString();
	// 	        return view('employ.index', compact('employes','cabs'));
	//         }
	//     if($request->format=='excel'){
    //             $cabang = $request->cabang;   
	//         if($request->cabang == 65){
    //               if($request->karyawan=='Internal'){
	// 	            $employes = Karyawan::where('jenis_karyawan','=','Internal')
	// 	            ->whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation"]);
	// 	        }
	// 	    if($request->karyawan=='External'){
    //             $employes = Karyawan::where('jenis_karyawan','=','Internal')
	// 	        ->whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation"]);
    //             }
	// 	    }
    //         else{
    //             if($request->karyawan=='Internal'){
    //                 $employes = Karyawan::where('jenis_karyawan','=','Internal')
	// 	            ->whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation"])
	// 	            ->where('fk_cabang','=', [$request->cabang])->get();
	// 	        }
    //             if($request->karyawan=='External'){
    //                 $employes = Karyawan::where('jenis_karyawan','=','External')
	//                 ->whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation"])
	// 		        ->where('fk_cabang','=', [$request->cabang])->get();
    //             }
	// 	    }
    //             return (new EmployeesExport($employes,$cabang))->download('employees.xlsx');#membuat excel
    //     }
	//     if($request->format=='pdf'){
	// 	$cabang = $request->cabang;
    //             if($request->karyawan=='Internal'){
    //               $employes = Karyawan::where('jenis_karyawan','=','Internal')
	// 	    ->whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation"])
	// 	    ->where('fk_cabang','=',  [$request->cabang])->get();
	// 	}
    //             if($request->karyawan=='External'){
	// 	  $employes = Karyawan::where('jenis_karyawan','=','External')
	// 	    ->whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation"])
	// 	    ->where('fk_cabang','=',  [$request->cabang])->get();
	// 	}
    //             $pdf = \PDF::loadView('employ.report_employ', compact('employes','cabang'))->setPaper('a4', 'landscape');
    //             return $pdf->download('data_karyawan.pdf');
    //         }
    //     }
	// else {
    //         dd($request->all());
    //         $cabs = Cabang::All();
    //         $jabs = LevelJabatan::all();
    //         $bgn = Bagian::All();
    //         $lvl = ParLevelJabatan::All();
    //         $employes = Karyawan::with(['cabang','getjeniskar','bagian','jabatan','jabatan.paramlevel'])->whereHas('getjeniskar', function ($query) {
    //             $query->where('jenis_kar', '=', 'Internal');
    //         })
    //         ->whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation",'Resign', 'PHK'])
    //         ->orderBy('id', 'ASC')->get();  
    //      return view('employ.indexbaruemploy', compact('employes','lvl','cabs','jabs','bgn'));
    //     }
    // }

    // public function exportexternal(Request $request)
    // {
    //     if ($request->ajax() && $request->has('report')) {
    //         $this->validate($request, [
    //             'cabang' => 'required',
    //             'format' => 'required',
    //         ]);

    //         if ($request->format == 'view') {
    //             $query = Karyawan::query()
    //                 ->where('status_karyawan', 'aktif')
    //                 ->where('jenis_karyawan', 'External')
    //                 ->with(['cabang', 'jabatan', 'bagian'])
    //                 ->latest();

    //             if ($request->cabang != '65') {
    //                 $query->where('fk_cabang', $request->cabang);
    //             }

    //             $employes = $query->paginate(10)->withQueryString();

    //             return response()->json(['employes' => $employes]);
    //         } elseif ($request->format == 'excel') {
    //             $query = Karyawan::query()
    //                 ->where('jenis_karyawan', 'External')
    //                 ->where('status_karyawan', 'aktif');

    //             if ($request->cabang != '65') {
    //                 $query->where('fk_cabang', $request->cabang);
    //             }

    //             $employes = $query->get();

    //             return response()->json(['file' => 'employees.xlsx']);
    //         } elseif ($request->format == 'pdf') {
    //             $query = Karyawan::query()
    //                 ->where('jenis_karyawan', 'External')
    //                 ->where('status_karyawan', 'aktif')
    //                 ->where('fk_cabang', $request->cabang)
    //                 ->get();

    //             $cabang = $request->cabang;
    //             $pdf = \PDF::loadView('employ.report_employ', compact('employes', 'cabang'))->setPaper('a4', 'landscape');
    //             $pdf->save(public_path('data_karyawan.pdf'));

    //             return response()->json(['file' => 'data_karyawan.pdf']);
    //         }
    //     } else {
    //         $cabs = Cabang::orderBy('nama', 'DESC')->get();
    //         $employes = Karyawan::whereHas('getjeniskar', function ($query) {
    //             $query->where('jenis_kar', '=', 'External');
    //         })
    //         ->where('status_karyawan', 'aktif')
    //         ->where('fk_cabang', $request->cabang)
    //         ->latest()
    //         ->paginate(20)
    //         ->withQueryString();


    //         // $employes = Karyawan::where('jenis_karyawan', 'External')
    //         //     ->where('status_karyawan', 'aktif')
    //         //     ->where('fk_cabang', $request->cabang)
    //         //     ->latest()
    //         //     ->paginate(20)
    //         //     ->withQueryString();

    //         return view('employ.readexternal', compact('employes', 'cabs'));
    //     }
    // }

    // SEPUR EXTERNAL



    public function index_external(Request $request) 
    {
    
        $cabs = Cabang::select('id','nama')->get();
        $vendor = Karyawan::whereNotNull('vendor')->distinct()->pluck('vendor');
        $brands = Karyawan::whereNotNull('brand')->distinct()->pluck('brand');
        // $dakar = Karyawan::whereNotNull('status_karyawan')->distinct()->pluck('status_karyawan');
        $dakar = Karyawan::select('status_karyawan')->where('jenis_karyawan', "Internal")->distinct()->get();
        // $dakar = Karyawan::select('status_karyawan')->where('jenis_karyawan','=','Internal')->groupBy('status_karyawan')->get();
        $bgn = Bagian::select('id','nama')->get();
        $jabs = LevelJabatan::select('id','nama')->get();
        $lvl = ParLevelJabatan::select('id','nama')->get();
        return view('employ.index_external',compact('cabs','vendor','brands','dakar','bgn','jabs','lvl'));
    }

    // END SEPUER EXTERNAL

    public function index_read_external(Request $request) 
    {        
            // dd($request->all());
            $length = $request->choiceValue ? $request->choiceValue : 10; #$request->choiceValue;
            $search = $request->search ? $request->search : null;
            $employmentcabang = $request->employmentcabang ? explode(',', $request->employmentcabang) : [''];
            $employmentvendor = $request->employmentvendor ? explode(',', $request->employmentvendor) : [''];
            $employmentbagian = $request->employmentbagian ? explode(',', $request->employmentbagian) : [''];
            $employmentjabatan = $request->employmentjabatan ? explode(',', $request->employmentjabatan) : [''];
            $employmentlevel = $request->employmentlevel ? explode(',', $request->employmentlevel) : [''];
            
            $dataaktif = ["Probation","PHL","AKTIF"];
            $datanonaktif = ["resign","PHK","Habis Kontak","NONAKTIF"];
            if ($request->status == "aktif" && $request->statusNonAktif == null) {
                $semuaStatus = $dataaktif;
            }elseif ($request->status == Null && $request->statusNonAktif == "Non Aktif") {
                $semuaStatus = $datanonaktif;
            }elseif ($request-> status == "aktif" && $request->statusNonAktif == "Non Aktif") {
                $semuaStatus = array_merge($dataaktif, $datanonaktif);
            }elseif ($request->status == Null && $request->statusNonAktif == Null ) {
                $semuaStatus = [''];   
            }
            $employes = Karyawan::with(['cabang','getjeniskar','bagian','jabatan','jabatan.paramlevel'])
                ->whereHas('getjeniskar', function ($query) {
                    $query->where('jenis_kar', '=', 'External');
                })
                ->when($request->employmentlevel, function ($query) use ($employmentlevel) {
                    return $query->whereHas('jabatan', function ($query)  use ($employmentlevel){
                            $query->whereIn('param_level',$employmentlevel);
                    });
                })
                ->when($request->employmentcabang, function ($query) use ($employmentcabang) {
                    return $query->whereIn('fk_cabang', $employmentcabang);
                })
                ->when($request->employmentvendor, function ($query) use ($employmentvendor) {
                    return $query->whereIn('vendor', $employmentvendor);
                })
                ->when($request->employmentbagian, function ($query) use ($employmentbagian) {
                    return $query->whereIn('fk_bagian', $employmentbagian);
                })
                ->when($request->employmentjabatan, function ($query) use ($employmentjabatan) {
                    return $query->whereIn('fk_level_jabatan', $employmentjabatan);
                })                
                ->wherein('status_karyawan', $semuaStatus)
                ->where('jenis_karyawan','=', "External")
                // ->where('nama_lengkap','like','%'.$search.'%')
                // ->orWhere('nomor_induk_karyawan','like','%'.$search.'%')
                ->where(function ($cekdata) use ($search) {
                    $cekdata->where('nama_lengkap', 'like', '%' . $search . '%')
                    ->orWhere('nomor_induk_karyawan', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhereHas('cabang', function ($query) use ($search) {       ##Tambahkan fungsi jika pencarian harus melalui relasi tabel
                        $query->where('nama', 'like', '%' . $search . '%');
                    })                                                             ##Akhir fungsi jika pencarian harus melalui relasi tabel
                    ->orWhereHas('bagian', function ($query) use ($search) {
                        $query->where('nama', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('jabatan', function ($query) use ($search) {
                        $query->where('nama', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('jabatan.paramlevel', function ($query) use ($search) {
                        $query->where('nama', '=', $search );
                    });
                    
                })
                ->paginate($length)
                ->withQueryString();
         return view('employ.readexternal', compact('employes'));
    }
   
    public function searchinter(Request $request)
    {
        if ($request->ajax()) {
        $search = $request->input('search');
        $cabs = Cabang::orderBy('nama', 'DESC');
        $employes = Karyawan::where('jenis_karyawan', 'Internal')
        ->where(function($query) use ($search) {
        $query->where('nomor_induk_karyawan', 'LIKE', '%'.$search.'%')
        ->orWhere('nama_lengkap', 'LIKE', '%'.$search.'%')
        ->orWhere('no_identitas', 'LIKE', '%'.$search.'%');
        });

        $employes = $employes->where('status_karyawan', '=', 'aktif')
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('employ.reademploy', compact('employes', 'cabs'))->render();
        } else {
        return response()->json(['error' => 'Unauthorized'], 401);
        }
    }


    public function searchexter(Request $request)
    {
        if ($request->ajax()) {
        $search = $request->input('search');
        $cabs = Cabang::orderBy('nama', 'DESC');
        $employes = Karyawan::where('jenis_karyawan', 'External')
        ->where(function($query) use ($search) {
        $query->where('nomor_induk_karyawan', 'LIKE', '%'.$search.'%')
        ->orWhere('nama_lengkap', 'LIKE', '%'.$search.'%')
        ->orWhere('no_identitas', 'LIKE', '%'.$search.'%');
        });

        $employes = $employes->where('status_karyawan', '=', 'aktif')
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('employ.readexternal', compact('employes', 'cabs'))->render();
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
   



    public function indexexternal(Request $request) 
    {
	    $cabs = Cabang::All();
        $employes = Karyawan::where('jenis_karyawan','=','external')->latest()->paginate(20)->withQueryString();
        return view('employ.readexternal', compact('employes', 'cabs'));
        #$cabs = Cabang::All();
        #$employes = Karyawan::where('jenis_karyawan','=','external')->latest()->paginate(2)->withQueryString();            
        #return view('employ.readexternal', compact('employes','cabs'));
       
    }

    public function showexternal(Request $request) {
        $cabs = Cabang::All();
        $employes = Karyawan::where('jenis_karyawan','=','external')->latest()->paginate(2)->withQueryString();                     

        if ($employes->count() == 0) {
            return view('employ.index')->withMessage('No Posts Found');
        }
        if($request->ajax()) {
            return response()->json([
                'data_employ_ex' => view('employ.readexternal', compact('employes', 'cabs'))->render(),
                'pagination_links' => $employes->links()->render()
            ]);
        }
    }

    public function detail($id)
    {
        $kary = Karyawan::findorFail($id);
        #$lm =  Pelamar::where('fk_user', $employes->fk_user)->get()->last();
        return view('employ.detailemploy', compact('kary'));#,'lm'));
    }

    public function myinfo($id) {
     $kary = Karyawan::findorFail($id);
    //  dd($kary->id);
     return view('employ.myinfo', compact('kary'));
    }

    public function showemploy(Request $request) {
        $cabs = Cabang::All();
        $employes = Karyawan::latest()->paginate(20)->withQueryString();
        $bgn = Bagian::All();
        if ($employes->count() == 0 ) {
            return view('employ.index')->withMessage('No Posts Found');
        }

        if($request->ajax()) {
            return response()->json([
                'data_employ' => view('employ.reademploy', compact('employes', 'cabs','bgn'))->render(),
                'pagination_links' => $employes->links()->render()
            ]);
        }
    }

   

   public function showedit($id) {
    $tr = Karyawan::find($id);

    $cabs = Cabang::all();
    $pt = Perusahaan::all();
    $bagian = Bagian::all();
    $jabatan = LevelJabatan::all();
    return view('employ.editkar', compact('cabs', 'pt', 'jabatan', 'bagian'))->with(['data'=>$tr]);
   }

   public function storeedit(Request $request) 
   {
       #dd($request->nik);
       $user_id = Auth::id();
       $validator = Validator::make($request->all(), [
       'fk_cabang'             => 'required',
       'fk_bagian'             => 'required',
       'agama'                 => 'required',
       'fk_level_jabatan'      => 'required',
       'status_karyawan'       => 'required',
       'fk_nama_perusahaan'    => 'required',
       'id_kar'                => 'required',
       'nik'                   => 'required',
       'email'                 => 'required',
       'gender'                => 'required',
       'status_pernikahan'     => 'required',
       'tgl_lahir'             => 'required',
       'golongan_darah'        => 'required',
       'no_hp'               => 'required',
       'tempat_lahir'          => 'required',
       'alamat'                => 'required',
       ]);

       $data = Karyawan::find($request->id_kar);
       $newData = $request->only(['fk_cabang','alamat','no_hp','tempat_lahir','golongan_darah','tgl_lahir','gender','status_pernikahan','email', 'fk_bagian','agama', 'fk_level_jabatan','status_karyawan','fk_nama_perusahaan','nik']);

       $hasChanges = false;
       if ($data->fk_cabang != $newData['alamat']) {
            $hasChanges = true;
        }
       if ($data->fk_cabang != $newData['tempat_lahir']) {
            $hasChanges = true;
        }
       if ($data->fk_cabang != $newData['no_hp']) {
            $hasChanges = true;
        }
       if ($data->fk_cabang != $newData['golongan_darah']) {
            $hasChanges = true;
        }
       if ($data->fk_cabang != $newData['tgl_lahir']) {
            $hasChanges = true;
        }
       if ($data->fk_cabang != $newData['status_pernikahan']) {
            $hasChanges = true;
        }
       if ($data->fk_cabang != $newData['gender']) {
            $hasChanges = true;
        }
       if ($data->fk_cabang != $newData['email']) {
           $hasChanges = true;
        }
       if ($data->fk_cabang != $newData['fk_cabang']) {
           $hasChanges = true;
       }
       if ($data->fk_bagian != $newData['fk_bagian']) {
           $hasChanges = true;
       }
       if ($data->agama != $newData['agama']) {
           $hasChanges = true;
       }
       if ($data->fk_level_jabatan != $newData['fk_level_jabatan']) {
           $hasChanges = true;
       }
       if ($data->status_karyawan != $newData['status_karyawan']) {
           $hasChanges = true;
       }
       if ($data->fk_nama_perusahaan != $newData['fk_nama_perusahaan']) {
           $hasChanges = true;
       }
       if ($data->nomor_induk_karyawan != $newData['nik']) {
           $hasChanges = true;
       }

       if ($hasChanges) {
           $copy_table = KaryawanEditLog::create([
               'nama_lengkap' =>$data->nama_lengkap ?? null,
               'nama_panggilan' =>$data->nama_panggilan ?? null,
               'no_identitas' =>$data->no_identitas ?? null,
               'golongan_darah' =>$data->golongan_darah ?? null,
               'status_pernikahan' =>$data->status_pernikahan ?? null,
               'nama_ibu_kandung' =>$data->nama_ibu_kandung ?? null,
               'email' =>$data->email ?? null,
               'gender' =>$data->gender ?? null,
               'tempat_lahir' =>$data->tempat_lahir ?? null,
               'tgl_lahir' =>$data->tgl_lahir ?? null,
               'agama' =>$data->agama ?? null,
               'photo' =>$data->photo ?? null,
               'medsos' =>$data->medsos ?? null,
               'kontak_darurat' =>$data->kontak_darurat ?? null,
               'no_telp' =>$data->no_telp ?? null,
               'no_hp' =>$data->no_hp ?? null,
               'alamat' =>$data->alamat ?? null,
               'alamat_domisili' =>$data->alamat_domisili ?? null,
               'rt' =>$data->rt ?? null,
               'rw' =>$data->rw ?? null,
               'desa' =>$data->desa ?? null,
               'kecamatan' =>$data->kecamatan ?? null,
               'kota' =>$data->kota ?? null,
               'provinsi' =>$data->provinsi ?? null,
               'kodepos' =>$data->kodepos ?? null,
               'status_rumah' =>$data->status_rumah ?? null,
               'pendidikan_terakhir' =>$data->pendidikan_terakhir ?? null,
               'no_ijazah' =>$data->no_ijazah ?? null,
               'nama_institusi' =>$data->nama_institusi ?? null,
               'instansi_ijazah' =>$data->instansi_ijazah ?? null,
               'jurusan' =>$data->jurusan ?? null,
               'gpa' =>$data->gpa ?? null,
               'tahun_masuk_pendidikan' =>$data->tahun_masuk_pendidikan ?? null,
               'tahun_lulus' =>$data->tahun_lulus ?? null,
               'grade' =>$data->grade ?? null,
               'nomor_induk_karyawan' =>$data->nomor_induk_karyawan ?? null,
               'fk_nama_perusahaan' =>$data->fk_nama_perusahaan ?? null,
               'fk_cabang' =>$data->fk_cabang ?? null,
               'fk_level_jabatan' =>$data->fk_level_jabatan ?? null,
               'jenis_karyawan' =>$data->jenis_karyawan ?? null,
               'tahun_gabung' =>$data->tahun_gabung ?? null,
               // 'tahun_keluar' =>$data->tahun_keluar ?? null,
               'tahun_keluar' => $data->tahun_keluar ?? null,
       
               'npwp' =>$data->npwp ?? null,
               'no_rek1' =>$data->no_rek1 ?? null,
               'no_rek2' =>$data->no_rek2 ?? null,
               'bank1' =>$data->bank1 ?? null,
               'bank2' =>$data->bank2 ?? null,
               'jamkes_lainnya' =>$data->jamkes_lainnya ?? null,
               'no_bpjs_tenaga_kerja' =>$data->no_bpjs_tenaga_kerja ?? null,
               'keterangan_bpjs_tenaga_kerja' =>$data->keterangan_bpjs_tenaga_kerja ?? null,
               'bpjs_tenaga_kerja' =>$data->bpjs_tenaga_kerja ?? null,
               'no_bpjs_kesehatan' =>$data->no_bpjs_kesehatan ?? null,
               'keterangan_bpjs' =>$data->keterangan_bpjs ?? null,
               'bpjs_kesehatan' =>$data->bpjs_kesehatan ?? null,
               'upah' =>$data->upah ?? null,
               'masa_kerja' =>$data->masa_kerja ?? null,
               'expired_kontrak' =>$data->expired_kontrak ?? null,
               'expired_kontrak_baru' =>$data->expired_kontrak_baru ?? null,
               'tanggal_pengangkatan' =>$data->tanggal_pengangkatan ?? null,
               'ptpk_status' =>$data->ptpk_status ?? null,
               'fk_user' =>$data->fk_user ?? null,
               'jenis_identitas' =>$data->jenis_identitas ?? null,
               'masa_berlaku_identitas' =>$data->masa_berlaku_identitas ?? null,
               'no_finger'    =>$data->no_finger ?? null,
               'brand'        =>$data->brand ?? null,
               'vendor'       =>$data->vendor ?? null,
               'fk_jenis_kar' => $data->fk_jenis_kar ?? null,
               'user_update'  =>  $data->fk_user_update ?? null, #$user_id,
               'menu_akses'   => "MENU EDIT KARYAWAN",#$data->menu_akses_update
           ]);
           $pt = Perusahaan::findOrFail($request->fk_nama_perusahaan);
           $cabang = Cabang::findOrFail($request->fk_cabang);
           $jabatan = LevelJabatan::findOrFail($request->fk_level_jabatan);
           $bagian = Bagian::findOrFail($request->fk_bagian);
           $data->fk_cabang           = $cabang->id;
           $data->fk_bagian           = $bagian->id;
           $data->fk_level_jabatan    = $jabatan->id;
           $data->status_karyawan     = $request->status_karyawan;
           $data->fk_nama_perusahaan  = $pt->id;
           $data->fk_user_update      = $user_id;
           $data->nomor_induk_karyawan = $request->nik;
           $data->agama               = $request->agama;
           $data->email               = $request->email;
           $data->gender              = $request->gender;
           $data->status_pernikahan   = $request->status_pernikahan;
           $data->tgl_lahir           = $request->tgl_lahir;
           $data->golongan_darah      = $request->golongan_darah;
           $data->no_hp               = $request->no_hp;
           $data->tempat_lahir        = $request->tempat_lahir;
           $data->alamat              = $request->alamat;
           $data->save();
           return response()->json(['message' => 'Edit data karyawan berhasil ditambahkan '], 200);
       } else {
           // Jika tidak ada perubahan, beri tahu pengguna.
           # return redirect()->back()->with('message', 'Tidak ada perubahan.');
           return response()->json(['message' => 'Tidak Ada Perubahan Data '], 200);
       }   
    }
   public function cekEmail(Request $request) {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            return response()->json(['status' => $user]);
        }
    }

    public function create()
   {
       $cabs = Cabang::all();
       $pt = Perusahaan::all();
       $bagian = Bagian::all();
       $jabatan = LevelJabatan::all();
       $parjnkar = ParamJenisKaryawan::where('jenis_kar', '=', 'Internal')->get();
       return view('employ.create', compact('cabs', 'pt', 'jabatan', 'bagian','parjnkar'));
   }

   public function simpanaa(Request $request) {
    
    $validator = Validator::make($request->all(), [
    // not null
    'nama_lengkap' => 'required',
    'nama_panggilan' => 'required',
    'no_identitas' => 'required',
    'golongan_darah' => 'required',
    'status_pernikahan' => 'required',
    'email' => 'required',
    'gender' => 'required',
    'tempat_lahir' => 'required',
    'tgl_lahir' => 'required',
    'agama' => 'required',
    'no_telp' => 'required',
    'no_hp' => 'required',
    'alamat' => 'required',
    'alamat_domisili' => 'required',
    'rt' => 'required',
    'rw' => 'required',
    'desa' => 'required',
    'kecamatan' => 'required',
    'kota' => 'required',
    'provinsi' => 'required',
    'kodepos' => 'required',
    'status_rumah' => 'required',
    'fk_nama_perusahaan' => 'required',
    'fk_cabang' => 'required',
    'fk_level_jabatan' => 'required',
    'status_karyawan' => 'required',
    'jenis_karyawan' => 'required',
    'tahun_gabung' => 'required',
    'upah' => 'required',

    ]);

    $photo = $request->file('photo');
    if ($photo) {
        $photo_Name = time() . '_' . $photo->getClientOriginalName();
        $filePath = $photo->storeAs('images/posts', $photo_Name, 'public');
    }

    $id_parent = Perusahaan::findOrFail($request->fk_nama_perusahaan);
    $cabang = Cabang::findOrFail($request->fk_cabang);

    $jabatan = LevelJabatan::findOrFail($request->fk_level_jabatan);

    $bag = Bagian::findOrFail($request->fk_bagian);

    $getbln = $request->tahun_gabung;

    $getthn = $request->tahun_gabung;

    // if ($request->jenis_karyawan == 'Internal') {
    //     $kode = 1;
    //  }elseif ($request->jenis_karyawan ==  'External') {
    //     $kode = 2;
    //  }
    $bln = date("m", strtotime($getbln));
    $thn = date("y", strtotime($getthn));
    // $get_no_urut = NourutNik::where('jenis_karyawan','=',$request->jenis_karyawan)->first();    
    $get_no_urut = ParamJenisKaryawan::where('id','=',$request->jenis_karyawan)->first();    
    $no_urut = $get_no_urut->no_urut + 1;
    $nik= $get_no_urut->format_depan_nik.$thn.$bln.str_pad($no_urut, 4, '0', STR_PAD_LEFT);
    // dd($nik);

    $user = User::create([
        'name'             => $request->nama_lengkap,
        'email'            => $request->email,
        'phone_number'     => $request->no_hp,
        'password'         => Hash::make("Qwerty123#"),
        'confirm_password' => Hash::make("Qwerty123#"),
        'status_user'      => 'Karyawan'
    ]);

    $kar = Karyawan::create([
    'nama_lengkap' => $request->nama_lengkap,
    'nama_panggilan' => $request->nama_panggilan,
    'no_identitas' => $request->no_identitas,
    'golongan_darah' => $request->golongan_darah,
    'status_pernikahan' => $request->status_pernikahan,
    'email' => $request->email,
    'gender' => $request->gender,
    'tempat_lahir' => $request->tempat_lahir,
    'tgl_lahir' => $request->tgl_lahir,
    'agama' => $request->agama,
    'no_telp' => $request->no_telp,
    'no_hp' => $request->no_hp,
    'alamat' => $request->alamat,
    'alamat_domisili' => $request->alamat_domisili,
    'rt' => $request->rt,
    'rw' => $request->rw,
    'desa' => $request->desa,
    'kecamatan' => $request->kecamatan,
    'kota' => $request->kota,
    'provinsi' => $request->provinsi,
    'kodepos' => $request->kodepos,
    'status_rumah' => $request->status_rumah,
    'fk_nama_perusahaan' => $id_parent->id,
    'fk_cabang' => $cabang->id,
    'fk_level_jabatan' => $jabatan->id,
    'status_karyawan' => $request->status_karyawan,
    #'jenis_karyawan' => $request->jenis_karyawan,
    'tahun_gabung' => $request->tahun_gabung,
    'nomor_induk_karyawan'=> $nik,
    'fk_user' =>$user->id,
    'fk_bagian'=>$bag->id,
    'photo'=>$photo_Name,
    'fk_jenis_kar'=>$request->jenis_karyawan,

    ###Yang Kelewat DIsave
    'upah' =>$request->upah,
    'expired_kontrak' =>$request->tahun_keluar,
    // 'expired_kontrak_baru' => Carbon::createFromTimestamp(($request->tahun_keluar - 25569) * 86400)->format('Y-m-d'),
    'ptkp_status' =>$request->ptkp_status,
    // 'masa_kerja' =>$request->tahun_keluar,
    'pendidikan_terakhir' =>$request->pendidikan_terakhir,
    'grade' =>$request->grade,
    'nama_institusi' =>$request->instansi_ijazah,
    'jurusan' =>$request->jurusan,
    'tahun_masuk_pendidikan' =>$request->tahun_masuk_pendidikan,
    'tahun_lulus' =>$request->tahun_lulus,
    'gpa' =>$request->gpa,
    'kontak_darurat' =>$request->kontak_darurat,
    'medsos' =>$request->medsos,
    'npwp' =>$request->npwp,
    'no_rek1' =>$request->no_rek1,
    'bank1' =>$request->bank1,
    'no_rek2' =>$request->no_rek2,
    'bank2' =>$request->bank2,
    'nama_ibu_kandung' =>$request->nama_ibu_kandung,
    'bpjs_kesehatan' =>$request->bpjs_kesehatan,
    'keterangan_bpjs' =>$request->keterangan_bpjs,
    'no_bpjs_kesehatan' =>$request->no_bpjs_kesehatan,
    'bpjs_tenagakerja' =>$request->bpjs_tenagakerja,
    'keterangan_bpjs_tenaga_kerja' =>$request->keterangan_bpjs_tenaga_kerja,
    'no_bpjs_tenaga_kerja' =>$request->no_bpjs_tenaga_kerja,
    'jamkes_lainnya' =>$request->jamkes_lainnya,
    'no_ijazah' =>$request->no_ijazah,
    'instansi_ijazah' =>$request->instansi_ijazah,
    ]);

    $get_no_urut-> no_urut = $no_urut;
    $get_no_urut->save();
    ##create Presensi Karyawan Baru
    $today = Carbon::now();
    $blndepan = date('Y-12-31');
    $dateRange = CarbonPeriod::create($today, $blndepan);
        foreach ($dateRange as $dr) {
              $cr = Presensi::create(['tanggal' => $dr->format('Y-m-d'),'id_karyawan' => $kar->id,
              'id_user' => $user->id, 'id_parampresensi' => 1,'created_at' => $today->format('Y-m-d H:i:s')]);
        }    
    return redirect()->route('employ.index')->with(['success' => 'Data Berhasil Disimpan!']);

   }

   public function create_external()
   {
       $cabs = Cabang::all();
       $pt = Perusahaan::all();
       $bagian = Bagian::all();
       $jabatan = LevelJabatan::all();
       $parjnkar = ParamJenisKaryawan::where('jenis_kar', '=', 'External')->get();
       return view('employ.create_external', compact('cabs', 'pt', 'jabatan', 'bagian','parjnkar'));
   }

   public function simpanaa_external(Request $request) {
    // dd($request->tahun_keluar);
    $validator = Validator::make($request->all(), [
    // not null
    'nama_lengkap' => 'required',
    'nama_panggilan' => 'required',
    'no_identitas' => 'required',
    'golongan_darah' => 'required',
    'status_pernikahan' => 'required',
    'email' => 'required',
    'gender' => 'required',
    'tempat_lahir' => 'required',
    'tgl_lahir' => 'required',
    'agama' => 'required',
    'no_hp' => 'required',
    'alamat' => 'required',
    'alamat_domisili' => 'required',
    'kota' => 'required',
    'provinsi' => 'required',
    'kodepos' => 'required',
    'fk_cabang' => 'required',
    'fk_level_jabatan' => 'required',
    #'fk_nama_perusahaan' => 'required',
    #'fk_bagian' => 'required',
    'tahun_gabung' => 'required',
    ]);

    $cabang = Cabang::findOrFail($request->fk_cabang);
    $jabatan = LevelJabatan::findOrFail($request->fk_level_jabatan);
    $bagian = Bagian::where('id', 1)->first();

    $getbln = $request->tahun_gabung;
    $getthn = $request->tahun_gabung;
    $kode = 2;
    $bln = date("m", strtotime($getbln));
    $thn = date("y", strtotime($getthn));
      
    $get_no_urut = ParamJenisKaryawan::where('id','=',$request->jenis_karyawan)->first();    
    $no_urut = $get_no_urut->no_urut + 1;
    $nik= $get_no_urut->format_depan_nik.$thn.$bln.str_pad($no_urut, 4, '0', STR_PAD_LEFT);

    $user = User::create([
        'name'             => $request->nama_lengkap,
        'email'            => $request->email,
        'phone_number'     => $request->no_hp,
        'password'         => Hash::make("Qwerty123#"),
        'confirm_password' => Hash::make("Qwerty123#"),
        'status_user'      => 'Karyawan'
    ]);

    $kar = Karyawan::create([
    'nama_lengkap' => $request->nama_lengkap,
    'nama_panggilan' => $request->nama_panggilan,
    'no_identitas' => $request->no_identitas,
    'golongan_darah' => $request->golongan_darah,
    'email' => $request->email,
    'gender' => $request->gender,
    'tempat_lahir' => $request->tempat_lahir,
    'tgl_lahir' => $request->tgl_lahir,
    'agama' => $request->agama,
    'no_hp' => $request->no_hp,
    'alamat' => $request->alamat,
    'alamat_domisili' => $request->alamat_domisili,
    'kota' => $request->kota,
    'kodepos' => $request->kodepos,
    'fk_cabang' => $cabang->id,
    'fk_level_jabatan' => $cabang->id,
    'fk_bagian' => $bagian->id,
    'fk_nama_perusahaan' => $cabang->fk_nama_perusahaan,
    'status_karyawan' => $request->status_karyawan,
    'tahun_gabung' => $request->tahun_gabung,
    'nomor_induk_karyawan'=> $nik,
    'fk_user' =>$user->id,
    ##TAMBAHAN 
    'jenis_karyawan'       => 'External', // diseragamkeun External
    'fk_jenis_kar'=>$request->jenis_karyawan,
    'expired_kontrak' =>$request->tahun_keluar,
    'expired_kontrak_baru' => $request->tahun_keluar,
    'pendidikan_terakhir' =>$request->pendidikan_terakhir,
    'nama_institusi' =>$request->nama_institusi,
    'status_pernikahan'    => $request->status_pernikahan,
    'alamat' => $request->alamat,
    'alamat_domisili' => $request->alamat_domisili,
    'brand' => $request->brand,
    'vendor' => $request->vendor,
    //for null
    'rt'                   => '-',
    'rw'                   => '-',
    'desa'                 => '-',
    'kecamatan'            => '-',
    'provinsi'             => '-',
    'status_rumah'         => '-',
    'photo'                => '-',
    
    'upah'                 => '0',
    
    'ptpk_status'          => '-',
    'grade'                => '0',
    'jurusan'              => '-',
    'tahun_masuk_pendidikan' => '-',
    'tahun_lulus'          => '-',
    'gpa'                  => '0',
    'kontak_darurat'       => '0',
    'medsos'               => '-',
    'npwp'                 => '-',
    'golongan_darah'       => '-',
    'no_rek1'              => '-',
    'bank1'                => '-',
    'no_rek2'              => '-',
    'bank2'                => '-',
    'nama_ibu_kandung'     => '-',
    'bpjs_kesehatan'       => '-',
    'keterangan_bpjs'      => '-',
    'no_bpjs_kesehatan'    => '-',
    'bpjs_tenaga_kerja'    => '-',
    'keterangan_bpjs_tenaga_kerja' => '-',
    'no_bpjs_tenaga_kerja' => '-',
    'jamkes_lainnya'       => '-',
    'no_ijazah'            => '-',
    'instansi_ijazah'      => '-',
    'no_telp'              => '-',
    
    ]);

    $get_no_urut-> no_urut = $no_urut;
    $get_no_urut->save();
    $today = Carbon::now();
    $kamri = date('Y-m-01');
    $blndepan = date('Y-12-31');
    $dateRange = CarbonPeriod::create($today, $blndepan);
    foreach ($dateRange as $dr) {
        $cr = Presensi::create(['tanggal' => $dr->format('Y-m-d'),'id_karyawan' => $kar->id,
            'id_user' => $user->id, 'id_parampresensi' => 1,'created_at' => $today->format('Y-m-d H:i:s')]);
    }
    return redirect()->route('employ.index_external')->with(['success' => 'Data Berhasil Disimpan!']);
    }

   public function showtransfer($id) {
    $tr = Karyawan::find($id);
    $cabs = Cabang::all();
    $pt = Perusahaan::all();
    $bagian = Bagian::all();
    $jabatan = LevelJabatan::all();
    return view('employ.transferkaryawan', compact('cabs', 'pt', 'jabatan', 'bagian'))->with(['data'=>$tr]);
    }

   public function showtransferbulk($id) {
    $tr = Karyawan::find($id);
    $cabs = Cabang::all();
    $pt = Perusahaan::all();
    $bagian = Bagian::all();
    $jabatan = LevelJabatan::all();
    return view('employ.transferkaryawanbulk', compact('cabs', 'pt', 'jabatan', 'bagian'))->with(['data'=>$tr]);
    }

    public function storetransfer(Request $request) {
        $validator = Validator::make($request->all(), [
            #'tanggal'           => 'required',
            'tgl_transfer'      => 'required',
            'id_karyawan'       => 'required',
            'type'              => 'required',
            'status_karyawan'   => 'required',
            'fk_cabang'         => 'required',
            'fk_bagian'         => 'required',
            'fk_level_jabatan'  => 'required',
            'fk_nama_perusahaan'=> 'required',
            'keterangan'        => 'required',
        ]);

        $data = Karyawan::find($request->id_karyawan);
        $skr = Carbon::now();
        #create history Transfer
        $trans = KaryawanTransfer::create([
            'tanggal'           => $skr,
            'tgl_transfer'      => $request->tgl_transfer,
            'id_karyawan'       => $request->id_karyawan,
            'type'              => $request->type,
            'status_karyawan'   => $data->status_karyawan,
            'fk_cabang'         => $data->fk_cabang,
            'fk_bagian'         => $data->fk_bagian,
            'fk_level_jabatan'  => $data->fk_level_jabatan,
            'fk_nama_perusahaan'=> $data->fk_nama_perusahaan,
            'keterangan'        => $request->keterangan,
        ]);


        $pt = Perusahaan::findOrFail($request->fk_nama_perusahaan);
        $cabang = Cabang::findOrFail($request->fk_cabang);
        $jabatan = LevelJabatan::findOrFail($request->fk_level_jabatan);
        $bagian = Bagian::findOrFail($request->fk_bagian);
        
        #Update Transfer data
        $data->fk_cabang           = $cabang->id;
        $data->fk_bagian           = $bagian->id;
        $data->fk_level_jabatan    = $jabatan->id;
        $data->status_karyawan     = $request->status_karyawan;
        $data->fk_nama_perusahaan  = $pt->id;
        
        $data->save();
        return response()->json(['message' => 'Transfer karyawan berhasil di update'], 200);
    }


    public function storetransferbulk(Request $request) {
        $validator = Validator::make($request->all(), [
            #'tanggal'           => 'required',
            'tgl_transfer'      => 'required',
            'id_karyawan'       => 'required',
            'type'              => 'required',
            'status_karyawan'   => 'required',
            'fk_cabang'         => 'required',
            'fk_bagian'         => 'required',
            'fk_level_jabatan'  => 'required',
            'fk_nama_perusahaan'=> 'required',
            'keterangan'        => 'required',
        ]);

        $data = Karyawan::find($request->id_karyawan);
        $skr = Carbon::now();
        #create history Transfer
        $trans = KaryawanTransfer::create([
            'tanggal'           => $skr,
            'tgl_transfer'      => $request->tgl_transfer,
            'id_karyawan'       => $request->id_karyawan,
            'type'              => $request->type,
            'status_karyawan'   => $data->status_karyawan,
            'fk_cabang'         => $data->fk_cabang,
            'fk_bagian'         => $data->fk_bagian,
            'fk_level_jabatan'  => $data->fk_level_jabatan,
            'fk_nama_perusahaan'=> $data->fk_nama_perusahaan,
            'keterangan'        => $request->keterangan,
        ]);


        $pt = Perusahaan::findOrFail($request->fk_nama_perusahaan);
        $cabang = Cabang::findOrFail($request->fk_cabang);
        $jabatan = LevelJabatan::findOrFail($request->fk_level_jabatan);
        $bagian = Bagian::findOrFail($request->fk_bagian);
        
        #Update Transfer data
        $data->fk_cabang           = $cabang->id;
        $data->fk_bagian           = $bagian->id;
        $data->fk_level_jabatan    = $jabatan->id;
        $data->status_karyawan     = $request->status_karyawan;
        $data->fk_nama_perusahaan  = $pt->id;
        
        $data->save();
        return response()->json(['message' => 'Transfer karyawan Bulk berhasil di update'], 200);
    }

    public function kontrak($id)
    {
        $kar = Karyawan::findOrFail($id);
        $pdf = \PDF::loadView('employ.kontrak', compact('kar'))->setPaper('a4', 'potrait');
        return $pdf->stream('Kontrak.pdf');
    }

    public function pkwt($id)
    {
        $kar = Karyawan::findOrFail($id);
        $pdf = \PDF::loadView('employ.perjanjian', compact('kar'))->setPaper('a4', 'potrait');
        return $pdf->stream('PKWT.pdf');
    }

    public function sp($id)
    {
        $kar = Karyawan::findOrFail($id);
        $pdf = \PDF::loadView('employ.peringatan', compact('kar'))->setPaper('a4', 'potrait');
        return $pdf->stream('Teguran.pdf');
    }


    public function showsp($id) {
        $tr = Karyawan::find($id);
        $pasal = PasalPelanggaran::all();
        $employes = Karyawan::whereIn('status_karyawan',["Contract","K3","Permanent","PHL","Probation"])->get();
        return view('employ.spkaryawan')->with(['data'=>$tr,'pasal'=>$pasal,'employes'=>$employes]);
        }

    public function cekpasal($id) {
        $pasal = PasalPelanggaran::find($id);
        return response()->json(['data'=>$pasal], 200);
        }

    public function storesp(Request $request) {
        $validator = Validator::make($request->all(), [
        #'startdate'   => 'required',
        #'enddate'     => 'required',
        'sangsi'      => 'required',
        'pasal'       => 'required',
        'keterangan'  => 'required',
        'id_kar'      => 'required',
        ]);

        $kar = Karyawan::findOrFail($request->id_kar);
        $user_id = Auth::id();
        $pasal = PasalPelanggaran::findOrFail($request->pasal);

        $trans = Peringatan::create([
        'id_karyawan'      => $kar->id,
        'user_aju_id'      => $user_id,
        'pasal_id'         => $pasal->id,
        'jenis_peringatan' => $request->sangsi,
        'status_approve'   => 'Request',
        'note'		       => $request->keterangan,
        ]);

        if($request->watcher){
            foreach ($request->watcher as $item) {
                $savewt = Watcher::create([
                    'id_watcher' => $item,
                    'id_sp'   => $trans->id,
                    ]);
            }

        }
        return response()->json(['message' => 'Peringatan Berhasil Disimpan'], 200);
    }

    // public function subordinate(Request $request) {
    //     $id_user = Auth::user();
    //     $lvl_jab = $id_user->getkaryawan->fk_level_jabatan;
    //     $tingkat = LevelJabatan::where('id', '=' , $lvl_jab)->get(['nama']);

    //     if ( (str_contains($tingkat, 'Manager')) || (str_contains($tingkat, 'Supervisor')) ) {
    //         $subordinate = Karyawan::where('fk_level_jabatan' , '=' , $lvl_jab)
    //         ->orwhereHas('jabatan', function ($query) use ($lvl_jab)
    //         { $query->where('parent_id','=', $lvl_jab);})->paginate(10);
    //     } else {
    //         $subordinate = Karyawan::where('fk_user','=','$id_user')->paginate(10);
	//     }
	//     if ($request->ajax()) {
    //         return view('employ.subordinatepage', ['subordinate' => $subordinate])->render();
    //     }
    //     return view ('employ.subindex1',compact('subordinate'));
    // }

    public function subordinate(Request $request) {
        $id_user = Auth::user();
        $lvl_jab = $id_user->getkaryawan->fk_level_jabatan;
        $tingkat = LevelJabatan::where('id', '=', $lvl_jab)->get(['nama']);
    
        if ((str_contains($tingkat, 'Manager')) || (str_contains($tingkat, 'Supervisor'))) {
            $subordinate = Karyawan::where('fk_level_jabatan', '=', $lvl_jab)
                ->orWhereHas('jabatan', function ($query) use ($lvl_jab) {
                    $query->where('parent_id', '=', $lvl_jab);
                })
                ->whereIn('status_karyawan', ['Contract', 'K3', 'PHL', 'Probation'])
                ->whereNotIn('status_karyawan', ['Resign', 'PHK'])
                ->paginate(10);
        } else {
            $subordinate = Karyawan::where('fk_user', '=', $id_user)
                ->whereIn('status_karyawan', ['Contract', 'K3', 'PHL', 'Probation'])
                ->whereNotIn('status_karyawan', ['Resign', 'PHK'])
                ->paginate(10);
        }
        
        if ($request->ajax()) {
            return view('employ.subordinatepage', ['subordinate' => $subordinate])->render();
        }
        
        return view('employ.subindex1', compact('subordinate'));
    }
    
    

    
    public function suborabsen(Request $request) {
        $id_user = Auth::user();
        $lvl_jab = $id_user->getkaryawan->fk_level_jabatan;
        $tingkat = LevelJabatan::where('id', $lvl_jab)->value('nama');

        if (str_contains($tingkat, ['Manager', 'Supervisor'])) {
            $subordinate = Karyawan::where('fk_level_jabatan', $lvl_jab)
                ->orWhereHas('jabatan', function ($query) use ($lvl_jab) {
                    $query->where('parent_id', $lvl_jab);
                })
                ->with(['presensi' => function ($query) {
                    $query->whereDate('tanggal', now()->format('Y-m-d'))
                        ->select('id_karyawan', 'jam_masuk', 'jam_pulang', 'istirahat_keluar', 'istirahat_masuk');
                }])
                ->paginate(10);
        } else {
            $subordinate = Karyawan::where('fk_user', $id_user)
                ->with(['presensi' => function ($query) {
                    $query->whereDate('tanggal', now()->format('Y-m-d'))
                        ->select('id_karyawan', 'jam_masuk', 'jam_pulang', 'istirahat_keluar', 'istirahat_masuk');
                }])
                ->paginate(10);
        }

        if ($request->ajax()) {
            return response()->json($employes);
                #return view('employ.subordinatepage', ['subordinate' => $subordinate]);
            }
        #return view('employ.subordinatepage', ['subordinate' => $subordinate]);
        return response()->json($employes);

        #return view('employ.subindex1', compact('subordinate'));
    }

    ##Import Data External
    public function eximindex()
    {
        $cabs = Cabang::all();
        $jabs = LevelJabatan::all();
        return view ('employ.bulk.eximindex',compact('jabs', 'cabs'));
        // return view('employ.bulk.eximindex');
    }

    public function bulkupdateiternal()
    {
        $cabs = Cabang::all();
        $jabs = LevelJabatan::all();
        return view ('employ.bulk.eximindexinternal',compact('jabs', 'cabs'));
        // return view('employ.bulk.eximindex');
    }
    
    public function bulkcutikar()
    {
        $cabs = Cabang::all();
        $jabs = LevelJabatan::all();
        return view ('employ.bulk.bulkcutikar',compact('jabs', 'cabs'));
    }    

    public function cutiformatexcel(Request $request)
    {
        return Excel::download(new CutiFormatExcel, 'FormatExcelCuti.xlsx');
    }

    public function eksebulkcutikar()
    {
        try {
            $file = request()->file('filecutibulk');
            if (!$file) {
                throw new Exception('Silakan pilih file untuk diunggah.');
            }
            Excel::import(new BulkCutiKaryawan, $file);
            return response()->json(['message' => 'Data Cuti karyawan berhasil diimport!']);
        }
            catch (\Exception $e) {
                return response()->json(['message' => 'Terjadi kesalahan saat mengimport data: ' . $e->getMessage()], 500);
        }
    }


    public function bulkupdateexternal()
    {
        $cabs = Cabang::all();
        $jabs = LevelJabatan::all();
        return view ('employ.bulk.eximindexexternal',compact('jabs', 'cabs'));
        // return view('employ.bulk.eximindex');
    }

    public function externalkaryawanimport()
    {
        try {
            $file = request()->file('file');
            if (!$file) {
                throw new Exception('Silakan pilih file untuk diunggah.');
            }
            Excel::import(new ExternalKaryawanImport, $file);
            return response()->json(['message' => 'Data karyawan berhasil diimport!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat mengimport data karyawan: ' . $e->getMessage()], 500);
        }
    }

    public function exporteksternal(Request $request)
    {
        return Excel::download(new EksternalbulkExport, 'Eksternalbulk.xlsx');
    }
    
    public function exportinternal(Request $request)
    {
        $tgl_lahir  = Carbon::create(1990, 1, 21)->format('Y-m-d');
	$thn_gabung = Carbon::create(2022, 1, 21);
	$expired_kontrak = Carbon::create(2023, 1, 21);
        return Excel::download(new InternalbulkExport($tgl_lahir,$thn_gabung,$expired_kontrak), 'Internalbulk.xlsx');
        #return Excel::download(new InternalbulkExport, 'Internalbulk.xlsx');
    }
    ###Edit Bulk External
    public function eksetempbulkex(Request $request)
    {
        if($request->cabang[0] == "RKM--" and $request->jabatan[0] == "All"){
            $employes = Karyawan::where('jenis_karyawan', 'like', '%External%')->get();
        }
        if($request->cabang[0] == "RKM--" and $request->jabatan[0] != "All"){
            $jab = LevelJabatan::where('nama', $request->jabatan)
            ->orwhere('id', $request->jabatan)->first();
            $employes = Karyawan::where('fk_level_jabatan', $jab->id)
            ->where('jenis_karyawan', 'like', '%External%')
            ->get();
        }
        if($request->cabang[0] != "RKM--" and $request->jabatan[0] == "All"){
            $cab = Cabang::where('nama', $request->cabang)->first();
            $employes = Karyawan::where('fk_cabang',$cab->id)
            ->where('jenis_karyawan', 'like', '%External%')
            ->get();
        }
        if($request->cabang[0] != "RKM--" and $request->jabatan[0] != "All"){
            $jab = LevelJabatan::where('nama', $request->jabatan)
            ->orwhere('id', $request->jabatan)->first();
            $cab = Cabang::where('nama', $request->cabang)->first();
            $employes = Karyawan::where('fk_cabang',$cab->id)
            ->where('fk_level_jabatan', $jab->id)
            ->where('jenis_karyawan', 'like', '%External%')
            ->get();
        }
        return Excel::download(new TemplateEksternalExport($employes), 'TemplateEksternalExport.xlsx');#membuat excel
    }

    // public function exportemployeexternal(Request $request)
    // {
    //     // dd('External cuyy');
    //     $validator = Validator::make($request->all(), [
    //         // 'exin'            => 'required',
    //         'employ_status'   => 'required',
    //         'branch'          => 'required',
    //         'organization'    => 'required',
    //         ]);
    // if($request->employ_status == ["active"]){
    //     $status = ['Probation','PHL','Contract','Permanent','AKTIF','PKWT'];
    // }
    // if($request->employ_status == ["resign"]){
    //     $status = ['PHK','Habis Kontrak','HabisKontrak','Resign'];
    // }
    // if($request->employ_status == ["active","resign"]){
    //     $status = ['Probation','PHL','Contract','Permanent','AKTIF','PKWT','PHK','Habis Kontrak','HabisKontrak','Resign'];
    // }
    // if($request->employ_status == ["All","active","resign"]){
    //     $status =['Probation','PHL','Contract','Permanent','AKTIF','PKWT','PHK','Habis Kontrak','HabisKontrak','Resign'];
    // }
    //     $employes = Karyawan::whereIn('fk_cabang',$request->branch)
    //     ->where('jenis_karyawan', 'like', '%External%')
    //     ->whereIn('status_karyawan',$status)
    //     ->whereIn('fk_bagian',$request->organization)
    //     ->get();
        
    // return Excel::download(new ExportEmployeExternal($employes), 'ExportEmployeExternal.xlsx');#membuat excel
    // }

    public function exportemployeexternal(Request $request)
    {
        // dd('External cuyy');
        $validator = Validator::make($request->all(), [
            'exin'            => 'required',
            'employ_status'   => 'required',
            'branch'          => 'required',
            'organization'    => 'required',
            ]);
    if($request->employ_status == ["active"]){
        $status = ['Probation','PHL','Contract','Permanent','AKTIF','PKWT'];
    }
    if($request->employ_status == ["resign"]){
        $status = ['PHK','Habis Kontrak','HabisKontrak','Resign'];
    }
    if($request->employ_status == ["active","resign"]){
        $status = ['Probation','PHL','Contract','Permanent','AKTIF','PKWT','PHK','Habis Kontrak','HabisKontrak','Resign'];
    }
    if($request->employ_status == ["All","active","resign"]){
        $status =['Probation','PHL','Contract','Permanent','AKTIF','PKWT','PHK','Habis Kontrak','HabisKontrak','Resign'];
    }
    
        $employes = Karyawan::whereIn('fk_cabang',$request->branch)
        ->where('jenis_karyawan', 'like', '%External%')
        ->whereIn('status_karyawan',$status)
        ->whereIn('fk_bagian',$request->organization)
        ->get();
        
    return Excel::download(new ExportEmployeExternal($employes), 'ExportEmployeExternal.xlsx');#membuat excel
    }


    public function exportemployeinternal(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'employ_status'   => 'required',
            'branch'          => 'required',
            'organization'    => 'required',
            ]);
    if($request->employ_status == ["active"]){
        $status = ['Probation','PHL','Contract','Permanent','AKTIF','PKWT'];
    }
    if($request->employ_status == ["resign"]){
        $status = ['PHK','Habis Kontrak','HabisKontrak','Resign'];
    }
    if($request->employ_status == ["active","resign"]){
        $status = ['Probation','PHL','Contract','Permanent','AKTIF','PKWT','PHK','Habis Kontrak','HabisKontrak','Resign'];
    }
    if($request->employ_status == ["All","active","resign"]){
        $status =['Probation','PHL','Contract','Permanent','AKTIF','PKWT','PHK','Habis Kontrak','HabisKontrak','Resign'];
    }
        $employes = Karyawan::whereIn('fk_cabang',$request->branch)
        ->where('jenis_karyawan', 'like', '%Internal%')
        ->whereIn('status_karyawan',$status)
        ->whereIn('fk_bagian',$request->organization)
        ->get();
    return Excel::download(new ExportEmployeInternal($employes), 'ExportEmployeInternal.xlsx');#membuat excel
    }

    
    public function intetempbulkex(Request $request)
    {
        // dd($request->all());

    $employes = Karyawan::whereIn('fk_cabang',$request->cabang_id)->get();
    // dd($employes);
	if($request->cabang[0] == "RKM--" and $request->jabatan[0] == "All"){
	    $employes = Karyawan::where('jenis_karyawan', 'like', '%Internal%')->get();
	}if($request->cabang[0] == "RKM--" and $request->jabatan[0] != "All"){
           $jab = LevelJabatan::where('nama', $request->jabatan)
           ->orwhere('id', $request->jabatan)->first();
           $employes = Karyawan::where('fk_level_jabatan', $jab->id)
             ->where('jenis_karyawan', 'like', '%Internal%')
             ->get();
        }if($request->cabang[0] != "RKM--" and $request->jabatan[0] == "All"){
            $cab = Cabang::where('nama', $request->cabang)->first();
            $employes = Karyawan::where('fk_cabang',$cab->id)
            ->where('jenis_karyawan', 'like', '%Internal%')
            ->get();
	}if($request->cabang[0] != "RKM--" and $request->jabatan[0] != "All"){
            $jab = LevelJabatan::where('nama', $request->jabatan)
                ->orwhere('id', $request->jabatan)->first();
	    $cab = Cabang::where('nama', $request->cabang)->first();
            $employes = Karyawan::where('fk_cabang',$cab->id)
                ->where('fk_level_jabatan', $jab->id)
                ->where('jenis_karyawan', 'like', '%Internal%')
                ->get();
        }
    return Excel::download(new TemplateInternalExport($employes), 'TemplateInternalExport.xlsx');#membuat excel
    }

    public function editbulkkaryawanexternal()
    {
        try {
            $file = request()->file('fileeditexternal');
            if (!$file) {
                throw new Exception('Silakan pilih file untuk diunggah.');
            }
            Excel::import(new EditBulkKaryawanExternal, $file);
            return response()->json(['message' => 'Data karyawan berhasil diimport!']);
        }
            catch (\Exception $e) {
                return response()->json(['message' => 'Terjadi kesalahan saat mengimport data karyawan: ' . $e->getMessage()], 500);
        }
    }

    public function editbulkkaryawaninternal()
    {
        try {
            $file = request()->file('fileeditinternal');
            if (!$file) {
                throw new Exception('Silakan pilih file untuk diunggah.');
            }
            Excel::import(new EditBulkKaryawanInternal, $file);
            return response()->json(['message' => 'Data karyawan berhasil diimport!']);
        }
            catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat mengimport data karyawan: ' . $e->getMessage()], 500);
        }
    }
    ##SEPURRRRR
 public function presensisubordinate(Request $request)
{
    $start_date = $request->startdate;
    $end_date = $request->enddate;
    $id_user = Auth::user();
    $cabang = Cabang::all();
    $skr = Carbon::now()->toDateString();
    $lvl_jab = $id_user->getkaryawan->fk_level_jabatan;

    if ((!$start_date) || (!$end_date)) {
        $subordinate = Presensi::with('preskaryawan.jabatan')
            ->whereDate('tanggal', '=', $skr)
            ->whereHas('preskaryawan.cabang', function ($query) use ($id_user) {
                $query->where('fk_cabang', '=', $id_user->getkaryawan->fk_cabang);
            })
            ->whereHas('preskaryawan.jabatan', function ($query) use ($lvl_jab) {
                $query->where('parent_id', '=', $lvl_jab);
            })
            ->with(['preskaryawan' => function ($query) {
                $query;
            }])
            ->paginate(2);
    } else {
        $subordinate = Presensi::with('preskaryawan.jabatan')
            ->whereBetween('tanggal', [$start_date, $end_date])
            ->whereHas('preskaryawan.cabang', function ($query) use ($id_user) {
                $query->where('fk_cabang', '=', $id_user->getkaryawan->fk_cabang);
            })
            ->whereHas('preskaryawan.jabatan', function ($query) use ($lvl_jab) {
                $query->where('parent_id', '=', $lvl_jab);
            })
            ->with(['preskaryawan' => function ($query) {
                $query;
            }])
            ->paginate(10);
    }

    if ($request->ajax()) {
        return view('employ.suborabsen', compact('subordinate', 'cabang'));
    }

    return view('employ.suborabsen', compact('subordinate', 'cabang'));
}

    public function showeditpersonaldata($id)
    {
        $personalkaryawan = Karyawan::find($id);
        return view('employ.edit_personal_data_profile')->with(['data'=>$personalkaryawan]);
    }

    public function storepersonalprofil(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_kar'            => 'required',
            'agama'             => 'required',
            'gender'            => 'required',
            'golongan_darah'    => 'required',
            'status_pernikahan' => 'required',
            'tgl_lahir'         => 'required',
            'tempat_lahir'      => 'required',
            'email'             => 'required',
            'no_telp'           => 'required',
            'mobile_phone'      => 'required',
            'nama'              => 'required',
            ]);
        if($validator->fails()){
                return response()->json($validator->errors());       
            }            
        $karupdate = Karyawan::find($request->id_kar);
            $karupdate->agama             = $request->agama;
            $karupdate->gender            = $request->gender;
            $karupdate->golongan_darah    = $request->golongan_darah;
            $karupdate->status_pernikahan = $request->status_pernikahan;
            $karupdate->tgl_lahir         = $request->tgl_lahir;
            $karupdate->tempat_lahir      = $request->tempat_lahir;
            $karupdate->email             = $request->email;
            $karupdate->no_telp           = $request->no_telp;
            $karupdate->no_hp             = $request->mobile_phone;
            $karupdate->nama_lengkap      = $request->nama;
            $karupdate->save();
        
        $userupdate = User::where('email',$karupdate->email)->update([
            'email' => $karupdate->email,
            'phone_number' => $karupdate->no_hp,
        ]);
        return view('employ.edit_personal_data_profile')->with(['data'=>$karupdate]);
    }

    public function showeditemploydata($id)
    {
        $personalkaryawan = Karyawan::find($id);
        $pt = Perusahaan::all();
        $cabs = Cabang::all();
        $bagian = Bagian::all();
        $jabatan = LevelJabatan::all();


        return view('employ.edit_employment_data_profile')->with(['jabatan'=>$jabatan,'bagian'=>$bagian,'data'=>$personalkaryawan,'pt'=>$pt,'cabs'=>$cabs]);
    }

    public function saveeditemploydata(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fk_nama_perusahaan'    => 'required',
            'nik'                   => 'required',
            'fk_level_jabatan'      => 'required',
            'tahun_gabung'      => 'required',
            'fk_cabang'             => 'required',
            'fk_bagian'             => 'required',
            'status_karyawan'       => 'required',
            'tahun_keluar'       => 'required',



            ]);
        if($validator->fails()){
                return response()->json($validator->errors());       
            }            
            $karupdate = Karyawan::find($request->id_kar);
            $pt = Perusahaan::findOrFail($request->fk_nama_perusahaan);
            $jabatan = LevelJabatan::findOrFail($request->fk_level_jabatan);
            $cabang = Cabang::findOrFail($request->fk_cabang);
            $bagian = Bagian::findOrFail($request->fk_bagian);
            $karupdate->fk_nama_perusahaan  = $pt->id;
            $karupdate->fk_cabang           = $cabang->id;
            $karupdate->fk_level_jabatan    = $jabatan->id;
            $karupdate->fk_bagian           = $bagian->id;
            $karupdate->nomor_induk_karyawan = $request->nik;
            $karupdate->tahun_gabung           = $request->tahun_gabung;
            $karupdate->status_karyawan     = $request->status_karyawan;
            $karupdate->tahun_keluar           = $request->tahun_keluar;
            $karupdate->save();
        // return view('employ.edit_employment_data_profile')->with(['data'=>$karupdate]);
        return response()->json(['message' => 'Data berhasil Di Edit '], 200);

    }


    public function showidentityaddressprofile($id)
    {
        $personalkaryawan = Karyawan::find($id);
        return view('employ.edit_identity_address_profile')->with(['data'=>$personalkaryawan]);
    }
    

    public function saveidentityaddressprofile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_kar'            => 'required',
            'no_identitas'      => 'required',
            'alamat'            => 'required',
            ]);
        if($validator->fails()){
                return response()->json($validator->errors());       
            }            
        $karupdate = Karyawan::find($request->id_kar);
            $karupdate->no_identitas      = $request->no_identitas;
            $karupdate->kodepos           = $request->kodepos;
            $karupdate->alamat            = $request->alamat;
            $karupdate->save();
        return view('employ.edit_personal_data_profile')->with(['data'=>$karupdate]);
    }

}
    
	