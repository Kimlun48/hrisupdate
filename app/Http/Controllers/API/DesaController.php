<?php

namespace App\Http\Controllers\API;

use App\Models\Desa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\DesaResource;
class DesaController extends Controller
{
    public function index()
    {
	//$posts = Desa::latest()->paginate(5);
        $posts = Desa::all();
	return new DesaResource(true, 'List Data Desa', $posts);
    }
    //
}
