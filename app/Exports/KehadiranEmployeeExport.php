<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use App\Models\Presensi;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\WithTitle;


class KehadiranEmployeeExport implements FromView, WithTitle
{
    private 
      $dateRange
    , $shift 
    , $absen 
    , $startdate
    , $enddate;
    public function __construct($dateRange,$shift,$absen,$startdate,$enddate)
    {
        $this->dateRange = $dateRange;
        $this->shift     = $shift;
        $this->absen     = $absen;
        $this->startdate = $startdate;
        $this->enddate   = $enddate;
    }

    public function title(): string
    {
        $st =  $this->startdate;
        $nd =  $this->enddate;
        $worksheetname = $st . 's/d' . $nd;
        return $worksheetname;
    }

    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        return view('shift.kehadiran_employee',['dateRange'=>$this->dateRange,
        'shift'=>$this->shift,
        'absen'=>$this->absen, 
        'startdate'=>$this->startdate, 
        'enddate'=>$this->enddate]);
    }
}

