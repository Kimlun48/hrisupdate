<?php

namespace App\Exports;

use App\Models\Karyawan;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Support\Responsable;

class PresensisExport implements FromView
{
    private $cabang,$prs;
    public function __construct($cabang,$prs)
    {
        
        $this->cabang = $cabang;
        $this->prs = $prs;

    }

    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('presensi.report_presensi_excel',['prs'=>$this->prs,'cabang'=>$this->cabang]);
    }
}


