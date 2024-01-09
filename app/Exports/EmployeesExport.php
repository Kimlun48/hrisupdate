<?php

namespace App\Exports;

use App\Models\Karyawan;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Support\Responsable;

class EmployeesExport implements FromView
{
    private $employes,$cabang;
    public function __construct($employes,$cabang)
    {
        $this->employes = $employes;
        $this->cabang = $cabang;
    }

    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('employ.report_employ_excel',['employes'=>$this->employes,'cabang'=>$this->cabang]);
    }
}

