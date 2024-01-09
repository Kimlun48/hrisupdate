<?php

namespace App\Exports;

use App\Models\Karyawan;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Support\Responsable;

class TemplateInternalExport implements FromView
{
    use Exportable;

    private $employes;
    public function __construct($employes)
    {
        $this->employes = $employes;
    }

    public function collection()
    {
    }

    public function view(): View
    {
        {
            return view('employ.bulk.export_internal_edit',['employes'=>$this->employes]);
        }
    }

}


