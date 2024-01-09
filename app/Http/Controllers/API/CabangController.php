<?php

namespace App\Http\Controllers\API;

use App\Models\Cabang;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CabangResource;
class CabangController extends Controller
{
    public function index()
    {
	$cab = Cabang::select('*')->where('status', '=', 'Aktif')->get();
        #$cab = Cabang::all();
	//$kot = KOta::latest()->paginate(5); untuk perhalaman
	return new CabangResource(true, 'List Data Cabang', $cab);
    }


}