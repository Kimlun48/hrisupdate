<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ShiftHeader;

class ShiftHeaderController extends Controller
{
    public function index()
    {
        $users = ShiftHeader::get();
        return view('cusers', compact('users'));
    }

    public function export()
    {
        return Excel::download(new ShiftHeader, 'shift_header.xlsx');
    }

    public function import()
    {
        Excel::import(new ShiftHeader, request()->file('file'));
        return back();
    }
}

