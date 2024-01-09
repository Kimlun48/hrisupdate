<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perusahaan;
use App\Http\Resources\ApiPerusahaanResource;
class ApiPerusahaanController extends Controller
{
    public function index()
    {
        #$pt = Perusahaan::all();
        $pt = Perusahaan::where('status', 'Aktif')->with('cabang_pt.loker')->get();
	return new ApiPerusahaanResource(true, 'List Data Perushaan', $pt);
    }
}		
