<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;

class DataImport implements ToModel
{
    public function model(array $row)
    {
        // Logic untuk mengembalikan model atau data dari setiap baris Excel
        // Contoh: return new YourModel($row);
    }
}
