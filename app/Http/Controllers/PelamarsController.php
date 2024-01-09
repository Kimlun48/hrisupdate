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

class PelamarsController extends Controller
{

    public function index(Request $request)
    {

        if ($request->has('report')) {
            $this->validate($request, [
                'startdate' => 'required|min:5',
                'enddate' => 'required',
                'format' => 'required'
            ]);

            if ($request->format == 'view') {
                $list = Apllyloker::whereBetween('tanggal', [$request->startdate, $request->enddate])->paginate(100)->withQueryString();
                return view('pelamar.index', compact('list'));
            }
            if ($request->format == 'excel') {
                $list = Apllyloker::whereBetween('tanggal', [$request->startdate, $request->enddate])->get();
                $start_date = $request->startdate;
                $end_date = $request->enddate;
                return (new PelamarsExport($list, $start_date, $end_date))->download('Pelamar.xlsx'); #membuat excel
            }
            if ($request->format == 'pdf') {
                $start_date = $request->startdate;
                $end_date = $request->enddate;
                $list = Apllyloker::whereBetween('tanggal', [$request->startdate, $request->enddate])->get();
                $pdf = \PDF::loadView('pelamar.range_aplicant', compact('list', 'start_date', 'end_date'));
                return $pdf->download('Pelamar-pdf.pdf');
            }
        }
            $list = Apllyloker::with('pelamar')->latest()->paginate(20);
        
        return view('pelamar.index', compact('list'));
    }

    

    public function show()
    {
        //dd(request('progres'));
        $list =  Apllyloker::with(['loker', 'pelamar'])->latest()->filter(request(['progres', 'search']))->paginate(20)->withQueryString();
        return view('pelamar.showpelamar', ['list' => $list])->render();
    }
    


    public function adm()
    {
        $uss = Pelamar::all();
        return view('pelamar.administrasi', compact('uss'));
    }

    public function showapp($id)
    {
        $det = Apllyloker::find($id);
        return view('pelamar.modalapprove', compact('det'));
    }

    public function showrej($id)
    {
        $det = Apllyloker::find($id);
        return view('pelamar.modalreject', compact('det'));
    }

    public function showdetail($id)
    {
        $det = Apllyloker::find($id);
        return view('pelamar.detailpelamar', compact('det'));
    }

    
}
