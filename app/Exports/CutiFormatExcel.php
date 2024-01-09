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
class CutiFormatExcel implements FromView
{

    // private $kar;
    public function __construct()
    {
        // $this->kar = $kar;
    }

    use Exportable;

    public function collection()
    {
    }

    public function view(): View
    {
    {
        return view('cuti.cutiformatexcel');
    }
  }
}

