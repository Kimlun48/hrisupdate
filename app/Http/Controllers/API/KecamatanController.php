<?php

namespace App\Http\Controllers\API;

use App\Models\Kecamatan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\KecamatanResource;

class KecamatanController extends Controller
{
    public function index()
    {
        //get posts
	//$kec = Kecamatan::latest()->paginate(5);
	$kec = Kecamatan::all();

        //return collection of posts as a resource
        return new KecamatanResource(true, 'List Data Kecamatan', $kec);
    }
	
}
