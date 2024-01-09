<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loker;
use App\Models\Posisijob;
use App\Models\Pelamar;
use App\Models\Apllyloker;
use App\Models\Cabang;
use App\Models\Verifikasi;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use DateTime;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PelamarsExport;

class PelamarController extends Controller
{
    public function index(Request $request)
    {
    //     $length = $request->choiceValue ? $request->choiceValue : 10;
    //     $search = $request->search ? $request->search : null;

	// if ($request->has('progres')) {
	//          $list = Apllyloker::whereHas('pelamar', function ($query) use ($request){
    //              $query->where('progres', '=', "{$request->progres}")
    //              ->orwhere('status','like','%'.request('progres').'%');
                 
    //          })
    //          ->latest()->paginate(20);
    //          return view('pelamar.showpelamar', compact('list'));	

    //        }
       # dd(phpinfo());

        


        if ($request->has('report')) {
            $this->validate($request, [
            'startdate' => 'required|min:5',
            'enddate'=> 'required',
            'format'=> 'required'
            ]);

            if($request->format=='view'){
                $list = Apllyloker::whereBetween('tanggal', [$request->startdate, $request->enddate])->paginate(100)->withQueryString();
                return view('pelamar.index', compact('list'));	
            }
            if($request->format=='excel'){
                $list = Apllyloker::whereBetween('tanggal', [$request->startdate, $request->enddate])->get();
                $start_date = $request->startdate;
                $end_date = $request->enddate;
                return (new PelamarsExport($list,$start_date,$end_date))->download('Pelamar.xlsx');#membuat excel
            }
            if($request->format=='pdf'){
                $start_date = $request->startdate;
                $end_date = $request->enddate;
                $list = Apllyloker::whereBetween('tanggal', [$request->startdate, $request->enddate])->get();
                $pdf = \PDF::loadView('pelamar.range_aplicant', compact('list','start_date','end_date'));
                return $pdf->download('Pelamar-pdf.pdf');
            }
	// }
	// // if ($request->has('search')) {
    // //         $list = Apllyloker::whereHas('pelamar', function ($query) {
    // //         $query->where('progres','like','%'.request('search').'%')
    // //         ->orwhere('nama_lengkap','like','%'.request('search').'%')
    // //         ->orwhere('status','like','%'.request('search').'%')
    // //         ->orwhere('kota','like','%'.request('search').'%')
    // //         ->orwhere('nama_sekolah','like','%'.request('search').'%')
    // //         ->orwhere('pendidikan_terakhir','like','%'.request('search').'%');})
    // //         ->orwhereHas('loker', function ($query){
    // //             $query->where('lowongan_kerja', 'like', '%'.request('search').'%');
    // //             })
    // //         ->orwhereHas('loker.cabang', function ($query){
    // //             $query->where('nama', 'like', '%'.request('search').'%');
    // //             })
    // //         ->latest()->paginate(20)->withQueryString();
    // //         return view('pelamar.showpelamar', ['list' => $list])->render();
    // //     } else {
           $list = Apllyloker::with('pelamar')->latest()->paginate(20);
    //     }
        if ($request->ajax()) {
            return view('pelamar.showpelamar', ['list' => $list])->render();
        }
        return view ('pelamar.index');
        
    }

    // public function viewprogress(Request $request, $progress){

    //     $applyloker = Applyloker::whereHas('progres', '=', $progress)
    //     ->latest()->pagination(20);
    //     return view('pelamar.showpelamar',compact('applyloker'));

    // }
	
#        else {
#	     $list = Apllyloker::with('pelamar')->latest()->paginate(20);
#             return view('pelamar.index', compact('list'));	
#         }   	
        #if ($request->has('search')) {
        #    #$list compact(): Undefined variable $list1= Apllyloker::where('progres', 'like', "%" . $request->search . "%")->latest()->paginate(20);
	#    $list = Apllyloker::whereHas('pelamar', function ($query) use ($request){
        #        $query->where('progres', 'like', "%{$request->search}%")
        #        ->orwhere('nama_lengkap', 'like', '%'.$request->search.'%')
        #        ->orwhere('nama_sekolah', 'like', '%'.$request->search.'%')
        #        ->orwhere('pendidikan_terakhir', 'like', '%'.$request->search.'%');
        #    })->latest()->paginate(20);
        #}else {
        #    $list = Apllyloker::latest()->paginate(20);
        #}
        #return view('pelamar.index', compact('list'));	
    }

    public function show (Request $request) {
          

        //$length = $request->buttonValue? $request->buttonValue : 10;
       $search = $request->search ? $request->search : null;
       

        if ($request->has('progres')) {
            $list = Apllyloker::whereHas('pelamar', function ($query) use ($request){
                $query->where('progres', '=', "{$request->progres}")
                ->orwhere('status','like','%'.request('progres').'%');
           // $list = $applyloker;
            })
            ->latest()->paginate(20);
             return view('pelamar.showpelamar', compact('list'));	
           // return view ('pelamara.showpelamar', ['list' => $apllyloker]);
          }

        if ($request->has('$search')) {
            $src = Apllyloker::whereHas('pelamar', function ($query) {
            $query->where('progres','like','%'.request('$search').'%')
            ->orwhere('nama_lengkap','like','%'.request('$search').'%')
            ->orwhere('status','like','%'.request('$search').'%')
            ->orwhere('kota','like','%'.request('$search').'%')
            ->orwhere('nama_sekolah','like','%'.request('$search').'%')
            ->orwhere('pendidikan_terakhir','like','%'.request('$search').'%');})
            ->orwhereHas('loker', function ($query){
                $query->where('lowongan_kerja', 'like', '%'.request('$search').'%');
                })
            ->orwhereHas('loker.cabang', function ($query){
                $query->where('nama', 'like', '%'.request('$search').'%');
                })
            ->latest()->paginate(20)->withQueryString();
            return view('pelamar.showpelamar', ['list' => $src])->render();
        } else {
            $src = Apllyloker::with('pelamar')->latest()->paginate(20);
        }
        if ($request->ajax()) {
            return view('pelamar.showpelamar', ['list' => $src])->render();
        }
        return view ('pelamar.index',compact('$src'));
          
          
          

    }

