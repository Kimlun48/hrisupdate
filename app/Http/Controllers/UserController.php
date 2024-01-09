<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use app\Models\User;

class UserController extends Controller
{
    public function eximp()
    {
        $users = User::get();
        return view('eximp.eximpusers', compact('users'));
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function import()
    {
        try {
            $file = request()->file('fileimportinter');
            if (!$file) {
                throw new Exception('Silakan pilih file untuk diunggah.');
            }
            Excel::import(new UsersImport, $file);
            return response()->json(['message' => 'Data karyawan berhasil diimport!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat mengimport data karyawan: ' . $e->getMessage()], 500);
        }
    }
}

