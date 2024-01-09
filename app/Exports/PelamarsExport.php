<?php

namespace App\Exports;

use App\Models\Apllyloker;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Support\Responsable;

class PelamarsExport implements FromView
{
    private $list,$start_date,$end_date;
    public function __construct($list,$start_date,$end_date)
    {
        $this->list = $list;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('pelamar.export_employees',['list'=>$this->list,'start_date'=>$this->start_date,'end_date'=>$this->end_date]);
    }
}