    public function create()
    {
	//
    }

    public function store(Request $request)
    {
       //
    }

    public function saveaplly($idloker,$idlamar)
    {
	//
    }

    // public function detail($id)
    // {
    //     //get List Loker
    //     $list = Apllyloker::where('id', $id)->first();
    //     $vers = Verifikasi::where('fk_apply', $id)->get();
    //     return view('pelamar.detailpelamar', compact('list','vers'));
    // } 
    
    public function readdata($status)
    {
        $lis = Apllyloker::where('status', $status)
        ->latest()->paginate(20);
        // $loks = Loker::where('status', $status)
        // ->paginate(20);
       return view('pelamar.showpelamar', compact('lis'));
    }

    // public function viewprogress($progress){

    //     $applyloker = Applyloker::where('progress', $progress)
    //     ->latest()->pagination(20);
    //     return view('pelamar.showpelamar',compact('applyloker'));

    // }


    public function listapply($id)
    {
        //get List Loker
    }   

    // public function listData ()
    //  {
    //     $apllyloker = Applyloker :: all()
    //     -> orderBY(nama_lengkap) 
    //     ->get();
            
    //         return Datatables::of($data)->escapeColumns([])->make(true);
    //         $no = 0; 
    //         $data = array();
    //         foreach ($apllyloker as $list) {
    //             $no ++;
    //             $row = array();
    //             $row[] = $no;
    //             $row[] = $list->nama_lengkap;
    //             $row[] = $list->hubungan_keluarga;
    //             $row[] = $list->pendidikan_terakhir;
    //             $row[] = $row;
    //         }
            
    //         return Datatables::of($data)->escapeColumns([])->make(true);

    //  }


    public function adm()
    {
        $uss = Pelamar::all();
        return view('pelamar.administrasi', compact('uss'));
    } 

    public function showapp($id) {
        $det = Apllyloker::find($id);
        return view('pelamar.modalapprove', compact('det'));
    }

    public function showrej($id) {
        $det = Apllyloker::find($id);
        return view('pelamar.modalreject', compact('det'));
    }

    public function showdetail($id) {
        $det = Apllyloker::find($id);
        return view('pelamar.detailpelamar', compact('det'));
    }



 }
        



/*
    public function index(Request $request)
    {
        $title="Data Pelamar Kerja";
        if (request()->ajax()){
            $query = Applicant::with('formation')->get();
       //      $query = Applicant::all('formation')->where('status','active')->get();
            return DataTables::of($query)
            ->addColumn('action', function($item){
            return 
              '
              <div class="btn-group">
              <a href="#!" data-toggle="tooltip"  data-id="'.$item->id.'" class="btn btn-sm btn-danger delete-data">Hapus</a>
              </div>
              ';
            })
            ->editColumn('status', function ($item){
                if ($item->status == 'quo'){
                     return '<span class="badge-text badge-text-small info"><ion-icon name="checkmark-circle"></ion-icon> '.$item->status.'</span>';
                }else{
                     return '<span class="badge-text badge-text-small success"><ion-icon name="close-circle"></ion-icon>'.$item->status.'</span>';
                }
            })
             ->editColumn('formations_id', function ($item){
                if ($item->formations_id == 0 || $item->formations_id == NULL){
                     return '<span class="text-danger">-</span>';
                }else{
                     return $item->formation->name;
                }
            })
             ->filter(function ($instance) use ($request) {
                        if ($request->get('status') == 'quo' || $request->get('status') == 'melamar') {
                            $instance->where('status', $request->get('status'));
                        }
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                $w->orWhere('name', 'LIKE', "%$search%")
                                ->orWhere('email', 'LIKE', "%$search%");
                            });
                        }
              })
       
            ->addIndexColumn()
            ->removeColumn('id')
            ->rawColumns(['action','status','formations_id'])
            ->make(true);
       }
        return view('pages.admin.applicant.index',['title'=>$title]);
    }


    var datatable = $('#appTable').DataTable({
            processing:true,
            serverSide:true,
            ordering:true,
            ajax:{
                     url:'{!! url()->current() !!}',
                     data: function (d) {
                     d.status = $('#status').val(),
                     d.search = $('input[type="search"]').val()
              }
            },
            columns:[
                {data: 'DT_RowIndex', name:'DT_RowIndex'},
                {data:'name', name:'name'},
                {data:'gender', name:'gender'},
                {data:'email', name:'email'},
                {data:'status', name:'status'},
                {data:'formations_id', name:'formations_id'},
                {
                    data:'action',
                    name:'action',
                    orderable:false,
                    searcable:false,
                    width:'15%'
                },
            ],
            order:[
                [0,'asc']
            ]
       });
       $('#status').change(function(){
       datatable.draw();
       });
*/

