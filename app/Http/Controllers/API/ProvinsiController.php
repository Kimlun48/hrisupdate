<?php

namespace App\Http\Controllers\API;

use App\Models\Provinsi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProvinsiResource;
class ProvinsiController extends Controller
{
    public function index()
    {
	//$prov = Provinsi::latest()->paginate(5); ini Jika Jsonnya di per halaman (page)
	$prov = Provinsi::all();
        return new ProvinsiResource(true, 'List Data Provinsi', $prov);
    }
}
