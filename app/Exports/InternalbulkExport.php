<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use App\Models\Karyawan;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\WithTitle;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
class InternalbulkExport implements FromView
{

    private $tgl_lahir,$thn_gabung,$expired_kontrak;
    public function __construct($tgl_lahir,$thn_gabung,$expired_kontrak)
    {
        $this->tgl_lahir = $tgl_lahir;
        $this->thn_gabung = $thn_gabung;
        $this->expired_kontrak = $expired_kontrak;

    }

    use Exportable;

    public function collection()
    {
    }

    public function view(): View
    {
    {
	    #return view('employ.bulk.export_internal');
	    return view('employ.bulk.export_internal',['tgl_lahir'=>$this->tgl_lahir,'thn_gabung'=> $this->thn_gabung, 'expired_kontrak'=>$this->expired_kontrak]);


        }
    }
}

