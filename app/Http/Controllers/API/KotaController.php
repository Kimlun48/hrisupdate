<?php

namespace App\Http\Controllers\API;

use App\Models\Kota;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\KotaResource;
class KotaController extends Controller
{
    public function index()
    {
        $kot = Kota::all();
	//$kot = KOta::latest()->paginate(5); untuk perhalaman
	return new KotaResource(true, 'List Data Kota', $kot);
    }
}
