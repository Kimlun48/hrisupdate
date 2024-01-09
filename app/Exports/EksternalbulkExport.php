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

class EksternalbulkExport implements FromView
{
    use Exportable;

    public function __construct()
    {
        //
    }

    public function collection()
    {
    }

    public function view(): View
    {
        {
            return view('employ.bulk.export_external');
        }
    }
}

