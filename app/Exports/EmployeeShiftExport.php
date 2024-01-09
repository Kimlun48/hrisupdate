<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Karyawan;
use App\Models\Presensi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\AutoFilter;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EmployeeShiftExport implements FromView
{
    private $absen;
    private $shift;
    private $dateRange;

    public function __construct($absen, $dateRange, $shift)
    {
        $this->absen = $absen;
        $this->dateRange = $dateRange;
        $this->shift = $shift;
    }

    use Exportable;

    public function view(): View
    {
        return view('shift.employee_shift', [
            'absen' => $this->absen,
            'dateRange' => $this->dateRange,
            'shift' => $this->shift,
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Mengatur seluruh sel dalam kolom agar teks tidak mematahkan baris (text nowrap)
                $event->sheet->getStyle('A1:' . $event->sheet->getHighestColumn() . $event->sheet->getHighestRow())
                    ->getAlignment()
                    ->setWrapText(true);

                // Mengatur kolom agar teks berada di tengah (center-align)
                $event->sheet->getStyle('A1:' . $event->sheet->getHighestColumn() . $event->sheet->getHighestRow())
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}


